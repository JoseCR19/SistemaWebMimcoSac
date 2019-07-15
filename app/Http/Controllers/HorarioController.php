<?php

namespace SistemaDigitalizacion\Http\Controllers;

use Illuminate\Http\Request;
use SistemaDigitalizacion\Horario;
use SistemaDigitalizacion\Horario_Detalle;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use Carbon\Carbon; 
class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $Horario=DB::connection('sqlsrv3')->table('Horario')
            ->where('HORARIO','LIKE','%'.$query.'%')
            ->orderBy('HORARIO')
            ->paginate(20);
            $correlativo=DB::connection('sqlsrv3')->select('exec  sp_getCorrelativoHorario');
            $dias=DB::connection('sqlsrv3')->select('exec  sp_comboDia');
            return view('Marcacion.Horario.index',["Horario"=>$Horario,"correlativo"=>$correlativo,"dias"=>$dias]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        
        try{
            $Codigo;
            $Descripcion;
            $Tipo_Horario;
            $codigoDia;
            $HoraInicio;
            $HoraFin;
            /*este for es para insertar la cabecera HORA*/
           foreach($request->datos as $dat)
            {   
                $Codigo=$dat['Codigo'];
                $Descripcion=$dat['Descripcion'];
                $Tipo_Horario=$dat['Tipo_Horario'];
            }
            $idHorarioCabecera=DB::connection('sqlsrv3')->table('Horario')->insertGetId(
                [
                    'HORARIO'=>$Codigo,
                    'TIPO_HORARIO'=>$Tipo_Horario,
                    'DESCRIPCION'=>$Descripcion,
                ]
            );
            foreach($request->detalle as $det)
            {
                $horariodetalle=new Horario_Detalle;
                $horariodetalle->HORARIO=$det['CodigoHora'];
                $horariodetalle->DIA=$det['CodDia'];
                $horariodetalle->TIPO_HORARIO='S';
                $horariodetalle->HORA_INICIO=$det['HoraInicio'];
                $horariodetalle->HORA_FIN=$det['HoraFin'];
                $horariodetalle->save();
            }
            return ['data'=>'Horario','veri'=>true];
        
        } catch(Exception $e){
            return ['data'=>$e,'veri'=>true];
        }
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
    public function ajaxRequestPostHorario(Request $request)
    {
        $id=$request->get('dato');
        $lista=DB::connection('sqlsrv3')->select('exec  sp_HoraioDiario ?',array($id));
        return['lista'=>$lista,'veri'=>true];
    }
}
