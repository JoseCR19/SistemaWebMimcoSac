<?php

namespace SistemaDigitalizacion\Http\Controllers;

use Illuminate\Http\Request;
use SistemaDigitalizacion\Area;
use SistemaDigitalizacion\Tipo;
use SistemaDigitalizacion\User_Area;
use Illuminate\Support\Facades\Auth;
use SistemaDigitalizacion\SubTipo;
use SistemaDigitalizacion\Documentos;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Response;
use Illuminate\Support\Collection;
use DB;
use Carbon\Carbon; 

class DocumentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request){ 
            $query=trim($request->get('searchText'));
            $documentos=DB::table('Documentos')
            ->orderBy('CodDocumento')
            ->paginate(10);

            $almacen=DB::table('Documentos')
            ->where('CodArea','=','AL')
            ->select(DB::raw('count(*) almacen'))
            ->first();

            $ti=DB::table('Documentos')
            ->where('CodArea','=','TI')
            ->select(DB::raw('count(*) ti'))
            ->first();

            $comercial=DB::table('Documentos')
            ->where('CodArea','=','CM')
            ->select(DB::raw('count(*) comercial'))
            ->first();

            $factura=DB::table('Documentos')
            ->where('CodArea','=','FT')
            ->select(DB::raw('count(*) factura'))
            ->first();

            $gestion=DB::table('Documentos')
            ->where('CodArea','=','GP')
            ->select(DB::raw('count(*) gestion'))
            ->first();


            return view('Digitalizacion.Documentos.index',["documentos"=>$documentos,"searchText"=>$query,
                                                           "almacen"=>$almacen,"ti"=>$ti,"comercial"=>$comercial,
                                                           "factura"=>$factura,"gestion"=>$gestion]);  
                  
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        
        return view("Digitalizacion.Documentos.create",["area"=>$area,"tipo"=>$tipo,"subtipo"=>$subtipo,"idSub"=>$idSub,"areaT"=>$areaT]);
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
        $documento->CodTipo=$request->get('CodTipo');
        $documento->CodSubTipo=$request->get('subtipo');
        $documento->NombreArchivo=$request->get('NombreArchivo');
        $documento->Fecha=$request->get('fecha_nacimiento');
        $documento->UsuarioAdd=$idUser;
        $documento->Archivo='W:\\';
        $documento->created_at=$mytime->toDateTimeString();
        $documento->updated_at=$mytime->toDateTimeString();
        //dd($documento);
        $documento->save();
        return Redirect::to('Digitalizacion/Documentos');

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
    public function subtipolist($id)
    {
       /* $CodTipo=$request->get('Tipo');
        $subtipo=DB::table('SubTipo')
        ->where('CodTipo','=',$CodTipo)
        ->get();
        dd($request);
        return ['subtipo'=>$subtipo,'veri'=>true];*/
        return SubTipo::where('CodTipo','=',$id)->get();
    }
    public function tipo(Request $request){
        $idtipo=$request->get('tipo');
        $subTipo=DB::table('SubTipo')
        ->where('CodTipo','=',$idtipo)
        ->get();
        return ['subTipo'=>$subTipo,'veri'=>true];
    } 
}
