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
    		<i class="fas fa-user-edit"></i> Trabajador</a>
    	</li>
    	<li class="active">Editar Trabajador</li>
    </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box" style="border-top: 3px solid #18A689">
				<div class="box-header with-border" style="padding: 10px !important">
					<h4>
						<strong style="font-weight: 400">
							<i class="fas fa-users"></i> Editar Datos Trabajador
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
						<div class="col-md-6">
							<div class="nav-tabs-custom">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#dni" data-toggle="tab"  style="font-size: 13px;color: #676a6c">DNI</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="active tab-pane" id="dni">
										<div class="panel panel-default panel-shadow">
                                            <div class="row">
                                                @foreach($Trabajador as $t)
                                                <div class="col-md-12">
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            <label for="" class="control-label" style="font-size: 13px;color: #676a6c">
                                                                Datos Generales
                                                            </label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                <label for="">Documento</label>
                                                                    <input type="text" id="DNI" name="Documento" class="form-control" required value="{{$t->DNI}}">
                                                                </div> 												
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="form-group">
                                                                <label for="">Nombre</label>
                                                                    <input type="text" id="NOMBRES" name="nombre" class="form-control" required value="{{$t->NOMBRES}}" >
                                                                </div>													
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                <label for="">Apellido Paterno</label>
                                                                    <input type="text" id="APELLIDOP" name="ApellidoPaterno" class="form-control" required value="{{$t->APELLIDO_PATERNO}}" {{old('paterno')}}>
                                                                </div> 												
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                <label for="">Apellido Materno</label>
                                                                    <input type="text" id="APELLIDOM" name="ApellidoMaterno" class="form-control" required value="{{$t->APELLIDO_MATERNO}}" {{old('ApellidoMaterno')}}>	
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                <label for="">CODIGO</label>
                                                                    <input type="text" id="CODIGO" name="ApellidoPaterno" class="form-control" required value="{{$t->CODIGO_TEMPUS}}" {{old('paterno')}}>
                                                                </div> 												
                                                            </div>
                                                        </div>
                                                    </div>                                                
                                                </div>
                                                @endforeach
                                            </div>
										</div>										
									</div>
								</div>
							</div>
						</div>
                        <div class="col-md-6">
                            <div class="box-body">
                                <div class="text-right">
                                    <button  class="btn btn-success btn-sm " type="button">
                                        <a style="color: white!important;text-decoration: none" data-target="#modal-create_horario"  data-toggle="modal" href="">
                                            <i class="fas fa-plus-circle"></i> Agregar Nuevo Horario
                                        </a>
                                    </button>
                                </div>
                                <br>
                                <table id="horadetallelista" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                                    <thead>
                                        <tr>
                                            <th>
                                                DESCRIPCION
                                            </th>
                                            <th>
                                                FECHA INICIO
                                            </th>
                                            <th>
                                                FECHA FINAL
                                            </th>
                                            <th>
                                                OPCIONES
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <div id="">
                                        {{Form::token()}}
                                            @foreach($Historial_H as $h)
                                            <tr>
                                                <td>
                                                    <input style="width: 70px !important;" id="DESCRIPCION" type="hidden" name="{{$h->DESCRIPCION}}" value="{{$h->DESCRIPCION}}">
                                                    {{$h->DESCRIPCION}}
                                                </td>
                                                <td>
                                                    <input style="width: 70px !important;" id="HORAINICIO" type="hidden" name="{{$h->FECHA_H_INICIO}}" value="{{$h->FECHA_H_INICIO}}">
                                                    {{$h->FECHA_H_INICIO}}
                                                </td>
                                                <td>
                                                <input style="width: 70px !important;" id="HORAFIN" type="hidden" name="{{$h->FECHA_H_FIN}}" value="{{$h->FECHA_H_FIN}}">
                                                {{$h->FECHA_H_FIN}}
                                                </td>
                                                <td>
                                                    <button id="modal" onclick="datos('{{$h->HORARIO}}')">VER</button>
                                                </td>
                                            </tr>
                                            @include('Marcacion.Trabajador.modal')
                                            @endforeach
                                        </div>
                                    </tbody>
                                </table>
                            </div>
                        </div>
					</div>
				</div>
				<div class="box-footer">
					<div class="text-right">
			    		<button class="btn btn-primary btn-sm" type="submit"><i class="far fa-save"></i> Guardar</button>
						<button class="btn btn-danger btn-sm" type="reset"><i class="far fa-times-circle"></i> Cancelar</button>
						<button  class="btn btn-success btn-sm " type="button">
                            <a style="color: white!important;text-decoration: none" href="{{ URL::previous()}}">
                                <i class="fas fa-reply-all"></i> Volver
                            </a>
                        </button>
					</div>
				</div>
              </div><!-- /.box -->
              
            </div><!-- /.col -->
          </div><!-- /.row -->
          @include('Marcacion.Trabajador.modal_create')
</section><!-- /.content -->
    @push('scripts')
    <script>
    $(document).ready(function(){
        $('#save').click(function(){
            guardarhorario();
        });
    });
        $('ul.loginbar').on('click', 'li#id1 > a', function(){
            $('div#myModal').modal('show');
        }); 
        
        function datosh(horarios)
        {
            var horariosd=horarios;
                console.log(horariosd);
                $.ajax(
                    {
                        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url:'horadetalle',
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
        function datos(horario) {
            var horarioJ=horario;
            console.log(horario);
            $.ajax({
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:'hora',
                data:{dato:horarioJ},
                type:'post',
                dataType:"json",
                beforeSend: function()
                {
                    //console.log('procesando');
                },
                success:function(response){
                    if(response.veri=true)
                    {
                        var Horario_detalle=response.lista;
                        console.log(Horario_detalle);
                        va=''
                                
                        for(const i in Horario_detalle)
                        {
                            va+='<ul class="list-group list-group-unbordered">'+
                                    '<li class="list-group-item";color: #676a6c !important;">'+
                                        '<b style="font-weight: 400 !important">'+
                                            Horario_detalle[i]['DESCRIPCION']+' '+
                                        '</b>'+
                                        '<b>'+
                                           'HORA INICIO'+' '+ Horario_detalle[i]['HORA_INICIO']+
                                        '</b>'+
                                        ' '+ 
                                        '<b>'+
                                            'HORA FIN'+ ' '+ Horario_detalle[i]['HORA_FIN']+
                                        '</b>'+
                                    '</li>'+
                                '</ul>';
                        }
                        $("#hora").html(va);
                        $('#modal-horario').modal('show');
                    }
                    else{
                        alert("problemas al enviar la informacion");
                    }
                }

            });
        }
        function guardarhorario()
        {
            
            var currentTime = new Date();
            var day = currentTime.getDate();
            var month = currentTime.getMonth() + 1;
            var year = currentTime.getFullYear();
            if (day < 10)
            {
                day = "0" + day;
            }
            if (month < 10)
            {
                month = "0" + month;
            }
            var today_date = day + "/" + month + "/" + year;
            var Dni=$("#DNI").val();
            var Codigo=$("#CODIGO").val();
            var Nombre=$("#NOMBRES").val();
            var ApellidoP=$("#APELLIDOP").val();
            var ApellidoM=$("#APELLIDOM").val();
            var TipoHorarioDetalle=$("#TIPOHORADETALLE").val();
            var HorarioDetalle=$("#HORARIODETALLEM").val();
            var Empresa='01';
            var Estado="1";
                var dat=[{HorarioDetalle:HorarioDetalle,
                TipoHorarioDetalle,TipoHorarioDetalle,
                Empresa:Empresa,Codigo:Codigo,
                today_date:today_date,Dni:Dni,Estado:Estado}];
                $.ajax({
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:'guardarhorario',
                    data:{datos:dat,id:Codigo},
                    type:'post',
                    dataType:"json",
                    beforeSend: function()
                    {
                        //console.log('procesando');
                    },
                    success:function(response)
                    {
                        if(response.veri==true)
                        {
                            vah='';
                            var horario_historial_lista = response.Historial_H;
                            console.log(horario_historial_lista);
                        }
                        else{
                            alert('no se registró correctamente');
                        }
                    }
                });

        }
    </script>
    @endpush
@endsection