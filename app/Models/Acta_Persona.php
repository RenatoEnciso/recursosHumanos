<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acta_Persona extends Model
{
    use HasFactory;
    protected $table = 'acta_persona';
    protected $primaryKey = 'idActaPersona';
    public $timestamps = false;
    protected $fillable = ['DNI','idActa'];
    public function Persona(){
        return $this->HasOne(Persona::class,'DNI','DNI');
    }
    public function Acta(){
        return $this->HasOne(Acta::class,'idActa','idActa');
    }
}

