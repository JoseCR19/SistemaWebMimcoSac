<?php

namespace SistemaDigitalizacion;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $connection='sqlsrv3';
    protected $table='Trabajador';
    protected $primaryKey='DNI';
    public $timestamps=false;
    protected $filleable=[
        'APELLIDO_PATERNO',
        'APELLIDO_MATERNO',
        'NOMBRES',
        'TIPOTRAB',
    ];
    protected $guarded=[];
}
