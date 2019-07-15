<?php

namespace SistemaDigitalizacion;

use Illuminate\Database\Eloquent\Model;

class User_Area extends Model
{
    protected $table='User_Area';
    protected $primaryKey='user_area';
    public $timestamps=false;
    protected $filleable=[
        'CodArea',
        'CodUser',
    ];
    protected $guarded=[];
}
