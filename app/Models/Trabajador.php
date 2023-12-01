<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;
    protected $table = 'trabajador';
    protected $primaryKey = 'idTrabajador';
    public $timestamps = false;
    protected $fillable = [
        'seguro',
        'AFP',
        // 'id',
        'DNI',
        'direccion',
        'telefono',
        'correoPersonal',
        'estado',
        
    ];
    public function persona(){
        return $this->hasOne(Persona::class,'DNI','DNI');
    }
    public function user(){
        return $this->hasOne(User::class,'id','id');
    }
}
