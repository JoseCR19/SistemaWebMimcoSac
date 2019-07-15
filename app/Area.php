<?php

namespace SistemaDigitalizacion;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table='Area';
    protected $primaryKey='CodArea';
    public $timestamps=false;

    protected $filleable=[
        'DescripArea',
    ];

    protected $guarded=[];
}
