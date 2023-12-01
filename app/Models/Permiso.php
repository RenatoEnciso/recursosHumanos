<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;
    public $table ='permiso';
    protected $primaryKey = 'idPermiso';
    protected $fillable = ['idPermiso','fechaRegistro','idContrato','fecha_inicio','fecha_fin','motivo','tipo_permiso','estadoPermiso','archivoCese','estado'];
    public $timestamps = false;

    public function contrato(){
        return $this->HasOne(Contrato::class,'idContrato','idContrato');
    }
    // public function persona(){
    //     return $this->HasOne(Persona::class,'DNI','DNI');
    // }

    // public function entrevista(){
    //     return $this->HasMany(Entrevista::class,'idOferta','idOferta');
    // }
    
}
