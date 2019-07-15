<?php

namespace SistemaDigitalizacion;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $connection='sqlsrv2';
    protected $table='Banco';
    protected $primaryKey='Codigo';
    public $timestamps=false;

    protected $filleable=[
        'CodEnt',
        'Moneda',
        'NumCuenta', 
        'CtaContable',
        'Descripcion',
    ];
    protected $guarded =[];
}
