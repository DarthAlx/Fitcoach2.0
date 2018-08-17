<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Orden;
use App\Pago;
use App\Particular;
use App\Horario;
use App\Grupo;
use App\Reservacion;
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
use App\Paquete;
use App\PaqueteComprado;
use Mail;
use Input;
use Openpay;
use Cookie;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartinst(Request $request)
    {
      //dd($request->all());
      $esresidencial=false;
      if (Cart::content()->count()>0){
      $items=Cart::content();
        foreach ($items as $product){
          if ($product->options->tipo=="residencial"){
            $esresidencial=true;
          }
        }

      }

      if (($request->tipo=="En condominio"||$request->tipo=="Evento")&&($esresidencial==true||Cart::content()->count()==0)) {

        foreach ($request->carrito as $item) {
          if ($request->tipo=="En condominio") {
            $items=explode(",",$item);
            $clase=Horario::find($items[0]);
            Cart::add($clase->id,$clase->clase->nombre,1,$items[2], ['tipo'=>'residencial','fecha' => $items[1],'hora' => $clase->hora, 'coach' => $clase->user_id]);
            Session::flash('mensaje', 'La clase que vas a reservar es únicamente para condóminos del residencial '.$clase->grupo->condominio->identificador.'. <br>
  No habrá cambios o devoluciones si eres externo y no puedes tomarla.');
            Session::flash('class', 'warning');
          }
          if ($request->tipo=="Evento") {

            Cart::add($clase->id,$clase->nombreevento,1,$clase->precio, ['tipo'=>'residencial','fecha' => $clase->fecha,'hora' => $clase->hora, 'coach' => $clase->user_id]);
          }
        }
        
      }
      elseif($request->tipo=="A domicilio"&&$esresidencial==false) {
        foreach ($request->carrito as $item) {
          $items=explode(",",$item);
          $clase=Horario::find($items[0]);
          $zona=$clase->zona->identificador;

          if ($clase->clase->precio_especial) {
            $precio=$clase->clase->precio_especial;
          }
          else {
            $precio=$clase->clase->precio;
          }
          Cart::add($clase->id,$clase->clase->nombre,1,0, ['tipo'=>'particular','fecha' => $items[1],'hora' => $clase->hora, 'coach' => $clase->user_id]);
          Session::flash('mensaje', 'La clase que vas a reservar es únicamente para la zona '.$zona.'.<br>
  No habrá cambios o devoluciones si no estas en la zona y no es posible para el COACH asistir.');
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
      $clases = Reservacion::whereBetween('fecha', array($from, $to))->get();
      return view('admin.clasesvista',['clases'=>$clases,'from'=>$from,'to'=>$to,'status'=>'*']);
    }

    public function clasesvistapost(Request $request)
    {
      $from_n = strtotime ( $request->from )  ;
      $to_n = strtotime ( $request->to )  ;
      $from = date ( 'Y-m-d' , $from_n );
      $to = date ( 'Y-m-d' , $to_n );

      if (!$request->status) {
        $clases = Reservacion::whereBetween('fecha', array($from, $to))->get();

      }
      elseif ($request->status=="*") {
        $clases = Reservacion::whereBetween('fecha', array($from, $to))->get();
      }
      else {
        $clases = Reservacion::where('status', $request->status)->whereBetween('fecha', array($from, $to))->get();

      }

      return view('admin.clasesvista',['clases'=>$clases,'from'=>$request->from,'to'=>$request->to,'status'=>$request->status]);

    }

    public function comentarios(Request $request)
    {
      $coment = Reservacion::find($request->orden_id);
      $coment->comentarios=$request->comentarios;
      $coment->save();
      Session::flash('mensaje', 'Comentario hecho.');
      Session::flash('class', 'success');
      return redirect()->intended(url('/clasesvista'));

    }

    public function abonar(Request $request)
    {
      $orden = Reservacion::find($request->reservacion_id);
      if ($orden->tipo=='En condominio') {
        $ordenes=Reservacion::where('nombre',$orden->nombre)->where('fecha',$orden->fecha)->where('hora',$orden->hora)->get();
        foreach ($ordenes as $ordenr) {
          $ordenr->status = 'COMPLETA';
          $ordenr->save();
        }
      }
      else{
      $orden->status="COMPLETA";
      $orden->save();
      }
      
      $abono = new Abono($request->all());
      $abono->save();
      Session::flash('mensaje', 'Abono completado.');
      Session::flash('class', 'success');
      return redirect()->intended(url('/clasesvista'));
    }

    public function cancelar(Request $request)
    {


      


      if ($request->tipocancelacion=="token") {
        $orden = Reservacion::find($request->id);
        

        if($orden->status!="CANCELADA"){
          if($orden->tipo=="En condominio"&&$residencial){

            $ordenes=Reservacion::where('nombre',$orden->nombre)->where('fecha',$orden->fecha)->where('hora',$orden->hora)->get();
            foreach ($ordenes as $ordenr) {
              $residencial=PaqueteComprado::where('user_id', $ordenr->user_id)->where('tipo','En condominio')->orderBy('expiracion','desc')->first();

              $residencial->disponibles=$residencial->disponibles+$orden->tokens;        
              $residencial->save();
              $ordenr->status='CANCELADA';
              $ordenr->metadata="token devuelto";
              Session::flash('mensaje', 'Token devuelto.');
              Session::flash('class', 'success');
              $ordenr->save();
            }


            
          }
          elseif($orden->tipo=="A domicilio"&&$particular){
            $particular=PaqueteComprado::where('user_id', $orden->user_id)->where('tipo','A domicilio')->orderBy('expiracion','desc')->first();

            $particular->disponibles=$particular->disponibles+$orden->tokens;
            /*$fecha = date('Y-m-d',$particular->expiracion);
            $nuevafecha = strtotime ( '+5 day' , strtotime ( $fecha ) ) ;
            $particular->expiracion = date ( 'Y-m-d' , $nuevafecha );*/
            $particular->save();
            $orden->status='CANCELADA';
            $orden->metadata="token devuelto";
            Session::flash('mensaje', 'Token devuelto.');
            Session::flash('class', 'success');
            $orden->save();
          }

          else{
            Session::flash('mensaje', 'No se realizó ninguna operación.');
            Session::flash('class', 'danger');
          }

          


        //$this->sendclasscancel($orden->id);
          
        }//clasecancelada
        
        else{
          Session::flash('mensaje', 'La clase ya fué cancelada.');
          Session::flash('class', 'danger');
        }
      }
      else {
        


        $orden = Reservacion::find($request->id);
        if ($orden->tipo=='En condominio') {
          
          $ordenes=Reservacion::where('nombre',$orden->nombre)->where('fecha',$orden->fecha)->where('hora',$orden->hora)->get();
          foreach ($ordenes as $ordenr) {
            $ordenr->status='CANCELADA';
            $ordenr->metadata="abonada a coach";
            $ordenr->save();
          }
        }
        else{
          $orden->status='CANCELADA';
          $orden->metadata="abonada a coach";
          $orden->save();
        }


        $abono = new Abono($request->all());
        $abono->abono=$request->abono;
        $abono->reservacion_id=$orden->id;
        $abono->save();
        
        //$this->sendclasscancel($orden->id);
        Session::flash('mensaje', 'Abono completado.');
        Session::flash('class', 'success');
      }


      return redirect()->intended(url('/clasesvista'));
    }






    public function terminar(Request $request)
    {
      $orden = Reservacion::find($request->revision);
      
      if ($orden->tipo=='En condominio') {
        $ordenes=Reservacion::where('nombre',$orden->nombre)->where('fecha',$orden->fecha)->where('hora',$orden->hora)->get();
        foreach ($ordenes as $ordenr) {
          $ordenr->status = 'EN REVISIÓN';
          $ordenr->aforo=$request->aforo;
          $ordenr->save();
        }
      }
      else{
        $orden->status = 'EN REVISIÓN';
        $orden->aforo=$request->aforo;
        $orden->save();
      }
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
      if($request->monto>$pendiente){
            $referenciados=User::where('referencia',$coach->code.'-ganado')->get();
            foreach($referenciados as $referenciado){
              $referenciado->referencia=$coach->code.'-pagado';
              $referenciado->save();
            }
            
            foreach ($coach->abonos as $abono) {
              $abono->delete();
            }
            $this->sendpayment($guardar->id);
            Session::flash('mensaje', 'El pago se realizó con éxito.');
            Session::flash('class', 'success');
            return redirect()->intended(url('/nomina'));
      }
      elseif ($request->monto==$pendiente) {
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
      $user=User::find(Auth::user()->id);

      if ($request->tipocancelacion=="24 horas antes") {
              $orden = Reservacion::find($request->ordencancelar);
              if($orden->status!="CANCELADA"){
                $particular=PaqueteComprado::where('user_id', $user->id)->where('tipo','A domicilio')->orderBy('expiracion','desc')->first();
                $residencial=PaqueteComprado::where('user_id', $user->id)->where('tipo','En condominio')->orderBy('expiracion','desc')->first();
                if($orden->tipo=="En condominio"&&$residencial){
                  $residencial->disponibles=$residencial->disponibles+$orden->tokens;
                  /*$fecha = date('Y-m-d',$residencial->expiracion);
                  $nuevafecha = strtotime ( '+5 day' , strtotime ( $fecha ) ) ;
                  $residencial->expiracion = date ( 'Y-m-d' , $nuevafecha );*/
                  $residencial->save();
                  $orden->status='CANCELADA';
                  $orden->metadata="token devuelto";
                  Session::flash('mensaje', 'Token devuelto.');
                  Session::flash('class', 'success');
                }
                elseif($orden->tipo=="En condominio"&&$orden->tokens==0){
                  $orden->status='CANCELADA';
                  $orden->metadata="token devuelto";
                  Session::flash('mensaje', 'Participación cancelada.');
                  Session::flash('class', 'success');
                }
                elseif($orden->tipo=="A domicilio"&&$particular){
                  $particular->disponibles=$particular->disponibles+$orden->tokens;
                  /*$fecha = date('Y-m-d',$particular->expiracion);
                  $nuevafecha = strtotime ( '+5 day' , strtotime ( $fecha ) ) ;
                  $particular->expiracion = date ( 'Y-m-d' , $nuevafecha );*/
                  $particular->save();
                  $orden->status='CANCELADA';
                  $orden->metadata="token devuelto";
                  Session::flash('mensaje', 'Token devuelto.');
                  Session::flash('class', 'success');
                  
                }
                else{
                  Session::flash('mensaje', 'No se realizó ninguna operación.');
                  Session::flash('class', 'danger');
                }
                
                $orden->save();


              //$this->sendclasscancel($orden->id);
                
              }else{
                Session::flash('mensaje', 'La clase ya fué cancelada.');
                Session::flash('class', 'danger');
              }

              
      }
      else{
              $orden = Reservacion::find($request->ordencancelar);
              $orden->status = 'CANCELADA';
              $orden->metadata=$request->tipocancelacion;
              $orden->save();
              Session::flash('mensaje', '¡Reservación Cancelada!');
              Session::flash('class', 'success');
              
      }
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
      require 'vendor/autoload.php';
      $user=User::find(Auth::user()->id);
      $paquete=Paquete::find($request->paquete);

      if(!$user->ordenes->isEmpty()&&$paquete->paquete=="Primer clase"){
        Session::flash('mensaje', "No eres candidato para esta promoción");
        Session::flash('class', 'danger');
        return back();
      }
      
      header('Content-Type: text/html; charset=utf-8');
      $openpay = Openpay::getInstance('mtxcxt534uf7g731pnty', 'sk_c1feb84d5c534a72a698e0d135e5d1d3');
      Openpay::setProductionMode(true);
          $customer = array(
           'name' => $user->name,
           'last_name' => "",
           'phone_number' => $user->tel,
           'email' => $user->email
            );
            $total=$paquete->precio;
            $descuento = Cookie::get('descuentofc'); 
            
            if($descuento){
              $cuponera =  Cuponera::find($descuento);
              $total=$total-$cuponera->monto;
              $desc=$cuponera->monto;
            }
            else{
              $desc=0;
            }
          //pago con tarjeta

            try {       
            $folio=Folio::first();

            $chargeData = array(
            'method' => 'card',
            'source_id' => $request->token_id,
            'amount' => $total,
            'currency' => 'MXN',
            'description' => "Paquete ".$paquete->paquete,
            'order_id' => $folio->folio,
            'device_session_id' => $_POST["deviceIdHiddenFieldName"],
            'customer' => $customer);

          
          

        $charge = $openpay->charges->create($chargeData);

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

        

          $guardar = new Orden();
          $guardar->order_id=$charge->id;
          $guardar->folio="W".$folio->folio;
          $guardar->user_id=Auth::user()->id;
          
         
          $guardar->cantidad=$total;
          $guardar->descuento=$desc;
          $guardar->status='PAGADA';
          $guardar->save();


          $paquetecomprado = new PaqueteComprado();
          $paquetecomprado->user_id=Auth::user()->id;
          $paquetecomprado->orden_id=$guardar->id;
          $paquetecomprado->clases=$paquete->num_clases;
          $paquetecomprado->disponibles=$paquete->num_clases;
          $paquetecomprado->tipo=$paquete->tipo;
          $paquetecomprado->fecha=date("Y-m-d");

          $fecha = date('Y-m-d');
          $nuevafecha = strtotime ( '+'.$paquete->dias.' day' , strtotime ( $fecha ) ) ;
          $expiracion = date ( 'Y-m-d' , $nuevafecha );
          $paquetecomprado->expiracion=$expiracion;
          $paquetecomprado->save();







        

          if($descuento){
            $cuponera->orden_id=$guardar->id;
            $cuponera->save();
          }


        


        $folio->folio++;
        $folio->save();

        $this->sendinvoice($guardar->id);
        //$this->sendclassrequest($order->id);
        //Session::flash('total', $order->amount);
        $cuantascompradas=0;

        if ($user->referencia!=""&&!str_contains($user->referencia, '-ganado')&&!str_contains($user->referencia, '-pagado')) {
          $clasescompradas=PaqueteComprado::where('user_id',$user->id)->get();
          foreach ($clasescompradas as $compradas) {
            $cuantascompradas=$cuantascompradas+$compradas->clases;
          }
          if ($cuantascompradas>=4) {
            $referente=User::where('code',$user->referencia)->first();

            if ($referente->role=="usuario") {
                  $particular=PaqueteComprado::where('user_id', $user->id)->where('tipo','A domicilio')->orderBy('expiracion','desc')->first();
                  $particular->disponibles=$particular->disponibles+1;
                  $fecha = date('Y-m-d',$particular->expiracion);
                  $nuevafecha = strtotime ( '+5 day' , strtotime ( $fecha ) ) ;
                  $particular->expiracion = date ( 'Y-m-d' , $nuevafecha );
                  $particular->save();
            }
            elseif ($referente->role=="instructor") {
              # code...
            }
            $user->referencia=$user->referencia.'-ganado';
            $user->save();
            

          }
        }
        return redirect()->intended(url('/completa'));





        
        
      









    }

//ERRORES
    catch (\OpenpayApiTransactionError $e) {
       $Motivo='ERROR de transacción: ' . $e->getMessage();
       Session::flash('mensaje', $Motivo);
        Session::flash('class', 'danger');
        return back();

    } catch (\OpenpayApiRequestError $e) {
      $Motivo='ERROR en la petición: ' . $e->getMessage();
      Session::flash('mensaje', $Motivo);
        Session::flash('class', 'danger');
        return back();

    } catch (\OpenpayApiConnectionError $e) {
      $Motivo='ERROR en la conexión: ' . $e->getMessage();
      Session::flash('mensaje', $Motivo);
        Session::flash('class', 'danger');
        return back();

    } catch (\OpenpayApiAuthError $e) {
      $Motivo='ERROR en la autenticación de la API: ' . $e->getMessage();
      Session::flash('mensaje', $Motivo);
        Session::flash('class', 'danger');
        return back();

    } catch (\OpenpayApiError $e) {
      $Motivo='ERROR de API: ' . $e->getMessage();
      Session::flash('mensaje', $Motivo);
        Session::flash('class', 'danger');
        return back();

    } catch (\Exception $e) {
      $Motivo='ERROR en el script: ' . $e->getMessage();
      Session::flash('mensaje', $Motivo);
        Session::flash('class', 'danger');
        return back();
    }

  }



public function reservar(Request $request)
    {
      //dd($request->all());
      $user=User::find(Auth::user()->id);
      $particulares=PaqueteComprado::where('user_id', $user->id)->where('tipo','A domicilio')->where('disponibles','<>',0)->orderBy('expiracion','asc')->get();
      $residenciales=PaqueteComprado::where('user_id', $user->id)->where('tipo','En condominio')->where('disponibles','<>',0)->orderBy('expiracion','asc')->get();
      $partdisp=0;
      $resdisp=0;

      $partcart=0;
      $rescart=0;


      
      $today = strtotime(date('Y-m-d'));

      foreach ($particulares as $pd) {

      $expire = strtotime($pd->expiracion);
        if ($expire >= $today) {
          $partdisp=$partdisp+$pd->disponibles;
        }
      }

      foreach ($residenciales as $rd) {

      $expire = strtotime($rd->expiracion);
        if ($expire >= $today) {
          $resdisp=$resdisp+$rd->disponibles;
        }
      }

      
      $items=Cart::content();

      foreach ($items as $product) {
       

        if ($product->options->tipo=="particular") {

          $productos[]=array(
            'name' => $product->name,
            'unit_price' => 1,
            'quantity' => 1,
            'metadata' => array(
              'tipo' => 'A domicilio',
              'asociado' => $product->id,
              'id' => $product->id,
              'coach' => $product->options->coach,
              'fecha' => $product->options->fecha,
              'hora' => $product->options->hora
            )
          );
          $partcart++;
        }
        if ($product->options->tipo=="residencial") {
          $esresidencial=true;
          $productos[]=array(
            'name' => $product->name,
            'unit_price' => $product->price,
            'quantity' => 1,
            'metadata' => array(
              'tipo' => 'En condominio',
              'id' => $product->id,
              'asociado' => $product->id,
              'coach' => $product->options->coach,
              'fecha' => $product->options->fecha,
              'hora' => $product->options->hora
            )
          );
          $rescart=$rescart+$product->price;
        }

      }


      if ($partdisp<$partcart||$resdisp<$rescart) {
        Session::flash('mensaje', "No cuentas con suficientes clases disponibles. <a href='".url('/comprar-clases')."'>Ir a comprar</a>");
        Session::flash('class', 'danger');
        return redirect()->intended(url('carrito'))->withInput();
      }

      foreach ($particulares as $pd) {

        $expire = strtotime($pd->expiracion);
        if ($expire >= $today) {
          if ($pd->disponibles>=$partcart) {
            $pd->disponibles=$pd->disponibles-$partcart;
            $partcart=0;
            $pd->save();
            break;
          }
          else{
            $partcart=$partcart-$pd->disponibles;
            $pd->disponibles=0;
            $pd->save();
          }
        }
      }


      foreach ($residenciales as $rd) {

        $expire = strtotime($rd->expiracion);
        if ($expire >= $today) {
          if ($rd->disponibles>=$rescart) {
            $rd->disponibles=$rd->disponibles-$rescart;
            $rescart=0;
            $rd->save();
            break;
          }
          else{
            $rescart=$rescart-$rd->disponibles;
            $rd->disponibles=0;
            $rd->save();
          }
        }
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
       
        foreach ($productos as $producto) {
          $guardar = new Reservacion();
          $guardar->tokens = $producto['unit_price'];
          
          $guardar->user_id=Auth::user()->id;
          $guardar->coach_id=$producto['metadata']['coach'];
          $guardar->tipo=$producto['metadata']['tipo'];
          


          if ($producto['metadata']['tipo']=="En condominio") {
            $guardar->horario_id=$producto['metadata']['asociado'];
            $grupo=Horario::find($producto['metadata']['asociado']);
          $guardar->nombre=$grupo->clase->nombre;
            
            if ($grupo->tipo=="Evento") {
              $guardar->direccion=$grupo->direccionevento;
            }
            elseif ($grupo->tipo=="En condominio") {
              $guardar->direccion=$grupo->grupo->condominio->identificador.". ".$grupo->grupo->condominio->direccion;
            }
          }else {
            $guardar->horario_id=$producto['metadata']['asociado'];
            $guardar->nombre=$producto['name'];
            if ($request->direccion==""&&$request->esresidencial!="true") {
              $guardar->direccion=$direccion->id;
            }
            else {
              $guardar->direccion=$request->direccion;
            }
          }

          $guardar->fecha=$producto['metadata']['fecha'];
          $guardar->hora=$producto['metadata']['hora'];

          $guardar->status='PROXIMA';
          $guardar->save();
          if ($producto['metadata']['tipo']=="En condominio") {
            $residencial= Horario::find($producto['metadata']['asociado']);
            $residencial->ocupados++;
            $residencial->save();
          }
          $this->sendclassrequest($guardar->id);
        }

        Cart::destroy();
        //$this->sendinvoice($order->id);
        
        //Session::flash('total', $order->amount);
        return redirect()->intended(url('/reservada'));
      

      }



      public function tokenplus(Request $request){
            $user=User::find($request->user_id);
            $particular=PaqueteComprado::where('user_id', $user->id)->where('tipo','A domicilio')->orderBy('expiracion','desc')->first();
            $residencial=PaqueteComprado::where('user_id', $user->id)->where('tipo','En condominio')->orderBy('expiracion','desc')->first();
            if($request->tipo=="En condominio"&&$residencial){
              $residencial->disponibles=$residencial->disponibles+$request->tokens;
              $fecha =$residencial->expiracion;
              $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
              $residencial->expiracion = date ( 'Y-m-d' , $nuevafecha );
              $residencial->save();
              Session::flash('mensaje', 'Token añadido.');
            Session::flash('class', 'success');
            }
            elseif($request->tipo=="A domicilio"&&$particular){
              $particular->disponibles=$particular->disponibles+$request->tokens;
              $fecha = $particular->expiracion;
              $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
              $particular->expiracion = date ( 'Y-m-d' , $nuevafecha );
              $particular->save();
              Session::flash('mensaje', 'Token añadido.');
            Session::flash('class', 'success');
            }
            else{
              Session::flash('mensaje', 'No se realizó ninguna operación.');
              Session::flash('class', 'danger');
            }
          //$this->sendclasscancel($orden->id);
            
            return back();

        
      }

      public function tokenminus(Request $request){
        $user=User::find($request->user_id);
        $particular=PaqueteComprado::where('user_id', $user->id)->where('tipo','A domicilio')->where('disponibles','<',$request->tokens)->orderBy('expiracion','desc')->first();
        $residencial=PaqueteComprado::where('user_id', $user->id)->where('tipo','En condominio')->where('disponibles','<',$request->tokens)->orderBy('expiracion','desc')->first();
        if($request->tipo=="En condominio"&&$residencial){
          $residencial->disponibles=$residencial->disponibles-$request->tokens;
          $residencial->save();
          Session::flash('mensaje', 'Token eliminado.');
        Session::flash('class', 'success');
        }
        elseif($request->tipo=="A domicilio"&&$particular){
          $particular->disponibles=$particular->disponibles-$request->tokens;
          $particular->save();
          Session::flash('mensaje', 'Token eliminado.');
        Session::flash('class', 'success');
        }
        else{
          Session::flash('mensaje', 'No se realizó ninguna operación.');
          Session::flash('class', 'danger');
        }
      //$this->sendclasscancel($orden->id);
        
        return back();

    
  }






      public function probarcomplete(){
        Session::flash('total', "500.00");
        return view('cart.complete');
      }
      public function complete(){
        return view('cart.complete');
      }
      public function reservada(){
        return view('cart.reserva');
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
      $orden=Orden::find($id);
      $user=$orden->user;
        Mail::send('emails.receiptmail', ['orden'=>$orden], function ($m) use ($user) {
            $m->from('fitcoach.notificaciones@gmail.com', 'FITCOACH México');
            $m->to($user->email, $user->name)->subject('¡Orden recibida!');
        });
    }

    public function sendclassrequest($id)
    {
      $orden=Reservacion::find($id);
      $user=User::find($orden->coach_id);
        Mail::send('emails.recibida', ['orden'=>$orden,'user'=>$user], function ($m) use ($user) {
            $m->from('fitcoach.notificaciones@gmail.com', 'FITCOACH México');
            $m->to($user->email, $user->name)->subject('¡Nueva clase agendada!');
        });
    }

    public function sendclasscancel($id)
    {
      $orden=Reservacion::find($id);
      $user=User::find($orden->coach_id);
      if ($user->role!="banned") {
        Mail::send('emails.cancelada', ['orden'=>$orden,'user'=>$user], function ($m) use ($user) {
            $m->from('fitcoach.notificaciones@gmail.com', 'FITCOACH México');
            $m->to($user->email, $user->name)->subject('¡Cancelación de clase!');
        });
      }
        
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
