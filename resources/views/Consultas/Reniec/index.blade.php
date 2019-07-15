@extends('layouts.admin')
@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading" style="background-color: #17a2b8!important;color: #FBF8F8;">
                <b> .. COLSULTA RENIEC .. </b>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email" class="col-md-3 control-label">NUMERO DNI:</label>

                            <div class="col-md-5">
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
    <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="email" class="col-md-3 control-label">DNI:</label>
            <div class="col-md-4">
                <input id="txtdni" type="text" class="form-control"  placeholder="DNI" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-md-3 control-label">Nombres:</label>
            <div class="col-md-8">
                <input id="txtnombres" name="boo" type="text" class="form-control"  placeholder="Nombres" value="" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-md-3 control-label">Apellidos:</label>
            <div class="col-md-8">
                <input id="txtapellidos" type="text" class="form-control"  placeholder="Apellidos" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-md-3 control-label">Grupo de votación:</label>
            <div class="col-md-4">
                <input id="txtgrupo" type="text" class="form-control"  placeholder="Grupo de votacion" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-md-3 control-label">Distrito:</label>
            <div class="col-md-8">
                <input id="txtdistrito" type="text" class="form-control"  placeholder="Distrito" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-md-3 control-label">Provincia:</label>
            <div class="col-md-8">
                <input id="txtprovincia" type="text" class="form-control"  placeholder="Provincia" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-md-3 control-label">Departamento:</label>
            <div class="col-md-8">
                <input id="txtdepartamento" type="text" class="form-control"  placeholder="Departamento" readonly="">
            </div>
        </div>
    </div>
</div>

                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){

        $('#btnbuscar').click(function(){
            var numdni=$('#dni').val();
            if (numdni!='') {
                $.ajax({
                    url:"{{ route('consultar.reniec') }}",
                    method:'GET',
                    data:{dni:numdni},
                    dataType:'json',
                    success:function(data){
                        var resultados=data.estado;
                        if (resultados==true) {
                            $('#txtdni').val(data.dni);
                            $('#txtnombres').val(data.nombres);
                            $('#txtapellidos').val(data.apellidos);
                            $('#txtgrupo').val(data.grupovota);
                            $('#txtdistrito').val(data.distrito);
                            $('#txtprovincia').val(data.provincia);
                            $('#txtdepartamento').val(data.departamento);
                        }else{
                            $('#txtdni').val('');
                            $('#txtnombres').val('');
                            $('#txtapellidos').val('');
                            $('#txtgrupo').val('');
                            $('#txtdistrito').val('');
                            $('#txtprovincia').val('');
                            $('#txtdepartamento').val('');                            
                            $('#mensaje').show();
                            $('#mensaje').delay(2000).hide(2500);
                        }
                    }
                });
            }else{
                alert('Escriba el DNI.!');
                $('#dni').focus();
            }
            
        });

    });
    
</script>   
@endpush
@endsection