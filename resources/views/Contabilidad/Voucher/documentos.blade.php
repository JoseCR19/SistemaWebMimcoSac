<div class="modal fade in" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-documentos-{{$v->NroVoucher}}" style="padding-left: 17px;border-radius:0px !important;">
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
            <div class="col-md-6" style="text-align:right;">
              Nro :  {{$v->NroVoucher}}
              <br>
              {{$v->FechaEmision}}
            </div>

          </div>
          <div class="box-header with-border" style="padding: 10px !important">
            <center>
              <h4 class="box-title" style="font-size: 14px !important;text-align: center;color: #676a6c !important;">VOUCHER</h4>
            </center> 
            
            <div class="row">
              <div class="col-md-8">
                <div>
                  Fecha: {{$v->FechaEmision}}
                </div>   
                <div>
                  Banco: {{$v->Banco}}
                </div>      
                <div>
                   @if ($v->TPersona == "04")
                  <div>
                    A la orden de: {{$v->Solicitante}}
                  </div>
                  @else
                  <div>
                    A la orden de: {{$v->CodSolicita .' '.  $v->Solicitante}}
                  </div>
                  @endif
                </div> 
              </div>
              <div class="col-md-4">
                <div>
                  S/   {{$v->MontoPago}}
                </div>
                <div>
                  Nro Cheque: {{$v->NroCheque}}
                </div>
              </div>

            </div>
            <div>
              Observaciones: {{$v->Observacion}}
            </div>
          </div>

          <div class="box-body">
            <div  class="container-fluid">
              <div class="row" style="border-top:1px  dashed black; border-bottom:1px dashed black;padding:5px">
                <div class="col-md-4" style="text-align:center">
                  DOCUMENTO
                </div>
                <div class="col-md-4" style="text-align:center">
                  USUARIO
                </div>
                <div class="col-md-4" style="text-align:center">
                  OPCIONES
                </div>
              </div>
            </div> 
            <div class="row" style="padding-left:  30px !important;padding-right: 30px !important;padding:5px">
              <div class="col-12 table-responsive">
                
                <div class="col-md-4" style="text-align:justify;font-size:11px">
                  <div >
                     
                  </div>
                </div>
                <div class="col-md-4" style="text-align:justify;font-size:11px">
                    
                </div>
                <div class="col-md-4" style="text-align:center;font-size:11px">
                     opciones
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









