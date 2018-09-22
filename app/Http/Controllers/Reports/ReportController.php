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

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.index');
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
                $users = User::where('role','instructor')
                    ->orderBy('name')->get();
                return view('admin.reports.type' . $id . '.form')
                    ->with('users', $users);
                break;

        }
    }

    public function create($id, Request $request)
    {
        $input = $request->all();
        $service = new ReportService($id);
        $now = Carbon::now();
        switch ($id) {
            case 1:
                $view = $service->clientsWithClassesDue($input);
                break;
            case 3:
                $view = $service->popularityOfClasses($input);
                break;
            case 4:
                $view = $service->useOfCoupons($input);
                break;
            case 5:
                $view = $service->detailedCapacityPerGroup($input);
                break;
            case 6:
                $view = $service->generalCapacityPerGroup($input);
                break;
            case 7:
                $view = $service->classesOfUser($input);
                break;
            case 8:
                $view = $service->classesOfCoach($input);
                break;
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('reporte_' . $now->getTimestamp() . '.pdf');
    }

}
