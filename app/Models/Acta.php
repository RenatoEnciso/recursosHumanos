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
    protected $fillable = ['fecha_registro','hora_registro','libro','folio','observacion','archivo','fecha_Acta','lugar_Acta','idTipoActa','estado'];
    public function TipoActa(){
        return $this->HasOne(TipoActa::class,'idTipoActa','idTipoActa');
    }
    public function Folio(){
        return $this->HasOne(Folio::class,'idFolio','idFolio');
    }
    public function Libro(){
        return $this->HasOne(Libro::class,'idLibro','idLibro');
    }
    public function Acta_Persona(){
        return $this->HasMany(Acta_Persona::class,'idActa','idActa');
    }
    public function Lista_Solicitud(){
        return $this->HasMany(Lista_Solicitud::class,'idActa','idActa');
    }
}
