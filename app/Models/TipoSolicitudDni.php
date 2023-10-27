<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSolicitudDni extends Model
{
    use HasFactory;
    protected $table = 'tipo_solicitud_dni';
    protected $primaryKey = 'idTipoSolicitud';
    public $timestamps = false;
    protected $fillable = ['tipoSolicitud'];

    public function SolicitudDNI(){
        return $this->hasMany(SolicitudDNI::class,'idTipoSolicitud','idTipoSolicitud');
    }

}
