<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{
    use HasFactory;
    protected $table = 'Folio';
    protected $primaryKey = 'idFolio';
    public $timestamps = false;
    public function Acta(){
        return $this->hasMany(Acta::class,'idFolio','idFolio');
    }
}
