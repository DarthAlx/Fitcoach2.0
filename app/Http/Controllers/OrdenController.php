<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Orden;
use App\Pago;
use App\Particular;
use App\Residencial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Cart;
use App\Abono;
use App\User;
use App\Tarjeta;
use App\Direccion;
use App\Folio;
use App\Cupon;
use App\Cuponera;
use Mail;
use Input;
class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartinst(Request $request)
    {
      $esresidencial=false;
      if (Cart::content()->count()>0){
      $items=Cart::content();
        foreach ($items as $product){
          if ($product->options->tipo=="residencial"){
            $esresidencial=true;
          }
        }

      }

      if (($request->tipo=="Residencial"||$request->tipo=="Evento")&&($esresidencial==true||Cart::content()->count()==0)) {
        $clase=Residencial::find($request->residencial_id);

        if ($request->tipo=="Residencial") {
          Cart::add($clase->id,$clase->clase->nombre,1,$clase->precio, ['tipo'=>'residencial','fecha' => $clase->fecha,'hora' => $clase->hora, 'coach' => $clase->user_id]);
          Session::flash('mensaje', 'La clase que vas a reservar es únicamente para condóminos del residencial '.$clase->condominio->identificador.'. <br>
  No habrá cambios o devoluciones si eres externo y no puedes tomarla.');
          Session::flash('class', 'warning');
        }
        if ($request->tipo=="Evento") {

          Cart::add($clase->id,$clase->nombreevento,1,$clase->precio, ['tipo'=>'residencial','fecha' => $clase->fecha,'hora' => $clase->hora, 'coach' => $clase->user_id]);
        }
      }
      elseif($request->tipo=="Particular"&&$esresidencial==false) {
        foreach ($request->carrito as $item) {
          $items=explode(",",$item);
          $clase=Particular::find($items[0]);
          $zona=$clase->zona->identificador;

          if ($clase->clase->precio_especial) {
            $precio=$clase->clase->precio_especial;
          }
          else {
            $precio=$clase->clase->precio;
          }
          Cart::add($clase->clase->id,$clase->clase->nombre,1,$precio, ['tipo'=>'particular','fecha' => $items[1],'hora' => $clase->hora, 'coach' => $clase->user_id]);
          Session::flash('mensaje', 'La clase que vas a reservar es únicamente para la zona '.$zona.'.<br>
  No habrá cambios o devoluciones si no estas en la zona y no es posible para el coach asistir.');
          Session::flash('class', 'warning');
        }
      }
      else{
        Session::flash('mensaje', 'Aún no termina el proceso con otra clase.');
        Session::flash('class', 'danger');

      }
      $items=Cart::content();
      return redirect()->intended(url('/carrito'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */




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

      $ventas = Orden::whereBetween('created_at', array($from, $to))->get();
      return view('admin.ventas',['ventas'=>$ventas,'from'=>$from,'to'=>$to]);
    }

    public function ventaspost(Request $request)
    {
      $from_n = strtotime ( $request->from )  ;
      $to_n = strtotime ( $request->to )  ;
      $from = date ( 'Y-m-d' , $from_n );
      $to = date ( 'Y-m-d' , $to_n );

      $ventas = Orden::whereBetween('created_at', array($from, $to))->get();
      return view('admin.ventas',['ventas'=>$ventas,'from'=>$request->from,'to'=>$request->to]);

    }
    public function clasesvista()
    {
      $month = date('m');
      $year = date('Y');
      $from= date('Y-m-d', mktime(0,0,0, $month, 1, $year));
      $day = date("d", mktime(0,0,0, $month+1, 0, $year));
      $to = date('Y-m-d', mktime(0,0,0, $month, $day, $year));
      $clases = Orden::whereBetween('fecha', array($from, $to))->get();
      return view('admin.clasesvista',['clases'=>$clases,'from'=>$from,'to'=>$to,'status'=>'*']);
    }

    public function clasesvistapost(Request $request)
    {
      $from_n = strtotime ( $request->from )  ;
      $to_n = strtotime ( $request->to )  ;
      $from = date ( 'Y-m-d' , $from_n );
      $to = date ( 'Y-m-d' , $to_n );

      if (!$request->status) {
        $clases = Orden::whereBetween('fecha', array($from, $to))->get();

      }
      elseif ($request->status=="*") {
        $clases = Orden::whereBetween('fecha', array($from, $to))->get();
      }
      else {
        $clases = Orden::where('status', $request->status)->whereBetween('fecha', array($from, $to))->get();

      }

      return view('admin.clasesvista',['clases'=>$clases,'from'=>$request->from,'to'=>$request->to,'status'=>$request->status]);

    }

    public function comentarios(Request $request)
    {
      $coment = Orden::find($request->orden_id);
      $coment->comentarios=$request->comentarios;
      $coment->save();
      Session::flash('mensaje', 'Comentario hecho.');
      Session::flash('class', 'success');
      return redirect()->intended(url('/clasesvista'));

    }

    public function abonar(Request $request)
    {
      $orden = Orden::find($request->orden_id);
      $orden->status="Completa";
      $orden->save();
      $abono = new Abono($request->all());
      $abono->save();
      Session::flash('mensaje', 'Abono completado.');
      Session::flash('class', 'success');
      return redirect()->intended(url('/clasesvista'));
    }

    public function cancelar(Request $request)
    {


      if ($request->tipocancelacion=="cupon") {
        $cupon=Cupon::where('codigo', $request->abono)->first();
        if ($cupon) {
          $user=User::find($cupon->user->id);

            Mail::send('emails.cupon', ['cupon'=>$cupon,'user'=>$user], function ($m) use ($user) {
                $m->from('fitcoach.notificaciones@gmail.com', 'FITCOACH México');
                $m->to($user->email, $user->name)->subject('¡Tu cupón de reembolso!');
            });

            $orden = Orden::find($request->orden_id);
            $orden->status="Cancelada";
            $orden->metadata="cupon enviado";
            $orden->save();
            //$this->sendclasscancel($orden->id);
          Session::flash('mensaje', 'Cupón enviado.');
          Session::flash('class', 'success');
        }
        else {
          Session::flash('mensaje', 'No existe el cupón.');
          Session::flash('class', 'danger');
        }


      }
      else {
        $abono = new Abono($request->all());
        $abono->save();
        $orden = Orden::find($request->orden_id);
        $orden->status="Cancelada";
        $orden->metadata="abonada a coach";
        $orden->save();
        $this->sendclasscancel($orden->id);
        Session::flash('mensaje', 'Abono completado.');
        Session::flash('class', 'success');
      }


      return redirect()->intended(url('/clasesvista'));
    }






    public function terminar(Request $request)
    {
      $orden = Orden::find($request->revision);
      $orden->status = 'Porrevisar';
      $orden->save();
      Session::flash('mensaje', '¡Orden en revisión!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/perfilinstructor'));

    }



    public function nomina()
    {
      $coaches = User::where('role', 'instructor')->get();
      return view('admin.nomina',['coaches'=>$coaches]);
    }

    public function pago(Request $request)
    {
      $guardar = new Pago($request->all());
      $fe = strtotime ( $request->fecha )  ;
      $guardar->fecha= date('Y-m-d',$fe);
      $guardar->save();

      $coach = User::find($request->user_id);
      $pendiente=0;
      foreach ($coach->abonos as $abono) {
        $pendiente= $pendiente + $abono->abono;
      }
      if ($request->monto==$pendiente) {
        foreach ($coach->abonos as $abono) {
          $abono->delete();
        }
        $this->sendpayment($guardar->id);
        Session::flash('mensaje', 'El pago se realizó con éxito.');
        Session::flash('class', 'success');
        return redirect()->intended(url('/nomina'));
      }elseif ($request->monto<$pendiente) {
        foreach ($coach->abonos as $abono) {
          $abono->delete();

        }
        $abono = new Abono();
        $abono->user_id=$coach->id;
        $abono->abono=$pendiente-$request->monto;
        $abono->save();
        $this->sendpayment($guardar->id);
        Session::flash('mensaje', 'El pago se realizó con éxito.');
        Session::flash('class', 'success');
        return redirect()->intended(url('/nomina'));
      }
      else {
        Session::flash('mensaje', 'Hubo un error en las cantidades.');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/nomina'));
      }





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
      $orden->status = 'Cancelada';
      $orden->metadata=$request->tipocancelacion;
      $orden->save();
      Session::flash('mensaje', '¡Orden Cancelada!');
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
      \Conekta\Conekta::setApiKey("key_WEAWMZsySp6ai1FaB9dd2A");
      $items=Cart::content();
      foreach ($items as $product){
        if ($product->id=="Desc"){
          $descuento=$product; $tienedescuento=true; break;
        }else{
          $tienedescuento=false;
        }
      }




      foreach ($items as $product) {


        $precio = $product->price*100;

        if ($product->options->tipo=="particular") {
          $productos[]=array(
            'name' => $product->name,
            'unit_price' => $precio,
            'quantity' => 1,
            'metadata' => array(
              'tipo' => 'particular',
              'asociado' => $product->id,
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
            'unit_price' => $precio,
            'quantity' => 1,
            'metadata' => array(
              'tipo' => 'residencial',
              'id' => $product->id,
              'asociado' => $product->id,
              'coach' => $product->options->coach,
              'fecha' => $product->options->fecha,
              'hora' => $product->options->hora
            )
          );
        }

        if ($product->id=="Desc"){
          $descuentos[]=array(
            'code'   => $product->name,
            'amount' => $precio*-1,
            'type'   => 'coupon'
          );
        }


      }



      try{
        if ($tienedescuento) {
          $order=\Conekta\Order::create(array(
            'currency' => 'MXN',
            "customer_info" => array(
              "name" => ''.$request->name,
              "email" => ''.$request->email,
              "phone" => "+521".$request->phone
            ), //customer_info
            'line_items' => $productos,
            'discount_lines' => $descuentos,
            'charges' => array(
              array(
                'payment_method' => array(
                  'type' => 'card',
                  "token_id" => $request->tokencard
                )
              )
            )
          ));
        }
        else {
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
        }



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
          $guardar->folio="W".$folio->folio;
          $guardar->user_id=Auth::user()->id;
          $guardar->coach_id=$producto['metadata']['coach'];
          $guardar->asociado=$producto['metadata']['asociado'];
          $guardar->tipo=$producto['metadata']['tipo'];
          if ($producto['metadata']['tipo']=="residencial") {
            $residencial=Residencial::find($producto['metadata']['asociado']);
            if ($residencial->tipo=="Evento") {
              $guardar->direccion=$residencial->direccionevento;
            }
            elseif ($residencial->tipo=="Residencial") {
              $guardar->direccion=$residencial->condominio->identificador.". ".$residencial->condominio->direccion;
            }

          }else {
            if ($request->direccion==""&&$request->esresidencial!="true") {
              $guardar->direccion=$direccion->id;
            }
            else {
              $guardar->direccion=$request->direccion;
            }

          }
          $guardar->nombre=$producto['name'];
          $guardar->fecha=$producto['metadata']['fecha'];
          $guardar->hora=$producto['metadata']['hora'];
          $guardar->cantidad=$producto['unit_price']/100;
          $guardar->status='Proxima';
          $guardar->save();
          if ($producto['metadata']['tipo']=="residencial") {
            $residencial= Residencial::find($producto['metadata']['asociado']);
            $residencial->ocupados++;
            $residencial->save();
          }

        }

        foreach ($items as $product) {
          if ($product->id=="Desc"){
            $cupon=Cuponera::find($product->options->id);
            $cupon->orden_id=$order->id;
            $cupon->save();
          }


        }


        $folio->folio++;
        $folio->save();

        Cart::destroy();
        $this->sendinvoice($order->id);
        $this->sendclassrequest($order->id);
        Session::flash('total', $order->amount);
        return redirect()->intended(url('/completa'));

      } catch (\Conekta\ProccessingError $error){
        Session::flash('mensaje', $error->getMessage());
        Session::flash('class', 'danger');
        return redirect()->intended(url('/carrito'))->withInput();
      } catch (\Conekta\ParameterValidationError $error){

        Session::flash('mensaje', $error->getMessage());
        Session::flash('class', 'danger');
        return redirect()->intended(url('/carrito'))->withInput();

      } catch (\Conekta\Handler $error){
        Session::flash('mensaje', $error->getMessage());
        Session::flash('class', 'danger');
        return redirect()->intended(url('/carrito'))->withInput();
      }



      }
      public function probarcomplete(){
              Session::flash('total', "500.00");
              return view('cart.complete');
            }
            public function complete(){
              return view('cart.complete');
            }

      public function receipt($id)
      {
        $ordenes=Orden::where('order_id', $id)->get();
        $datos=Orden::where('order_id', $id)->first();
        $user=User::find($datos->user_id);
        return view('recibo',['ordenes'=>$ordenes,'datos'=>$datos,'user'=>$user]);
      }
      public function verinvoice($id)
      {
        $ordenes=Orden::where('order_id', $id)->get();
        $datos=Orden::where('order_id', $id)->first();
        $user=User::find($datos->user_id);
        return view('emails.receipt',['ordenes'=>$ordenes,'datos'=>$datos,'user'=>$user]);
      }
      public function invoice($id)
    {
        $ordenes=Orden::where('order_id', $id)->get();
        $datos=Orden::where('order_id', $id)->first();
        $user=User::find($datos->user_id);
        $view =  \View::make('emails.receipt', ['ordenes'=>$ordenes,'datos'=>$datos,'user'=>$user])->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf');
    }
    public function sendinvoice($id)
    {
      $ordenes=Orden::where('order_id', $id)->get();
      $datos=Orden::where('order_id', $id)->first();
      $user=User::find($datos->user_id);
        Mail::send('emails.receiptmail', ['ordenes'=>$ordenes,'datos'=>$datos,'user'=>$user], function ($m) use ($user) {
            $m->from('fitcoach.notificaciones@gmail.com', 'FITCOACH México');
            $m->to($user->email, $user->name)->subject('¡Orden recibida!');
        });
    }

    public function sendclassrequest($id)
    {
      $ordenes=Orden::where('order_id', $id)->get();
      $datos=Orden::where('order_id', $id)->first();
      $user=User::find($datos->coach_id);
        Mail::send('emails.recibida', ['ordenes'=>$ordenes,'datos'=>$datos,'user'=>$user], function ($m) use ($user) {
            $m->from('fitcoach.notificaciones@gmail.com', 'FITCOACH México');
            $m->to($user->email, $user->name)->subject('¡Nueva clase agendada!');
        });
    }

    public function sendclasscancel($id)
    {
      $ordenes=Orden::where('id', $id)->get();
      $datos=Orden::where('id', $id)->first();
      $user=User::find($datos->coach_id);
        Mail::send('emails.cancelada', ['ordenes'=>$ordenes,'datos'=>$datos,'user'=>$user], function ($m) use ($user) {
            $m->from('fitcoach.notificaciones@gmail.com', 'FITCOACH México');
            $m->to($user->email, $user->name)->subject('¡Cancelación de clase!');
        });
    }
    public function sendpayment($id)
    {
      $pago=Pago::find($id);

      $user=$pago->user;
        Mail::send('emails.pago', ['pago'=>$pago,'user'=>$user], function ($m) use ($user) {
            $m->from('fitcoach.notificaciones@gmail.com', 'FITCOACH México');
            $m->to($user->email, $user->name)->subject('¡Nuevo pago!');
        });
    }

    public function historialpagos($id)
    {
    $user=User::find($id);
    $pagos=$user->pagos;
    $view =  \View::make('emails.historial', ['pagos'=>$pagos,'user'=>$user])->render();
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($view);
    return $pdf->stream('invoice.pdf');
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
