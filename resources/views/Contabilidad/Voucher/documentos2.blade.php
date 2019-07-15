@extends ('layouts.admin')
@section ('contenido')
<section class="content-header">
  <h1>
    Panel de Administrador
    <small>Version 1.0.0</small>
  </h1>
  <ol class="breadcrumb">
    <li href="#">
      <i class="fas fa-dolly"></i> Voucher
    </li>
    <li class="active">Lista de Voucher</li>
  </ol>
</section>  
<section class="content"> 
  <div class="row">
    <div class="col-md-12">
      <div class="box">
         @foreach($voucher as $v)
        <div class="box-header with-border" style="padding: 10px !important">
          <h4 style="float:left">
            <strong style="font-weight: 400">
              <i class="fas fa-list-ul"></i> Lista de Documentos Pertenecientes a 
              {{$v->NroVoucher}}
            </strong>
          </h4>
          <div class="ibox-title-buttons pull-right">
            <a href="{{route('voucher-create',$v->NroVoucher)}}"  style="text-decoration: none !important">
              <button class="btn btn-block btn-success" style="background-color: #18A689 !important;">
                <i class="fas fa-plus-circle"></i> Nueva Digitalización
              </button>
            </a>
          </div>
        </div>
        @endforeach
        <div class="box-body">
          <table id="example" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
            <thead> 
              <tr>
                <th>
                  Nombre Archivo 
                </th>
                <th>
                  Fecha
                </th>
                <th>
                  Usuario
                </th>
                <th>
                  Area
                </th>
                <th>
                  Documento
                </th>
                <th>
                  Tipo Documento
                </th>
                <th>
                  Opciones
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($digital as $d)
              <tr>
                <td >
                  {{$d->NombreArchivo}}
                </td>
                <td>
                  {{$d->Fecha}} 
                </td>
                <td>
                  {{$d->UsuarioAdd}}
                </td>
                <td>
                  {{$d->DescripArea}}
                </td>
                <td>
                  {{$d->DescripTipo}}
                </td>
                <td>
                  {{$d->DescripSubTipo}}
                </td> 
                <td style="align-content: center">
                 <a target="_blank" href="{{asset($d->CodArea.'/'.$d->CodTipo.'/'.$d->CodSubTipo.'/'.$d->NombreArchivo.'.pdf')}}" class="btn btn-light btn-xs" title="Voucher Digitalizado">
                  <img src="{{asset('iconos-svg/pdf.svg')}}" width="25" title="Voucher Digitalizado">
                 </a>
                </td>
              </tr>
              @endforeach 
            </tbody>
          </table>
        </div>
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-12">
              <a class="btn btn-default" href="{{ URL::previous() }}" title="Volver Pagina Anterior">
                <img src="{{asset('iconos-svg/left-arrow.svg')}}" width="25" title="Volver Pagina Anterior">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

