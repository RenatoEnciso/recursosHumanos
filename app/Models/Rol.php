<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    public $table ='roles';
    protected $primaryKey = 'idRol';
    protected $fillable = ['nombreRol'];
    public $timestamps = false;

    public function usuarios(){
        return $this->HasMany(User::class,'idRol','idRol');
    }
    
}
