<div class="modal fade in" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-horario" style="padding-left: 17px;border-radius:0px !important;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header mh-v" style="border:1px solid #1A7BB9 !important;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <img src="{{asset('img/invoice.png')}}" alt="" width="60px">
      </div>
      <div class="modal-body">
        <div class="box box-primary">
          <div class="row" style="margin-top:5px;margin-right:2.5px;margin-left:2.5px;">
            <div class="col-md-6">
              MIMCO S.A.C
            </div>
          </div>
          <div class="box-header with-border" style="padding: 10px !important">
            <center>
              <h4 class="box-title" style="font-size: 14px !important;text-align: center;color: #676a6c !important;">DETALLE REQUERIMIENTO</h4>
            </center> 
          <div class="box-body">
          <table id="detallerequerimiento" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important;">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Descripción Producto
                                                    </th>
                                                    <th>
                                                        Cantidad
                                                    </th>
                                                    <th>
                                                        Peso
                                                    </th>
                                                    <th>
                                                        Moneda
                                                    </th>
                                                    <th>
                                                        Estado
                                                    </th>
                                                    <th>
                                                      Stock
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="detalle-reque">
                                                <tr>
                                                    <th colspan="6" align="text-center">
                                                        <div class="panel panel-transparent panel-dashed tip-sales text-center" >
                                                            <div class="row">
                                                                <div class="col-sm-8 col-sm-push-2">
                                                                    <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                                                                    <h3 class="ich m-t-none">
                                                                        LISTA DE REQUERIMIENTOS
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
        </div>
  </div>
  <div class="modal-footer">
       <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i> Cerrar</button>
      </div>
    </div>
  </div> 
</div>
</div>