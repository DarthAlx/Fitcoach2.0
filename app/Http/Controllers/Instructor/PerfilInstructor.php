<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 11/09/18
 * Time: 06:23 PM
 */

namespace App\Http\Controllers\Instructor;


use App\Direccion;
use App\Horario;
use App\Http\Controllers\Controller;
use App\Plan;
use App\Repositories\ClaseRepository;
use App\Reservacion;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PerfilInstructor extends Controller
{
    public function index()
    {
        $repository = new ClaseRepository();

        $user = User::find(Auth::user()->id);
        $data = $repository->clasesDeCoach(Auth::user()->id);
        $array = array();
        $proximas = array();
        $now = Carbon::now();
        foreach ($data as $item) {
            date_default_timezone_set('America/Mexico_City');
            if ($item->tipo == "clase") {
                $horario = Horario::with('condominio')->where('id','=',$item->horarioId)->get()->first();
                $item->lugar = $horario->condominio->direccion;
            } else {
                $reservacion = Reservacion::where('id','=',$item->reservacionId)->get()->first();
                $direccion = Direccion::find($reservacion->direccion);
                $item->lugar = $direccion->calle . " " .
                    $direccion->numero_ext . " " .
                    $direccion->numero_int . ", " .
                    $direccion->colonia . ", " .
                    $direccion->municipio_del . ", " .
                    $direccion->cp . ", " .
                    $direccion->estado;
            }

            $plan = Plan::where('reservacion_id','=',$item->id)->get()->first();
            $item->plan = $plan;


            $fecha = date_create($item->fecha);
            setlocale(LC_TIME, "es-ES");

            $horadeclase = new DateTime($item->fecha . ' ' . $item->hora);
            $horaactual = new DateTime("now");
            $dteDiff = $horaactual->diff($horadeclase);

            $dias = intval($dteDiff->format("%R%d")) * 24;
            $horas = intval($dteDiff->format("%R%h"));
            $horastotales = $dias + $horas;


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