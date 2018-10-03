<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 11/09/18
 * Time: 06:23 PM
 */

namespace App\Http\Controllers\Instructor;


use App\Http\Controllers\Controller;
use App\Reservacion;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PerfilInstructor extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $data = Reservacion::where('coach_id', $user->id)
            ->where('status', 'PROXIMA')
            ->orWhere('status', 'COMENZADA')
            ->orderBy('created_at', 'asc')->get();
        $array = array();
        $proximas = array();
        $now = Carbon::now();
        foreach ($data as $item) {
            if (!in_array($item->nombre . $item->fecha . $item->hora, $array)) {
                if ($item->fecha == $now->toDateString()) {
                    $item->active = true;
                } else {
                    $item->active = false;
                }
                array_push($proximas, $item);
            }
        }
        Log::debug("item in", ['proximas' => $proximas]);
        return view('perfilinstructor')
            ->with('proximas', $proximas)
            ->with('user', $user);
    }

    public function iniciar($id)
    {
        $reservacion = Reservacion::find($id);
        $reservacion->status = 'COMENZADA';
        $reservacion->save();
        return redirect(url('/perfilinstructor'));
    }

}