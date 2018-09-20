<?php

namespace App\Http\Controllers\Reports;

use App\Services\ReportService;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

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
        return view('admin.reports.type' . $id . '.form');
    }

    public function create($id, Request $request)
    {
        $input = $request->all();
        $service = new ReportService();
        $now = Carbon::now();
        switch ($id) {
            case 1:
                $date = Carbon::parse($input['date']);
                $data = $service->clientsWithClassesDue($input['date']);
                $view = View::make('admin.reports.type' . $id . '.show', compact('data', 'now', 'date'))->render();
                break;
            case 3:
                $startDate = Carbon::parse($input['from']);
                $endDate = Carbon::parse($input['to']);
                $data = $service->popularityOfClasses($startDate, $endDate);
                $total = 0;
                foreach ($data as $item){
                    $total+=$item->total;
                }
                $view = View::make('admin.reports.type' . $id . '.show', compact('data', 'now', 'startDate', 'endDate','total'))->render();
                break;
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('reporte_' . $now->getTimestamp() . '.pdf');
    }

}
