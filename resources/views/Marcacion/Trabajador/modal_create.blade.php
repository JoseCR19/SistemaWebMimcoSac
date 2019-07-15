<div class="modal fade in" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-create_horario">
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
            <div class="container-fluid" >
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
  <div class="modal-footer">
       <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i> Cerrar</button>
      </div>
    </div>
  </div> 
</div>
</div>









