<?php

namespace SistemaDigitalizacion;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $connection='sqlsrv3';
    protected $table='HORARIO';
    protected $primaryKey='HORARIO';
    public $timestamps=false;
    protected $filleable=[
        'TIPO_HORARIO',
        'DESCRIPCION',
    ];
    protected $guarded=[];
}
