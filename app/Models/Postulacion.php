<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    
    use HasFactory;
    public $table ='postulacion';
    protected $primaryKey = 'idPostulacion';
    protected $fillable = ['idPostulacion','DNI','idOferta','fecha','curriculum','estado'];
    public $timestamps = false;

    public function oferta(){
        return $this->HasOne(Oferta::class,'idOferta','idOferta');
    }
    public function persona(){
        return $this->HasOne(Persona::class,'DNI','DNI');
    }
}