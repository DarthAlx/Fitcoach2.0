<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Orden;
use App\Particular;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Cart;
use App\User;
use App\Tarjeta;
use App\Direccion;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartinst(Request $request)
    {
      foreach ($request->carrito as $item) {

        $items=explode(",",$item);
        $clase=Particular::find($items[0]);
        Cart::add($clase->clase->id,$clase->clase->nombre,1,$clase->clase->precio, ['tipo'=>$clase->clase->tipo,'fecha' => $items[1],'hora' => $clase->hora, 'coach' => $clase->user_id]);
      }


    $items=Cart::content();
    return view('cart.cart',['items'=>$items]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($id)
    {
        //
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
      Session::flash('mensaje', 'Orden cancelada!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/perfil'));
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

        if ($request->direccion=="") {
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

        foreach ($productos as $producto) {
          $guardar = new Orden();
          $guardar->order_id=$order->id;
          $guardar->user_id=Auth::user()->id;
          $guardar->coach_id=$producto['metadata']['coach'];
          $guardar->nombre=$producto['name'];
          $guardar->fecha=$producto['metadata']['fecha'];
          $guardar->hora=$producto['metadata']['hora'];
          $guardar->cantidad=$producto['unit_price'];
          $guardar->metadata=implode(",", $producto['metadata']);
          $guardar->status='pagada';
          $guardar->save();
        }
        Cart::destroy();

        Session::flash('mensaje', "Orden completada! revisa <a class='alert-link' href='".url('/mis-ordenes')."'>tus ordenes.</a>");
        Session::flash('class', 'success');
        return redirect()->intended(url('/carrito'));

        } catch (\Conekta\ProccessingError $error){
          Session::flash('mensaje', $error->getMesage());
          Session::flash('class', 'danger');
          return redirect()->intended(url('/carrito'));
        } catch (\Conekta\ParameterValidationError $error){
          Session::flash('mensaje', $error->getMesage());
          Session::flash('class', 'danger');
          return redirect()->intended(url('/carrito'));
        }
        } catch (\Conekta\Handler $error){
          Session::flash('mensaje', $error->getMesage());
          Session::flash('class', 'danger');
          return redirect()->intended(url('/carrito'));
        }
    }
}
