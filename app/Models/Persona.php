<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'persona';
    protected $primaryKey = 'DNI';
    public $timestamps = false;
    protected $fillable = [
        'Apellido_Paterno',
        'Apellido_Materno',
        'Nombres',
        'sexo',
        'estado',
        'estadocivil',
        'direccion'
    ];
    public function Acta_persona(){
        return $this->hasMany(Acta_Persona::class,'DNI','DNI');
    }
    public function Solicitud(){
        return $this->hasMany(Solicitud::class,'DNISolicitante','DNI');
    }
    public function SolicitudDNI(){
        return $this->hasMany(SolicitudDNI::class,'DNI','DNI');
    }
}
