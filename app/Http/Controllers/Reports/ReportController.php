<?php

namespace App\Http\Controllers\Reports;

use App\Clase;
use App\Condominio;
use App\Http\Controllers\Controller;
use App\Services\ReportService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $condominios = Condominio::all();
        $clases = Clase::orderBy('nombre')->get();
        $types = Collect(DB::table('clases')
            ->select('tipo')
            ->groupBy('tipo')
            ->get())
            ->pluck('tipo');
        $users = User::where('role', 'instructor')
            ->orderBy('name')->get();

        return view('admin.reports.index')
            ->with('condominios', $condominios)
            ->with('clases', $clases)
            ->with('types', $types)
            ->with('users', $users);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        switch ($id) {
            case 1:
            case 3:
            case 4:
                return view('admin.reports.type' . $id . '.form');
                break;
            case 5:
            case 6:
            case 9:
                $condominios = Condominio::all();
                return view('admin.reports.type' . $id . '.form')
                    ->with('condominios', $condominios);
                break;
            case 7:
                $clases = Clase::orderBy('nombre')->get();
                return view('admin.reports.type' . $id . '.form')
                    ->with('clases', $clases);
                break;
            case 8:
                $users = User::where('role', 'instructor')
                    ->orderBy('name')->get();
                return view('admin.reports.type' . $id . '.form')
                    ->with('users', $users);
                break;

        }
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $id = $input['report_type'];
        $service = new ReportService($input['report_type']);
        if (isset($input['desde']) && $input['desde']!= '' && isset($input['hora_inicio']) && $input['hora_inicio']!= '') {
            $from = Carbon::parse($input['desde'] . ' ' . $input['hora_inicio']);
            $input['from'] = $from;
        } else if (isset($input['desde']) && $input['desde']!= '') {
            $from = Carbon::parse($input['desde']);
            $input['from'] = $from;
        }else{
            $input['from'] = null;
        }

        if (isset($input['hasta']) && $input['hasta']!= '' && isset($input['hora_fin']) && $input['hora_fin']!= '') {
            $from = Carbon::parse($input['hasta'] . ' ' . $input['hora_fin']);
            $input['to'] = $from;
        } else if (isset($input['hasta']) && $input['hasta']!= '') {
            $from = Carbon::parse($input['hasta']);
            $input['to'] = $from;
        }else{
            $input['to'] = null;

        }

        Log::debug("esta es la request",['$request'=>$input]);
        $now = Carbon::now();
        switch ($id) {
            case 1:
                $view = $service->clientsWithClassesDue($input);
                break;
            case 3:
                $view = $service->popularityOfClasses($input);
                break;
            case 5:
                $view = $service->useOfCoupons($input);
                break;
            case 6:
                $view = $service->detailedCapacityPerGroup($input);
                break;
            case 7:
                $view = $service->generalCapacityPerGroup($input);
                break;
            case 8:
                $view = $service->classesOfUser($input);
                break;
            case 9:
                $view = $service->classesOfCoach($input);
                break;
            case 10:
                $view = $service->salesOfGroup($input);
                break;
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('reporte_' . $now->getTimestamp() . '.pdf');
    }

}
