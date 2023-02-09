<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;
    protected $table = 'Libro';
    protected $primaryKey = 'idLibro';
    public $timestamps = false;
    public function Acta(){
        return $this->hasMany(Acta::class,'idLibro','idLibro');
    }
}
