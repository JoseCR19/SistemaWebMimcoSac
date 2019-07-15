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
        <li class="active">Lista de Empleados</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border" style="padding: 10px !important">
                    <h4 style="float:left">
                        <strong style="font-weight: 400">
                            <i class="fas fa-list-ul"></i> Lista de Empleados
                        </strong>
                    </h4>
                    <div class="ibox-title-buttons pull-right">
                        <a  data-target="#modal-create-personal"  data-toggle="modal" href="" style="text-decoration: none !important">
                            <button class="btn btn-block btn-success" style="background-color: #18A689 !important;">
                                <i class="fas fa-plus-circle"></i> Nuevo Empleados
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
                                    APELLIDO PATERNO
                                </th>
                                <th>
                                    APELLIDO MATERNO
                                </th>
                                <th>
                                    NOMBRE
                                </th>
                                <th>
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trabajador as $t)
                                <tr>
                                    <td>
                                        {{$t->DNI}}
                                    </td>
                                    <td>
                                        {{$t->APELLIDO_PATERNO}}
                                    </td>
                                    <td>
                                        {{$t->APELLIDO_MATERNO}}
                                    </td>
                                    <td>
                                        {{$t->NOMBRES}}
                                    </td>
                                    <td style="align-content: center">
                                        <a href="{{route('trabajador-edit',$t->DNI)}}" class="btn btn-success btn-xs" role="button">
                                            <i class="fas fa-edit" title="Editar Proforma"></i>Editar 
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$trabajador->render()}}
                    @include('Marcacion.Trabajador.modal_create_personal')
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script type="text/javascript">
$('#save').click(function(){
    saveTrabajador();
        });
function saveTrabajador(){
    let Dni=$("#txtdni").val();
    console.log(Dni);
    let Nombre=$("#txtnombres").val();
    console.log(Nombre);
    let ApellidoP =$("#txtapellidoP").val();
    console.log(ApellidoP);
    let ApellidoM =$("#txtapellidoM").val();
    console.log(ApellidoM);
    let Codigo=$("#correlativo").val();
    console.log(Codigo);
    let FechaN = $("#fecnac").val();
    console.log(FechaN);
    let FechaI = $("#fecinicio").val();
    console.log(FechaI);
    let TarjetaT = $("#txtdni").val();
    console.log(TarjetaT);
    /**esto es para obtener la palabra del id */
    let UN = document.getElementById("idorganizacion1");
    let UnidadNegocio = UN.options[UN.selectedIndex].text;
    /**esto es para obtener el codigo del id */
    let CodigoUN=$("#idorganizacion1").val();
    console.log(UnidadNegocio);
     /**esto es para obtener la palabra del id */
    let A=document.getElementById("idarea");
    let Area=A.options[A.selectedIndex].text;
    /**esto es para obtener el codigo del id */
    let CodArea=$("#idarea").val();
    console.log(Area);
     /**esto es para obtener la palabra del id */
    let C=document.getElementById("categoria");
    let Categoria=C.options[C.selectedIndex].text;
    /**esto es para obtener el codigo del id */
    let CodigoCategoria=$("#categoria").val();
    console.log(Categoria);
    /**esto es para obtener la palabra del id */
    let CA=document.getElementById("cargo");
    let Cargo=CA.options[CA.selectedIndex].text;
    /**esto es para obtener el codigo del id */
    let CodigoCargo=$("#cargo").val();
    console.log(Cargo);
    /**esto es para obtener la palabra del id */
    let CC=document.getElementById("centrocosto");
    let CentroCosto=CC.options[CC.selectedIndex].text;
    /**esto es para obtener el codigo del id */
    let CodigoCentroCosto=$("#centrocosto").val();
    console.log(CentroCosto);
    let CodHuella=$("#codigohuella").val();
    let CodigoHuella=parseInt(CodHuella);

    let idday= IDDIA(FechaI);
    let iddia=parseInt(idday);
    console.log(iddia);
    let TipoHorarioDetalle=$("#TIPOHORADETALLE").val();
    let HorarioDetalle=$("#HORARIODETALLEM").val();
    var dat=[{Dni:Dni,Nombre:Nombre,ApellidoP:ApellidoP,ApellidoM:ApellidoM,Codigo:Codigo,
                FechaN:FechaN,FechaI:FechaI,TarjetaT:TarjetaT,UnidadNegocio:UnidadNegocio,
                CodigoUN:CodigoUN,Area:Area,CodArea:CodArea,Categoria:Categoria,CodigoCategoria:CodigoCategoria,
                Cargo:Cargo,CodigoCargo:CodigoCargo,CentroCosto:CentroCosto,CodigoCentroCosto:CodigoCentroCosto,
                CodigoHuella:CodigoHuella,iddia:iddia}];

    console.log(dat);
    //if(Dni!='' && Nombre!='' && ApellidoP!='' && ApellidoM!='' && Codigo!='' && Empresa!='' && FechaN!='' && FechaI!='' && TarjetaT!='')
    //{
        $.ajax({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:  {datos:dat},
            url:   'guardartrabajador',
            type:  'post',
            dataType: "json",
            beforeSend:function()
            {
            },
            success:  function (response) { 
                    if(response.veri=true){
                        alert("retorno");
                        var urlBase=window.location.origin;
                        var url=urlBase+'/'+response.data;
                        document.location.href=url;
                    }else{
                        alert("problemas al guardar la informacion");
                    }
                }
        });
    //}
    //else{
    //    alert("Llenar los campos requeridos");
    //}
}
function IDDIA(DIA)
{
    var separador = separador || "-";
    var arrayFecha = DIA.split(separador);

    var anio = arrayFecha[0];
    var mes = arrayFecha[1];
    var dia = arrayFecha[2]; 

    return anio+mes+dia;
}
function datosh(horarios)
        {
            var horariosd=horarios;
                console.log(horariosd);
                $.ajax(
                    {
                        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url:'horadetalleindex',
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
$(document).ready(function(){

$('#btnbuscar').click(function(){
    var docu=$('#dni').val();
    var usuario='10479949404';
    var password='Deimusdark191295';
    var documento='DNI';
    var nro_documento=docu;
    if (docu.length==8 ) {
        $.ajax({
            url:"https://www.facturacionelectronica.us/facturacion/controller/ws_consulta_rucdni_v2.php",
            data:{usuario:usuario,password:password,documento:documento,nro_documento:nro_documento},
            method:'GET',
            dataType:'json',
            success:function(data){
               if (data.success=='True') {
                var dninum=data.result['DNI'];
                var ApePaterno=data.result['Paterno'];
                var ApeMaterno=data.result['Materno'];
                var Nombre=data.result['Nombre'];
                var Fecha=data.result['FechaNac'];
                var Genero=data.result['Sexo'];
                if (Genero=='2') {
                    Genero='MASCULINO';
                }else if (Genero=='3') {
                    Genero='FEMENINO';
                }else{
                    Genero='';
                }
                $('#txtdni').val(dninum);
                $('#txtnombres').val(Nombre);
                $('#txtapellidoP').val(ApePaterno);
                $('#txtapellidoM').val(ApeMaterno);
                //alert(dninum + ' - ' + ApePaterno + ' ' + ApeMaterno + ' ' + Nombre + ' - ' + Fecha + ' - ' + Genero);
               }else{
                alert(data.success);
               }
            }
        });  
    }else{
    alert('DNI INCORRECTO');
    }
    });

    });
    
</script>
@endpush
@endsection