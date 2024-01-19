<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $table = 'pago';
    protected $primaryKey = 'idPago';
    protected $fillable = ['fechaPago','entidadFinanciera','rutaVoucher','NumeroOperacion','Monto','estado','idSolicitud'];
    public $timestamps = false;

    public function solicitud(){
        return $this->HasOne(Solicitud::class,'idSolicitud','idSolicitud');
    }
}
