@extends('layouts.admin')
@section('contenido')
<section class="content-header">
    <h1>
        Panel de Administrador
        <small>Version 1.0.0</small>
    </h1>
    <ol class="breadcrumb">
        <li href="#">
            <i class="fas fa-dolly"></i> Gerencia</li>
        <li class="active">Diagrama OT Compras</li>
    </ol>
</section>
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border" style="padding: 10px !important">
                    <h4 style="float:left">
                        <strong style="font-weight: 400">
                            <i class="fas fa-list-ul"></i> DIAGRAMA 
                        </strong>
                    </h4>
                    <div class="ibox-title-buttons pull-right">
                        <button id="listar" class="btn btn-block btn-success" type="button">
                        <i class="fas fa-search"></i> Buscar</button>
                    </div>
                    <div class="form-group  ibox-title-buttons pull-right">
                        <input type="text" id="ot"  class="form-control"  placeholder="OT">
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    PROCESO INGENIERIA
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <ol class="breadcrumb">
                                                <li class="active">REQUERIMIENTOS</li>
                                            </ol>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                                <div id="div2">
                                    <table id="listareque" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important;">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        N.R
                                                    </th>
                                                    <th>
                                                        Fecha Requerimiento
                                                    </th>
                                                    <th>
                                                        Tipo Requerimiento
                                                    </th>
                                                    <th>
                                                        Responsable
                                                    </th>
                                                    <th>
                                                        Solicitante
                                                    </th>
                                                    <th>
                                                        Observación
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="requedetalle">
                                                <tr>
                                                    <th colspan="8" align="text-center">
                                                        <div class="panel panel-transparent panel-dashed tip-sales text-center" >
                                                            <div class="row">
                                                                <div class="col-sm-8 col-sm-push-2">
                                                                    <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                                                                    <h3 class="ich m-t-none">
                                                                        LISTA DE REQUERIMIENTOS
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    PROCESO LOGISTICA
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <ol class="breadcrumb">
                                                <li class="active">ORDENES DE COMPRA</li>
                                            </ol>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                                <div id="div1">
                                    <table id="listaoc" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                                        <thead>
                                            <tr>
                                                <th>
                                                    N.R
                                                </th>
                                                <th>
                                                    Producto
                                                </th>
                                                <th>
                                                    Orden Compra
                                                </th>
                                                <th>
                                                    Proveedor
                                                </th>
                                                <th>
                                                    Fecha
                                                </th>
                                                <th>
                                                    Fecha Entrega
                                                </th>
                                                <th>
                                                    Usuario
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="ocdetalle">
                                            <tr>
                                                <th colspan="7" align="text-center">
                                                    <div class="panel panel-transparent panel-dashed tip-sales text-center" >
                                                        <div class="row">
                                                            <div class="col-sm-8 col-sm-push-2">
                                                                <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                                                                <h3 class="ich m-t-none">
                                                                    LISTA DE OREDENES DE COMPRA
                                                                </h3>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    PROCESO ALMACEN
                                </div>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="panel-body">
                                                <div class="col-md-12">
                                                    <ol class="breadcrumb">
                                                        <li class="active">INGRESOS</li>
                                                    </ol>
                                                </div>
                                            </div>
                                            <div id="div2">
                                                <table id="listaingreso" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important;">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                Nro.Vale
                                                            </th>
                                                            <th>
                                                                Fecha Ingreso
                                                            </th>
                                                            <th>
                                                                Orden Compra
                                                            </th>
                                                            <th>
                                                                Responsable
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="ingresodetalle">
                                                        <tr>
                                                            <th colspan="4" align="text-center">
                                                                <div class="panel panel-transparent panel-dashed tip-sales text-center" >
                                                                    <div class="row">
                                                                        <div class="col-sm-8 col-sm-push-2">
                                                                            <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                                                                            <h3 class="ich m-t-none">
                                                                                LISTA DE INGRESO DE PRODUCTOS
                                                                            </h3>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="panel-body">
                                                <div class="col-md-12">
                                                    <ol class="breadcrumb">
                                                        <li class="active">SALIDAS</li>
                                                    </ol>
                                                </div>
                                            </div>
                                            <div id="div2">
                                                <table id="listasalida" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important;">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                Nro.Vale
                                                            </th>
                                                            <th>
                                                                Fecha Ingreso
                                                            </th>
                                                            <th>
                                                                Orden Compra
                                                            </th>
                                                            <th>
                                                                Responsable
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="salidadetalle">
                                                        <tr>
                                                            <th colspan="4" align="text-center">
                                                                <div class="panel panel-transparent panel-dashed tip-sales text-center" >
                                                                    <div class="row">
                                                                        <div class="col-sm-8 col-sm-push-2">
                                                                            <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                                                                            <h3 class="ich m-t-none">
                                                                                LISTA DE SALIDA DE PRODUCTOS
                                                                            </h3>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    PROCESO COMPRA
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <ol class="breadcrumb">
                                                <li class="active">FACTURAS</li>
                                            </ol>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                                <div id="div2">
                                    <table id="listafactura" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important;">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Producto
                                                    </th>
                                                    <th>
                                                        Codigo
                                                    </th>
                                                    <th>
                                                        Cantidad
                                                    </th>
                                                    <th>
                                                        Precio Venta
                                                    </th>
                                                    <th>
                                                        Precio Total
                                                    </th>
                                                    <th>
                                                        Número Doc.
                                                    </th>
                                                    <th>
                                                        Serie Doc.
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="facturadetalle">
                                                <tr>
                                                    <th colspan="8" align="text-center">
                                                        <div class="panel panel-transparent panel-dashed tip-sales text-center" >
                                                            <div class="row">
                                                                <div class="col-sm-8 col-sm-push-2">
                                                                    <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                                                                    <h3 class="ich m-t-none">
                                                                        LISTA DE FACTURAS
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    PROCESO CONTABILIDAD
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <ol class="breadcrumb">
                                                <li class="active">VOUCHER</li>
                                            </ol>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                                <div id="div1">
                                    <table id="listavoucher" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                                        <thead>
                                            <tr>
                                                <th>
                                                    N.Voucher
                                                </th>
                                                <th>
                                                    Documento
                                                </th>
                                                <th>
                                                    Serie
                                                </th>
                                                <th>
                                                    Razon Social
                                                </th>
                                                <th>
                                                    Fecha
                                                </th>
                                                <th>
                                                    Tipo Abono
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="voucherdetalle">
                                            <tr>
                                                <th colspan="7" align="text-center">
                                                    <div class="panel panel-transparent panel-dashed tip-sales text-center" >
                                                        <div class="row">
                                                            <div class="col-sm-8 col-sm-push-2">
                                                                <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                                                                <h3 class="ich m-t-none">
                                                                    LISTA DE OREDENES DE COMPRA
                                                                </h3>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('Diagrama.OTCompras.modal')
</section>
@push('scripts')
<script>    
$(document).ready(function(){
    $('#listar').click(function(){
            requerimientos();
    });
 });
 function requerimientos(){
    let ot=$("#ot").val();
    let dat=[{ot:ot}];
    let lrot='';
    let loct='';
    let lrip='';
    let lrsp='';
    let lrf='';
    let lrv='';
    $.ajax({
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:'listarrequermientos',
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
                let lisreque=response.listarrequerimientos;
                let listaoc=response.listarordendecompras;
                let listaip=response.listaringreso;
                let listasp=response.listarsalida;
                let listafactura=response.listaregistrocompradetalle;
                let listav=response.listarvoucher;
                for (let lr = 0; lr < lisreque.length; lr++) {
                    var numreque=lisreque[lr]['numReq'];
                    console.log(numreque);
                    $("#listareque > tbody").empty();
                    lrot+=  '<tr data-toggle="collapse" data-target=".demo1" style="font-size: 9px !important;">'+
                                '<td class="text-center">'+
                                    '<input  style="width: 30px !important;" type="hidden" name="" value="'+lisreque[lr]['numReq']+'">'+lisreque[lr]['numReq']+
                                '</td>'+
                                '<td class="text-center" WIDTH="100">'+
                                    '<input style="width: 30px !important;" type="hidden" name="" value="">'+lisreque[lr]['fecha']+
                                '</td>'+
                                '<td class="text-center" WIDTH="150">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+lisreque[lr]['desTipReq']+
                                '</td>'+
                                '<td class="text-center">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+lisreque[lr]['responsable']+
                                '</td>'+
                                '<td class="text-center">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+lisreque[lr]['solicitante']+
                                '</td>'+
                                '<td class="text-center" WIDTH="250">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+lisreque[lr]['observ']+
                                '</td>'+
                                //'<td style="align-content: center">'+
                                    //'<button id="codigoreque" class="btn btn-block btn-success btn-xs" style="background-color: #18A689 !important;" onclick="detalle('+numreque+')">'+
                                        //'<i class="fas fa-plus-circle"></i>'+
                                            //'Visualizar'+
                                    //'</button>'+
                                //'</td>'+
                            '</tr>';
                    $('#listareque >tbody').empty();
                }
                $("#requedetalle").html(lrot);
                for (let oc = 0; oc < listaoc.length; oc++) {
                    loct+=  '<tr data-toggle="collapse" data-target=".demo1" style="font-size: 9px !important;">'+
                                '<td class="text-center">'+
                                    '<input  style="width: 30px !important;font-size:5px;" type="hidden" name="" value="">'+listaoc[oc]['numReq']+
                                '</td>'+
                                '<td class="text-center" WIDTH="100">'+
                                    '<input style="width: 30px !important;" type="hidden" name="" value="">'+listaoc[oc]['desProd']+
                                '</td>'+
                                '<td class="text-center" WIDTH="150">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listaoc[oc]['desTipOC']+
                                '</td>'+
                                '<td class="text-center">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listaoc[oc]['nomprov']+
                                '</td>'+
                                '<td class="text-center">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listaoc[oc]['fecha']+
                                '</td>'+
                                '<td class="text-center" WIDTH="250">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listaoc[oc]['fech_Ent']+
                                '</td>'+
                                '<td class="text-center" WIDTH="250">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listaoc[oc]['nomUsu']+
                                '</td>'+
                            '</tr>';
                }
                $("#ocdetalle").html(loct);
                if(listaip.length>0){
                    for (let lip = 0; lip < listaip.length; lip++) {
                        lrip+='<tr data-toggle="collapse" data-target=".demo1" style="font-size: 9px !important;">'+
                                '<td class="text-center">'+
                                    '<input  style="width: 30px !important;" type="hidden" name="" value="">'+listaip[lip]['nroVale']+
                                '</td>'+
                                '<td class="text-center" WIDTH="100">'+
                                    '<input style="width: 30px !important;" type="hidden" name="" value="">'+listaip[lip]['fecha']+
                                '</td>'+
                                '<td class="text-center" WIDTH="150">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listaip[lip]['ordCompra']+
                                '</td>'+
                                '<td class="text-center">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listaip[lip]['nomUsu']+
                                '</td>'+
                            '</tr>';
                    }
                    $("#ingresodetalle").html(lrip);
                }
                else{
                    lrip='<tr>'+
                            '<th colspan="4" align="text-center">'+
                                '<div class="panel panel-transparent panel-dashed tip-sales text-center" >'+
                                    '<div class="row">'+
                                        '<div class="col-sm-8 col-sm-push-2">'+
                                            '<i class="fas fa-exclamation-triangle fa-3x text-warning"></i>'+
                                            '<h3 class="ich m-t-none">'+
                                                'ESTA OT NO TIENE INGRESOS'+
                                            '</h3>'+
                                       ' </div>'+
                                   ' </div>'+
                                '</div>'+ 
                            '</th>'+
                       ' </tr>';
                    $("#ingresodetalle").html(lrip);
                }
                if(listasp.length>0)
                {
                    for (let lsp = 0; lsp < listasp.length; lsp++) {
                        lrsp+='<tr data-toggle="collapse" data-target=".demo1" style="font-size: 9px !important;">'+
                                '<td class="text-center">'+
                                    '<input  style="width: 30px !important;" type="hidden" name="" value="">'+listasp[lsp]['nroVale']+
                                '</td>'+
                                '<td class="text-center" WIDTH="100">'+
                                    '<input style="width: 30px !important;" type="hidden" name="" value="">'+listasp[lsp]['fecha']+
                                '</td>'+
                                '<td class="text-center" WIDTH="150">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listasp[lsp]['ordCompra']+
                                '</td>'+
                                '<td class="text-center">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listasp[lsp]['nomUsu']+
                                '</td>'+
                            '</tr>';
                    }
                    $("#salidadetalle").html(lrsp);
                }else{
                    lrsp='<tr>'+
                            '<th colspan="4" align="text-center">'+
                                '<div class="panel panel-transparent panel-dashed tip-sales text-center" >'+
                                    '<div class="row">'+
                                        '<div class="col-sm-8 col-sm-push-2">'+
                                            '<i class="fas fa-exclamation-triangle fa-3x text-warning"></i>'+
                                            '<h3 class="ich m-t-none">'+
                                                'ESTA OT NO TIENE INGRESOS'+
                                            '</h3>'+
                                       ' </div>'+
                                   ' </div>'+
                                '</div>'+ 
                            '</th>'+
                       ' </tr>';
                       $("#salidadetalle").html(lrsp);
                }
                for (let lf = 0; lf < listafactura.length; lf++) {
                    lrf+='<tr data-toggle="collapse" data-target=".demo1" style="font-size: 9px !important;">'+
                                '<td class="text-center">'+
                                    '<input  style="width: 30px !important;font-size:5px;" type="hidden" name="" value="">'+listafactura[lf]['Descripcion']+
                                '</td>'+
                                '<td class="text-center" WIDTH="100">'+
                                    '<input style="width: 30px !important;" type="hidden" name="" value="">'+listafactura[lf]['CodigoProducto']+
                                '</td>'+
                                '<td class="text-center" WIDTH="150">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listafactura[lf]['Cantidad']+
                                '</td>'+
                                '<td class="text-center">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listafactura[lf]['PrecioTotal']+
                                '</td>'+
                                '<td class="text-center">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listafactura[lf]['Usuario']+
                                '</td>'+
                                '<td class="text-center" WIDTH="250">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listafactura[lf]['Numero']+
                                '</td>'+
                                '<td class="text-center" WIDTH="250">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listafactura[lf]['Serie']+
                                '</td>'+
                            '</tr>';
                $("#facturadetalle").html(lrf);
                }
                for (let lv = 0; lv < listav.length; lv++) {
                    
                    lrv+='<tr data-toggle="collapse" data-target=".demo1" style="font-size: 9px !important;">'+
                                '<td class="text-center">'+
                                    '<input  style="width: 30px !important;font-size:5px;" type="hidden" name="" value="">'+listav[lv]['NroVoucher']+
                                '</td>'+
                                '<td class="text-center" WIDTH="100">'+
                                    '<input style="width: 30px !important;" type="hidden" name="" value="">'+listav[lv]['NroDocRef']+
                                '</td>'+
                                '<td class="text-center" WIDTH="150">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listav[lv]['SerieDocRef']+
                                '</td>'+
                                '<td class="text-center">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listav[lv]['Importe']+
                                '</td>'+
                                '<td class="text-center">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listav[lv]['RazonSocial']+
                                '</td>'+
                                '<td class="text-center" WIDTH="250">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listav[lv]['FechaEmRef']+
                                '</td>'+
                                '<td class="text-center" WIDTH="250">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+listav[lv]['TAOB']+
                                '</td>'+
                            '</tr>';
                            $("#voucherdetalle").html(lrv);
                }
            }
            else{
                alert("no se pudo ingresar")
            }
        }
    });
    
 }
 function detalle(idreque)
 {
     console.log(idreque);
     
    let id=idreque;
     //var id=idreque;
     console.log(id);
     let dat=[{id:id}];
     let ldr='';
     $.ajax({
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:'listarequedetalle',
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
                let detalle=response.listarrequerimientosdetalle;
                for (let lrd = 0; lrd < detalle.length; lrd++) {
                    ldr+='<tr data-toggle="collapse" data-target=".demo1">'+
                                '<td class="text-center" WIDTH="350">'+
                                    '<input id="horario" type="checkbox" "/>'+
                                '</td>'+
                                '<td class="text-center" WIDTH="350">'+
                                    '<input  style="width: 30px !important;" type="hidden" name="" value="">'+detalle[lrd]['desProd']+
                                '</td>'+
                                '<td class="text-center">'+
                                    '<input style="width: 30px !important;" type="hidden" name="" value="">'+detalle[lrd]['cant']+
                                '</td>'+
                                '<td class="text-center">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+detalle[lrd]['peso']+
                                '</td>'+
                                '<td class="text-center">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+detalle[lrd]['DesMon']+
                                '</td>'+
                                '<td class="text-center">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+detalle[lrd]['desEst']+
                                '</td>'+
                                '<td class="text-center">'+
                                    '<input style="width: 20px !important;" type="hidden" name="" value="">'+detalle[lrd]['stock']+
                                '</td>'+
                            '</tr>';
                }
                $("#detalle-reque").html(ldr);
                $('#modal-horario').modal('show');
                console.log(detalle);
            }
        }
     });
 }
</script>
@endpush
@endsection
