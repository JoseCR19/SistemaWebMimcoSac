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
use iio\libmergepdf\Merger;
class OrdenComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $count=DB::connection('sqlsrv3')->select('sp_countoc_aprobar');
        //dd($count);
        return view('Gerencia.OrdenCompra.index',["count"=>$count]);
    }
    public function indexverificado(Request $request)
    {
        $count=DB::connection('sqlsrv3')->select('sp_count_aprobados');
        //dd($count);
        return view('Gerencia.OrdenCompra.index-ocv',["count"=>$count]);
    }

    public function oc(Request $request){
        if($request){
            $currentPage = LengthAwarePaginator::resolveCurrentPage(); 
            $query=trim($request->get('searchText'));
            $listaoc1=DB::connection('sqlsrv3')->select('sp_ListarOrdenesCompra');
            $lista=collect($listaoc1);
            $pagina=10;
            $listaoc=$lista->slice(($currentPage*$pagina)-$pagina,$pagina)->all();
            $paginatedItems= new LengthAwarePaginator($listaoc , count($lista), $pagina);
            $paginatedItems->setPath($request->url());
            
        return view('Gerencia.OrdenCompra.OC.index',['listaoc'=>$paginatedItems,"searchText"=>$query]);
        }
    }
    public function ocv(Request $request)
    {
        if($request){
            $currentPage = LengthAwarePaginator::resolveCurrentPage(); 
            $query=trim($request->get('searchText'));
            $listaoc1=DB::connection('sqlsrv3')->select('sp_ListarOrdenesCompraAprobadas');
            $lista=collect($listaoc1);
            $pagina=10;
            $listaoc=$lista->slice(($currentPage*$pagina)-$pagina,$pagina)->all();
            $paginatedItems= new LengthAwarePaginator($listaoc , count($lista), $pagina);
            $paginatedItems->setPath($request->url());
        return view('Gerencia.OrdenCompra.OC.index-verificados',['listaoc'=>$paginatedItems,"searchText"=>$query]);
        }
    }
    public function documentos($id,$idocd,$idcoden)
    {
        //dd($id,$idocd,$idcoden);
        $cabecera=DB::connection('sqlsrv3')->select('exec  sp_ListarOrdenesCompraId ?,?,?',array($id,$idocd,$idcoden));
        $detalle=DB::connection('sqlsrv3')->select('exec  sp_ListarOrdenesCompraDetalle ?,?,?',array($id,$idocd,$idcoden));
        $documentos=DB::connection('sqlsrv3')->select('exec  sp_ListarDocumentos ?,?,?',array($id,$idocd,$idcoden));
        //dd($getreque);
        $combinador = new Merger;
        foreach ($documentos as $documento) {
            $doc=$documento->RUTA;
            $combinador->addFile($doc);
        }
        //dd($detalle);
        /**ID=CODIGO,IDOCD=TIPO DOCUMENTO, IDCODEN=ENTIDAD */
        $nombre='GERENCIA/OC/PROCESADOS/'.$id.''.$idocd.''.$idcoden.'.pdf';
        $salida = $combinador->merge();
        file_put_contents($nombre, $salida);
        return view('Gerencia.OrdenCompra.OC.documentos',['cabecera'=>$cabecera,"detalle"=>$detalle]);
    }
    public function ajaxdocumento(Request $request)
    {
        $id=$request->get('dato');
        $documentos=DB::connection('sqlsrv3')->select('exec  sp_ListarDocumentosRequerimientos ?',array($id));
        $combinador = new Merger;
        foreach ($documentos as $documento) {
            $doc=$documento->RUTA;
            $combinador->addFile($doc);
        }
        $nombre='GERENCIA/OC/PROCESADOS/'.$id.'.pdf';
        $salida = $combinador->merge();
        file_put_contents($nombre, $salida);
        return['veri'=>true,'lista'=>$nombre];
    }
    public function ajaxaprobar(Request $request)
    {
        try {
            $DOCUMENTO;
            $TIPODOCUMENTO;
            $CODENTIDAD;
            foreach ($request->datos as $dato) {
                $DOCUMENTO=$dato['codigo'];
                $TIPODOCUMENTO=$dato['tipo'];
                $CODENTIDAD=$dato['entidad'];
            }
            $actualizarestado=DB::connection('sqlsrv3')->update('exec  sp_UpdateOC ?,?,?',array($DOCUMENTO,$TIPODOCUMENTO,$CODENTIDAD));

        return['veri'=>true,'documento'=>$DOCUMENTO];
        } catch (Exception $e) {

            return['veri'=>false];
        }  
    }
    public function ajaxdesaprobar(Request $request)
    {
        try {
            $DOCUMENTO;
            $TIPODOCUMENTO;
            $CODENTIDAD;
            foreach ($request->datos as $dato) {
                $DOCUMENTO=$dato['codigo'];
                $TIPODOCUMENTO=$dato['tipo'];
                $CODENTIDAD=$dato['entidad'];
            }
        $actualizarestado=DB::connection('sqlsrv3')->update('exec  sp_UpdateOcRechazada ?,?,?',array($DOCUMENTO,$TIPODOCUMENTO,$CODENTIDAD));
        return['veri'=>true,'documento'=>$DOCUMENTO];
        } catch (Exception $e) {

            return['veri'=>false];
        }  
    }
    public function ajaxfaltasustento(Request $request)
    {
        try {
            $DOCUMENTO;
            $TIPODOCUMENTO;
            $CODENTIDAD;
            foreach ($request->datos as $dato) {
                $DOCUMENTO=$dato['codigo'];
                $TIPODOCUMENTO=$dato['tipo'];
                $CODENTIDAD=$dato['entidad'];
            }
            $actualizarestado=DB::connection('sqlsrv3')->update('exec  sp_UpdateFaltaSustento ?,?,?',array($DOCUMENTO,$TIPODOCUMENTO,$CODENTIDAD));
            return['veri'=>true,'documento'=>$DOCUMENTO];
        } catch (Exception $e) {

            return['veri'=>false];
        }
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
}
