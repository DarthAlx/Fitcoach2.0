<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Orden;
use App\Particular;
use App\Residencial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Cart;
use App\User;
use App\Tarjeta;
use App\Direccion;
use App\Folio;
use Mail;
class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartinst(Request $request)
    {
      if ($request->tipo=="Residencial") {
        $clase=Residencial::find($request->residencial_id);
        Cart::add($clase->id,$clase->clase->nombre,1,$clase->precio, ['tipo'=>'residencial','fecha' => $clase->fecha,'hora' => $clase->hora, 'coach' => $clase->user_id]);
      }
      if ($request->tipo=="Particular") {
        foreach ($request->carrito as $item) {
          $items=explode(",",$item);
          $clase=Particular::find($items[0]);
          Cart::add($clase->clase->id,$clase->clase->nombre,1,$clase->clase->precio, ['tipo'=>'particular','fecha' => $items[1],'hora' => $clase->hora, 'coach' => $clase->user_id]);
        }
      }
      $items=Cart::content();
      return view('cart.cart',['items'=>$items]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $user = User::findOrFail(1);
      $ordenes=Orden::where('order_id', $id)->get();
      $datos=Orden::where('order_id', $id)->first();
        Mail::send('emails.receipt', ['ordenes'=>$ordenes,'datos'=>$datos,'user'=>$user], function ($m) use ($user) {
            $m->from('alxunscarred@gmail.com', 'FITCOACH México');
            $m->to($user->email, $user->name)->subject('¡Orden recibida!');
        });
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ventas()
    {
      $month = date('m');
      $year = date('Y');
      $from= date('Y-m-d', mktime(0,0,0, $month, 1, $year));
      $day = date("d", mktime(0,0,0, $month+1, 0, $year));
      $to = date('Y-m-d', mktime(0,0,0, $month, $day, $year));

      $ventas = Orden::whereBetween('fecha', array($from, $to))->get();
      return view('admin.ventas',['ventas'=>$ventas]);
    }
    public function ventaspost(Request $request)
    {
      $from_n = strtotime ( $request->form )  ;
      $to_n = strtotime ( $request->to )  ;
      $from = date ( 'Y-m-d' , $from_n );
      $to = date ( 'Y-m-d' , $to_n );

      $ventas = Orden::whereBetween('fecha', array($from, $to))->get();
      return view('admin.ventas',['ventas'=>$ventas]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $orden = Orden::find($request->ordencancelar);
      $orden->status = 'cancelada';
      $orden->save();
      Session::flash('mensaje', '!Orden cancelada!');
      Session::flash('class', 'success');
      return redirect($this->redirectPath());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
      Cart::remove($rowId);
      Session::flash('mensaje', 'La clase se eliminó del carrito.');
      Session::flash('class', 'success');
      return redirect()->intended(url('/carrito'));
    }
    public function cargartarjeta(Request $request)
    {
      $tarjeta = Tarjeta::find($request->tarjeta);

      echo $tarjeta->num.",".$tarjeta->nombre.",".$tarjeta->mes.",".$tarjeta->año;
    }

    public function cargo(Request $request)
    {
      \Conekta\Conekta::setApiKey("key_fr9YE9Y98jxYQ9NJrJTZXw");
      $items=Cart::content();

      foreach ($items as $product) {
        $precio = $product->price;
        $decimales   = '.';
        $pos = strpos($precio, $decimales);
        if ($pos === false) {
            $precio_completo=$precio.".00";
        }
        else {
          $precio_completo=$product->price;
        }
        if ($product->options->tipo=="particular") {
          $productos[]=array(
            'name' => $product->name,
            'unit_price' => str_replace('.', '',$precio_completo),
            'quantity' => 1,
            'metadata' => array(
              'tipo' => 'particular',
              'id' => $product->id,
              'coach' => $product->options->coach,
              'fecha' => $product->options->fecha,
              'hora' => $product->options->hora
            )
          );
        }
        if ($product->options->tipo=="residencial") {
          $esresidencial=true;
          $productos[]=array(
            'name' => $product->name,
            'unit_price' => str_replace('.', '',$precio_completo),
            'quantity' => 1,
            'metadata' => array(
              'tipo' => 'residencial',
              'id' => $product->id,
              'coach' => $product->options->coach,
              'fecha' => $product->options->fecha,
              'hora' => $product->options->hora
            )
          );
        }

      }



      try{
        $order=\Conekta\Order::create(array(
          'currency' => 'MXN',
          "customer_info" => array(
            "name" => $request->name,
            "email" => $request->email,
            "phone" => "+521".$request->phone
          ), //customer_info
          'line_items' => $productos,
          'charges' => array(
            array(
              'payment_method' => array(
                'type' => 'card',
                "token_id" => $request->tokencard
              )
            )
          )
        ));

        if ($request->tarjeta==""&&$request->identificadortarjeta) {
          $tarjeta = new Tarjeta();
          $tarjeta->identificador = $request->identificadortarjeta;
          $tarjeta->num= $request->numero;
          $tarjeta->nombre = $request->nombre;
          $tarjeta->mes = $request->mes;
          $tarjeta->año = $request->año;
          $tarjeta->user_id = Auth::user()->id;
          $tarjeta->save();
        }

        if ($request->direccion==""&&$request->esresidencial!="true") {
          $direccion = new Direccion();
          $direccion->identificador=$request->identificadordireccion;
          $direccion->calle=$request->calle;
          $direccion->numero_ext=$request->numero_ext;
          $direccion->numero_int=$request->numero_int;
          $direccion->colonia=$request->colonia;
          $direccion->municipio_del=$request->municipio_del;
          $direccion->cp=$request->cp;
          $direccion->estado=$request->estado;
          $direccion->user_id = Auth::user()->id;
          $direccion->save();
        }
        $folio=Folio::first();
        foreach ($productos as $producto) {
          $guardar = new Orden();
          $guardar->order_id=$order->id;
          $guardar->folio=$folio->folio;
          $guardar->user_id=Auth::user()->id;
          $guardar->coach_id=$producto['metadata']['coach'];
          $guardar->nombre=$producto['name'];
          $guardar->fecha=$producto['metadata']['fecha'];
          $guardar->hora=$producto['metadata']['hora'];
          $guardar->cantidad=$producto['unit_price'];
          $guardar->metadata=implode(",", $producto['metadata']);
          $guardar->status='pagada';
          $guardar->save();
          if ($producto['metadata']['tipo']=="residencial") {
            $residencial= Residencial::find($producto['metadata']['id']);
            $residencial->ocupados++;
            $residencial->save();
          }

        }
        $folio->folio++;
        $folio->save();

        Cart::destroy();

        Session::flash('mensaje', "!Orden completada! revisa <a class='alert-link' href='".url('/mis-ordenes')."'>tus ordenes.</a>");
        Session::flash('class', 'success');
        return redirect()->intended(url('/recibo')."/".$order->id);

      } catch (\Conekta\ProccessingError $error){
        Session::flash('mensaje', $error->getMessage());
        Session::flash('class', 'danger');
        return redirect()->intended(url('/carrito'));
      } catch (\Conekta\ParameterValidationError $error){

        Session::flash('mensaje', $error->getMessage());
        Session::flash('class', 'danger');
        return redirect()->intended(url('/carrito'));

      } catch (\Conekta\Handler $error){
        Session::flash('mensaje', $error->getMessage());
        Session::flash('class', 'danger');
        return redirect()->intended(url('/carrito'));
      }



      }


      public function receipt($id)
      {
        $ordenes=Orden::where('order_id', $id)->get();
        $datos=Orden::where('order_id', $id)->first();
        $user=User::find($datos->user_id);
        return view('recibo',['ordenes'=>$ordenes,'datos'=>$datos,'user'=>$user]);
      }

      public function invoice($id)
    {
        $ordenes=Orden::where('order_id', $id)->get();
        $datos=Orden::where('order_id', $id)->first();
        $user=User::find($datos->user_id);
        $view =  \View::make('emails.receipt', ['ordenes'=>$ordenes,'datos'=>$datos,'user'=>$user])->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }

      public function redirectPath()
      {
        $usuario = User::find(Auth::user()->id);
        if (Auth::user()->role=="superadmin" || Auth::user()->role=="admin") {
          return url('/admin');
        }
        if (Auth::user()->role=="instructor") {
          return url('/perfilinstructor');
        }
        else {
            return url('/perfil');
        }


      }
    }
