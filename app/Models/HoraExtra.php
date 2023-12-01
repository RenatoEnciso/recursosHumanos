<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoraExtra extends Model
{
    use HasFactory;
    public $table ='horaExtra';
    protected $primaryKey = 'idHoraExtra';
    protected $fillable = ['idHoraExtra','idTrabajador','fecha','hora_inicio','hora_fin','descripcion','estado'];
    public $timestamps = false;

    public function trabajador(){
        return $this->HasOne(Trabajador::class,'idTrabajador','idTrabajador');
    }
    // public function persona(){
    //     return $this->HasOne(Persona::class,'DNI','DNI');
    // }

    // public function entrevista(){
    //     return $this->HasMany(Entrevista::class,'idOferta','idOferta');
    // }
}
