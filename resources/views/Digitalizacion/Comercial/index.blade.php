@extends('layouts.admin')
@section('contenido')
<section class="content-header">
        <h1>
            Panel de Administrador
            <small>Version 1.0.0</small>
        </h1>
        <ol class="breadcrumb">
            <li href="#">
                <i class="fas fa-dolly"></i> Digitalización</li>
            <li class="active">Lista de Documentos de Comercial</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border" style="padding: 10px !important">
                        <h4 style="float:left">
                            <strong style="font-weight: 400">
                                <i class="fas fa-list-ul"></i> Lista de Documentos de Comercial
                            </strong>
                        </h4>
                        <div class="ibox-title-buttons pull-right">
                            <a href="{{url('Digitalizacion/Documentos/create')}}"  style="text-decoration: none !important">
                                <button class="btn btn-block btn-success" style="background-color: #18A689 !important;">
                                    <i class="fas fa-plus-circle"></i> Nueva Digitalización
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="example" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                            <thead> 
                                <tr>
                                    <th>
                                        Codigo de Documento
                                    </th>
                                    <th>
                                        Codigo de Área
                                    </th>
                                    <th>
                                        Codigo de Tipo
                                    </th>
                                    <th>
                                        Codigo de SupTipo
                                    </th>
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Nombre de Archivo
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documentos as $d)
                                    <tr>
                                        <td>
                                            {{$d->CodDocumento}}
                                        </td>
                                        <td>
                                            {{$d->CodArea}}
                                        </td>
                                        <td>
                                            {{$d->CodTipo}}
                                        </td>
                                        <td>
                                            {{$d->CodSubTipo}}
                                        </td>
                                        <td>
                                            {{$d->Fecha}}
                                        </td>
                                        <td id="nom">
                                            {{$d->NombreArchivo}}
                                        </td>
                                        <td style="align-content: center">
                                        <a target="_blank" href="{{asset($d->CodArea.'/'.$d->CodTipo.'/'.$d->CodSubTipo.'/'.$d->NombreArchivo.'.pdf')}}">PDF</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$documentos->render()}}
                    </div>
                </div>
            </div>
        </div>
    </section>    
@endsection