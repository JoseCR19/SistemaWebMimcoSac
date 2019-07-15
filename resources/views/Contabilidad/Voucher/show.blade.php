@extends ('layouts.admin')
@section ('contenido')
<section class="content-header">
  <h1 style="margin-top: 55px;">
    Panel de Administrador
    <small>Version 2.3.0</small>
    </h1>
    <ol class="breadcrumb" style="margin-top: 55px;">
      <li>
        <a href="#">
          <i class="fas fa-clipboard-check"></i> Voucher</a>
      </li>
      <li class="active"> Voucher Detallado</li>
    </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="callout callout-info">
        <h5 >
          <i class="fa fa-info">
            
          </i>
          Nota
        </h5>
          Esta página ha sido mejorada para la impresión. Haga clic en el botón Imprimir en la parte inferior de la factura para probar.     
      </div>
      <div class="box">
        <div class="box-header with-border" style="padding: 10px !important">
          <h4>
            <strong style="font-weight: 400">
              <i class="fas fa-list-ul"></i> Voucher
            </strong>
          </h4>
        </div>
        
                <!-- /.box-header -->
        <div class="box-body" style="background-color: #4A4B49 !important;">
          <div class="container-fluid" style="background-color: white !important;">
            @foreach($cabecera as $c)
            <div class="row">
              <div class="col-md-12">
                <img class="float-left mr-t-1" src="{{asset('img/logoinka.png')}}" alt="" style="width: 150px;"> 
                <small class="float-right mr-t-1">
                  <span class="negrita">Nro</span> :{{$c->NroVoucher}}
                  <br>
                  {{$c->FechaEmision}}

                </small>
              </div>
            </div>
            <center>
              <h4 class="box-title" style="font-size: 14px !important;text-align: center;color: #676a6c !important;">VOUCHER</h4>
            </center> 

            <div class="row">
              <div class="col-sm-8">
                <address>
                  <strong style="font-weight: 400 !important;width:70px">
                    Fecha:
                  </strong> {{$c->FechaEmision}}
                  <br>
                  <strong style="font-weight: 400 !important;">
                    Banco: {{$c->Banco}}
                  </strong>  
                  <br>
                  @if ($c->TPersona == "04")
                  <strong style="font-weight: 400 !important;">
                    A la orden de: {{$c->Solicitante}}
                    </strong> 
                  @else
                  <strong style="font-weight: 400 !important;">
                  A la orden de: {{$c->CodSolicita .' '.  $c->Solicitante}}
                  </strong> 
                  @endif
                  <br>
                  <strong style="font-weight: 400 !important;">
                    Observaciones: {{$c->Observacion}}
                  </strong>                                   

                </address>
              </div>
              <div class="col-sm-4">
                <address>
                   @if($c->MonedaCod=="PEN")
                    <strong style="font-weight: 400 !important;">
                      S/ : {{$c->MontoPago}}
                    </strong>
                    @endif
                    @if($c->MonedaCod=="USD")
                    <strong style="font-weight: 400 !important;">
                      $ : {{$c->MontoPago}}
                    </strong>
                    @endif
                  <br>
                  <strong style="font-weight: 400 !important;">Nro Cheque:{{$c->NroCheque}}</strong>
                  <br>
                </address>
              </div>
            </div>
            @endforeach
            <div  class="container-fluid">
              <div class="row" style="border-top:1px  dashed black; border-bottom:1px dashed black;padding:5px">
                <div class="col-md-1" style="text-align:center;font-size:11px !important;font-weight: bold;">
                  CC/OT
                </div>
                <div class="col-md-4" style="text-align:center;font-size:11px !important;font-weight: bold;">
                  CLIENTE
                </div>
                <div class="col-md-2" style="text-align:center;font-size:11px !important;font-weight: bold;">
                  DESCRIPCION
                </div>
                <div class="col-md-2" style="text-align:center;font-size:11px !important;font-weight: bold;">
                  DOCUMENTO
                </div>
                <div class="col-md-2" style="text-align:center;font-size:11px !important;font-weight: bold;">
                  F.EMISION
                </div>
                <div class="col-md-1" style="text-align:center;font-size:11px !important;font-weight: bold;">
                  MONTO 
                </div>
              </div>
            </div>
            <div class="row" style="padding-left:  30px !important;padding-right: 30px !important;padding:5px">
              <div class="col-lg-12 table-responsive">
                @foreach($cuerpo as $ca)
                <div class="col-md-1" style="text-align:justify;font-size:8px !important">
                  <div >
                     {{$ca->NroOt}}
                  </div>
                </div>
                <div class="col-md-4" style="text-align:justify;font-size:8px !important">
                    {{trim($ca->RazonSocial)}}
                </div>
                <div class="col-md-2" style="text-align:center;font-size:8px !important">
                     {{$ca->TAOB}}
                </div>
                <div class="col-md-2" style="text-align:center;font-size:8px !important">
                    {{$ca->Descripcion}}
                </div>
                <div class="col-md-2" style="text-align:center;font-size:8px !important">
                    {{$ca->FechaRefe}}
                </div>
                <div class="col-md-1" style="text-align:center;font-size:8px !important">
                    {{$ca->Importe}}
                </div>
                @endforeach
              </div>
            </div>
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-9">
                </div>
                <div class="col-sm-3" style="border-top:1px  dashed black;padding:5px">
                  <div>
                    @if($c->MonedaCod=="PEN")
                    <div class="col-md-6" style="text-align:center;font-size:10px !important;font-weight: bold;">
                      TOTAL : S/.
                    </div>
                    @endif
                    @if($c->MonedaCod=="USD")
                    <div class="col-md-6" style="text-align:center;font-size:10px !important;font-weight: bold;">
                      TOTAL : $
                    </div>
                    @endif
                    <div class="col-md-6" style="text-align:center;font-size:10px !important;font-weight: bold;">
                      {{$c->MontoPago}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-12">
              <a class="btn btn-default" href="" target="_blank">
                <i class="fa fa-print"></i>
                Imprimir
              </a>
              <a class="btn btn-default" href="{{ URL::previous() }}" title="Volver Pagina Anterior">
                <img src="{{asset('iconos-svg/left-arrow.svg')}}" width="25" title="Volver Pagina Anterior">
              </a>
            </div>
          </div>
        </div>
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
@endsection

