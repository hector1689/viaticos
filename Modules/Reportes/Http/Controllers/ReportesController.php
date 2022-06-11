<?php

namespace Modules\Reportes\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use \Modules\Recibos\Entities\Recibos;
use \DB;
use Auth;
class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('reportes::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('reportes::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('reportes::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('reportes::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function descargar($fecha1,$fecha2){

  //  dd($fecha1,$fecha2);

    list($dia,$mes,$anio) = explode('-',$fecha1);
    $fecha = $anio.'-'.$mes.'-'.$dia;

    list($dia2,$mes2,$anio2) = explode('-',$fecha2);
    $fecha2 = $anio2.'-'.$mes2.'-'.$dia2;

    ////////////////////////////////////////////
    ini_set('memory_limit', '-1');
    $formulario_query  =  ('
      SELECT
      *
      FROM t_viaticos
      WHERE t_viaticos.fecha_hora_salida  BETWEEN "'.$fecha.' 00:00:00" and "'.$fecha2.' 23:59:59" and t_viaticos.activo = 1
    ');
    //dd($formulario_query);
    $formulario = DB::select($formulario_query);
    //////////////////////////////////////////////
    $formulario_total_query  =  ('
      SELECT SUM(importe) AS total FROM t_viaticos WHERE t_viaticos.fecha_hora_salida  BETWEEN "'.$fecha.' 00:00:00" and "'.$fecha2.' 23:59:59" and activo = 1
    ');
    //dd($formulario_total_query);
    $formulario_total = DB::select($formulario_total_query);

    foreach ($formulario_total as $key => $value) {
      $total = $value->total;
    }
    /////////////////////////////////////////////

    $formulario_total_personasquery  =  ('
      SELECT COUNT(id) AS total_personas FROM t_viaticos WHERE t_viaticos.fecha_hora_salida  BETWEEN "'.$fecha.' 00:00:00" and "'.$fecha2.' 23:59:59" and activo = 1
    ');
    //dd($formulario_total_personasquery);
    $formulario_totalp = DB::select($formulario_total_personasquery);

    foreach ($formulario_totalp as $key => $values) {
      $totalp = $values->total_personas;
    }
    ////////////////////////////////////////////
    $data['elaboro'] = Auth::user()->nombre.' '.Auth::user()->apellido_paterno.' '.Auth::user()->apellido_materno;
    $data['formulario'] = $formulario;
    $data['total'] = $total;
    $data['totalp'] = $totalp;
    $data['fecha'] = $fecha;
    $data['fecha2'] = $fecha2;


    $pdf = PDF::loadView('reportes::reporte_viaticos_folio', $data);
    $pdf->setPaper(array(0,0,612.00, 790.00), 'portrait');
    $pdf->setOptions(['enable_php' => true,'isHtml5ParserEnabled' => true,'isRemoteEnabled' => true]);

    $pdf->output();

    $namePdf = 'Documento Reporte Rango - '.$fecha.'.pdf';
    return $pdf->download($namePdf);
    return $pdf->stream();

  }

}
