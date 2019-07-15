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
                            <i class="fas fa-list-ul"></i> Lista de Horario
                        </strong>
                    </h4>
                    <div class="ibox-title-buttons pull-right">
                        <a  data-target="#modal-create-horario"  data-toggle="modal" href="" style="text-decoration: none !important">
                            <button class="btn btn-block btn-success" style="background-color: #18A689 !important;">
                                <i class="fas fa-plus-circle"></i> Nuevo Horario
                            </button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                        <thead> 
                            <tr>
                                <th>
                                    CODIGO
                                </th>
                                <th>
                                    DESCRIPCION
                                </th>
                                <th>
                                   TIPO HORARIO
                                </th>
                                <th>
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Horario as $h)
                                <tr>
                                    <td>
                                        {{$h->HORARIO}}
                                    </td>
                                    <td>
                                        {{$h->DESCRIPCION}}
                                    </td>
                                    <td>
                                        {{$h->TIPO_HORARIO}}
                                    </td>
                                    <td style="align-content: center">
                                        <button onclick="datos('{{$h->HORARIO}}')"  >VER</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @include('Marcacion.Horario.modal_edit')
                    </table>
                    {{$Horario->render()}}
                </div>
                @include('Marcacion.Horario.modal_create')
            </div>
        </div>
    </div>
    
</section>
@push('scripts')
<script>
$(document).ready(function(){
    $('input.timepicker').timepicker({
        timeFormat: 'HH:mm',
    });
});
$('#btnagregar').click(function(){
    agregarHorarioTableros();     
});
$('#save').click(function(){
    savehorario();
});
var filaob=[];
var cont=0;
function datos(horarios)
        {
            var horariosd=horarios;
                console.log(horariosd);
                $.ajax(
                    {
                        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url:'horadetalle_hora',
                        data:{dato:horariosd},
                        type:'post',
                        dataType:'json',
                        beforeSend: function()
                        {
                                //console.log('procesando');
                        },
                        success:function(response)
                        {
                            if(response.veri=true)
                            {
                                vah='';
                                var horario_detalle_lista = response.lista;
                                $("#horafija > tbody").empty();
                                for(const i in horario_detalle_lista)
                                {   
                                    vah+='<tr class="selected text-center" style="width:100%; color:black !important">'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+horario_detalle_lista[i]['DESCRIPCION']+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+horario_detalle_lista[i]['HORA_INICIO']+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input style="width: 70px !important;" type="hidden" name="" value="">'+horario_detalle_lista[i]['HORA_FIN']+
                                            '</td>'+
                                            '<td class="text-center">'+
                                                '<input id="HORARIODETALLEM" style="width: 70px !important;" type="hidden" name="'+horario_detalle_lista[i]['HORARIO']+'" value="'+horario_detalle_lista[i]['HORARIO']+'">'+horario_detalle_lista[i]['HORARIO']+
                                            '</td>'+
                                        '</tr>';
                                    $('#horafija tbody').append(vah);
                                }
                               $("#hora_detalle").html(vah);
                            }
                            else
                            {
                                alert("problemas al enviar la informacion");
                            }
                        }
                    }
                );
            }
function agregarHorarioTableros(){
    var CodDia=$("#dia").val();
    var HoraInicio=$("#horainicio").val();
    var HoraFin=$("#horafin").val();
    var CodigoHora=$("#correlativo").val();
    var data=[{CodigoHora:CodigoHora,HoraFin:HoraFin,
        HoraInicio:HoraInicio,CodDia:CodDia
    }]
    //console.log(data);
    if(HoraInicio!='' && HoraFin!='')
    {
        var fila='<tr class="selected text-center" style="width:100%; color:black !important" id="fila'+cont+'">'+
                    '<td class="text-center">'+
                        '<input id="codigodia" style="width: 70px !important;" type="hidden" name="" value="'+CodDia+'">'+CodDia+
                    '</td>'+
                    '<td class="text-center">'+
                        '<input id="horainicio" style="width: 70px !important;" type="hidden" name="" value="'+HoraInicio+'">'+HoraInicio+
                    '</td>'+
                    '<td class="text-center">'+
                        '<input id="horafin" style="width: 70px !important;" type="hidden" name="" value="'+HoraFin+'">'+HoraFin+
                    '</td>'+
                    '<td class="text-center">'+
                        '<input  id="codigohora" style="width: 70px !important;" type="hidden" name="" value="'+CodigoHora+'">'+CodigoHora+
                    '</td>'+
                    '<td>'+
                        '<button type="button" class="btn btn-danger" onclick="eliminar('+cont+');">X</button>'
                    '</td>'+
                '</tr>';
                cont++;
        limpiar();
        evaluar();
        $('#creacionhorario').append(fila);
    }
    else{
        alert("Ingresar Datos del Producto!!");
    }
}
function limpiar()
{
    $("#horainicio").val("");
    $("#horafin").val("");
}
function evaluar()
{
    if(cont<0)
        {
            $("#save").hide();
        }
        else
        {
            $("#save").show();
        }
}
function eliminar(index){
    $("#fila" + index).remove();
    evaluar();
}
function savehorario(){
    var Codigo=$("#correlativo").val();
    var Descripcion=$("#txtdescripcion").val();
    var Tipo_Horario='S';
    var hora=[{Codigo:Codigo,Descripcion:Descripcion,
                Tipo_Horario:Tipo_Horario}];
    console.log(hora);
    console.log(filaob);
    if(Descripcion!='')
    {
        $.ajax({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:  {datos:hora,detalle:filaob},
            url:   'guardar',
            type:  'post',
            dataType: "json",
            success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                
                if(response.veri==true){
                    var urlBase=window.location.origin;
                    var url=urlBase+'/'+response.data;
                    document.location.href=url;
                }else{
                    alert("problemas al guardar la informacion");
                }
            }
        });
    }else{
        alert("Llenar la descripcion");
    }
}
</script>
@endpush
@endsection