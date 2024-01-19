<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class huella_persona extends Model
{
    use HasFactory;
    protected $table = 'huella_persona';
    protected $primaryKey = 'idHuellaPersona';
    public $timestamps = false;
    protected $fillable = [
        'idPersona',
        'idHuella',
        'calidadHuella',
        'rutaHuella'
    ];

    public function huella(){
        return $this->hasOne(Huella::class,'idHuella','idHuella');
    }
    public function persona(){
        return $this->hasOne(Persona::class,'DNI','idPersona');
    }
}
