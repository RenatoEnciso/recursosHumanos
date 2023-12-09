<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroDNI extends Model
{
    use HasFactory;
    protected $table = 'registro_dni';
    protected $primaryKey = 'idRegistro';
    public $timestamps = false;
    // protected $fillable = [
    //     'idTipoSolicitud',
    //     'DNI',
    //     'file_foto',
    //     'valida_foto',
    //     'file_voucher',
    //     'valida_voucher',
    //     'cod_servicio_agua',
    //     'cod_servicio_luz',
    //     'solComentario',
    //     'solEstado',
    //     'solFecha'
    // ];

    public function Persona(){
        return $this->HasOne(Persona::class,'DNI','DNI');
    }   
    public function TipoDNI(){
        return $this->hasOne(TipoDNI::class,'idTipoDni','idTipoDni');
    }  		
}
