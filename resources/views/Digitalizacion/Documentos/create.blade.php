@extends('layouts.admin')
@section('contenido')
<section class="content-header">
        <h1>
            Panel de Administrador
            <small>Version 1.0.0</small>
        </h1>
        <ol class="breadcrumb">
            <li href="#">
                <i class="fas fa-dolly"></i> Digitalización</li>
            <li class="active">Nueva Digitalización</li>

        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border" style="padding: 10px !important">
                        <h4 style="float:left">
                            <strong style="font-weight: 400">
                                <i class="fas fa-list-ul"></i> Datos del Documento 
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
                    {!!Form::open(array('url'=>'Digitalizacion/Documentos','method'=>'POST','autocomplete'=>'off'))!!}

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
                                                    <div id="DWTcontainer"><!--class="container"-->
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
                                                                                    <!--
                                                                                    <li id="liLoadImage">
                                                                                        <div class="divType">
                                                                                        <div class="mark_arrow collapsed"></div>
                                                                                        Load Images or PDFs</div>
                                                                                        <div id="div_LoadLocalImage" style="display: none" class="divTableStyle">
                                                                                            <ul>
                                                                                                <li class="tc">
                                                                                                    <input class="btnOrg" type="button" value="Load" onclick="return btnLoadImagesOrPDFs_onclick()" />
                                                                                                </li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </li>-->
                                                                                </ul>
                                                                            </div>
                                                                            <div id="divUpload" class="divinput mt30" style="position:relative">
                                                                                <ul>
                                                                                    <li class="toggle">Guardar Documentos</li>
                                                                                    <li>
                                                                                        <p>Nombre del archivo:</p>
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
                                                                                        <!--<input id="btnUpload" class="btnOrg" type="button" value="Upload to Server" onclick ="saveUploadImage('server')"/>-->
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
    tipo.addEventListener('change',function(){
        var selectedOption = this.options[tipo.selectedIndex];
        idTipo(selectedOption.value);

    });    

    function idTipo(idTipo){
        $.ajax({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{tipo:idTipo}, //datos que se envian a traves de ajax
            url:'tipo', //archivo que recibe la peticion
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

    </script>
    @endpush 
@endsection