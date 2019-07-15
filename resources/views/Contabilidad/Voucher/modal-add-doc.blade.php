<div class="modal fade in" aria-labelledby="myModalLabel" role="dialog" tabindex="-2" id="modal-create-personal">
    <form id="formid">
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
                      REGISTRAR FACTURA 
                  </h4>
              </center> 
            <div class="box-body">
            <div class="row">
                  <div class="col-lg-12 col-md-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              Registro Factura...
                          </div>
                          <div class="panel-body">
                              <div class="row">
                                  <div class="form-group">
                                      <label for="email" class="col-md-2 control-label">NUMERO</label>
                                      <div class="col-md-3">
                                          <input id="ft" type="text" class="form-control" name="ft" value="" placeholder="Escribe Factura" required autofocus maxlength="8">
                                      </div>
                                      <div class="col-md-3">
                                          <button type="button" class="btn btn-success" id="buscar">
                                          <i class="fa fa-search"></i> Buscar
                                          </button>
                                      </div>
                                  </div>
                                  <hr>                              
                              </div>
                              <div class="row">
                                <div class="col-md-7">
                                    <table class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                                        <thead>
                                            <tr>
                                                <th>Seleccionar</th>
                                                <th>Serie</th>
                                                <th>Documento</th>
                                                <th>Importe</th>
                                            </tr>
                                        </thead>
                                        <form action="">
                                            <tbody>
                                                <div>
                                                    @foreach($facturas as $fa)
                                                    <tr>
                                                        <td>
                                                            <input name="page" value="{{$fa->NUMDOC}}"  type="checkbox" />
                                                        </td>
                                                        <td>
                                                            <input style="width: 70px !important;" id="SERIE" type="hidden" name="{{$fa->SERIE}}" value="{{$fa->SERIE}}">
                                                            {{$fa->SERIE}}
                                                        </td>
                                                        <td>
                                                            <input style="width: 70px !important;" id="TIPOHORADETALLE" type="hidden" name="{{$fa->NUMDOC}}" value="{{$fa->NUMDOC}}">
                                                            {{$fa->NUMDOC}}
                                                        </td>
                                                        <td>
                                                        <input style="width: 70px !important;" id="HORARIODETALLE" type="hidden" name="{{$fa->total}}" value="{{$fa->total}}">
                                                            {{$fa->total}}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </div>
                                            </tbody>
                                        </form>
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
            <button  id="enviar" class="btn btn-primary btn-sm" type="button"><i class="far fa-save"></i> Agregar</button>
         <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i> Cerrar</button>
        </div>
      </div>
    </div> 
  </div>
</form>
  </div>

  
  
  
  
  
  
  
  
  