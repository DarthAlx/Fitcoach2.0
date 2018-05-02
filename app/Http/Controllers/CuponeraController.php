<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Cart;
use App\Cupon;
use App\Cuponera;
use App\Particular;
use App\Residencial;
use Cookie;

class CuponeraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $cupon= Cupon::where('codigo', $request->codigo)->first();
        if ($cupon) {
          $usos= Cuponera::where('cupon_id', $cupon->id)->where('user_id', Auth::user()->id)->where('orden_id','<>', '')->count();
          $usogeneral= Cuponera::where('cupon_id', $cupon->id)->where('orden_id','<>', '')->count();
          //$total=Cart::total();
          date_default_timezone_set('America/Mexico_City');
          setlocale(LC_TIME, "es-ES");
          $datetime2 = date_create($cupon->expiracion."0:00");
          $datetime1 = date_create("now");
          $interval = $datetime1->diff($datetime2);
          $dias=intval($interval->format("%R%d")*24);
          $horas=intval($interval->format("%R%h"));
          $horastotales=$dias+$horas;


          if ($cupon->maximo==0) {
            $maximo=999999;
          }
          else {
            $maximo=$cupon->maximo;
          }


          if($maximo>$usogeneral&&$cupon->usos>$usos&&$horastotales>0){


                if ($cupon->user_id!="") {
                  if ($cupon->user_id==Auth::user()->id) {
                    $guardar = new Cuponera();
                    $guardar->cupon_id=$cupon->id;
                    $guardar->user_id=Auth::user()->id;
                    $guardar->descripcion=$cupon->descripcion;
                    $guardar->codigo=$cupon->codigo;
                    $guardar->monto=$cupon->monto;
                    $guardar->save();
                    
                    $descuentofc = Cookie::queue(Cookie::make('descuentofc', $guardar->id, 30));
            
                    //Cart::add("Desc",$cupon->descripcion,1,-$cupon->monto, ['id'=>$guardar->id]);
                    Session::flash('mensaje', '¡Descuento aplicado!');
                    Session::flash('class', 'success');
                  }
                  else {
                    Session::flash('mensaje', 'Este cupón no se puede aplicar.');
                    Session::flash('class', 'danger');
                  }
                }
                else {
                  $guardar = new Cuponera();
                  $guardar->cupon_id=$cupon->id;
                  $guardar->user_id=Auth::user()->id;
                  $guardar->descripcion=$cupon->descripcion;
                    $guardar->codigo=$cupon->codigo;
                    $guardar->monto=$cupon->monto;
                  $guardar->save();
                  $descuentofc = Cookie::queue(Cookie::make('descuentofc', $guardar->id, 30));

                  //Cart::add("Desc",$cupon->descripcion,1,-$cupon->monto, ['id'=>$guardar->id]);
                  Session::flash('mensaje', '¡Descuento aplicado!');
                  Session::flash('class', 'success');
                }


            return back();
          }
          else {
            Session::flash('mensaje', 'Este cupón no se puede aplicar.');
            Session::flash('class', 'danger');
            return back()->withInput();
          }
        }



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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
