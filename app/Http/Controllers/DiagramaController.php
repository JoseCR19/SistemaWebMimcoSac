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


class DiagramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Diagrama.OTCompras.index');
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
    public function ajaxrequerimiento(Request $request)
    {
       foreach($request->datos as $dato)
       {
            $ot=$dato['ot'];
       }
       $listarrequerimientos=DB::connection('sqlsrv3')->select('exec sp_listarRequerimientos ?',array($ot));
       $listarordendecompras=DB::connection('sqlsrv3')->select('exec sp_listarordendecomprasdetalle ?',array($ot));
       $listaringreso=DB::connection('sqlsrv3')->select('exec sp_listaralmaceningreso ?',array($ot));
       $listarsalida=DB::connection('sqlsrv3')->select('exec sp_listaralmacensalida ?',array($ot));
       $listaregistrocompradetalle=DB::connection('sqlsrv3')->select('exec sp_ListaRegistroCompra ?',array($ot));
       $listarvoucher=DB::connection('sqlsrv3')->select('exec sp_ListarVoucher ?',array($ot));
       return['veri'=>true,'listarrequerimientos'=>$listarrequerimientos,'listarordendecompras'=>$listarordendecompras,
       'listaringreso'=>$listaringreso,'listarsalida'=>$listarsalida,'listaregistrocompradetalle'=>$listaregistrocompradetalle,
        'listarvoucher'=>$listarvoucher];
    }
    public function ajaxrequerimientodetalle(Request $request){
        foreach ($request->datos as $dato) {
            $idreque=$dato['id'];
        }
        $listarrequerimientosdetalle=DB::connection('sqlsrv3')->select('exec sp_listarrequerimientodetalle ?',array($idreque));
        return['veri'=>true,'listarrequerimientosdetalle'=>$listarrequerimientosdetalle];
    }
}
