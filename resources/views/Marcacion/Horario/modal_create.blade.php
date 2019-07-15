<div class="modal fade in" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-create-horario">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header mh-c" style="border:1px solid #18A689 !important;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <img src="{{asset('iconos-svg/schedule.svg')}}" alt="" width="60px">
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
                    REGISTRAR HORARIO 
                </h4>
            </center> 
          <div class="box-body">
          <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Registro Horario...
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12" style="margin-bottom:5px;">
                                    <div class="form-group">
                                        <label for="codigo"  class="col-md-2 control-label">CODIGO</label>
                                        <div class="col-lg-3">
                                            @foreach($correlativo as $as)
                                                <input type="text" name="correlativo" id="correlativo" class="form-control col-lg-4" value="{{$as->CODHORARIO}}"  readonly="">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12" style="margin-bottom:5px;">
                                    <div class="form-group">
                                        <label for="email" class="col-md-2 control-label">Horario:</label>
                                        <div class="col-md-10">
                                            <input id="txtdescripcion" name="txtdescripcion" type="text" class="form-control"  placeholder="Descripción" >
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-lg-12" style="margin-bottom:5px;">
                                    <div class="form-group">
                                        <label for="email" class="col-md-2 control-label">Dia:</label>
                                        <div class="col-md-2">
                                            <select  name="iddia" class="form-control" id="dia" data-live-search="true">
                                                <option value="" disabled="" selected="">Seleccionar</option>
                                                @foreach($dias as $di)                
                                                <option value="{{$di->DIA}}">{{$di->DESCRIPCION}}</option>
                                                @endforeach  
                                                </select> 
                                        </div>
                                        <label for="email" class="col-md-1 control-label">H.Inicio:</label>
                                        <div class="col-md-2">
                                            <input class="timepicker form-control" id="horainicio" name="timepicker" />
                                        </div>
                                        <label for="email" class="col-md-1 control-label">H.Fin:</label>
                                        <div class="col-md-2">
                                            <input class="timepicker form-control" id="horafin" name="timepicker" />
                                        </div>
                                        <div class="col-md-2">
                                        <button type="button" id="btnagregar" class="btn btn-primary">
                                            <i class="fas fa-cart-plus"></i> Agregar
                                        </button>
                                        </div>
                                    </div>                                
                                </div>                           
                            </div>
                            <div class="row">
                            <div class="col-md-12">
                                    <table id="creacionhorario" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                                        <thead>
                                            <tr>
                                                <th>DIA</th>
                                                <th>HORA INICIO</th>
                                                <th>HORA FIN</th>
                                                <th>CODIGO HORA</th>
                                                <th>OPCIONES</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button  id="save" class="btn btn-primary btn-sm" type="button"><i class="far fa-save"></i> Guardar</button>
       <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i> Cerrar</button>
      </div>
    </div>
  </div> 
</div>
</div>









