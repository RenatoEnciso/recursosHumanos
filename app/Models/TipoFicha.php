<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoFicha extends Model
{
    use HasFactory;
    protected $table = 'tipoficha';
    protected $primaryKey = 'idtipo';
    public $timestamps = false;
    protected $fillable = ['nombre'];

    public function fichas(){
        return $this->hasMany(Ficha::class,'idtipo','idtipo');
    }

}
