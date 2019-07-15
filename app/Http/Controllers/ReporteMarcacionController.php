<?php

namespace SistemaDigitalizacion\Http\Controllers;

use Illuminate\Http\Request;
use SistemaDigitalizacion\Trabajador;
use SistemaDigitalizacion\Horario_Detalle;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\reniec\reniec;
use App\reniec\curl;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use Carbon\Carbon; 

class ReporteMarcacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $centrocosto=DB::connection('sqlsrv3')->select('exec  sp_centrocosto');
        return view('Marcacion.Reporte.index',["centrocosto"=>$centrocosto]);
/*
        $f1 = $f2 = date('Y-m-d');
        if(! is_null($request->fechaInicial) && ! empty($request->fechaInicial) && ! is_null($request->fechaFinal) || ! empty($request->fechaFinal) {
        $f1 = $request->fechaInicial;
        $f2 = $request->fechaFinal;
        }

        if($request)
        {
            $query=trim($request->get('searchText'));
            $reporte=DB::connection('sqlsrv3')->select('exec  sp_reporteListaMarcacion');
            $reporteDetalle=DB::connection('sqlsrv3')->select('exec  sp_getDatosMarcacionTrabajador ?',array($DNI));
            dd($reporteDetalle);
            return view('Marcacion.Reporte.index',["reporte"=>$reporte]);
        }
        else{

        }*/
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
    public function reporte()
    {

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    /*POR PERSONAL*/ 
    public function ajaxmarcacionPersonal(Request $request)
    {
       foreach($request->datos as $dato)
       {
           $fechainicio=$dato['fechainicio'];
           $fechafin=$dato['fechafin'];
           $dni=$dato['dni'];
       }
       $listatrabajador=DB::connection('sqlsrv3')->select('exec sp_listarTrabajadorDNI ?',array($dni));
       $reporteDetalle=DB::connection('sqlsrv3')->select('exec  sp_getDatosMarcacionTrabajadorDNI ?,?,?',array($fechainicio,$fechafin,$dni));
       $detalleHorario=DB::connection('sqlsrv3')->select('exec sp_ListarHorarioTrabajador ?',array($dni));
       $feriados=DB::connection('sqlsrv3')->select('exec sp_ListaFeriados');
       return['veri'=>true,'reporteDetalle'=>$reporteDetalle,'listatrabajador'=>$listatrabajador,'detalleHorario'=>$detalleHorario,'feriados'=>$feriados];
    }
    /**POR OBRERO */
    public function ajaxmarcacionObrero(Request $request)
    {
       foreach($request->datos as $dato)
       {
            $fechainicio=$dato['fechainicio'];
            $fechafin=$dato['fechafin'];
            $dni=$dato['dni'];
       }
       $feriados=DB::connection('sqlsrv3')->select('exec sp_ListaFeriados');
       $listatrabajador=DB::connection('sqlsrv3')->select('exec sp_listarObreroPorDNI ?',array($dni));
    return['veri'=>true,'listatrabajador'=>$listatrabajador,'feriados'=>$feriados];
    }
    public function ajaxmarcacionreporteobrero(Request $request)
    {
        foreach($request->datos as $dato)
        {
            $fechainicio=$dato['fechainicio'];
            $fechafin=$dato['fechafin'];
        }
        $horariotrabajador=DB::connection('sqlsrv3')->select('exec sp_HorarioTrabajador');
        $listatrabajador=DB::connection('sqlsrv3')->select('exec sp_ListarObrero');
        $feriados=DB::connection('sqlsrv3')->select('exec sp_ListaFeriados');
        $reporteDetalle=DB::connection('sqlsrv3')->select('exec  sp_getDatosMarcacionObrero ?,?',array($fechainicio,$fechafin));
        return['veri'=>true,'reporteDetalle'=>$reporteDetalle,'listatrabajador'=>$listatrabajador,'feriados'=>$feriados,'horariotrabajador'=>$horariotrabajador];
    }
    /*GENERAL */ 
    public function ajaxmarcacion(Request $request)
    {
       foreach($request->datos as $dato)
       {
           $fechainicio=$dato['fechainicio'];
           $fechafin=$dato['fechafin'];
           $centrocosto=$dato['centrocosto'];
       }
       $horariotrabajador=DB::connection('sqlsrv3')->select('exec sp_HorarioTrabajador');
       $horariodetalletrabajador=DB::connection('sqlsrv3')->select('exec sp_ListarHorarioDetalleHoraReporte');
       $listatrabajador=DB::connection('sqlsrv3')->select('exec sp_ListarTrabajador ?',array($centrocosto));
       $reporteDetalle=DB::connection('sqlsrv3')->select('exec  sp_getDatosMarcacionTrabajador ?,?',array($fechainicio,$fechafin));
       $feriados=DB::connection('sqlsrv3')->select('exec sp_ListaFeriados');
       return['veri'=>true,'reporteDetalle'=>$reporteDetalle,'listatrabajador'=>$listatrabajador,'feriados'=>$feriados,'horariotrabajador'=>$horariotrabajador,'horariodetalletrabajador'=>$horariodetalletrabajador];
    }
    public function ajaxmarcacionpersonalgeneral(Request $request)
    {
       foreach($request->datos as $dato)
       {
           $fechainicio=$dato['fechainicio'];
           $fechafin=$dato['fechafin'];
       }
       $horariotrabajador=DB::connection('sqlsrv3')->select('exec sp_HorarioTrabajador');
       $horariodetalletrabajador=DB::connection('sqlsrv3')->select('exec sp_ListarHorarioDetalleHoraReporte');
       $listatrabajador=DB::connection('sqlsrv3')->select('exec sp_listarTrabjador');
       $reporteDetalle=DB::connection('sqlsrv3')->select('exec  sp_getDatosMarcacionTrabajador ?,?',array($fechainicio,$fechafin));
       $feriados=DB::connection('sqlsrv3')->select('exec sp_ListaFeriados');
       return['veri'=>true,'reporteDetalle'=>$reporteDetalle,'listatrabajador'=>$listatrabajador,'feriados'=>$feriados,'horariotrabajador'=>$horariotrabajador,'horariodetalletrabajador'=>$horariodetalletrabajador];
    }
    public function ajaxmarcaciontrabajador(Request $request)
    {
        foreach($request->datos as $dato)
       {
           $dni=$dato['DNI'];
       }
       $detalleHorario=DB::connection('sqlsrv3')->select('exec sp_ListarHorarioTrabajador ?',array($dni));
       return['veri'=>true,'detalleHorario'=>$detalleHorario];
    }
}
