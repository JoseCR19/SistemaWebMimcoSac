@extends('layouts.admin')
@section('contenido')
<section class="content-header">
        <h1>
            Panel de Administrador
            <small>Version 1.0.0</small>
        </h1>
        <ol class="breadcrumb">
            <li href="#">
                <i class="fas fa-dolly"></i> Bancos</li>
            <li class="active">Lista de Bancos</li>
        </ol>
    </section>  
    <section class="content"> 
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border" style="padding: 10px !important">
                        <h4 style="float:left">
                            <strong style="font-weight: 400">
                                <i class="fas fa-list-ul"></i> Lista de bancos
                            </strong>
                        </h4>
                        <div class="ibox-title-buttons pull-right">
                            <a href="{{url('Digitalizacion/Documentos/create')}}"  style="text-decoration: none !important">
                                <button class="btn btn-block btn-success" style="background-color: #18A689 !important;">
                                    <i class="fas fa-plus-circle"></i> Nueva Banco
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="example" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                            <thead> 
                                <tr>
                                    <th>
                                        Codigo 
                                    </th>
                                    <th>
                                        Codigo Entidad
                                    </th>
                                    <th>
                                        Codigo Moneda
                                    </th>
                                    <th>
                                        Codigo Número Cuenta
                                    </th>
                                    <th>
                                        Cuenta Contable
                                    </th>
                                    <th>
                                        Descripción
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banco as $b)
                                    <tr>
                                        <td>
                                            {{$b->Codigo}}
                                        </td>
                                        <td>
                                            {{$b->CodEnt}}
                                        </td>
                                        <td>
                                            {{$b->Moneda}}
                                        </td>
                                        <td>
                                            {{$b->NumCuenta}}
                                        </td>
                                        <td>
                                            {{$b->CtaContable}}
                                        </td>
                                        <td >
                                            {{$b->Descripcion}}
                                        </td>
                                        <td style="align-content: center">
                                        
                                        </td>
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                        {{$banco->render()}}
                    </div>
                </div>
            </div>
        </div>
    </section>    
@endsection