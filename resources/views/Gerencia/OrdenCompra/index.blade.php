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
        <li class="active">DOCUMENTOS PARA APROBAR</li>
    </ol>
</section>
<section class="content container-fluid">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    @foreach ($count as $c)
                        <h3>{{$c->oc_aprobar}}</h3>
                    @endforeach
                    <p>O.Compra Por Aprobar</p>
                </div>
                <div class="icon" style="top:10px !important">
                    <img src="{{asset('iconos-svg/product.svg')}}" alt="" width="60">
                </div>
                <a href="{{route('oc')}}" class="small-box-footer">Aprobar <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</section>
@endsection