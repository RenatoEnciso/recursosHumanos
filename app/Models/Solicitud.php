<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'solicitud';
    protected $primaryKey = 'idSolicitud';
    public $timestamps = false;
    protected $fillable = ['DNISolicitante','fechaSolicitud','horaSolicitud','observacion'];
    public function Persona(){
        return $this->HasOne(Persona::class,'DNI','DNISolicitante');
    }   
    public function Lista_Solicitud(){
        return $this->HasMany(Lista_Solicitud::class,'idSolicitud','idSolicitud');
    }  		
}
