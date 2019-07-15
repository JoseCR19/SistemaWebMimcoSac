<?php

namespace SistemaDigitalizacion;

use Illuminate\Database\Eloquent\Model;

class VoucherDetalle extends Model
{
 	protected $connection='sqlsrv2';
    protected $table='Voucher_Det';
    protected $primaryKey='NroVoucher';
    public $timestamps=false;
    protected $filleable=[
        'CodEnt',
        'Item',
        'Importe',
        'Descripcion',
        'SerieDocRef',
        'NroDocRef',
        'TipoDocRef',
        'CodOt',
        'TipPago',
        'NroRegistro',
        'NroOt',
        'DirOt',
    ];
    protected $guarded=[];
}

