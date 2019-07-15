<?php

namespace SistemaDigitalizacion;

use Illuminate\Database\Eloquent\Model;


class Voucher extends Model
{
	protected $connection='sqlsrv2';
    protected $table='Voucher';
    protected $primaryKey='NroVoucher';
    public $timestamps=false;
    protected $filleable=[
        'FechaPago',
        'FechaEmision',
        'NroCheque',
        'NroCuenta',
        'EstadoCheque',
        'MontoPago',
        'CodBanco',
        'EstadoPagoMasivo',
        'Moneda',
        'CodEnt',
    ];
    protected $guarded=[];
}
