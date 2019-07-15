@extends('layouts.admin')
@section('contenido')
<section class="content-header">
    <h1>
        Panel de Administrador
        <small>Version 1.0.0</small>
    </h1>
    <ol class="breadcrumb">
        <li href="#">
            <i class="fas fa-dolly"></i> Ajustes</li>
        <li class="active">Lista de Áreas</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border" style="padding: 10px !important">
                    <h4 style="float:left">
                        <strong style="font-weight: 400">
                            <i class="fas fa-list-ul"></i> Lista de Áreas
                        </strong>
                    </h4>
                    <div class="ibox-title-buttons pull-right">
                        <a href="{{url('Ajustes/Area/create')}}"  style="text-decoration: none !important">
                            <button class="btn btn-block btn-success" style="background-color: #18A689 !important;">
                                <i class="fas fa-plus-circle"></i> Nueva Área
                            </button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                        <thead> 
                            <tr>
                                <th>
                                    Codigo de Área
                                </th>
                                <th>
                                    Área
                                </th>
                                <th>
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($area as $a)
                                <tr>
                                    <td>
                                        {{$a->CodArea}}
                                    </td>
                                    <td>
                                        {{$a->DescripArea}}
                                    </td>
                                    <td style="align-content: center">
                                        <a href="" ></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$area->render()}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection