<?php

namespace SistemaDigitalizacion;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table='Tipo';
    protected $primaryKey='CodTipo';
    public $timestamps=false;
    protected $filleable=[
        'DescripTipo',
    ];
    protected $guarded=[];
}
