<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 27/09/18
 * Time: 02:43 PM
 */

namespace App\Http\Controllers\Publico;


use App\Evento;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;

class EventosController extends Controller
{
    public function index()
    {
        $eventos = Evento::where('condominio_id', 0)
            ->orderBy('fecha', 'asc')->get();
        return view('eventos', ['eventos' => $eventos]);
    }

    public function search(Request $request)
    {
        $eventos = Evento::where('condominio_id', 0)
            ->where('nombreevento', 'like', '%' . $request->busqueda . '%')
            ->orderBy('nombreevento', 'asc')->get();
        return view('eventos', ['eventos' => $eventos]);
    }

}