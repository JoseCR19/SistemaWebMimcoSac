<?php

namespace SistemaDigitalizacion\Http\Controllers;

use Illuminate\Http\Request;
use SistemaDigitalizacion\Area;
use SistemaDigitalizacion\Tipo;
use SistemaDigitalizacion\User_Area;
use SistemaDigitalizacion\Voucher;
use SistemaDigitalizacion\SubTipo;
use SistemaDigitalizacion\Documentos;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use Carbon\Carbon; 

class VoucherController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request){
            $currentPage = LengthAwarePaginator::resolveCurrentPage(); 
            $query=trim($request->get('searchText'));
            $voucher1=DB::connection('sqlsrv2')->select('sp_ListarVoucherWeb');/*,$array( )*/ 
            $lista=collect($voucher1);
            $pagina=30;
            $voucher=$lista->slice(($currentPage*$pagina)-$pagina,$pagina)->all();
            $paginatedItems= new LengthAwarePaginator($voucher , count($lista), $pagina);
            $paginatedItems->setPath($request->url());
            //dd($pagelist);
            return view('Contabilidad.Voucher.index',["voucher"=>$paginatedItems,"searchText"=>$query]); 
        }
    }
    public function index2(Request $request)
    {
        if($request){
            $currentPage = LengthAwarePaginator::resolveCurrentPage(); 
            $query=trim($request->get('searchText'));
            $voucher1=DB::connection('sqlsrv2')->select('sp_ListarVoucherWeb');/*,$array( )*/ 
            $lista=collect($voucher1);
            $pagina=20;
            $voucher=$lista->slice(($currentPage*$pagina)-$pagina,$pagina)->all();
            $paginatedItems= new LengthAwarePaginator($voucher , count($lista), $pagina);
            $paginatedItems->setPath($request->url());
            //dd($paginatedItems);
            return view('Contabilidad.Voucher.index2',["voucher"=>$paginatedItems,"searchText"=>$query]); 
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
        $mytime = Carbon::now('America/Lima');
        $idUser=\Auth::user()->name;
        $documento=new Documentos;
        $documento->NombreArchivo=$request->get('NombreArchivo');
        $documento->CodArea=$request->get('CodArea');
        $documento->NroVoucher=$request->get('NroVoucher');
        $documento->CodTipo=$request->get('CodTipo');
        $documento->CodSubTipo=$request->get('subtipo');
        $documento->Fecha=$request->get('fecha_nacimiento');
        $documento->UsuarioAdd=$idUser;
        $documento->Archivo='W:\\';
        $documento->created_at=$mytime->toDateTimeString();
        $documento->updated_at=$mytime->toDateTimeString();
        //dd($documento);
        $documento->save();
        return Redirect::to('Contabilidad/Voucher');
    }
    public function ajaxstore(Request $request)
    {
        $dni;
        $idvoucher;
        $id=$request->get('idvoucher');
        foreach($request->datos as $dato) {
            $dni=$dato['nrodoc'];
        }
        //$Trabajador=DB::connection('sqlsrv3')->select('exec  sp_insertarDocumentoRef ?,?',array($dni,$horario));
        return ['dni'=>$dni,'veri'=>true];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cabecera=DB::connection('sqlsrv2')->select('exec  sp_ListarVoucherWebCabecera ?',array($id));
        $cuerpo=DB::connection('sqlsrv2')->select('exec sp_listarVoucherDetalleWeb ?',array($id));
        $detalle=DB::connection('sqlsrv2')->select('exec sp_getDocumentosPagarVoucherDetalle ?',array($id));
        //dd($cabecera,$cuerpo);
        return view("Contabilidad.Voucher.show",['cabecera'=>$cabecera,'cuerpo'=>$cuerpo,'detalle'=>$detalle]);
    }
    public function documentos($id)
    {
        $digital=DB::connection('sqlsrv')->select('exec  sp_DocumentosDigitales ?',array($id));
        $voucher=DB::connection('sqlsrv2')->table('Voucher')
        ->where('NroVoucher','=',$id)
        ->get();
        //dd($digital);
        return view("Contabilidad.Voucher.documentos2",['digital'=>$digital,'voucher'=>$voucher]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
                //ACA SE LISTA TODO LA ÁREAS PARA PODER VISUALIZAR POR SER ADMINSITRADOR
        $iduser = Auth::user()->id;

        /*esto e para cuando el usuario */
        $area=DB::table('Area as a')
        ->join('User_Area as ua','a.CodArea','=','ua.CodArea')
        ->join('users as u','u.id','=','ua.CodUser')
        ->where('ua.CodUser','=',$iduser)
        ->get();  
        //dd($area);
        $areaT=DB::table('Area')
        ->get();
        $tipo=DB::table('Tipo')
        ->get();
        $subtipo=DB::table('SubTipo')
        ->get();
        $idSub=DB::table('Documentos as s')
        ->select('s.CodDocumento')
        ->get();
        $cabecera=DB::connection('sqlsrv2')->table('Voucher')
        //->select('NroVoucher')
        ->where('NroVoucher','=',$id)
        ->get();
        //dd( $cabecera);
        return view("Contabilidad.Voucher.create",['cabecera'=>$cabecera,"area"=>$area,"tipo"=>$tipo,"subtipo"=>$subtipo,"idSub"=>$idSub,"areaT"=>$areaT]);
    }
    public function edit2($id,$ruc)
    {
        //ACA SE LISTA TODO LA ÁREAS PARA PODER VISUALIZAR POR SER ADMINSITRADOR
        $iduser = Auth::user()->id;
        /*esto e para cuando el usuario */
        $area=DB::table('Area as a')
        ->join('User_Area as ua','a.CodArea','=','ua.CodArea')
        ->join('users as u','u.id','=','ua.CodUser')
        ->where('ua.CodUser','=',$iduser)
        ->get();  
        //dd($area);
        $areaT=DB::table('Area')
        ->get();
        $tipo=DB::table('Tipo')
        ->get();
        $subtipo=DB::table('SubTipo')
        ->get();
        //dd($subtipo);
        $idSub=DB::table('Documentos as s')
        ->select('s.CodDocumento')
        ->get();
        $cabecera=DB::connection('sqlsrv2')->table('Voucher')
        //->select('NroVoucher')
        ->where('NroVoucher','=',$id)
        ->get();
        $voucher=DB::connection('sqlsrv2')->select('exec  sp_getVoucher ?',array($id));
        $facturas=DB::connection('sqlsrv3')->select('exec  sp_listarFacturas ?',array($ruc));
        
        //dd($voucher);
        //dd($facturas);
        //dd( $cabecera);
        return view("Contabilidad.Voucher.create2",['cabecera'=>$cabecera,"area"=>$area,"tipo"=>$tipo,"subtipo"=>$subtipo,"idSub"=>$idSub,"areaT"=>$areaT,"facturas"=>$facturas,"voucher"=>$voucher]);
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
    public function tipo(Request $request){
        $idtipo=$request->get('tipo');
        $subTipo=DB::table('SubTipo')
        ->where('CodTipo','=',$idtipo)
        ->get();
        return ['subTipo'=>$subTipo,'veri'=>true];
    } 
    public function UpdateEstado(Request $request)
    {
        $voucher=$request->get('dato');
        dd($request);
        $udp=DB::connection('sqlsrv2')->Voucher::findOrFail($voucher);
        $udp->EstadoPagoMasivo='E';
        $udp->update();
        return Redirect::to('Contabilidad/Voucher/index');
    }
    public function ajaxRequestPost(Request $request)
    {
        $voucher=$request->get('dato');  
        $udp=Voucher::findOrFail($voucher);
        $udp->EstadoPagoMasivo='E';
        $udp->update();
        if($udp){            
            $estado=true;
        }else{
            $estado=false;
        }
        return ['data'=>'Voucher','veri'=>$estado];
    }
    public function listarVoucherPagados(Request $request)
    {
        if($request){
            $currentPage = LengthAwarePaginator::resolveCurrentPage(); 
            $query=trim($request->get('searchText'));
            $voucher1=DB::connection('sqlsrv2')->select('sp_ListarVoucherPagadosWeb');/*,$array( )*/ 
            $lista=collect($voucher1);
            $pagina=30;
            $voucher=$lista->slice(($currentPage*$pagina)-$pagina,$pagina)->all();
            $paginatedItems= new LengthAwarePaginator($voucher , count($lista), $pagina);
            $paginatedItems->setPath($request->url());
            //dd($pagelist);
            return view('Contabilidad.Voucher.listar',["voucher"=>$paginatedItems,"searchText"=>$query]); 
        }
    }


}
