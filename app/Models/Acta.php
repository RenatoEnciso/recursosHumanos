<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acta extends Model
{
    use HasFactory;
    protected $table = 'acta';
    protected $primaryKey = 'idActa';
    public $timestamps = false;
    protected $fillable = [
        'fecha_registro',
        'observcion',
        'lugar_ocurrencia',
        'estado',
        'nombreregistradorcivil',
        'localidad'
    ];
   
    
    public function Acta_Persona(){
        return $this->HasMany(Acta_Persona::class,'idActa','idActa');
    }
    public function Lista_Solicitud(){
        return $this->HasMany(Lista_Solicitud::class,'idActa','idActa');
    }
    public function ficha(){
        return $this->HasOne(Ficha::class,'idficha','idActa');
    }
    public function actaNacimiento(){
        return $this->HasOne(ActaNacimiento::class,'idActa','idActa');
    }
    public function ActaMatrimonio(){
        return $this->HasOne(Acta_Matrimonio::class,'idActa','idActa');
    }
}
