<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista_Solicitud extends Model
{
    use HasFactory;
    protected $table = 'lista_solicitud';
    protected $primaryKey = 'idActaSolicitada';
    public $timestamps = false;
    protected $fillable = ['idActa','idSolicitud','estado'];
    public function Solicitud(){
        return $this->HasOne(Solicitud::class,'idSolicitud','idSolicitud');
    }
    public function Acta(){
        return $this->HasOne(Acta::class,'idActa','idActa');
    }
}
