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
        <li class="active">Lista de Obreros</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border" style="padding: 10px !important">
                    <h4 style="float:left">
                        <strong style="font-weight: 400">
                            <i class="fas fa-list-ul"></i> Lista de Obreros
                        </strong>
                    </h4>
                    <div class="ibox-title-buttons pull-right">
                        <a  data-target="#modal-create-personal"  data-toggle="modal" href="" style="text-decoration: none !important">
                            <button class="btn btn-block btn-success" style="background-color: #18A689 !important;">
                                <i class="fas fa-plus-circle"></i> Nuevo Obrero
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
@endsection