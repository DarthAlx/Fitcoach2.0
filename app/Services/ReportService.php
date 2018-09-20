<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 16/09/18
 * Time: 11:15 PM
 */

namespace App\Services;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportService
{

    public function clientsWithClassesDue($date)
    {

        $data = DB::table('paquetescomprados')
            ->join('users', 'users.id', '=', 'paquetescomprados.user_id')
            ->where('expiracion', '<=', $date)
            ->where('paquetescomprados.disponibles', '>', 0)
            ->select('users.*', DB::raw('SUM(paquetescomprados.disponibles) as disponibles'), 'paquetescomprados.expiracion')
            ->groupBy('users.id')
            ->get();
        return $data;
    }

    public function popularityOfClasses($startDate, $endDate)
    {
        $data = DB::table('clases')
            ->join('horarios', 'horarios.clase_id', '=', 'clases.id')
            ->where('fecha', '>=', $startDate)
            ->where('fecha', '<=', $endDate)
            ->select('clases.*', DB::raw('SUM(horarios.ocupados) as total'))
            ->groupBy('clases.id')
            ->get();
        return $data;
    }
    public function classStatus(){
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
            ->where('expiracion', '>=',$start)
            ->where('expiracion', '<',$now)
            ->select(DB::raw('SUM(paquetescomprados.disponibles) as total'))
            ->get()->first();

        $expiredTotal = DB::table('paquetescomprados')
            ->where('expiracion', '>=',$start)
            ->where('expiracion', '<',$now)
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
}