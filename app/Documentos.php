<?php

namespace SistemaDigitalizacion;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    protected $table='Documentos';
    protected $primaryKey='CodDocumento';
    public $timestamps=false;

    protected $filleable=[
        'CodArea',
        'CodTipo',
        'CodSubTipo',
        'NroVoucher',
        'Fecha',
        'Archivo',
        'FechaAdd',
        'NombreArchivo',
        'UsuarioAdd',
        'created_at',
        'updated_at',
    ];
    protected $guarded =[];
}
