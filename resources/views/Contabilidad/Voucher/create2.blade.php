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
        <li class="active">Agregar Documentos</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border" style="padding: 10px !important">
                    <h4 style="float:left">
                        <strong style="font-weight: 400">
                            <i class="fas fa-list-ul"></i> Datos del Voucher
                        </strong>
                    </h4>
                    <!--<div class="ibox-title-buttons pull-right">
                        <a  data-target="#modal-create-personal"  data-toggle="modal" href="" style="text-decoration: none !important">
                            <button class="btn btn-block btn-success" style="background-color: #18A689 !important;">
                                <i class="fas fa-plus-circle"></i> Agregar Documentos
                            </button>
                        </a>
                    </div>-->
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
                <div class="box-body bg-gray-c">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#dni" data-toggle="tab"  style="font-size: 13px;color: #676a6c">VOUCHER</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="dni">
                                        <div class="panel panel-default panel-shodow">
                                            <div class="row">
                                                @foreach ($voucher as $v)
                                                    <div class="col-md-12">
                                                        <div class="panel-body">
                                                            <div class="form-group">
                                                                <label for="" class="control-label" style="font-size: 13px;color: #676a6c">
                                                                    Datos Generales del Voucher
                                                                </label>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                        <label for="">N° Voucher</label>
                                                                        <input type="text" id="NROVOUCHER" name="Documento" class="form-control"  disabled value="{{$v->NroVoucher}}" placeholder="{{$v->NroVoucher}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">{{$v->Solicita}}</label>
                                                                        <input type="text" id="SOLICITA" name="Documento" class="form-control"  disabled value="{{$v->Solicitante}}" placeholder="{{$v->Solicitante}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label for="">Documento</label>
                                                                        <input type="text" id="DOCUMENTO" name="Documento" class="form-control"  disabled value="{{$v->CodSolicita}}" placeholder="{{$v->CodSolicita}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label for="">F.Emisión</label>
                                                                        <input type="text" id="FECHAEM" name="Documento" class="form-control"  disabled value="{{$v->FechaEmision}}" placeholder="{{$v->FechaEmision}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="fom-group">
                                                                        <label for="">F.Pago</label>
                                                                        <input type="text" id="FECHAPAGO" name="Documento" class="form-control" disabled value="{{$v->FechaPago}}" placeholder="{{$v->FechaPago}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="" class="control-label" style="font-size: 13px;color: #676a6c">
                                                                    Importe del voucher
                                                                </label>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <div class="fom-group">
                                                                        <label for="">Moneda</label>
                                                                        <input type="text" id="MONEDA" name="Documento" class="form-control" disabled value="{{$v->Moneda}}" placeholder="{{$v->Moneda}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="fom-group">
                                                                        <label for="">Importe</label>
                                                                        <input type="text" id="IMPORTE" name="Documento" class="form-control" disabled value="{{$v->MontoPago}}" placeholder="{{$v->MontoPago}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="fom-group">
                                                                        <label for="">Banco</label>
                                                                        <input type="text" id="BANCO" name="Documento" class="form-control" disabled value="{{$v->Banco}}" placeholder="{{$v->Banco}}">
                                                                    </div>
                                                                </div>
                                                                @if($v->TipVou=="CH")
                                                                <div class="col-md-2">
                                                                    <div class="fom-group">
                                                                        <label for="">Cheque</label>
                                                                        <input type="text" id="CHEQUE" name="Documento" class="form-control" disabled value="{{$v->NroCheque}}" placeholder="{{$v->NroCheque}}">
                                                                    </div>
                                                                </div>
                                                                @else
                                                                <div class="col-md-2">
                                                                    <div class="fom-group">
                                                                        <label for="">Cheque</label>
                                                                        <input type="text" id="CHEQUE" name="Documento" class="form-control" disabled>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                <div class="col-md-3">
                                                                    <div class="fom-group">
                                                                        <label for="">Cuenta</label>
                                                                        <input type="text" id="CHEQUE" name="Documento" class="form-control" disabled value="{{$v->NroCuenta}}" placeholder="{{$v->NroCuenta}}">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table id="horafija" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>
                                        Documento
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="hora_detalle">

                            </tbody>
                        </table>
                    </div>
                </div>
                {!!Form::open(array('url'=>'Contabilidad/Voucher','method'=>'POST','autocomplete'=>'off'))!!}
                {{Form::token()}}
                <div class="box-body bg-gray-c">
                    <div id="wrapper">
                        <div id="demoContent">
                            <div id="dwtScanDemo">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="ct-top"> 
                                            <span class="title">Digitalización</span> 
                                            <a target="_blank" href="#">
                                                <img src="{{url('img/logoinka.png')}}" style="height:35px" title="Dynamic Web TWAIN" alt="Dynamic Web TWAIN">
                                            </a> 
                                        </div> 
                                    </div>
                                    <div class="col-md-10">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <p>Area:</p>
                                                <select name="CodArea" id="CodArea" class="form-control "  data-live-search="true"  onselect="generarRuta()">
                                                    <option value="" disabled="" selected="">Area</option>
                                                    @if(Auth::user()->privilegios=='1')
                                                        @foreach($areaT as $at)
                                                            <option value="{{$at->CodArea}}">{{$at->DescripArea}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($area as $a)
                                                            <option value="{{$a->CodArea}}">{{$a->DescripArea}}</option>
                                                        @endforeach
                                                    @endif
                                                 </select>
                                            </div>
                                        </div> 
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <p>Tipo:</p>
                                                <select name="CodTipo" id="tipo" class="form-control "  data-live-search="true" >
                                                    <option value="" disabled="" selected="">Tipo</option>
                                                    @foreach($tipo as $t)
                                                        <option value="{{$t->CodTipo}}">{{$t->DescripTipo}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <p>Sub Tipo:</p>
                                                <select name="subtipo" id="subtipo" class="form-control"  data-live-search="true" >
                                                    <option value="" disabled="" selected="">Subtipo</option>                                                                
                                                </select>
                                            </div>
                                        </div>   
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <p>Fecha:</p>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </div>
                                                    <input type="date" class="form-control pull-right" name="fecha_nacimiento">	
                                                </div>
                                            </div>
                                        </div>     
                                    </div>
                                </div>
                                <div class="continer">
                                    <div id="DWTcontainer">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <div id="DWTcontainerTop">
                                                    <div id ="divEdit">
                                                        <div id="ImgSizeEditor" style="visibility:hidden">
                                                            <ul>
                                                                <li>
                                                                    <label for="img_height">New Height :
                                                                        <input type="text" id="img_height" style="width:50%;" size="10"/>
                                                                            pixel
                                                                    </label>
                                                                </li>
                                                                <li>
                                                                    <label for="img_width">New Width :&nbsp;
                                                                        <input type="text" id="img_width" style="width:50%;" size="10"/>
                                                                            pixel
                                                                    </label>
                                                                </li>
                                                                <li>Interpolation method:
                                                                    <select size="1" id="InterpolationMethod">
                                                                        <option value = ""></option>
                                                                    </select>
                                                                </li>
                                                                <li style="text-align:center;">
                                                                    <input type="button" value="   OK   " id="btnChangeImageSizeOK" onclick ="btnChangeImageSizeOK_onclick();"/>
                                                                        <input type="button" value=" Cancel " id="btnCancelChange" onclick ="btnCancelChange_onclick();"/>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div id="dwtcontrolContainer">
                                                    </div>
                                                    <div id="btnGroupBtm" class="clearfix">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div id="ScanWrapper">
                                                    <div id="divScanner" class="divinput">
                                                        <ul class="PCollapse">
                                                            <li>
                                                                <div class="divType">
                                                                    <div class="mark_arrow expanded">
                                                                    </div>
                                                                    Propiedades del Scaner
                                                                </div>
                                                                <div id="div_ScanImage" class="divTableStyle">
                                                                    <ul id="ulScaneImageHIDE" >
                                                                        <li>
                                                                            <label for="source">
                                                                                <p>Seleccione Scaner:</p>
                                                                            </label>
                                                                            <select size="1" id="source" style="position:relative;" onchange="source_onchange()">
                                                                                <option value = ""></option>
                                                                            </select>
                                                                        </li>
                                                                        <li style="display:none;" id="pNoScanner">
                                                                            <a href="javascript: void(0)" class="ShowtblLoadImage" style="color:#fe8e14" id="aNoScanner">(No se detectaron controladores compatibles con el sistema)</a></li>
                                                                        <li id="divProductDetail"></li>
                                                                        <li class="tc">
                                                                            <input id="btnScan" disabled="disabled" type="button" value="Escanear" onclick ="acquireImage();"/>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div id="divUpload" class="divinput mt30" style="position:relative">
                                                        <ul>
                                                            <li class="toggle">Guardar Documentos</li>
                                                            <li><p>Nombre del Voucher:</p>
                                                                <div class="form-group">
                                                                    <select id="idvoucher" name="NroVoucher"  class="form-control "  data-live-search="true" >
                                                                    @foreach($cabecera as $cb)
                                                                        <option id="{{$cb->NroVoucher}}" value="{{$cb->NroVoucher}}">{{$cb->NroVoucher}}</option>
                                                                    @endforeach
                                                                    </select>   
                                                                </div>
                                                                <input type="text" name="NombreArchivo" size="20" id="txt_fileName" required/>
                                                            </li>
                                                            <li style="padding-right:0;">
                                                                <label for="imgTypebmp">
                                                                    <input type="radio" value="bmp" name="ImageType" id="imgTypebmp" onclick ="rd_onclick();" disabled/>
                                                                        BMP
                                                                </label>
                                                                <label for="imgTypejpeg">
                                                                    <input type="radio" value="jpg" name="ImageType" id="imgTypejpeg" onclick ="rd_onclick();" disabled/>
                                                                        JPEG
                                                                </label>
                                                                <label for="imgTypetiff">
                                                                    <input type="radio" value="tif" name="ImageType" id="imgTypetiff" onclick ="rdTIFF_onclick();" disabled/>
                                                                        TIFF
                                                                </label>
                                                                <label for="imgTypepng">
                                                                    <input type="radio" value="png" name="ImageType" id="imgTypepng" onclick ="rd_onclick();" disabled/>
                                                                        PNG
                                                                </label>
                                                                <label for="imgTypepdf">
                                                                    <input type="radio" value="pdf" name="ImageType" id="imgTypepdf" onclick ="rdPDF_onclick();"/>
                                                                        PDF
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="MultiPageTIFF">
                                                                    <input type="checkbox" id="MultiPageTIFF"/>
                                                                        Multi-Page TIFF
                                                                </label>
                                                                <label for="MultiPagePDF">
                                                                    <input type="checkbox" id="MultiPagePDF"/>
                                                                        Multi-Page PDF
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <input id="btnSave" class="btnOrg" type="submit" value="Guardar" onclick ="saveUploadImage('local')" style="margin-bottom:5px;"/>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="DWTcontainerBtm" class="clearfix">
                                            <div id="DWTemessageContainer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('Contabilidad.Voucher.modal-add-doc')
            {!!Form::close()!!}
        </div>
    </div>
</section> 
    @push('scripts') 
    <script>
        window['bDWTOnlineDemo'] = true;
    </script> 
    <!--<script src="{{asset('Scripts/jquery.js?t=170607')}}"></script> -->
    <script src="{{asset('Resources/dynamsoft.webtwain.config.js?t=170607')}}"></script> 
    <script src="{{asset('Resources/dynamsoft.webtwain.initiate.js?t=170607')}}"></script> 
    <script src="{{asset('Resources/addon/dynamsoft.webtwain.addon.pdf.js?t=170607')}}"></script> 
    <script src="{{asset('Scripts/online_demo_operation.js?t=170607')}}"></script> 
    <script src="{{asset('Scripts/online_demo_initpage.js?t=170607')}}"></script> 
    <script>
        $("ul.PCollapse li>div").click(function() {
            if ($(this).next().css("display") == "none") {
                $(".divType").next().hide("normal");
                $(".divType").children(".mark_arrow").removeClass("expanded");
                $(".divType").children(".mark_arrow").addClass("collapsed");
                $(this).next().show("normal");
                $(this).children(".mark_arrow").removeClass("collapsed");
                $(this).children(".mark_arrow").addClass("expanded");
            }
        });
    </script> 
    <script>
        // Assign the page onload fucntion.
        $(function() {
            pageonload();
        });
    </script>
    <script type="text/javascript">
        // function generarRuta(){
        //     document.getElementById("rutagenerada").value=
        //         document.getElementById("CodArea").value
        // }
    var tipo = document.getElementById('tipo');
    tipo.addEventListener('change',function(){var selectedOption = this.options[tipo.selectedIndex];
    idTipo(selectedOption.value);

    });    

    function idTipo(idTipo){
        $.ajax({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{tipo:idTipo}, //datos que se envian a traves de ajax
            url:'/tipo', //archivo que recibe la peticion
            type:'post', //método de envio
            dataType:"json",//tipo de dato que envio 
            beforeSend: function () {
                // console.log('procesando');
            }, 
            success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
            //    ACA ES DONDE SE MUESTRA LOS VALORES DEL SELECT DEL SUB TIPO 
                if(response.veri==true){
                    var subtipo=response.subTipo;
                    va='<option value="" disabled="" selected="">Seleccione</option>'
                    for(const i in subtipo){
                        va+='<option value="'+subtipo[i]['CodSubTipo']+'">'+subtipo[i]['DescripSubTipo']+'</option>';                 
                    }

                    $("#subtipo").html(va); 
                }else{
                    alert("problemas al enviar la informacion");
                }
            }
        });
    }
    $(document).ready(function(){
        $('#btnSave').click(function(){

            let voucher=$("#idvoucher option:selected").val();
            
            let TABLAID='horafija';
            var DATA 	= [];
            var TABLA 	= $("#"+TABLAID+" tbody > tr");
            TABLA.each(function(){
                var ID 		= $(this).find("input[id='numdoc']").val();
                item = {};
                if(ID !== ''){
	            item ["nrodoc"] 	= ID;
	            //una vez agregados los datos al array "item" declarado anteriormente hacemos un .push() para agregarlos a nuestro array principal "DATA".
	            DATA.push(item);
		        } 
            });
            console.log(DATA);
            //INFO 	= new FormData();
            //aInfo 	= JSON.stringify(DATA);

            //INFO.append('data', aInfo);
            $.ajax({
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {datos:DATA,voucher:voucher},
                type: 'POST',
                url : '/guardardocumento',
                dataType:"json",
                //processData: false, 
                //contentType: false,
                success: function(r){
                    //Una vez que se haya ejecutado de forma exitosa hacer el código para que muestre esto mismo.
                }
            });
            //console.log(TABLA);
        });
    });
    $(document).ready(function() {
  $('#enviar').click(function() {
    $('#modal-create-personal').modal('hide');
    // defines un arreglo
    var selected = [];
    $(":checkbox[name=page]").each(function() {
      if (this.checked) {
        // agregas cada elemento.
        selected.push($(this).val());
      }
    });
    let llenar='';
    $("#horafija > tbody").empty();
    let cont=1;
    for (let index = 0; index < selected.length; index++) {
        const element = selected[index];
        llenar+='<tr class="selected text-center" style="width:100%; color:black !important" id="'+cont+'">'+
                '<td class="text-center" id="idcod" >'+
                    '<input style="width: 70px !important;" type="hidden" name="" value="" >'+cont+
                '</td>'+
                '<td class="text-center" id="nrodoc">'+
                    '<input style="width: 70px !important;" type="hidden" name="" id="numdoc" value="'+selected[index]+'">'+selected[index]+
                '</td>'+
            '</tr>';
        $('#horafija tbody').append(llenar);
        console.log(element);
        cont++;
    }
    $("#hora_detalle").html(llenar);
    /*
    if (selected.length) {

      $.ajax({
        cache: false,
        type: 'post',
        dataType: 'json', // importante para que 
        data: selected, // jQuery convierta el array a JSON
        url: 'roles/paginas',
        success: function(data) {
          alert('datos enviados');
        }
      });

      // esto es solo para demostrar el json,
      // con fines didacticos
      alert(JSON.stringify(selected));

    } else
      alert('Debes seleccionar al menos una opción.');
*/
    return false;
  });
});

    </script>
    @endpush 
@endsection