@extends ('layouts.admin')
@section ('contenido')
<section class="content-header">
	<h1 >
		Panel de Administrador
		<small>Version 2.3.0</small>
    </h1>
    <ol class="breadcrumb" >
    	<li>
    		<a href="#">
    		<i class="fas fa-user-edit"></i> GENERENCIA</a>
    	</li>
    	<li class="active">DOCUMENTOS PARA APROBAR</li>
    </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box" style="border-top: 3px solid #18A689">
				<div class="box-header with-border" style="padding: 10px !important">
					<h4>
						<strong style="font-weight: 400">
							<i class="fas fa-users"></i> DOCUMENTOS PARA APROBAR ORDEN DE COMPRA
						</strong>
					</h4>
				    @if(count($errors)>0)
					<div class="alert-alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							    <li>{{$error}}</li>
							@endforeach 
						</ul>	
				    </div>
				    @endif
				</div>
                <!-- /.box-header -->
				<div class="box-body bg-gray-c">
					<div class="row">
						<div class="col-md-12">
							<div class="nav-tabs-custom">
								<div class="tab-content">
									<div class="active tab-pane" id="dni">
										<div class="panel panel-default panel-shadow">
                                            <div class="row">
                                                @foreach($cabecera as $c)
                                                <div class="col-md-12">
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            <label for="" class="control-label" style="font-size: 13px;color: #676a6c">
                                                                Datos Generales
                                                            </label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label for="">Tipo Documento</label>
                                                                    <input type="text" id="desTipOC" name="Documento" class="form-control" disabled required value="{{$c->desTipOC}}">
                                                                </div> 												
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label for="">Serie</label>
                                                                    <input type="text" id="serie" name="serie" class="form-control" required disabled value="{{$c->serie}}" >
                                                                </div>													
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label for="">Documento</label>
                                                                    <input type="text" id="numOc" name="nombre" class="form-control" required disabled value="{{$c->numOc}}" >
                                                                </div>													
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-8">
                                                                <div class="form-group">
                                                                <label for="">Proveedor</label>
                                                                    <input type="text" id="nomprov" name="ApellidoPaterno" class="form-control" required  disabled value="{{$c->nomprov}}">
                                                                </div> 												
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                <label for="">RUC</label>
                                                                    <input type="text" id="rucprov" name="ApellidoMaterno" class="form-control" required disabled value="{{$c->rucprov}}">	
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                <label for="">Fecha Emisión</label>
                                                                    <input type="text" id="fecha" name="ApellidoPaterno" class="form-control" required disabled value="{{$c->fecha}}">
                                                                </div> 												
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                <label for="">Fecha Entrega</label>
                                                                    <input type="text" id="fech_Ent" name="ApellidoMaterno" class="form-control" required disabled value="{{$c->fech_Ent}}">	
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                <label for="">Moneda</label>
                                                                    <input type="text" id="DesMon" name="ApellidoPaterno" class="form-control" required disabled value="{{$c->DesMon}}">
                                                                </div> 												
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                <label for="">Total</label>
                                                                    <input type="text" id="total" name="ApellidoMaterno" class="form-control" required disabled value="{{$c->total}}">	
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                <label for="">Usuario</label>
                                                                    <input type="text" id="nomUsu" name="ApellidoMaterno" class="form-control" required disabled value="{{$c->nomUsu}}">	
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                                
                                                </div>
                                            </div>
										</div>										
									</div>
								</div>
							</div>
                        </div>
                        <div class="col-md-12">
                            <div class="box-footer">
                                <div class="form-group">
                                    <label for="" class="control-label" style="font-size: 13px;color: #676a6c">
                                        Documentos Digitalizados
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-md-12 text-center" >
                                        <label for="">Orden Compra</label>
                                    </div>
                                    <!-- 
                                        <div class="col-md-12">
                                            <center>
                                                <a target="_blank" href="{{asset('GERENCIA/OC/PROCESADOS/'.$c->numOc.''.$c->tipOC.''.$c->codEnt.'.pdf')}}" class="btn btn-light btn-xs" title="Voucher Digitalizado">
                                                    <img src="{{asset('iconos-svg/pdf.svg')}}" width="45" title="Voucher Digitalizado">
                                                </a>
                                            </center>
                                        </div>
                                     -->
                                        <!-- -->
                                        <div class="col-md-12">
                                            <center>
                                                <a data-target="#modal-pdf"  data-toggle="modal" href="#" class="btn btn-light btn-xs" title="Voucher Digitalizado">
                                                    <img src="{{asset('iconos-svg/pdf.svg')}}" width="45" title="Voucher Digitalizado">
                                                </a>
                                            </center>
                                        </div>
                                </div>
                            </div> 
                        </div>
                        @include('Gerencia.OrdenCompra.OC.modal-pdf-oc')
                        @endforeach
                        <div class="col-md-12">
                            <div class="box-body">
                                <table id="horadetallelista" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                ITEM
                                            </th>
                                            <th class="text-center">
                                                Requerimiento
                                            </th>
                                            <th class="text-center">
                                                Ot
                                            </th>
                                            <th class="text-center">
                                                Visualizar
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $cant=1
                                        @endphp
                                        @foreach($detalle as $d)
                                        <tr>
                                            <td class="text-center">
                                                <input style="width: 70px !important;" type="hidden" name="" value="">{{$cant++}}
                                            </td>
                                            <td class="text-center">
                                                <input style="width: 70px !important;" type="hidden" name="" value="">{{$d->numReq}}
                                            </td>
                                            <td class="text-center">
                                                <input style="width: 70px !important;" type="hidden" name="" value="">{{$d->numOT}}
                                            </td>
                                            <td>
                                                <center>
                                                    <a class="btn btn-light btn-xs" onclick="combinar('{{$d->numReq}}')"   title="Voucher Digitalizado">
                                                        <img src="{{asset('iconos-svg/pdf.svg')}}" width="25" title="Voucher Digitalizado">
                                                    </a>
                                                </center>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
					</div>
                </div>
                @foreach($cabecera as $c)
				<div class="box-footer">
					<div class="text-right">
                        <button class="btn btn-success btn-sm" type="button" id="" onclick="aprobar('{{$c->numOc}}','{{$c->tipOC}}','{{$c->codEnt}}')"><i class="far fa-pull-left"></i>APROBAR</button>
                        <button class="btn btn-warning btn-sm" type="button" id=""><i class="far fa-pull-left"></i>FALTA SUSTENTO</button>
						<button class="btn btn-danger btn-sm" type="reset"><i class="far fa-times-circle"></i>RECHAZAR</button>
						<button  class="btn btn-primary btn-sm " type="button">
                            <a style="color: white!important;text-decoration: none" href="{{ URL::previous()}}">
                                <i class="fas fa-reply-all"></i> Volver
                            </a>
                        </button>
					</div>
                </div>
                @endforeach
            </div><!-- /.box -->
        </div><!-- /.col -->
        @include('Gerencia.OrdenCompra.OC.modal-aprobar')
    </div><!-- /.row -->
</section><!-- /.content -->
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
function combinar(id)
{
    let idreque = id;
    console.log(idreque);
    $.ajax({
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:'../../../../requerimientos',
        data:{dato:idreque},
        type:'POST',
        dataType:'json',
        beforeSend: function () {
            console.log('procesando');
        },
        success : function (response) {
            console.log(response.veri,response.lista);
            doOpen(response.lista);
        }
    });
}
function doOpen(url){
    console.log(url);
window.open('http://webapp.mimco.com.pe:7010/Paginaphp/'+url,'_blank');
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




