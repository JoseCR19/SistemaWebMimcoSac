<div class="modal fade in" aria-labelledby="myModalLabel" role="dialog" tabindex="-2" id="modal-create-personal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header mh-c" style="border:1px solid #18A689 !important;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <img src="{{asset('iconos-svg/profile.svg')}}" alt="" width="60px">
      </div>
      <div class="modal-body">
        <div class="box box-success">
          <div class="row" style="margin-top:5px;margin-right:2.5px;margin-left:2.5px;">
            <div class="col-md-6">
              MIMCO S.A.C
            </div>
          </div>
          <div class="box-header with-border" style="padding: 10px !important">
            <center>
                <h4 class="box-title" style="font-size: 14px !important;text-align: center;color: #676a6c !important;">
                    REGISTRAR PERSONAL 
                </h4>
            </center> 
          <div class="box-body">
          <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Registro Personal...
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group">
                                    <label for="email" class="col-md-2 control-label">NUMERO</label>
                                    <div class="col-md-3">
                                        <input id="dni" type="text" class="form-control" name="dni" value="" placeholder="Escribe DNI" required autofocus maxlength="8">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-success" id="btnbuscar">
                                        <i class="fa fa-search"></i> Buscar
                                        </button>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-5">
                                        <small id="mensaje" style="color: red;display: none;font-size: 12pt;" > 
                                            <i class="fa fa-remove"></i> El numero de DNI no es valido. 
                                        </small>
                                    </div>                            
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12" style="margin-bottom:5px;">
                                        <div class="form-group">
                                            <label for="email" class="col-md-2 control-label">DNI:</label>
                                            <div class="col-md-3">
                                                <input id="txtdni" name="txtdni" type="text" class="form-control"  placeholder="DNI" >
                                            </div>
                                            <label for="email" class="col-md-2 control-label">Nombres:</label>
                                            <div class="col-md-5">
                                                <input id="txtnombres" name="txtnombres" type="text" class="form-control"  placeholder="Nombres" value="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" style="margin-bottom:5px;">
                                        <div class="form-group">
                                            <label for="email" class="col-md-2 control-label">Apellidos:</label>
                                            <div class="col-md-5">
                                                <input id="txtapellidoP" type="text" class="form-control"  placeholder="Apellido Paterno">
                                            </div>
                                            <div class="col-md-5">
                                                <input id="txtapellidoM" type="text" class="form-control"  placeholder="Apellidos Materno">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" style="margin-bottom:5px;">
                                        <div class="form-group">
                                            <label for="fecha_nacimiento"  class="col-md-2 control-label">F.Nacimiento</label>
                                            <div class="col-lg-3">
                                                <input type="date" name="fecha_nacimiento" id="fecnac" class="form-control col-lg-4" placeholder="Ingrese Fecha nacimiento">
                                            </div>
                                            <label for="fecha_inicio"  class="col-md-2 control-label">F.Inicio</label>
                                            <div class="col-lg-3">
                                                <input type="date" name="fecha_inicio" id="fecinicio" class="form-control col-lg-4" placeholder="Ingrese Fecha Inicio">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" style="margin-bottom:5px;">
                                        <div class="form-group">
                                            <label for="fecha_nacimiento"  class="col-md-2 control-label">U.Negocio</label>
                                            <div class="col-lg-3">
                                                <select required name="unidad" class="form-control" id="idorganizacion1" data-live-search="true">	
                                                    <option value="" disabled="" selected="">Seleccione</option>
                                                    @foreach($listaorganizacion1 as $idorg1)
                                                    <option value="{{$idorg1->IDORG1}}">{{$idorg1->DESCRIPCION}}</option>
                                                    @endforeach	
                                                </select> 
                                            </div>
                                            <label for="fecha_inicio"  class="col-md-2 control-label">Area</label>
                                            <div class="col-lg-4">
                                                <select required name="area" class="form-control" id="idarea" data-live-search="true">	
                                                    <option value="" disabled="" selected="">Seleccione</option>
                                                    @foreach($listaorganizacion2 as $idorg2)
                                                    <option value="{{$idorg2->IDORG2}}">{{$idorg2->DESCRIPCION}}</option>
                                                    @endforeach	
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" style="margin-bottom:5px;">
                                        <div class="form-group">
                                            <label for="fecha_nacimiento"  class="col-md-2 control-label">Categoria</label>
                                            <div class="col-lg-3">
                                                <select required name="unidad" class="form-control" id="categoria" data-live-search="true">	
                                                    <option value="" disabled="" selected="">Seleccione</option>
                                                    @foreach($listarcategoria as $idcg)
                                                    <option value="{{$idcg->CATEGORIA}}">{{$idcg->DESCRIPCION}}</option>
                                                    @endforeach	
                                                </select> 
                                            </div>
                                            <label for="fecha_inicio"  class="col-md-2 control-label">Cargo</label>
                                            <div class="col-lg-5">
                                                <select required name="area" class="form-control" id="cargo" data-live-search="true">	
                                                    <option value="" disabled="" selected="">Seleccione</option>
                                                    @foreach($listacargos as $idcargo)
                                                    <option value="{{$idcargo->CARGO}}">{{$idcargo->DESCRIPCION}}</option>
                                                    @endforeach	
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" style="margin-bottom:5px;">
                                        <div class="form-group">
                                            <label for="fecha_nacimiento"  class="col-md-2 control-label">Centro Costo</label>
                                            <div class="col-lg-10">
                                                <select required name="unidad" class="form-control" id="centrocosto" data-live-search="true">	
                                                    <option value="" disabled="" selected="">Seleccione</option>
                                                    @foreach($centrocosto as $idcc)
                                                    <option value="{{$idcc->CENTRO_DE_COSTO}}">{{$idcc->DESCRIPCION}}</option>
                                                    @endforeach	
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" style="margin-bottom:5px;" >
                                        <div class="form-group">
                                            <label for="codigo"  class="col-md-2 control-label">CODIGO</label>
                                            <div class="col-lg-3">
                                                @foreach($correlativo as $as)
                                                    <input  type="text" name="correlativo" id="correlativo" class="form-control col-lg-4" value="{{$as->CODTEMPUS}}" readonly="">
                                                @endforeach
                                            </div>
                                            <label for="codigo"  class="col-md-2 control-label">HUELLA</label>
                                            <div class="col-lg-3">
                                                @foreach($correlativohuella as $ch)
                                                    <input type="text" name="correlativo" id="codigohuella" class="form-control col-lg-4" value="{{$ch->CODIGOHUELLA}}"  readonly="">
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Horario
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <table class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                                        <thead>
                                            <tr>
                                                <th>Seleccionar</th>
                                                <th>Descripcion</th>
                                                <th>Tipo Horario</th>
                                                <th>CODIGO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <div>
                                                @foreach($Horario as $ho)
                                                <tr>
                                                    <td>
                                                        <input id="horario" type="checkbox" onclick="datosh('{{$ho->HORARIO}}')"/>
                                                    </td>
                                                    <td>
                                                        <input style="width: 70px !important;" id="DESCRIPCIONHORADETALLE" type="hidden" name="{{$ho->DESCRIPCION}}" value="{{$ho->DESCRIPCION}}">
                                                        {{$ho->DESCRIPCION}}
                                                    </td>
                                                    <td>
                                                        <input style="width: 70px !important;" id="TIPOHORADETALLE" type="hidden" name="{{$ho->TIPO_HORARIO}}" value="{{$ho->TIPO_HORARIO}}">
                                                        {{$ho->TIPO_HORARIO}}
                                                    </td>
                                                    <td>
                                                    <input style="width: 70px !important;" id="HORARIODETALLE" type="hidden" name="{{$ho->HORARIO}}" value="{{$ho->HORARIO}}">
                                                        {{$ho->HORARIO}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </div>
                                        </tbody>
                                    </table>
                                </div>  
                                <div class="col-md-5">
                                    <table id="horafija" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                                        <thead>
                                            <tr>
                                                <th>DIA</th>
                                                <th>HORA INICIO</th>
                                                <th>HORA FIN</th>
                                                <th>CODIGO HORA</th>
                                            </tr>
                                        </thead>
                                        <tbody id="hora_detalle">
                                            <tr>
                                                <th colspan="8" align="text-center">
                                                    <div class="panel panel-transparent panel-dashed tip-sales text-center" >
                                                        <div class="row">
                                                            <div class="col-sm-8 col-sm-push-2">
                                                                <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                                                                <h3 class="ich m-t-none">
                                                                    Seleccione un horario
                                                                </h3>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button  id="save" class="btn btn-primary btn-sm" type="button"><i class="far fa-save"></i> Guardar</button>
                                </div>                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
       <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i> Cerrar</button>
      </div>
    </div>
  </div> 
</div>
</div>









