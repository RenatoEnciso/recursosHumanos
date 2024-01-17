<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Huella extends Model
{
    use HasFactory;
    protected $table = 'huella';
    protected $primaryKey = 'idHuella';
    public $timestamps = false;
    protected $fillable = [
        'nombreHuella',
        'idMano'
    ];
    public function huellasPersonas(){
        return $this->hasMany(huella_persona::class,'idHuella','idHuella');
    }
    public function mano(){
        return $this->hasOne(Mano::class,'idMano','idMano');
    }
   
}
