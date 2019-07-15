@extends ('layouts.admin')
@section ('contenido')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h1 class="page-header">¡Bienvenidos! <small>Por favor seleccione una opción del menu izquierdo</small></h1>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
                <!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								@if(Auth::user()->privilegios=='3' || Auth::user()->privilegios=='1')
								<div class="col-md-2 col-sm-12">
									<a href="{{ route('almacen')}}" class="widget widget-stats bg-gradient-yellow inverse-mode" >
										<div class="widget-stats-left">
											<div class="widget-stats-title">
												<i class="fas fa-clipboard-list"  style="font-size:20px"></i>
											</div>
										</div>
										<div class="widget-stats-right">
											<div class="widget-stats-value">
                                            {{$almacen->almacen}}
											</div>
											<div class="widget-desc" style="font-size:16px">Almacen</div>
										</div>
									</a>		
								</div>
								@endif
								@if(Auth::user()->privilegios=='5' || Auth::user()->privilegios=='1')
								<div class="col-md-2 col-sm-12">
									<a href="{{ route('comercial')}}" class="widget widget-stats bg-gradient-blue inverse-mode">
										<div class="widget-stats-left">
											<div class="widget-stats-title">
												<i class="far fa-window-restore"  style="font-size:20px"></i>
											</div>
										</div>
										<div class="widget-stats-right">
											<div class="widget-stats-value">
												{{$comercial->comercial}}
											</div>
											<div class="widget-desc" style="font-size:16px">Comercial</div>
										</div>
									</a>		
								</div>
								@endif
								@if(Auth::user()->privilegios=='4' || Auth::user()->privilegios=='1')
								<div class="col-md-2 col-sm-12">
									<a href="{{ route('facturacion')}}" class="widget widget-stats bg-gradient-purple inverse-mode">
										<div class="widget-stats-left">
											<div class="widget-stats-title">
												<i class="fas fa-wrench"  style="font-size:20px"></i>
											</div>
										</div>
										<div class="widget-stats-right">
											<div class="widget-stats-value">
												{{$factura->factura}}
											</div>
											<div class="widget-desc" style="font-size:16px">Facturación</div>
										</div>
									</a>		
								</div>
								@endif
								@if(Auth::user()->privilegios=='2' || Auth::user()->privilegios=='1')
								<div class="col-md-3 col-sm-12">
									<a href="{{ route('gestion')}}" class="widget widget-stats bg-olive-active inverse-mode">
										<div class="widget-stats-left">
											<div class="widget-stats-title">
												<i class="far fa-hdd"  style="font-size:20px"></i>
											</div>
										</div>
										<div class="widget-stats-right">
											<div class="widget-stats-value">
                                            {{$gestion->gestion}}
											</div>
											<div class="widget-desc" style="font-size:16px">Gestión de Personas</div>
										</div>
									</a>		
                                </div>
                                @endif
                                @if(Auth::user()->privilegios=='1')
								<div class="col-md-2 col-sm-12">
									<a href="{{ route('ti')}}" class="widget widget-stats bg-gradient-red inverse-mode">
										<div class="widget-stats-left">
											<div class="widget-stats-title">
												<i class="far fa-hdd"  style="font-size:20px"></i>
											</div>
										</div>
										<div class="widget-stats-right">
											<div class="widget-stats-value">
												{{$ti->ti}}
											</div>
											<div class="widget-desc" style="font-size:20px">T.I</div>
										</div>
									</a>		
                                </div>
                                @endif 
                                <div class="col-md-1 col-sm-1">
                                </div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="box box-success">
							            <div class="box-header with-border">
							            	Accesos Directos <i class="fas fa-external-link-alt"></i>
							            </div>
							            <div class="box-body">
							                <div class="row">
							                    <div class="col-md-12">
							                    	<div class="row">
							                    		<div class="col-xs-6">
																<!-- BEGIN widget -->
																<ul class="widget widget-list m-b-0 no-bg inverse-mode">
																	<li>
																		<!-- BEGIN widget-list-container -->
																		<a href="{{ route('almacen')}}" class="widget-list-container" style="text-decoration: none;">
																			<div class="widget-list-media icon p-l-0">
																				<i class="bg-gradient-yellow fas fa-clipboard-list"></i>
																			</div>
																			<div class="widget-list-content">
																				<h4 class="widget-title" style="color:#222">Lista de Documentos Digitalizacdos Almacen</h4>
							 												</div>
																		</a>
																		<!-- END widget-list-container -->
																	</li>
																	<li>
																		<!-- BEGIN widget-list-container -->
																		<a href="{{ route('comercial')}}" class="widget-list-container" style="text-decoration: none;">
																			<div class="widget-list-media icon p-l-0">
																				<i class=" bg-gradient-blue far fa-window-restore "></i>
																			</div>
																			<div class="widget-list-content">
																				<h4 class="widget-title" style="color:#222">Lista de Documentos Digitalizacdos Comercial</h4>
																				 
																			</div>
																		</a>
																		<!-- END widget-list-container -->
																	</li>
																	<li>
                                                                            <!-- BEGIN widget-list-container -->
                                                                            <a href="{{ route('facturacion')}}" class="widget-list-container" style="text-decoration: none;">
                                                                                <div class="widget-list-media icon p-l-0">
                                                                                    <i class="bg-gradient-purple fas fa-wrench" style="color: white !important"></i>
                                                                                </div>
                                                                                <div class="widget-list-content">
                                                                                    <h4 class="widget-title" style="color:#222">Lista de Documentos Digitalizacdos Facturación</h4>
                                                                                 </div>
                                                                            </a>
                                                                            <!-- END widget-list-container -->
                                                                        </li>																	
																</ul>
																<!-- END widget -->
														</div>
															<!-- END col-6 -->  
							                    		<div class="col-xs-6">
																<!-- BEGIN widget -->
																<ul class="widget widget-list m-b-0 no-bg inverse-mode">

																	<li>
																		<!-- BEGIN widget-list-container -->
																		<a href="{{ route('gestion')}}"  class="widget-list-container" style="text-decoration: none;">
																			<div class="widget-list-media icon p-l-0">
																				<i class=" bg-olive-active  far fa-hdd "></i>
																			</div>
																			<div class="widget-list-content">
																				<h4 class="widget-title" style="color:#222">Lista de Documentos Digitalizacdos Gestión de Personas</h4>
																				 
																			</div>
																		</a>
																		<!-- END widget-list-container -->
																	</li>
                                                                    <li>
                                                                        <!-- BEGIN widget-list-container -->
                                                                            <a href="{{ route('ti')}}"  class="widget-list-container" style="text-decoration: none;">
                                                                                <div class="widget-list-media icon p-l-0">
                                                                                    <i class=" bg-gradient-red  far fa-hdd "></i>
                                                                                </div>
                                                                                <div class="widget-list-content">
                                                                                    <h4 class="widget-title" style="color:#222">Lista de Documentos Digitalizacdos T.I</h4>
                                                                                     
                                                                                </div>
                                                                            </a>
                                                                            <!-- END widget-list-container -->
                                                                        </li>
																</ul>
																<!-- END widget -->
														</div>
															<!-- END col-6 -->                   			
							                    	</div>
							                    </div>
							                </div>
							            </div><!-- /.row -->
							        </div><!-- /.box-body -->
							    </div><!-- /.box -->
							</div><!-- /.col -->
						</div>
					</div>
				</div>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

@endsection