<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudDNI extends Model
{
    use HasFactory;
    protected $table = 'solicitud_dni';
    protected $primaryKey = 'idSolicitud';
    public $timestamps = false;
    protected $fillable = [
        'idTipoSolicitud',
        'DNI',
        'file_foto',
        'valida_foto',
        'file_voucher',
        'valida_voucher',
        'cod_servicio_agua',
        'cod_servicio_luz',
        'solComentario',
        'solEstado',
        'solFecha'
    ];

    public function Persona(){
        return $this->HasOne(Persona::class,'DNI','DNI');
    }   
    public function TipoSolicitudDni(){
        return $this->hasOne(TipoSolicitudDni::class,'idTipoSolicitud','idTipoSolicitud');
    }  		
}
