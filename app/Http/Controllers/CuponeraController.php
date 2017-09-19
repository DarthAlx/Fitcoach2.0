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
          $usos= Cuponera::where('cupon_id', $cupon->id)->where('user_id', Auth::user()->id)->count();

          $total=Cart::total();
          date_default_timezone_set('America/Mexico_City');
          setlocale(LC_TIME, "es-ES");
          $datetime2 = date_create($cupon->expiracion."0:00");
          $datetime1 = date_create("now");
          $interval = $datetime1->diff($datetime2);
          $dias=intval($interval->format("%R%d")*24);
          $horas=intval($interval->format("%R%h"));
          $horastotales=$dias+$horas;

          if($cupon->usos>$usos&&$horastotales>0&&$cupon->minimo>=$total){
            $guardar = new Cuponera();
            $guardar->cupon_id=$cupon->id;
            $guardar->user_id=Auth::user()->id;
            $guardar->save();
            Cart::add("Desc",$cupon->descripcion,1,-$cupon->monto);
            Session::flash('mensaje', '!Descuento aplicado!');
            Session::flash('class', 'success');
            return redirect()->intended(url('/carrito'));
          }
          else {
            Session::flash('mensaje', 'Este cupón ya fue aplicado.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/carrito'));
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
