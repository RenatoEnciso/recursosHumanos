<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    use HasFactory;
    public $table ='entrevista';
    protected $primaryKey = 'idEntrevista';
    protected $fillable = ['idEntrevista','DNI','idOferta','fecha','observacion','estado'];
    public $timestamps = false;

    public function oferta(){
        return $this->HasOne(Oferta::class,'idOferta','idOferta');
    }
    public function persona(){
        return $this->HasOne(Persona::class,'DNI','DNI');
    }

    // public function entrevista(){
    //     return $this->HasMany(Entrevista::class,'idOferta','idOferta');
    // }
    
}
