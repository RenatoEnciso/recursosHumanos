<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoActa extends Model
{
    use HasFactory;
    protected $table = 'TipoActa';
    protected $primaryKey = 'idTipoActa';
    public $timestamps = false;
    protected $fillable = ['nombre'];

    public function Acta(){
        return $this->hasMany(Acta::class,'idTipoActa','idTipoActa');
    }
}
