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
                </div>
                <div class="box-body">
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-md-12">
                            <form class="form-inline">
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
                            </form>                        
                        </div>
                    </div>
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
                                   M.FIN
                                </th>
                                <th>
                                    TARDANZAS
                                </th>
                                <th>
                                    P.N.A
                                </th>
                                <th>
                                    FERIADO
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
                                <th colspan="10" align="text-center">
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
                        @include('Marcacion.Reporte.modal_edit_horario')
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</section>
@push('scripts')
<script>
$(document).ready(function(){
        $('#listar').click(function(){
            listar();
        });
});
function listar()
{
    /*SEPARACION DE FECHAS*/ 
    let listaReporte=[];
    var diasSemana = new Array("Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
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
    console.log(fechainicio);
    console.log(fechafin);
    let dat=[{fechainicio:fechainicio,fechafin:fechafin,dni:dni}];
    console.log(dat);
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
                console.log(Feriados);
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
                        console.log('EL MES ES'+mes+'-'+diafestivo);
                        /**PARA OBTENER EL DIA DE LA SEMANA EN PALABRAS */
                        dia = new Date(fechainicio);
                        diasemana= dia.getDay();
                        weeeekk=diasSemana[diasemana];
                        /**FIN PARA OBTENER EL DIA DE LA SEMANA EN PALABRAS */
                        console.log('DIA DE LA SEMANA:'+weeeekk);
                        LISTAFERIADOS = Feriados.filter(function (f){ return f.MES==mes && f.DIA==diafestivo;});
                        consulta3 = Marcacion_detalle.filter(function (c){return c.NUMERO_TARJETA== dniconsulta && c.FECHA==fechainicio && c.CODIGO==CodigoTempus;});
                        consulta4 = DetalleHorario.filter(function (d){return d.DESCRIPCION == weeeekk;});
                        console.log(LISTAFERIADOS);
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
                                console.log(diafestivo+'-'+mes);
                                if(diafestivo==DIAFERIADO && mes==MESFERIADO)
                                {
                                    FERIADOSCALENDARIO='1'
                                }
                            }
                        }
                        else{
                            FERIADOSCALENDARIO='-'
                        }
                        
                        $("#horafija > tbody").empty();
                        if(consulta==true)
                        {
                            $("#horafija > tbody").empty();
                            for(const array2 in consulta3 )
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

                                TARDANZA = Tardanza(HORADEINGRESOPERSONAL,HORADEINGRESOMARCACION);
                                PNA =PermisosNoAutorizados(HORADEINGRESOPERSONAL,HORADEINGRESOMARCACION,HORADESALIDAPERSONAL,HORADESALIDAMARCACION);
                                vah+='<tr class="selected text-center" style="width:100%; color:black !important">'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+consulta3[array2]['DIA']+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+consulta3[array2]['FECHA']+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+Trabajador[t]['NOMBRES']+
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
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+FERIADOSCALENDARIO+
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
                                $("#horafija > tbody").empty();
                            }
                            
                        }
                        else{
                            TARDANZA = Tardanza(HORADEINGRESOPERSONAL,HORADEINGRESOMARCACION);
                            PNA =PermisosNoAutorizados(HORADEINGRESOPERSONAL,HORADEINGRESOMARCACION,HORADESALIDAPERSONAL,HORADESALIDAMARCACION);
                            let dia = new Date(fechainicio);
                            let diasemana= dia.getDay();
                            vah+='<tr class="selected text-center" style="width:100%; color:black !important">'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+diasSemana[diasemana]+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+fechainicio+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+Trabajador[t]['NOMBRES']+
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
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+PNA+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="" value="">'+FERIADOSCALENDARIO+
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
                                $("#horafija > tbody").empty();
                        }
                        $("#hora_detalle").html(vah);
                        console.log(consulta4);
                        
                        console.log(TARDANZA);
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
function PermisosNoAutorizados(sHora1,sHora2,sHora3,sHora4){
    /**HORA INICIO */
    var arHora1 = sHora1.split(":"); 
     var arHora2 = sHora2.split(":"); 
     /**HORA FIN */
     var arHora3= sHora3.split(":");
     var arHora4=sHora4.split(":");
/**ACA SE OBTIENE LAS HORAS Y MINUTOS DE LA HORA INICIAL */
     // Obtener horas y minutos (hora 1) 
     var hh1 = parseInt(arHora1[0],10); 
     var mm1 = parseInt(arHora1[1],10); 
     // Obtener horas y minutos (hora 2) 
     var hh2 = parseInt(arHora2[0],10); 
     var mm2 = parseInt(arHora2[1],10); 
/**ACA SE OBTIENE LAS HORAS Y MINUTOS DE LA HORA FINAL */
     // Obtener horas y minutos (hora 1) 
     var hh3 = parseInt(arHora3[0],10); 
     var mm3 = parseInt(arHora3[1],10); 
     // Obtener horas y minutos (hora 2) 
     var hh4 = parseInt(arHora4[0],10); 
     var mm3 = parseInt(arHora4[1],10); 
/**ACA SE OBTIENE LAS HORAS Y MINUTOS PARA LA RESTA HORA INICIAL */
    inicioMinutos = parseInt(sHora1.substr(3,2));
    inicioHoras = parseInt(sHora1.substr(0,2));
    finMinutos = parseInt(sHora2.substr(3,2));
    finHoras = parseInt(sHora2.substr(0,2));
/**ACA SE OBTIENE LAS HORAS Y MINUTOS PARA LA RESTA HORA FINAL*/
    inicioMinutosHF = parseInt(sHora3.substr(3,2));
    inicioHorasHF = parseInt(sHora3.substr(0,2));
    finMinutosHF = parseInt(sHora4.substr(3,2));
    finHorasHF = parseInt(sHora4.substr(0,2));
/**SE RESTA LA HORA Y MINUTOS FINAL DEL INICIO DE MARCACION Y LA HORA Y MINUTOS INICIO DEL INICIO DE LA MARCACION */
    transcurridoMinutos = finMinutos - inicioMinutos;
    transcurridoHoras = finHoras - inicioHoras;
/**SE SUMA HORA Y MINUTOS PARA LA HORA DE SALIDA*/
    transcurridoMinutosHF = inicioMinutosHF - finMinutosHF;
    transcurridoHorasHF = inicioHorasHF - finHorasHF;

    if(transcurridoHoras>=2 && transcurridoMinutosHF>0)
    {
        if (transcurridoMinutos < 0 && transcurridoMinutosHF < 0) 
        {
            transcurridoHoras--;
            transcurridoHorasHF--;
            transcurridoMinutos = 60 + transcurridoMinutos;
            transcurridoMinutosHF = 60 + transcurridoMinutosHF;
            transcurridoMinutosF =transcurridoMinutos+transcurridoMinutosHF;
            horafinal=transcurridoHoras+transcurridoHorasHF;
        }else{
            horafinal=transcurridoHoras+transcurridoHorasHF;
        }

        horas = horafinal.toString();
        minutos = transcurridoMinutosF.toString();
        if (horas.length < 2) 
        {
            horas = "0"+horas;
        }

        if (horas.length < 2) 
        {
            horas = "0"+horas;
        }
        console.log(horas+':'+minutos);
        return horas+":"+minutos;
    }
    else if(transcurridoHoras>=2 )
    {
        if (transcurridoMinutos < 0) 
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

        if (horas.length < 2) 
        {
            horas = "0"+horas;
        }
        console.log(horas+':'+minutos);
        return horas+":"+minutos;
    }
    else if(transcurridoMinutosHF>0)
    {
        if (transcurridoMinutosHF < 0) 
        {
            transcurridoHorasHF--;
            transcurridoMinutosHF = 60 + transcurridoMinutosHF;
        }

        horas = transcurridoHorasHF.toString();
        minutos = transcurridoMinutosHF.toString();
        if (horas.length < 2) 
        {
            horas = "0"+horas;
        }

        if (horas.length < 2) 
        {
            horas = "0"+horas;
        }
        console.log(horas+':'+minutos);
        return horas+":"+minutos;
    }
    else{
        return "-";
    }
}
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
    if(transcurridoHoras>=2)
    {
        return "-";
    }
    else if(hh2==hh1 && mm2<mm1){
            return 'NO HAY TARDANZAS';
    }
    else{
        if (transcurridoMinutos < 0) 
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

        if (horas.length < 2) 
        {
            horas = "0"+horas;
        }
        console.log(horas+':'+minutos);
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
</script>
@endpush
@endsection
