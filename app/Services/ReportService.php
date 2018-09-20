<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 16/09/18
 * Time: 11:15 PM
 */

namespace App\Services;


use App\Clase;
use App\Condominio;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ReportService
{

    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function clientsWithClassesDue(array $input)
    {
        $now = Carbon::now();
        $date = Carbon::parse($input['date']);
        $data = DB::table('paquetescomprados')
            ->join('users', 'users.id', '=', 'paquetescomprados.user_id')
            ->where('expiracion', '<=', $date)
            ->where('paquetescomprados.disponibles', '>', 0)
            ->select('users.*', DB::raw('SUM(paquetescomprados.disponibles) as disponibles'), 'paquetescomprados.expiracion')
            ->groupBy('users.id')
            ->get();
        return View::make('admin.reports.type' . $this->id . '.show', compact('data', 'now', 'date'))->render();
    }

    public function popularityOfClasses(array $input)
    {
        $now = Carbon::now();
        $startDate = Carbon::parse($input['from']);
        $endDate = Carbon::parse($input['to']);
        $data = DB::table('clases')
            ->join('horarios', 'horarios.clase_id', '=', 'clases.id')
            ->where('fecha', '>=', $startDate)
            ->where('fecha', '<=', $endDate)
            ->select('clases.*', DB::raw('SUM(horarios.ocupados) as total'))
            ->groupBy('clases.id')
            ->get();
        $total = 0;
        foreach ($data as $item) {
            $total += $item->total;
        }
        return View::make('admin.reports.type' . $this->id . '.show', compact('data', 'now', 'startDate', 'endDate', 'total'))->render();
    }


    public function useOfCoupons(array $input)
    {
        $now = Carbon::now();
        $startDate = Carbon::parse($input['from']);
        $endDate = Carbon::parse($input['to']);
        $data = DB::table('cupones')
            ->where('expiracion', '>=', $startDate)
            ->where('expiracion', '<=', $endDate)
            ->select('cupones.*')
            ->get();
        return View::make('admin.reports.type4.show', compact('data', 'now', 'startDate', 'endDate'))->render();
    }


    public function classStatus()
    {
        $now = Carbon::now();
        $start = new Carbon('first day of last month');

        $classesAvailable = DB::table('paquetescomprados')
            ->select(DB::raw('SUM(paquetescomprados.disponibles) as total'))
            ->get()->first();
        $expiracionIn7 = DB::table('paquetescomprados')
            ->where('expiracion', '<=', $now->addDays(7))
            ->select(DB::raw('SUM(paquetescomprados.disponibles) as total'))
            ->get()->first();

        $expiracionIn14 = DB::table('paquetescomprados')
            ->where('expiracion', '<=', $now->addDays(14))
            ->select(DB::raw('SUM(paquetescomprados.disponibles) as total'))
            ->get()->first();

        $expiracionIn21 = DB::table('paquetescomprados')
            ->where('expiracion', '<=', $now->addDays(21))
            ->select(DB::raw('SUM(paquetescomprados.disponibles) as total'))
            ->get()->first();

        $expiredInTheMonth = DB::table('paquetescomprados')
            ->where('expiracion', '>=', $start)
            ->where('expiracion', '<', $now)
            ->select(DB::raw('SUM(paquetescomprados.disponibles) as total'))
            ->get()->first();

        $expiredTotal = DB::table('paquetescomprados')
            ->where('expiracion', '>=', $start)
            ->where('expiracion', '<', $now)
            ->select(DB::raw('SUM(paquetescomprados.disponibles) as total'))
            ->get()->first();

        $response = new \stdClass();
        $response->classesAvailable = $classesAvailable->total;
        $response->expiracionIn7 = $expiracionIn7->total;
        $response->expiracionIn14 = $expiracionIn14->total;
        $response->expiracionIn21 = $expiracionIn21->total;
        $response->expiredInTheMonth = $expiredInTheMonth->total;
        $response->expiredTotal = $expiredTotal->total;
        return $response;
    }


    public function detailedCapacityPerGroup(array $input){
        $now = Carbon::now();
        $startDate = Carbon::parse($input['from']);
        $endDate = Carbon::parse($input['to']);
        $condominioId = $input['condominio_id'];
        $condominio = Condominio::find($condominioId);
        $data = DB::table('horarios')
            ->join('users', 'users.id', '=', 'horarios.user_id')
            ->join('clases', 'clases.id', '=', 'horarios.clase_id')
            ->where('horarios.fecha', '>=', $startDate)
            ->where('horarios.fecha', '<=', $endDate)
            ->where('horarios.condominio_id', '=', $condominioId)
            ->select(
                DB::raw('horarios.user_id as coach_id'),
                'horarios.clase_id',
                'users.name',
                'horarios.hora',
                'clases.nombre',
                DB::raw('count(*) as total'),
                DB::raw('avg(horarios.ocupados) as promedio ')
            )
            ->groupBy(DB::raw('horarios.hora,horarios.clase_id'))
            ->get();
        foreach ($data as $item){
            $horarios = DB::table('horarios')
                ->where('horarios.fecha', '>=', $startDate)
                ->where('horarios.fecha', '<=', $endDate)
                ->where('horarios.condominio_id', '=', $condominioId)
                ->where('horarios.user_id', '=', $item->coach_id)
                ->where('horarios.clase_id', '=', $item->clase_id)
                ->select('horarios.fecha','horarios.ocupados','horarios.cupo')
                ->get();
            $item->horarios = $horarios;
        }
        return View::make('admin.reports.type5.show',
            compact('data', 'now', 'startDate', 'endDate','condominio'))->render();
    }


    public function generalCapacityPerGroup(array $input){
        $now = Carbon::now();
        $startDate = Carbon::parse($input['from']);
        $endDate = Carbon::parse($input['to']);
        $condominioId = $input['condominio_id'];
        $condominio = Condominio::find($condominioId);
        $data = DB::table('horarios')
            ->join('users', 'users.id', '=', 'horarios.user_id')
            ->join('clases', 'clases.id', '=', 'horarios.clase_id')
            ->where('horarios.fecha', '>=', $startDate)
            ->where('horarios.fecha', '<=', $endDate)
            ->where('horarios.condominio_id', '=', $condominioId)
            ->select(
                DB::raw('horarios.user_id as coach_id'),
                'horarios.clase_id',
                'users.name',
                'horarios.hora',
                'clases.nombre',
                DB::raw('count(*) as total'),
                DB::raw('avg(horarios.ocupados) as promedio ')
            )
            ->groupBy(DB::raw('horarios.hora,horarios.clase_id'))
            ->get();
        return View::make('admin.reports.type6.show',
            compact('data', 'now', 'startDate', 'endDate','condominio'))->render();
    }

    public function classesOfUser(array $input){
        $now = Carbon::now();
        $startDate = Carbon::parse($input['from']);
        $endDate = Carbon::parse($input['to']);
        $clase_id = $input['clase_id'];
        $clase = Clase::find($clase_id);
        $data = DB::table('reservaciones')
            ->join('users', 'users.id', '=', 'reservaciones.user_id')
            ->join('horarios', 'horarios.id', '=', 'reservaciones.horario_id')
            ->where('reservaciones.fecha', '>=', $startDate)
            ->where('reservaciones.fecha', '<=', $endDate)
            ->where('horarios.clase_id', '=', $clase_id)
            ->select('users.name','users.email','users.tel',DB::raw('count(*) as total'))
            ->groupBy('reservaciones.user_id')
            ->get();
        return View::make('admin.reports.type7.show',
            compact('data', 'now', 'startDate', 'endDate','clase'))->render();
    }
}