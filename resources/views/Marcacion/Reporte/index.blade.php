@extends('layouts.admin')
@section('contenido')
<section class="content-header">
    <h1>
        Panel de Administrador
        <small>Version 1.0.0</small>
    </h1>
    <ol class="breadcrumb">
        <li href="#">
            <i class="fas fa-dolly"></i> Marcación</li>
        <li class="active">Lista de Horario</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border" style="padding: 10px !important">
                    <h4 style="float:left">
                        <strong style="font-weight: 400">
                            <i class="fas fa-list-ul"></i> Reporte de Marcación
                        </strong>
                    </h4>
                    <div class="ibox-title-buttons pull-right">
                        <button id="test" class="btn btn-block btn-success" onclick="tableToExcel('horafija');" style="background-color: #18A689 !important;">
                            <i class="fas fa-plus-circle"></i> EXPORTAR A EXCEL
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-md-12">
                            <form class="form-inline">
                                <div class="form-group">
								    <select required name="tipo" class="form-control" id="tipo" data-live-search="true">									             
										<option value=""  selected>Seleccione</option>
									    <option value="1">REPORTE</option>
                                        <option value="2">PERSONAL</option> 
                                        <option value="3">OBRERO</option>
                                        <option value="4">REPORTE O</option>
									</select> 
							    </div>
                                <div class="form-group">
                                    <label for="exampleInputName2" style="font-size: 12px;">DOCUMENTO</label>
                                    <input type="email" id="dni"  class="form-control"  placeholder="DOCUMENTO">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName2" style="font-size: 12px;">DESDE</label>
                                    <input type="date" name="fecha"   class="form-control" id="fechainicio">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName2" style="font-size: 12px;">HASTA</label>
                                    <input type="date" name="fecha"  class="form-control" id="fechafin">
                                </div>
                                <div class="ibox-title-buttons pull-right">
                                    <button id="listar" class="btn btn-block btn-success" type="button">
                                    <i class="fas fa-search"></i> Buscar</button>
                                </div>
                                <div class="form-group">
								    <select required name="centrocoso" class="form-control" id="centrocosto" data-live-search="true">	
                                        <option value="" disabled="" selected="">Centro Costo</option>
                                        @foreach($centrocosto as $cc)
                                        <option value="{{$cc->CENTRO_DE_COSTO}}">{{$cc->DESCRIPCION}}</option>
                                        @endforeach	
									</select> 
                                </div>  
                            </form>                        
                        </div>
                    </div>
                    <iframe id="txtArea1" style="display:none"></iframe>
                    <table id="horafija" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                        <thead> 
                            <tr>
                                <th>
                                    DIA
                                </th>
                                <th>
                                    FECHA
                                </th>
                                <th>
                                    NOMBRE
                                </th>
                                <th>
                                    M.INICIO
                                </th>
                                <th>
                                    M.A.INICIO
                                </th>
                                <th>
                                   M.A.FIN
                                </th>
                                <th>
                                   M.FIN
                                </th>
                                <th>
                                    TARDANZAS
                                </th>
                                <th>
                                    P.N.A.I
                                </th>
                                <th>
                                    P.N.A.S
                                </th>
                                <th>
                                    FERIADO
                                </th>
                                <th>
                                    INASISTENCIAS
                                </th>
                                <th>
                                    HORARIO
                                </th>
                                <th>
                                    OPCIONES
                                </th>
                            </tr>
                        </thead>
                        <tbody id="hora_detalle">
                            <tr>
                                <th colspan="14" align="text-center">
                                    <div class="panel panel-transparent panel-dashed tip-sales text-center" >
                                        <div class="row">
                                            <div class="col-sm-8 col-sm-push-2">
                                                <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                                                <h3 class="ich m-t-none">
                                                     Seleccione un rango de fechas
                                                </h3>
                                            </div>
                                        </div>
                                    </div> 
                                </th>
                            </tr>
                        </tbody>
                        <tfoot id="totales_general">
                            <tr>
                                <td colspan="14" class="text-center" align="text-center">
                                   SUMATORIA
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('Marcacion.Reporte.modal_edit_horario')
</section>
@push('scripts')
<script>
$(document).ready(function(){
 	$('#tipo').change(function(){
 			deshabilitar();
 	});
 });
 var vaj='';
 var CONTADOREXCEL=0;
 function deshabilitar(){
 		tipobandeja =document.getElementById('tipo').value;
 		console.log(tipobandeja);
 	if(tipobandeja == '1'){

         $("input#dni").attr('disabled',true);

         $('#listar').click(function(){
            listarreporte();
        });

         
 	}else if (tipobandeja == '2')
 	{
         $("input#dni").attr('disabled',false);
         $('#listar').click(function(){
            listar();
        });
     }
     else if(tipobandeja=='3')
     {
        $("input#dni").attr('disabled',false);
         $('#listar').click(function(){
            listaobrero();
        });
     }
     else if(tipobandeja=='4')
     {
        $("input#dni").attr('disabled',false);
         $('#listar').click(function(){
            listarreporteobrero();
        });
     }
 }
function listarreporteobrero()
{
    /*SEPARACION DE FECHAS*/ 
    let listaReporte=[];
    let diasSemana = new Array("Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
    let fechainicio=$("#fechainicio").val();
    let fechafin=$("#fechafin").val();
    let dni=$("#dni").val();
    let consulta='';
    let vah='';
    let HORARIOINICIO='';
    let dniconsulta='';
    let CodigoTempus='';
    let consulta3='';
    let dia='';
    let diafestivo='';
    let diasemana='';
    let mes='';
    let weeeekk='';
    let consulta4='';
    let NOMBREDELDIA='';
    let DIADELHORARIO='';
    let DESCRIPCIONHORARIO='';
    let HORADEINGRESOPERSONAL='';
    let HORADESALIDAPERSONAL='';
    let TARDANZA='';
    let HORADEINGRESOMARCACION='';
    let HORADESALIDAMARCACION='';
    let FERIADOSCALENDARIO=''
    let LISTAFERIADOS='';
    let DIAFERIADO='';
    let MESFERIADO='';
    let HORATOTALSUB1='0:00';
    let HORATOTALSUB2='';
    let TOTALHORASTARDANZAS='';
    let HORASPERMISOSNA='0:00';
    let TOTALPERMISOSNA='';
    let HORASFALTAS='0:00';
    let TOTALHORASFALTA='';
    let TOTALHORASPNAS='';
    let SUBTOTALHORASPNAS='0:00';
    let FERIADOSTOTAL='';
    let FERIADOSLARGOS=0;
    let NUMEROTARJETAOBRERO='';
    let array5=[];
    let pruebaFecha='';
    let resultadohorario='';
    let CODIGOTEMPUSOBRERO='';
    let horaprueba2019='';
    let dat=[{fechainicio:fechainicio,fechafin:fechafin}];
    $.ajax({
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:'listarmarcacionreporteobrero',
        data:{datos:dat},
        type:'post',
        dataType:'json',
        beforeSend:function()
        {
        },
        success:function(response)
        {
            if(response.veri=true)
            {
                let Marcacion_detalle=response.reporteDetalle;
                let Trabajador = response.listatrabajador;
                let DetalleHorario = response.detalleHorario;
                let Feriados= response.feriados;
                let horariotrabajador= response.horariotrabajador;
                let cont=Trabajador.length;
                console.log(horariotrabajador);
                console.log(Trabajador);
                console.log(cont);
                let resultadopruebaj=[];
                console.log(Marcacion_detalle);
                for (let t = 0; t < Trabajador.length; t++) {
                    /**VOLVEMOS A CAPTURAR LAS FECHAS */
                    let fechainicio=$("#fechainicio").val();
                    let fechafin=$("#fechafin").val();
                    let dniconsulta=Trabajador[t]['DNI'];
                    let CodigoTempus=Trabajador[t]['CODIGO_TEMPUS'].trim();
                    console.log(CodigoTempus);
                    for (let ht = 0; ht < horariotrabajador.length; ht++) {
                        CODIGOTEMPUSOBRERO=horariotrabajador[ht]['CODIGO'].trim();
                        if(Trabajador[t]['CODIGO_TEMPUS'].trim()==CODIGOTEMPUSOBRERO)
                        {
                            while (condition) {
                                
                            }
                            horaprueba2019=horariotrabajador[ht]['HORARIO'];
                        }
                    }

                    console.log(horaprueba2019);
                    /*while(fechainicio<=fechafin)
                    {
                        
                        diafestivo = DIA(fechainicio);
                        mes = MES(fechainicio);
                        
                        dia = new Date(fechainicio);
                        diasemana= dia.getDay();
                        weeeekk=diasSemana[diasemana];
                        
                        for (let f = 0; f < Feriados.length; f++) 
                        {
                            const MESF = Feriados[f]['MES'];
                            const DIAF = Feriados[f]['DIA'];
                            if(DIAF===diafestivo && MESF===mes)
                            {
                                FERIADOSCALENDARIO='1';
                            }else{
                                FERIADOSCALENDARIO='-';
                            }
                        }
                        
                        for (let m = 0; m < Marcacion_detalle.length; m++) {
                            const NUMEROTARJETA = Marcacion_detalle[m]['NUMERO_TARJETA'];
                            const FECHA = Marcacion_detalle[m]['FECHA'];
                            const CODIGOTEMPUSOBREO = Marcacion_detalle[m]['CODIGO'];
                            if(NUMEROTARJETA===dniconsulta && FECHA===fechainicio && CODIGOTEMPUSOBREO===CodigoTempus)
                            {
                                NOMBREDELDIA = Marcacion_detalle[m]['DIA'];
                                HORADEINGRESOMARCACION =Marcacion_detalle[m]['INICIO'];
                                HORADESALIDAMARCACION =Marcacion_detalle[m]['FIN'];
                            }
                        }
                        console.log(NOMBREDELDIA+'-'+HORADEINGRESOMARCACION+'-'+HORADESALIDAMARCACION);
                        
                        console.log(FERIADOSCALENDARIO);
                        console.log('hoy es '+fechainicio);
                        fechainicio = editar_fecha(fechainicio,1,"d");
                    }*/
                    console.log(resultadohorario);
                }
            }
            else{
                alert("no se pudo ingresar")
            }
        }
    });
}
function listaobrero()
{
    /*SEPARACION DE FECHAS*/ 
    let listaReporte=[];
    let diasSemana = new Array("Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
    let fechainicio=$("#fechainicio").val();
    let fechafin=$("#fechafin").val();
    let dni=$("#dni").val();
    let consulta='';
    let vah='';
    let HORARIOINICIO='';
    let dniconsulta='';
    let CodigoTempus='';
    let consulta3='';
    let dia='';
    let diafestivo='';
    let diasemana='';
    let mes='';
    let weeeekk='';
    let consulta4='';
    let NOMBREDELDIA='';
    let DIADELHORARIO='';
    let DESCRIPCIONHORARIO='';
    let HORADEINGRESOPERSONAL='';
    let HORADESALIDAPERSONAL='';
    let TARDANZA='';
    let HORADEINGRESOMARCACION='';
    let HORADESALIDAMARCACION='';
    let FERIADOSCALENDARIO=''
    let LISTAFERIADOS='';
    let DIAFERIADO='';
    let MESFERIADO='';
    let HORATOTALSUB1='0:00';
    let HORATOTALSUB2='';
    let TOTALHORASTARDANZAS='';
    let HORASPERMISOSNA='0:00';
    let TOTALPERMISOSNA='';
    let HORASFALTAS='0:00';
    let TOTALHORASFALTA='';
    let TOTALHORASPNAS='';
    let SUBTOTALHORASPNAS='0:00';
    let FERIADOSTOTAL='';
    let FERIADOSLARGOS=0;
    let dat=[{fechainicio:fechainicio,fechafin:fechafin,dni:dni}];
    $.ajax({
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:'listarmarcacionObrero',
        data:{datos:dat},
        type:'post',
        dataType:'json',
        beforeSend:function()
        {
        },
        success:function(response)
        {
            if(response.veri=true)
            {
                let Marcacion_detalle=response.reporteDetalle;
                let Trabajador = response.listatrabajador;
                let DetalleHorario = response.detalleHorario;
                let Feriados= response.feriados;
                console.log(Trabajador);
                let fechainicio=$("#fechainicio").val();
                let fechafin=$("#fechafin").val();
                for(const t in Trabajador)
                {   
                    dniconsulta=Trabajador[t]['DNI'];
                    CodigoTempus=Trabajador[t]['CODIGO_TEMPUS'];
                    console.log(dniconsulta);
                }
                while(fechainicio<=fechafin)
                {
                    diafestivo = DIA(fechainicio);
                    mes = MES(fechainicio);
                    LISTAFERIADOS = Feriados.filter(function (f){ return f.MES==mes && f.DIA==diafestivo;});
                    if(LISTAFERIADOS.length>0)
                    {
                        for(const f in LISTAFERIADOS)
                        {
                            DIAFERIADO=LISTAFERIADOS[f]['DIA'];
                            MESFERIADO=LISTAFERIADOS[f]['MES'];
                            if(diafestivo==DIAFERIADO && mes==MESFERIADO)
                            {
                                FERIADOSCALENDARIO='1'
                                FERIADOSLARGOS++;
                            }
                        }
                    }
                    else{
                        FERIADOSCALENDARIO='-'
                    }
                    fechainicio = editar_fecha(fechainicio,1,"d");
                    console.log(FERIADOSCALENDARIO);
                }
            }
            else{
                alert("no se pudo ingresar")
            }
        }
    });
}
 /**FUNCION PARA EL REPORTE */
function listarreporte()
{
    let listaReporte=[];
    let listaHorarioDetalle=[];
    let diasSemana = new Array("Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
    let fechainicio=$("#fechainicio").val();
    let fechafin=$("#fechafin").val();
    let dni=$("#dni").val();
    let centrocosto=$("#centrocosto").val();
    console.log(centrocosto);
    let consulta='';
    let cont=0;
    let vah='';
    let HORARIOINICIO='';
    let dniconsulta='';
    let CodigoTempus='';
    let consulta3='';
    let consulta5='';
    let dia='';
    let diafestivo='';
    let diasemana='';
    let mes='';
    let weeeekk='';
    let consulta4='';
    let NOMBREDELDIA='';
    let DIADELHORARIO='';
    let DESCRIPCIONHORARIO='';
    let HORADEINGRESOPERSONAL='';
    let HORADESALIDAPERSONAL='';
    let TARDANZA='';
    let HORADEINGRESOMARCACION='';
    let HORADESALIDAMARCACION='';
    let FERIADOSCALENDARIO=''
    let LISTAFERIADOS='';
    let DIAFERIADO='';
    let MESFERIADO='';
    let codigoHORARIO='';
    let consultatrue='';
    let arr=[];
    let HORASTRABAJADAS='';
    let FERIADOPALABRA='';
    let HORAINICIOALMUERZO='';
    let HORAFINALMUERZO='';
    let FERIADOSLARGOS='';
    let mayorDate= new Date(arr[0]);
    let menorDate= new Date(arr[0]);
    let dat=[{fechainicio:fechainicio,fechafin:fechafin,centrocosto:centrocosto}];
    $.ajax({
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:'listarmarcacion',
        data:{datos:dat},
        type:'post',
        dataType:'json',
        beforeSend:function()
        {
        },
        success:function(response)
        {
            if(response.veri=true){

                let Marcacion_detalle=response.reporteDetalle;
                let Trabajador = response.listatrabajador;
                let Feriados= response.feriados;
                let horariotrabajador= response.horariotrabajador;
                let horariodetalletrabajador=response.horariodetalletrabajador;
                for(let t = 0; t < Trabajador.length; t++){
                    /*************************************************************/
                                /* DECLARACIONES DE VARIABLES GLOBALES*/
                    /*************************************************************/
                    /*se vuelve a recorrer la las fechas y se obtiene el valor*/ 
                    let fechainicio=$("#fechainicio").val();
                    let fechafin=$("#fechafin").val();
                    /**variable para consultar el dni dentro del filter array(MARCACION_DETALLE)*/
                    dniconsulta=Trabajador[t]['DNI'];
                    /**variable para consultar el codigo del tempus dentro del filter array(MARCACION_DETALLE)*/
                    CodigoTempus=Trabajador[t]['CODIGO_TEMPUS'];
                    consulta5=horariotrabajador.filter(function (h){return h.CODIGO==CodigoTempus;});
                    while(fechainicio<=fechafin)
                    {
                        /**PARA OBTENER EL DIA Y EL MES EN NUMEROS */
                        diafestivo = DIA(fechainicio);
                        mes = MES(fechainicio);
                        /**FIN PARA OBTENER EL DIA Y EL MES EN NUMEROS */
                        /**PARA OBTENER EL DIA DE LA SEMANA EN PALABRAS */
                        dia = new Date(fechainicio);
                        diasemana= dia.getDay();
                        weeeekk=diasSemana[diasemana];
                        /**FIN PARA OBTENER EL DIA DE LA SEMANA EN PALABRAS */
                        LISTAFERIADOS = Feriados.filter(function (f){ return f.MES==mes && f.DIA==diafestivo;});
                        consulta3 = Marcacion_detalle.filter(function (c){return c.NUMERO_TARJETA== dniconsulta && c.FECHA==fechainicio && c.CODIGO==CodigoTempus;});
                        /**llena el array , 4 */
                        for (let index = 0; index < consulta3.length; index++) {

                            if(consulta3.length<=4)
                            {
                                if(index==0)
                                {
                                     HORADEINGRESOMARCACION=consulta3[index]['HORATXT'];
                                }
                                if(index==1)
                                {
                                     HORAINICIOALMUERZO=consulta3[index]['HORATXT'];
                                }
                                if(index==2)
                                {
                                     HORAFINALMUERZO=consulta3[index]['HORATXT'];
                                }
                                if(index==3)
                                {
                                     HORADESALIDAMARCACION=consulta3[index]['HORATXT'];
                                }
                            }
                            if(consulta3.length<=3)
                            {
                                if(index==0)
                                {
                                     HORADEINGRESOMARCACION=consulta3[index]['HORATXT'];
                                }
                                if(index==1)
                                {
                                     HORAINICIOALMUERZO=consulta3[index]['HORATXT'];
                                }
                                if(index==2)
                                {
                                    HORADESALIDAMARCACION=consulta3[index]['HORATXT'];
                                }
                                HORAFINALMUERZO='0:00';
                            }
                            if(consulta3.length<=2)
                            {
                                if(index==0)
                                {
                                     HORADEINGRESOMARCACION=consulta3[index]['HORATXT'];
                                }
                                if(index==1)
                                {
                                    HORADESALIDAMARCACION=consulta3[index]['HORATXT'];
                                }
                                HORAINICIOALMUERZO='0:00';
                                HORAFINALMUERZO='0:00';
                            }
                            if(consulta3.length<=1)
                            {
                                if(index==0)
                                {
                                     HORADEINGRESOMARCACION=consulta3[index]['HORATXT'];
                                }
                                HORADESALIDAMARCACION='0:00'
                                HORAINICIOALMUERZO='0:00';
                                HORAFINALMUERZO='0:00';
                            }

                            
                        }
                        NOMBREDELDIA=diasSemana[diasemana];
                        if(consulta3.length>0)
                        {
                            consulta=true;
                            
                        }else{
                            consulta=false;
                        }
                        if(consulta5.length>0)
                        {
                            consultatrue=true;
                        }else{
                            consultatrue=false;
                        }
                        if(consultatrue=true)
                        {                        
                            for (let index = 0; index < consulta5.length; index++) {
                            const element = consulta5[index]['FECHA'];

                                if(index==0)
                                {
                                    pruebaFecha=consulta5[index]['FECHA'];
                                    codigo=consulta5[index]['CODIGO'];
                                    codigoHORARIO=consulta5[index]['HORARIO'];
                                }
                                else if(pruebaFecha<consulta5[index]['FECHA'])
                                {
                                    pruebaFecha=consulta5[index]['FECHA'];
                                    codigo=consulta5[index]['CODIGO'];
                                    codigoHORARIO=consulta5[index]['HORARIO'];
                                } 
                            }
                        }
                        consulta4 = horariodetalletrabajador.filter(function (d){return d.DESCRIPCION == weeeekk && d.HORARIO== codigoHORARIO ;});
                        if(LISTAFERIADOS.length>0)
                        {
                            for(let f = 0; f < LISTAFERIADOS.length; f++)
                            {
                                DIAFERIADO=LISTAFERIADOS[f]['DIA'];
                                MESFERIADO=LISTAFERIADOS[f]['MES'];
                                if(diafestivo==DIAFERIADO && mes==MESFERIADO)
                                {
                                    FERIADOSCALENDARIO='1';
                                    FERIADOSLARGOS++;
                                }
                            }
                        }else{
                            FERIADOSCALENDARIO='-';
                        }
                        for(let week = 0; week < consulta4.length; week++)
                        {
                            DIADELHORARIO=consulta4[week]['DESCRIPCION'];
                            
                            if(NOMBREDELDIA==DIADELHORARIO)
                            {
                                DESCRIPCIONHORARIO=consulta4[week]['DESCRIPCIONHORARIO'];
                                HORADEINGRESOPERSONAL=consulta4[week]['HORA_INICIO'];
                                HORADESALIDAPERSONAL=consulta4[week]['HORA_FIN'];

                            }else{

                                DESCRIPCIONHORARIO=consulta4[week]['DESCRIPCIONHORARIO'];
                            }
                        }

                        if(consulta==true)
                        {
                                if(HORADEINGRESOPERSONAL=='' && HORADESALIDAPERSONAL=='')
                                {
                                    TARDANZA='-';
                                }else{
                                    TARDANZA = Tardanza(HORADEINGRESOPERSONAL,HORADEINGRESOMARCACION);
                                }
                                if(FERIADOSCALENDARIO=='1'){
                                    HORASTRABAJADAS='-';
                                    DESCRIPCIONHORARIO='FERIADO';
                                }else if(HORADEINGRESOPERSONAL!='' && HORADESALIDAPERSONAL!='')
                                {
                                    DESCRIPCIONHORARIO;
                                }
                                PNA =PermisosNoAutorizados(HORADEINGRESOPERSONAL,HORADEINGRESOMARCACION,HORADESALIDAPERSONAL,HORADESALIDAMARCACION);
                                
                                vah+='<tr class="selected text-center" style="width:100%; color:black !important">'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+NOMBREDELDIA+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+fechainicio+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+Trabajador[t]['NOMBRES']+' '+Trabajador[t]['APELLIDO_PATERNO']+' '+Trabajador[t]['APELLIDO_MATERNO']+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+HORADEINGRESOMARCACION+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+HORAINICIOALMUERZO+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+HORAFINALMUERZO+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+HORADESALIDAMARCACION+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+TARDANZA+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+PNA+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+PNA+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+FERIADOSCALENDARIO+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+'-'+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+DESCRIPCIONHORARIO+
                                            '</td>'+
                                            '<td style="align-content: center">'+
                                                '<a data-target="#modal_edit_horario_" id="modal_edit_horario" data-toggle="modal" href="" style="text-decoration: none !important">'+
                                                    '<button class="btn btn-block btn-success btn-xs" style="background-color: #18A689 !important;">'+
                                                        '<i class="fas fa-plus-circle"></i>'+
                                                        'Editar'+
                                                    '</button>'+
                                                '</a>'+
                                            '</td>'+
                                        '</tr>';
                                    vat='<tr>'+
                                        '<td colspan="1">'+
                                            'TOTALIZADO'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1" class="text-center">'+
                                            '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+'HORATOTALSUB1'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                        '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+'HORASPERMISOSNA'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                    '</tr>';
                                $("#horafija > tbody").empty();
                        }
                        else{
                            let dia = new Date(fechainicio);
                            let diasemana= dia.getDay();
                            NOMBREDELDIA=diasSemana[diasemana];
                            for(const week in consulta4)
                                {
                                    DIADELHORARIO=consulta4[week]['DESCRIPCION'];
                                    if(NOMBREDELDIA==DIADELHORARIO)
                                    {
                                        DESCRIPCIONHORARIO=consulta4[week]['DESCRIPCIONHORARIO'];
                                        HORADEINGRESOPERSONAL=consulta4[week]['HORA_INICIO'];
                                        HORADESALIDAPERSONAL=consulta4[week]['HORA_FIN'];
                                    }
                                }
                            if(HORADEINGRESOPERSONAL!='' && HORADESALIDAPERSONAL!='')
                            {

                                HORASTRABAJADAS=horastrabajadas(HORADEINGRESOPERSONAL,HORADESALIDAPERSONAL);
                            }
                            else{
                                HORASTRABAJADAS='-';
                            }

                            if(FERIADOSCALENDARIO=='1'){
                                HORASTRABAJADAS='-';
                                DESCRIPCIONHORARIO='FERIADO';
                            }else if(HORADEINGRESOPERSONAL!='' && HORADESALIDAPERSONAL!='')
                            {
                                DESCRIPCIONHORARIO;
                            }else if(FERIADOSCALENDARIO=='-' )
                            {
                                DESCRIPCIONHORARIO='DESCANSO';
                            }
                            TARDANZA = Tardanza(HORADEINGRESOPERSONAL,HORADEINGRESOMARCACION);
                            PNA =PermisosNoAutorizados(HORADEINGRESOPERSONAL,HORADEINGRESOMARCACION,HORADESALIDAPERSONAL,HORADESALIDAMARCACION);
                            vah+='<tr class="selected text-center" style="width:100%; color:black !important">'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+NOMBREDELDIA+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+fechainicio+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+Trabajador[t]['NOMBRES']+' '+Trabajador[t]['APELLIDO_PATERNO']+' '+Trabajador[t]['APELLIDO_MATERNO']+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+'0:00'+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+'0:00'+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+'0:00'+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+'0:00'+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+'-'+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+'-'+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+PNA+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+FERIADOSCALENDARIO+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+HORASTRABAJADAS+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+DESCRIPCIONHORARIO+
                                            '</td>'+
                                            '<td style="align-content: center">'+
                                                '<a data-target="#modal_edit_horario_'+fechainicio+'" id="modal_edit_horario"  data-toggle="modal" href="" style="text-decoration: none !important">'+
                                                    '<button class="btn btn-block btn-success btn-xs" style="background-color: #18A689 !important;">'+
                                                        '<i class="fas fa-plus-circle"></i>'+
                                                        'Editar'+
                                                    '</button>'+
                                                '</a>'+
                                            '</td>'+
                                        '</tr>';
                                vat='<tr>'+
                                        '<td colspan="1">'+
                                            'TOTALIZADO'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1" class="text-center">'+
                                            '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+'HORATOTALSUB1'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                        '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+'HORASPERMISOSNA'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                    '</tr>';
                                $("#horafija > tbody").empty();
                        }
                       
                        fechainicio = editar_fecha(fechainicio,1,"d");
                    }
                    console.log("Terminó el bucle"+fechainicio);
                    CONTADOREXCEL++;
                    $("#hora_detalle").html(vah);
                }

            }
            else{
                alert("no se pudo ingresar");
            }
        }       
    });
}
/**FUNCION PARA CADA PERSONAL */
function listar()
{
    /*SEPARACION DE FECHAS*/ 
    let listaReporte=[];
    let diasSemana = new Array("Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
    let fechainicio=$("#fechainicio").val();
    let fechafin=$("#fechafin").val();
    let dni=$("#dni").val();
    let consulta='';
    let vah='';
    let HORARIOINICIO='';
    let dniconsulta='';
    let CodigoTempus='';
    let consulta3='';
    let dia='';
    let diafestivo='';
    let diasemana='';
    let mes='';
    let weeeekk='';
    let consulta4='';
    let NOMBREDELDIA='';
    let DIADELHORARIO='';
    let DESCRIPCIONHORARIO='';
    let HORADEINGRESOPERSONAL='';
    let HORADESALIDAPERSONAL='';
    let TARDANZA='';
    let HORADEINGRESOMARCACION='';
    let HORADESALIDAMARCACION='';
    let FERIADOSCALENDARIO=''
    let LISTAFERIADOS='';
    let DIAFERIADO='';
    let MESFERIADO='';
    let HORATOTALSUB1='0:00';
    let HORATOTALSUB2='';
    let TOTALHORASTARDANZAS='';
    let HORASPERMISOSNA='0:00';
    let TOTALPERMISOSNA='';
    let HORASFALTAS='0:00';
    let TOTALHORASFALTA='';
    let TOTALHORASPNAS='';
    let SUBTOTALHORASPNAS='0:00';
    let FERIADOSTOTAL='';
    let FERIADOSLARGOS=0;
    let dat=[{fechainicio:fechainicio,fechafin:fechafin,dni:dni}];
    $.ajax({
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:'listarmarcacionPersonal',
        data:{datos:dat},
        type:'post',
        dataType:'json',
        beforeSend:function()
        {
        },
        success:function(response)
        {
            if(response.veri=true)
            {
                let Marcacion_detalle=response.reporteDetalle;
                let Trabajador = response.listatrabajador;
                let DetalleHorario = response.detalleHorario;
                let Feriados= response.feriados;
                for(const t in Trabajador)
                {   
                    /*************************************************************/
                                /* DECLARACIONES DE VARIABLES GLOBALES*/
                    /*************************************************************/
                    /*se vuelve a recorrer la las fechas y se obtiene el valor*/ 
                    let fechainicio=$("#fechainicio").val();
                    let fechafin=$("#fechafin").val();
                    /**variable para consultar el dni dentro del filter array(MARCACION_DETALLE)*/
                    dniconsulta=Trabajador[t]['DNI'];
                    /**variable para consultar el codigo del tempus dentro del filter array(MARCACION_DETALLE)*/
                    CodigoTempus=Trabajador[t]['CODIGO_TEMPUS'];
                    while(fechainicio<=fechafin)
                    {                      
                        /**PARA OBTENER EL DIA Y EL MES EN NUMEROS */
                        diafestivo = DIA(fechainicio);
                        mes = MES(fechainicio);
                        /**FIN PARA OBTENER EL DIA Y EL MES EN NUMEROS */
                        /**PARA OBTENER EL DIA DE LA SEMANA EN PALABRAS */
                        dia = new Date(fechainicio);
                        diasemana= dia.getDay();
                        weeeekk=diasSemana[diasemana];
                        /**FIN PARA OBTENER EL DIA DE LA SEMANA EN PALABRAS */
                        LISTAFERIADOS = Feriados.filter(function (f){ return f.MES==mes && f.DIA==diafestivo;});
                        consulta3 = Marcacion_detalle.filter(function (c){return c.NUMERO_TARJETA== dniconsulta && c.FECHA==fechainicio && c.CODIGO==CodigoTempus;});
                        consulta4 = DetalleHorario.filter(function (d){return d.DESCRIPCION == weeeekk;});
                        if(consulta3.length>0)
                        {
                            consulta=true;
                        }else{
                            consulta=false;
                        }
                        if(LISTAFERIADOS.length>0)
                        {
                            for(const f in LISTAFERIADOS)
                            {
                                DIAFERIADO=LISTAFERIADOS[f]['DIA'];
                                MESFERIADO=LISTAFERIADOS[f]['MES'];
                                if(diafestivo==DIAFERIADO && mes==MESFERIADO)
                                {
                                    FERIADOSCALENDARIO='1'
                                    FERIADOSLARGOS++;
                                    console.log(FERIADOSLARGOS);
                                }
                            }
                        }
                        else{
                            FERIADOSCALENDARIO='-'
                        }
                        if(consulta==true)
                        {
                            $("#horafija > tbody").empty();
                            for(const array2 in consulta3)
                            {
                                NOMBREDELDIA = consulta3[array2]['DIA'];
                                HORADEINGRESOMARCACION =consulta3[array2]['INICIO'];
                                HORADESALIDAMARCACION =consulta3[array2]['FIN'];
                                for(const week in consulta4)
                                {
                                    DIADELHORARIO=consulta4[week]['DESCRIPCION'];
                                    if(NOMBREDELDIA==DIADELHORARIO)
                                    {
                                        DESCRIPCIONHORARIO=consulta4[week]['DESCRIPCIONHORARIO'];
                                        HORADEINGRESOPERSONAL=consulta4[week]['HORA_INICIO'];
                                        HORADESALIDAPERSONAL=consulta4[week]['HORA_FIN'];
                                    }else{
                                        DESCRIPCIONHORARIO=consulta4[week]['DESCRIPCIONHORARIO'];
                                    }
                                }
                                if(HORADEINGRESOPERSONAL=='' && HORADESALIDAPERSONAL=='')
                                {
                                    TARDANZA='-';
                                }else{
                                    TARDANZA = Tardanza(HORADEINGRESOPERSONAL,HORADEINGRESOMARCACION);
                                    console.log(TARDANZA);
                                    if(TARDANZA!='NO HAY TARDANZAS')
                                    {
                                        TOTALHORASTARDANZAS=horastrabajadas2(HORATOTALSUB1,TARDANZA);
                                        HORATOTALSUB1=TOTALHORASTARDANZAS;
                                        console.log(HORATOTALSUB1);
                                    }
                                }
                                if(FERIADOSCALENDARIO=='1'){
                                    HORASTRABAJADAS='-';
                                    DESCRIPCIONHORARIO='FERIADO';
                                }else if(HORADEINGRESOPERSONAL!='' && HORADESALIDAPERSONAL!='')
                                {
                                    DESCRIPCIONHORARIO;
                                }
                                PNA =PermisosNoAutorizados(HORADEINGRESOPERSONAL,HORADEINGRESOMARCACION);
                                PNAS=PermisosNoAutorizadosSalidas(HORADESALIDAPERSONAL,HORADESALIDAMARCACION);
                                if(PNAS!='-')
                                {
                                    TOTALHORASPNAS=horastrabajadas4(SUBTOTALHORASPNAS,PNAS);
                                    SUBTOTALHORASPNAS=TOTALHORASPNAS;
                                }
                                console.log(PNA);
                                if(PNA!='-')
                                {
                                    TOTALPERMISOSNA=horastrabajadas2(HORASPERMISOSNA,PNA);
                                    HORASPERMISOSNA=TOTALPERMISOSNA;
                                }
                                vah+='<tr class="selected text-center" style="width:100%; color:black !important">'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+consulta3[array2]['DIA']+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+consulta3[array2]['FECHA']+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+Trabajador[t]['NOMBRES']+' '+Trabajador[t]['APELLIDO_PATERNO']+' '+Trabajador[t]['APELLIDO_MATERNO']+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+consulta3[array2]['INICIO']+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+consulta3[array2]['FIN']+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+TARDANZA+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+PNA+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+PNAS+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+FERIADOSCALENDARIO+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+'-'+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+DESCRIPCIONHORARIO+
                                            '</td>'+
                                            '<td style="align-content: center">'+
                                                '<a data-target="#modal_edit_horario_'+consulta3[array2]['FECHA']+'" id="modal_edit_horario" data-toggle="modal" href="" style="text-decoration: none !important">'+
                                                    '<button class="btn btn-block btn-success btn-xs" style="background-color: #18A689 !important;">'+
                                                        '<i class="fas fa-plus-circle"></i>'+
                                                        'Editar'+
                                                    '</button>'+
                                                '</a>'+
                                            '</td>'+
                                        '</tr>';
                                vat='<tr>'+
                                        '<td colspan="1">'+
                                            'TOTALIZADO'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1" class="text-center">'+
                                            '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+HORATOTALSUB1+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+HORASPERMISOSNA+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+SUBTOTALHORASPNAS+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+FERIADOSLARGOS+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                    '</tr>';
                                $("#horafija > tbody").empty();
                            }
                        }
                        else{
                            let dia = new Date(fechainicio);
                            let diasemana= dia.getDay();
                            NOMBREDELDIA=diasSemana[diasemana];
                            for(const week in consulta4)
                                {
                                    DIADELHORARIO=consulta4[week]['DESCRIPCION'];
                                    if(NOMBREDELDIA==DIADELHORARIO)
                                    {
                                        DESCRIPCIONHORARIO=consulta4[week]['DESCRIPCIONHORARIO'];
                                        HORADEINGRESOPERSONAL=consulta4[week]['HORA_INICIO'];
                                        HORADESALIDAPERSONAL=consulta4[week]['HORA_FIN'];
                                    }
                                }
                            if(HORADEINGRESOPERSONAL!='' && HORADESALIDAPERSONAL!='')
                            {

                                HORASTRABAJADAS=horastrabajadas(HORADEINGRESOPERSONAL,HORADESALIDAPERSONAL);
                            }
                            else{
                                HORASTRABAJADAS='-';
                            }
                            if(FERIADOSCALENDARIO=='1'){
                                HORASTRABAJADAS='-';
                                DESCRIPCIONHORARIO='FERIADO';
                            }else if(HORADEINGRESOPERSONAL!='' && HORADESALIDAPERSONAL!='')
                            {
                                DESCRIPCIONHORARIO;
                            }else if(FERIADOSCALENDARIO=='-' )
                            {
                                DESCRIPCIONHORARIO='DESCANSO';
                            }
                            TARDANZA = Tardanza(HORADEINGRESOPERSONAL,HORADEINGRESOMARCACION);
                            PNA =PermisosNoAutorizados(HORADEINGRESOPERSONAL,HORADEINGRESOMARCACION,HORADESALIDAPERSONAL,HORADESALIDAMARCACION);
                            PNAS=PermisosNoAutorizadosSalidas(HORADESALIDAPERSONAL,HORADESALIDAMARCACION);
                            if(PNAS!='-')
                            {
                                TOTALHORASPNAS=horastrabajadas4(SUBTOTALHORASPNAS,PNAS);
                                SUBTOTALHORASPNAS=TOTALHORASPNAS;
                            }
                            if(HORASTRABAJADAS!='-')
                            {
                                TOTALHORASFALTA=horastrabajadas3(HORASFALTAS,HORASTRABAJADAS);
                                HORASFALTAS=TOTALHORASFALTA;
                            }
                            $("#horafija > tbody").empty();
                            vah+='<tr class="selected text-center" style="width:100%; color:black !important">'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+diasSemana[diasemana]+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+fechainicio+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+Trabajador[t]['NOMBRES']+' '+Trabajador[t]['APELLIDO_PATERNO']+' '+Trabajador[t]['APELLIDO_MATERNO']+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+'0:00'+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+'0:00'+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+'-'+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+'-'+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+'-'+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+FERIADOSCALENDARIO+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+HORASTRABAJADAS+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+DESCRIPCIONHORARIO+
                                            '</td>'+
                                            '<td style="align-content: center">'+
                                                '<a data-target="#modal_edit_horario_'+fechainicio+'" id="modal_edit_horario"  data-toggle="modal" href="" style="text-decoration: none !important">'+
                                                    '<button class="btn btn-block btn-success btn-xs" style="background-color: #18A689 !important;">'+
                                                        '<i class="fas fa-plus-circle"></i>'+
                                                        'Editar'+
                                                    '</button>'+
                                                '</a>'+
                                            '</td>'+
                                        '</tr>';
                                        $("#horafija > tbody").empty();
                                vat='<tr>'+
                                        '<td colspan="1">'+
                                            'TOTALIZADO'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1" class="text-center">'+
                                            '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+HORATOTALSUB1+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+HORASPERMISOSNA+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+SUBTOTALHORASPNAS+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+FERIADOSLARGOS+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '<input id="" style="width: 70px !important;" type="hidden" name="" value="">'+HORASFALTAS+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                        '<td colspan="1">'+
                                            '-'+
                                        '</td>'+
                                    '</tr>';
                        }
                        $("#hora_detalle").html(vah);
                        $("#totales_general").html(vat);
                        fechainicio = editar_fecha(fechainicio,1,"d");
                    }
                    console.log("Terminó el bucle"+fechainicio);
                }
                //primer bucle
            }
            else{
                alert("no se pudo ingresar")
            }
        }
    });
}
function PermisosNoAutorizados(sHora1,sHora2){
    /**HORA INICIO */
    var arHora1 = sHora1.split(":"); 
     var arHora2 = sHora2.split(":"); 
     /**HORA FIN */
/**ACA SE OBTIENE LAS HORAS Y MINUTOS DE LA HORA INICIAL */
     // Obtener horas y minutos (hora 1) 
     var hh1 = parseInt(arHora1[0],10); 
     var mm1 = parseInt(arHora1[1],10); 
     // Obtener horas y minutos (hora 2) 
     var hh2 = parseInt(arHora2[0],10); 
     var mm2 = parseInt(arHora2[1],10); 
/**ACA SE OBTIENE LAS HORAS Y MINUTOS PARA LA RESTA HORA INICIAL */
    inicioMinutos = parseInt(sHora1.substr(3,2));
    inicioHoras = parseInt(sHora1.substr(0,2));
    finMinutos = parseInt(sHora2.substr(3,2));
    finHoras = parseInt(sHora2.substr(0,2));
/**SE RESTA LA HORA Y MINUTOS FINAL DEL INICIO DE MARCACION Y LA HORA Y MINUTOS INICIO DEL INICIO DE LA MARCACION */
    transcurridoMinutos = finMinutos - inicioMinutos;
    transcurridoHoras = finHoras - inicioHoras;
/**PRIMER IF PARA SABER LAS HORAS Y MIUNUTOS DE DIFERENCIA DE HORA INICIO Y HORA INICIO MARCACION */
    if(transcurridoMinutos < 0)
    {
        transcurridoHoras--;
        transcurridoMinutos = 60 + transcurridoMinutos;
    }
    horas = transcurridoHoras.toString();
    minutos = transcurridoMinutos.toString();
    if(horas>=2)
    {
        if (horas.length < 2 ) 
        {
            horas = "0"+horas;
        }
        if(minutos.length<2)
        {
            minutos="0"+minutos;
        }
        return horas+":"+minutos;
    }
    else{
        return "-";
    }
}
function PermisosNoAutorizadosSalidas(sHora1,sHora2){
    /**HORA INICIO */
    var arHora1 = sHora1.split(":"); 
     var arHora2 = sHora2.split(":"); 
/**ACA SE OBTIENE LAS HORAS Y MINUTOS DE LA HORA INICIAL */
     // Obtener horas y minutos (hora 1) 
     var hh1 = parseInt(arHora1[0],10); 
     var mm1 = parseInt(arHora1[1],10); 
     // Obtener horas y minutos (hora 2) 
     var hh2 = parseInt(arHora2[0],10); 
     var mm2 = parseInt(arHora2[1],10); 
/**ACA SE OBTIENE LAS HORAS Y MINUTOS PARA LA RESTA HORA INICIAL */
    inicioMinutos = parseInt(sHora1.substr(3,2));
    inicioHoras = parseInt(sHora1.substr(0,2));
    finMinutos = parseInt(sHora2.substr(3,2));
    finHoras = parseInt(sHora2.substr(0,2));
/**SE RESTA LA HORA Y MINUTOS FINAL DEL INICIO DE MARCACION Y LA HORA Y MINUTOS INICIO DEL INICIO DE LA MARCACION */
    transcurridoMinutos =inicioMinutos-finMinutos;
    transcurridoHoras =inicioHoras- finHoras;
/**SE SUMA HORA Y MINUTOS PARA LA HORA DE SALIDA*/
/**PRIMER IF PARA SABER LAS HORAS Y MIUNUTOS DE DIFERENCIA DE HORA INICIO Y HORA INICIO MARCACION */
    if(transcurridoMinutos < 0)
    {
        transcurridoHoras--;
        transcurridoMinutos = 60 + transcurridoMinutos;
    }
    horas = transcurridoHoras.toString();
    minutos = transcurridoMinutos.toString();
    if(hh1>hh2 || (hh1==hh2 && mm1>mm2))
    {
        if (horas.length < 2) 
        {
            horas = "0"+horas;
        }
        if (minutos.length < 2) 
        {
            minutos = "0"+minutos;
        }

        return horas+":"+minutos;
    }
    else if(hh1==0 && mm1==0 )
    {
        return "-";
    }
    else{
        return "-";
    }
}
/**LAS TARDANZAS SE CALCULAN SIEMPRE  Y CUANDO SEAN MENORES DE 2 HORAS */
function Tardanza(sHora1,sHora2)
{
    var arHora1 = sHora1.split(":"); 
    var arHora2 = sHora2.split(":"); 
    // Obtener horas y minutos (hora 1) 
    var hh1 = parseInt(arHora1[0],10); 
    var mm1 = parseInt(arHora1[1],10); 
    // Obtener horas y minutos (hora 2) 
    var hh2 = parseInt(arHora2[0],10); 
    var mm2 = parseInt(arHora2[1],10); 
    inicioMinutos = parseInt(sHora1.substr(3,2));
    inicioHoras = parseInt(sHora1.substr(0,2));
    finMinutos = parseInt(sHora2.substr(3,2));
    finHoras = parseInt(sHora2.substr(0,2));
    transcurridoMinutos = finMinutos - inicioMinutos;
    transcurridoHoras = finHoras - inicioHoras;
    if(transcurridoMinutos < 0)
    {
        transcurridoHoras--;
        transcurridoMinutos = 60 + transcurridoMinutos;
    }
    horas = transcurridoHoras.toString();
    minutos = transcurridoMinutos.toString();
    if(horas>=2)
    {
        return '-';
    }
    else if(hh2==hh1 && mm2<mm1){
        return 'NO HAY TARDANZAS';
    }
    else if(hh1>hh2 || (hh1==hh2 && mm1>mm2)) 
    {
        return 'NO HAY TARDANZAS';
    }
    else{
        if (horas.length < 2) 
        {
            horas = "0"+horas;
        }
        if (minutos.length < 2) 
        {
            minutos = "0"+minutos;
        }
        return horas+":"+minutos;
    }
}
/**FUNCIN PARA COMPRAR HORAS*/
function CompararHoras(sHora1, sHora2) { 
     
     var arHora1 = sHora1.split(":"); 
     var arHora2 = sHora2.split(":"); 
     // Obtener horas y minutos (hora 1) 
     var hh1 = parseInt(arHora1[0],10); 
     var mm1 = parseInt(arHora1[1],10); 
     // Obtener horas y minutos (hora 2) 
     var hh2 = parseInt(arHora2[0],10); 
     var mm2 = parseInt(arHora2[1],10); 
     // Comparar 
     if (hh1<hh2 || (hh1==hh2 && mm1<mm2)) 
         return "sHora1 MENOR sHora2"; 
     else if (hh1>hh2 || (hh1==hh2 && mm1>mm2)) 
         return "sHora1 MAYOR sHora2"; 
     else  
         return "sHora1 IGUAL sHora2"; 
 }
function MES(MES)
{
    var separador = separador || "-";
    var arrayFecha = MES.split(separador);

    var anio = arrayFecha[0];
    var mes = arrayFecha[1];
    var dia = arrayFecha[2];  
    return mes;
}
function DIA(DIA)
{
    var separador = separador || "-";
    var arrayFecha = DIA.split(separador);

    var anio = arrayFecha[0];
    var mes = arrayFecha[1];
    var dia = arrayFecha[2];  
    return dia;
}
/**FUNCION PARA SUMAR DIAS,MESES,AÑOS */
function editar_fecha(fecha, intervalo, dma, separador) {

    var separador = separador || "-";
    var arrayFecha = fecha.split(separador);
    var anio = arrayFecha[0];
    var mes = arrayFecha[1];
    var dia = arrayFecha[2];  
    var fechaInicial = new Date(anio, mes - 1, dia);
    var fechaFinal = fechaInicial;
    if(dma=="m" || dma=="M"){
    fechaFinal.setMonth(fechaInicial.getMonth()+parseInt(intervalo));
    }else if(dma=="y" || dma=="Y"){
    fechaFinal.setFullYear(fechaInicial.getFullYear()+parseInt(intervalo));
    }else if(dma=="d" || dma=="D"){
    fechaFinal.setDate(fechaInicial.getDate()+parseInt(intervalo));
    }else{
        return fecha;
    }
    dia = fechaFinal.getDate();
    mes = fechaFinal.getMonth() + 1;
    anio = fechaFinal.getFullYear();
    dia = (dia.toString().length == 1) ? "0" + dia.toString() : dia;
    mes = (mes.toString().length == 1) ? "0" + mes.toString() : mes;
    return anio + "-" + mes + "-" + dia;
}
function horastrabajadas(sHora1,sHora2)
{
    var arHora1 = sHora1.split(":"); 
    var arHora2 = sHora2.split(":"); 
    // Obtener horas y minutos (hora 1) 
    var hh1 = parseInt(arHora1[0],10); 
    var mm1 = parseInt(arHora1[1],10); 
    // Obtener horas y minutos (hora 2) 
    var hh2 = parseInt(arHora2[0],10); 
    var mm2 = parseInt(arHora2[1],10); 
    inicioMinutos = parseInt(sHora1.substr(3,2));
    inicioHoras = parseInt(sHora1.substr(0,2));
    finMinutos = parseInt(sHora2.substr(3,2));
    finHoras = parseInt(sHora2.substr(0,2));
    transcurridoMinutos = finMinutos - inicioMinutos;
    transcurridoHoras = finHoras - inicioHoras;
    if(transcurridoMinutos < 0)
    {
        transcurridoHoras--;
        transcurridoMinutos = 60 + transcurridoMinutos;
    }
    horas = transcurridoHoras.toString();
    minutos = transcurridoMinutos.toString();
    if (horas.length < 2) 
    {
        horas = "0"+horas;
    }
    if (minutos.length < 2) 
    {
        minutos = "0"+minutos;
    }
    return horas+":"+minutos;
}
function horastrabajadas2(sHora1,sHora2)
{
    var arHora1 = sHora1.split(":"); 
    var arHora2 = sHora2.split(":"); 
    // Obtener horas y minutos (hora 1) 
    var hh1 = parseInt(arHora1[0],10); 
    var mm1 = parseInt(arHora1[1],10); 
    // Obtener horas y minutos (hora 2) 
    var hh2 = parseInt(arHora2[0],10); 
    var mm2 = parseInt(arHora2[1],10); 
    inicioMinutos = parseInt(sHora1.substr(3,2));
    inicioHoras = parseInt(sHora1.substr(0,2));
    finMinutos = parseInt(sHora2.substr(3,2));
    finHoras = parseInt(sHora2.substr(0,2));
    transcurridoMinutos = finMinutos + inicioMinutos;
    transcurridoHoras = finHoras + inicioHoras;
    if(transcurridoMinutos >=60)
    {
        transcurridoHoras++;
        transcurridoMinutos =transcurridoMinutos - 60;
    }
    horas = transcurridoHoras.toString();
    minutos = transcurridoMinutos.toString();
    if (horas.length < 2) 
    {
        horas = "0"+horas;
    }
    if(minutos.length<2)
    {
        minutos="0"+minutos;
    }
    return horas+":"+minutos;
}
function horastrabajadas3(sHora1,sHora2)
{
    var arHora1 = sHora1.split(":"); 
    var arHora2 = sHora2.split(":"); 
    // Obtener horas y minutos (hora 1) 
    var hh1 = parseInt(arHora1[0],10); 
    var mm1 = parseInt(arHora1[1],10); 
    // Obtener horas y minutos (hora 2) 
    var hh2 = parseInt(arHora2[0],10); 
    var mm2 = parseInt(arHora2[1],10); 
    inicioMinutos = parseInt(sHora1.substr(3,2));
    inicioHoras = parseInt(sHora1.substr(0,2));
    finMinutos = parseInt(sHora2.substr(3,2));
    finHoras = parseInt(sHora2.substr(0,2));
    transcurridoMinutos = finMinutos + inicioMinutos;
    transcurridoHoras = finHoras + inicioHoras;
    if(transcurridoMinutos >=60)
    {
        transcurridoHoras++;
        transcurridoMinutos =transcurridoMinutos - 60;
    }
    horas = transcurridoHoras.toString();
    minutos = transcurridoMinutos.toString();
    if (horas.length < 2) 
    {
        horas = "0"+horas;
    }
    if (minutos.length < 2) 
    {
        minutos = "0"+minutos;
    }
    return horas+":"+minutos;
}
function horastrabajadas4(sHora1,sHora2)
{
    var arHora1 = sHora1.split(":"); 
    var arHora2 = sHora2.split(":"); 
    // Obtener horas y minutos (hora 1) 
    var hh1 = parseInt(arHora1[0],10); 
    var mm1 = parseInt(arHora1[1],10); 
    // Obtener horas y minutos (hora 2) 
    var hh2 = parseInt(arHora2[0],10); 
    var mm2 = parseInt(arHora2[1],10); 
    inicioMinutos = parseInt(sHora1.substr(3,2));
    inicioHoras = parseInt(sHora1.substr(0,2));
    finMinutos = parseInt(sHora2.substr(3,2));
    finHoras = parseInt(sHora2.substr(0,2));
    transcurridoMinutos = finMinutos + inicioMinutos;
    transcurridoHoras = finHoras + inicioHoras;
    if(transcurridoMinutos >=60)
    {
        transcurridoHoras++;
        transcurridoMinutos =transcurridoMinutos - 60;
    }
    horas = transcurridoHoras.toString();
    minutos = transcurridoMinutos.toString();
    if (horas.length < 2) 
    {
        horas = "0"+horas;
    }
    if (minutos.length < 2) 
    {
        minutos = "0"+minutos;
    }
    return horas+":"+minutos;
}
function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; 
    let j=0;
    tab = document.getElementById('horafija'); // id of table
    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        console.log(tab_text);
        //tab_text=tab_text+"</tr>";
    }
    console.log(tab_text);
    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
    while (tab_text.indexOf('á') != -1) tab_text = tab_text.replace('á', '&aacute;');
    while (tab_text.indexOf('é') != -1) tab_text = tab_text.replace('é', '&eacute;');
    while (tab_text.indexOf('í') != -1) tab_text = tab_text.replace('í', '&iacute;');
    while (tab_text.indexOf('ó') != -1) tab_text = tab_text.replace('ó', '&oacute;');
    while (tab_text.indexOf('ú') != -1) tab_text = tab_text.replace('ú', '&uacute;');
    while (tab_text.indexOf('º') != -1) tab_text = tab_text.replace('º', '&ordm;');

    console.log(tab_text);
    var ua = window.navigator.userAgent;
    console.log(ua);
    var msie = ua.indexOf("MSIE "); 
    console.log(msie);
    /**ACA NO ENTRA SI ESTAS EN CHROME , MOZILLA,  */
    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else {
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
        console.log(sa);
    }
    return (sa);
}
var tableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,',
        template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
        base64 = function(s) { 
          return window.btoa(unescape(encodeURIComponent(s))) 
        },
        format = function(s, c) { 
          return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; })
        }
    return function(table, name) {
        if (table.nodeType) table = document.getElementById("horafija")
        var ctx = {worksheet: name || 'horafija', table: horafija.innerHTML}
        window.location.href = uri + base64(format(template, ctx))
    }
})()
</script>
@endpush
@endsection
