<?php

namespace SistemaDigitalizacion;

use Illuminate\Database\Eloquent\Model;

class SubTipo extends Model
{
    protected $table='SubTipo';
    protected $primaryKey='CodSubTipo';
    public $timestamps=false;
    protected $filleable=[
        'CodTipo',
        'DescripSubTipo',
    ];
    protected $guarded=[];
}
