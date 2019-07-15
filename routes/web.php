<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 
Route::middleware(['auth'])->group(function() 
{
    Route::get('/', 'DocumentosController@index');
    Route::resource('Contabilidad/Voucher','VoucherController');
    Route::resource('Marcacion/Trabajador','TrabajadorController');
    Route::get('Area',['as'=>'area','uses'=>'AreaController@index']);
    Route::get('Trabajador',['as'=>'trabajador','uses'=>'TrabajadorController@index']);
    Route::get('Obrero',['as'=>'obrero','uses'=>'ObreroController@index']);
    Route::get('Trabajador/edit/{id}',['as'=>'trabajador-edit','uses'=>'TrabajadorController@edit']);
    Route::post('Trabajador/edit/update',['as' => 'trabajador-update','uses'=>'TrabajadorController@update']);
    Route::resource('Digitalizacion/Documentos','DocumentosController');
    Route::get('Documentos',['as'=>'documentos','uses'=>'DocumentosController@index']);
    Route::get('Almacen',['as'=>'almacen','uses'=>'AlmacenController@index']);
    Route::get('Comercial',['as'=>'comercial','uses'=>'ComercialController@index']);
    Route::get('Facturacion',['as'=>'facturacion','uses'=>'FacturacionController@index']);
    Route::get('Gestion',['as'=>'gestion','uses'=>'GesPersonasController@index']);
    Route::get('Tecnologia',['as'=>'ti','uses'=>'TiController@index']);
    /*Rutas para la parte de contabilidad online*/
    Route::get('Bancos',['as'=>'banco','uses'=>'BancoController@index']); 
    Route::get('Voucher',['as'=>'voucher','uses'=>'VoucherController@index']);
    Route::get('Voucher/{idVoucher}/show',['as'=>'voucher-show','uses'=>'VoucherController@show']);
    Route::get('Voucher-Contabilidad',['as'=>'voucher-asociar','uses'=>'VoucherController@index2']);
    Route::get('Voucher/{idVoucher}/documentos2',['as'=>'voucher-documentos','uses'=>'VoucherController@documentos']);
    Route::get('Voucher/listar',['as'=>'voucher-listar','uses'=>'VoucherController@listarVoucherPagados']);
    Route::get('Voucher/create/{id}',['as'=>'voucher-create','uses'=>'VoucherController@edit']);
    Route::get('Voucher/create/{id}/{idruc}',['as'=>'voucher-create2','uses'=>'VoucherController@edit2']);
    Route::post('Voucher/create/tipo',['as'=>'id-tipo','uses'=>'VoucherController@tipo']);
    Route::post('tipo',['as'=>'id-tipo','uses'=>'VoucherController@tipo']);
    Route::resource('Contabilidad/Voucher','VoucherController');
    Route::get('Contabilidad/Voucher/documento',['as'=>'id-documento','uses'=>'VoucherController@documento']);
    // Digitalizacion/Documentos/create
    Route::post('Digitalizacion/Documentos/tipo',['as'=>'id-tipo','uses'=>'DocumentosController@tipo']);

    Route::post('vou', 'VoucherController@ajaxRequestPost');
    Route::post('Trabajador/edit/guardar',['as' => 'trabajador-horario-store','uses'=>'TrabajadorController@store']);
    Route::post('Trabajador/edit/hora','TrabajadorController@ajaxRequestPostHorario');
    Route::post('Trabajador/edit/horadetalle','TrabajadorController@ajaxRequestPostHorario');
    Route::post('/horadetalleindex','TrabajadorController@ajaxRequestPostHorario');
    Route::post('Trabajador/edit/guardarhorario','TrabajadorController@ajaxStoreHorario');
    
    Route::get('Trabajador/index/consultardni', 'TrabajadorController@buscarDni');
    Route::get('/consultardni', 'TrabajadorController@buscarDni')->name('consultar.reniec');
    Route::get('Horario',['as'=>'horario','uses'=>'HorarioController@index']);
    Route::post('/guardar','HorarioController@store');
    Route::post('/horadetalle_hora','HorarioController@ajaxRequestPostHorario');
    Route::post('/listarmarcacion','ReporteMarcacionController@ajaxmarcacion');
    Route::post('/listarmarcacionreporteobrero','ReporteMarcacionController@ajaxmarcacionreporteobrero');
    Route::get('/listarmarcacionTrabajador','ReporteMarcacionController@ajaxmarcaciontrabajador');
    Route::post('/listarmarcacionPersonal','ReporteMarcacionController@ajaxmarcacionPersonal');
    Route::post('/listarmarcacionObrero','ReporteMarcacionController@ajaxmarcacionObrero');
    Route::get('Reporte',['as'=>'reporte','uses'=>'ReporteMarcacionController@index']);
    Route::get('Compras',['as'=>'compras','uses'=>'DiagramaController@index']);
    
    Route::post('/listarrequermientos','DiagramaController@ajaxrequerimiento');
    Route::post('/listarequedetalle','DiagramaController@ajaxrequerimientodetalle');
    Route::get('OrdenesCompra',['as'=>'ordenescompra','uses'=>'OrdenComprasController@index']);
    Route::get('OCAprobadas',['as'=>'ordenesaprobadas','uses'=>'OrdenComprasController@indexverificado']);
    Route::get('OC',['as'=>'oc','uses'=>'OrdenComprasController@oc']);
    Route::get('OCV',['as'=>'ocv','uses'=>'OrdenComprasController@ocv']);
    Route::post('/guardartrabajador','TrabajadorController@ajaxstoretrabajador');
    Route::post('/guardardocumento','VoucherController@ajaxstore');

    Route::get('OrdenesCompra/{idguest}/{idbook}/{idcoden}/documentos',['as'=>'ordenescompra-documentos','uses'=>'OrdenComprasController@documentos']);
    //Route::get('Pdf',['as'=>'pdf','uses'=>'PDFcontroller@index']);
    Route::get('Area',['as'=>'area','uses'=>'AreaController@index']);
    Route::get('Convertir',['as'=>'pdf','uses'=>'ConvertirPdfController@index']);
    Route::post('requerimientos',['as'=>'id-pro','uses'=>'OrdenComprasController@ajaxdocumento']);
    
    //Route::post('/pruebareque','OrdenComprasController@prueba');
    Route::post('/aprobar','OrdenComprasController@ajaxaprobar');
    Route::post('/desaprobar','OrdenComprasController@ajaxdesaprobar');
    Route::post('/faltasustento','OrdenComprasController@ajaxfaltasustento');

});
Auth::routes();