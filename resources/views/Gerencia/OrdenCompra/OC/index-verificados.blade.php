@extends('layouts.admin')
@section('contenido')
<section class="content-header">
    <h1>
        Panel de Administrador
        <small>Version 1.0.0</small>
    </h1>
    <ol class="breadcrumb">
        <li href="#">
            <i class="fas fa-dolly"></i> GENERENCIA</li>
        <li class="active">ORDENES DE COMPRA VERIFICADAS</li>
    </ol>
</section>
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border" style="padding: 10px !important">
                    <h4 style="float:left">
                        <strong style="font-weight: 400">
                            <i class="fas fa-list-ul"></i>Lista de Ordenes de Compras
                        </strong>
                    </h4>
                </div>
                <div class="box-body">
                <table id="example" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                        <thead> 
                            <tr>
                                <th>
                                    DOCUMENTO
                                </th>
                                <th>
                                    SERIE
                                </th>
                                <th>
                                   N.DOCUMENTO
                                </th>
                                <th>
                                    PROVEEDOR
                                </th>   
                                <th>
                                    FECHA EMISION
                                </th>
                                <th>
                                    FECHA ENTREGA
                                </th>
                                <th>
                                    MONEDA
                                </th>
                                <th>
                                    TOTAL
                                </th>
                                <th>
                                    USUARIO
                                </th>
                                <th>
                                    DOCUMENTOS
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listaoc as $oc)
                                <tr>
                                    <td>
                                        {{$oc->desTipOC}}
                                    </td>
                                    <td>
                                        {{$oc->serie}}
                                    </td>
                                    <td>
                                        {{$oc->numOc}}
                                    </td>
                                    <td>
                                        {{$oc->nomprov}}
                                    </td>
                                    <td>
                                        {{$oc->fecha}}
                                    </td>
                                    <td>
                                        {{$oc->fech_Ent}}
                                    </td>
                                    <td>
                                        {{$oc->DesMon}}
                                    </td>
                                    <td>
                                        {{$oc->total}}
                                    </td>
                                    <td>
                                        {{$oc->nomUsu}}
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{route('ordenescompra-documentos',['idguest'=>$oc->numOc,'idbook'=>$oc->tipOC,'id'=>$oc->codEnt])}}" class="btn btn-light btn-xs">
                                                <img src="{{asset('iconos-svg/insurance.svg')}}" width="30" title="Documentos Digitalizados"> 
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>      
                    {{$listaoc->links()}}          
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script type="text/javascript">
let arr='';
function aprobar(id,nom,end){
    let codigo=id;
    let tipo=nom;
    let entidad=end;
    let dat=[{codigo:codigo,tipo:tipo,entidad:entidad}];
    console.log(dat);
    $.ajax({
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:  {datos:dat},
        url:   'aprobar',
        type:  'post',
        dataType: "json",
        beforeSend: function()
        {
        },
        success:function(response){ 
            let respuesta=response.veri;
            console.log(respuesta);
            if(response.veri==true)
            {
                arr=response.documento;
                console.log(arr);
                $("#oc").html(arr);
                $('#modal-aprobar').modal('show');
            }else{
                alert("problemas al guardar la informacion");
            }
        }
    });
}
function rechazar(id,nom,end){
    let codigo=id;
    let tipo=nom;
    let entidad=end;
    let dat=[{codigo:codigo,tipo:tipo,entidad:entidad}];
    console.log(dat);
    $.ajax({
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:  {datos:dat},
        url:   'desaprobar',
        type:  'post',
        dataType: "json",
        beforeSend:function()
        {
        },
        success:  function (response) { 
            if(response.veri==true){
                /*for (let index = 0; index < data.length; index++) {
                    let element = data[index];
                    console.log(element);
                }*/
            $('#modal-desaprobar').modal('show');
            }else{
                alert("problemas al guardar la informacion");
            }
        }
    });
}
function faltasustento(id,nom,end){
    let codigo=id;
    let tipo=nom;
    let entidad=end;
    let dat=[{codigo:codigo,tipo:tipo,entidad:entidad}];
    console.log(dat);
    $.ajax({
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:  {datos:dat},
        url:   'faltasustento',
        type:  'post',
        dataType: "json",
        beforeSend: function()
        {
        },
        success:function(response){ 
            let respuesta=response.veri;
            console.log(respuesta);
            if(response.veri==true)
            {
                arr=response.documento;
                console.log(arr);
                $("#oc2").html(arr);
                $('#modal-faltasustento').modal('show');
            }else{
                alert("problemas al guardar la informacion");
            }
        }
    });
}
$(document).ready(function() {
    $('#estadook').click(function() {
        // Recargo la página
        location.reload();
    });
});
$(document).ready(function() {
    $('#estadook2').click(function() {
        // Recargo la página
        location.reload();
    });
});
</script>
@endpush
@endsection
