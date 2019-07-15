@extends('layouts.admin')
@section('contenido')
<section class="content-header">
        <h1>
            Panel de Administrador
            <small>Version 1.0.0</small>
        </h1>
        <ol class="breadcrumb">
            <li href="#">
                <i class="fas fa-dolly"></i> Voucher</li>
            <li class="active">Lista de Voucher</li>
        </ol>
    </section>  
    <section class="content"> 
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border" style="padding: 10px !important">
                        <h4 style="float:left">
                            <strong style="font-weight: 400">
                                <i class="fas fa-list-ul"></i> Lista de Voucher
                            </strong>
                        </h4>
                        <!--<div class="ibox-title-buttons pull-right">
                            <a href="{{url('Digitalizacion/Documentos/create')}}"  style="text-decoration: none !important">
                                <button class="btn btn-block btn-success" style="background-color: #18A689 !important;">
                                    <i class="fas fa-plus-circle"></i> Nueva Voucher
                                </button>
                            </a>
                        </div>-->
                    </div>
                    <div class="box-body">
                        <table id="example" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                            <thead> 
                                <tr>
                                    <th>
                                        Pagar
                                    </th>
                                    <th>
                                        N° Voucher 
                                    </th>
                                    <th>
                                        Solicitante
                                    </th>
                                    <th>
                                        N° Cheque
                                    </th>
                                    <th>
                                        Fecha de Pago
                                    </th>
                                    <th>
                                        Importe
                                    </th>
                                    <th>
                                        Moneda
                                    </th>
                                    <th>
                                        Banco
                                    </th>
                                    <th>
                                        Estado
                                    </th>
                                    <th>
                                        Opciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <div id="pago_voucher">
                                {{Form::token()}}
                                    @foreach ($voucher as $v)
                                
                                    <tr>
                                        <td>
                                            <button id="checkbox" onclick="datos('{{$v->NroVoucher}}')">OK</button>
                                        </td>
                                        <td >
                                            {{$v->NroVoucher}}
                                        </td>
                                        <td>
                                            {{$v->Solicitante}}
                                        </td>
                                        <td>
                                            {{$v->NroCheque}} 
                                        </td>
                                        <td>
                                            {{$v->FechaPago}}
                                        </td>
                                        <td>
                                            {{$v->MontoPago}}
                                        </td>
                                        <td>
                                            {{$v->Moneda}}
                                        </td>
                                        <td >
                                            {{$v->Banco}} 
                                        </td>
                                        <td >
                                            {{$v->Estado}} 
                                        </td>
                                        <td style="align-content: center">
                                            <a  href="{{route('voucher-show',$v->NroVoucher)}}" class="btn btn-light btn-xs">
                                                <img src="{{asset('iconos-svg/preview.svg')}}" width="25" title="Visualizar Voucher"> 
                                            </a>
                                            <!--<a  href=""  data-target="#modal-show-{{$v->NroVoucher}}"  data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Ver Voucher">
                                                <img src="{{asset('iconos-svg/preview.svg')}}" width="25">
                                            </a>-->
                                            <a href="{{route('voucher-documentos',$v->NroVoucher)}}" class="btn btn-light btn-xs">
                                                <img src="{{asset('iconos-svg/database.svg')}}" width="25" title="Documentos Digitalizados"> 
                                            </a>
                                            <a target="_blank" href="{{asset('PDF/'.'20300166611-'.$v->NroVoucher.'-'.trim($v->Solicitante).'.pdf')}}" class="btn btn-light btn-xs">
                                                <img src="{{asset('iconos-svg/pdf.svg')}}" width="25" title="Voucher Digitalizado">
                                            </a>
                                            <a  href="{{route('voucher-create',$v->NroVoucher)}}" class="btn btn-light btn-xs">
                                                <img src="{{asset('iconos-svg/scaner.svg')}}" width="25" title="Digitalizar Documento">
                                            </a>
                                            <a href="#">Cant <span class="badge">{{$v->Cantidad}}</span></a>

                                        </td>
                                    </tr>
                                     
                                @endforeach 
                                </div>
                                
                            </tbody>
                        </table>
                        {{$voucher->links()}} 
                    </div>
                </div>
            </div>
        </div>
    </section> 
    @push('scripts')
    <script>
        function datos(voucher){
            // console.log(voucher);
            var vouche=voucher;
            console.log(vouche);
            $.ajax({
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:'vou', 
                data:{dato:vouche},
                type:'POST',
                dataType:"JSON",
                beforeSend: function () {
                    console.log('procesando');
                // $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                    // console.log(response.response);
                //una vez que el archivo recibe el request lo procesa y lo devuelve
                     if(response.veri==true){
                            console.log(response.detalle); 
                            var urlBase=window.location.origin;//192.168.0.9:8000
                            var url2=urlBase+'/'+response.data;//192.168.0.9:8000/Voucher deberia ser esta
                            document.location.href=url2;
                        }else{
                            alert("problemas al actualzar");
                        }
                    }    
            });
        }
    </script>
    @endpush
@endsection

