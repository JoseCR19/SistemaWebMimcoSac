<?php

namespace SistemaDigitalizacion;

use Illuminate\Database\Eloquent\Model;

class Horario_Detalle extends Model
{
    protected $connection='sqlsrv3';
    protected $table='HORARIO_DETALLE';
    protected $primaryKey='HORARIO';
    public $timestamps=false;
    protected $filleable=[
        'DIA',
        'TIPO_HORARIO',
        'HORA_INICIO',
        'HORA_FIN',
    ];
    protected $guarded=[];
}
