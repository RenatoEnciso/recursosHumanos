<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacacion extends Model
{
    use HasFactory;
    public $table ='vacacion';
    protected $primaryKey = 'idVacacion';
    protected $fillable = ['idVacacion','fecha_inicio','fecha_fin','idTrabajador','descripcion','estado'];
    public $timestamps = false;

    public function trabajador(){
        return $this->HasOne(Trabajador::class,'idTrabajador','idTrabajador');
    }

    // public function entrevista(){
    //     return $this->HasMany(Contrato::class,'Nhorario','Nhorario');
    // }
    
}
