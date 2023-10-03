<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{

    use HasFactory;
    public $table ='cargo';
    protected $primaryKey = 'idCargo';
    protected $fillable = ['descripcion','estado','idCargo'];
    public $timestamps = false;

    public function usuarios(){
        return $this->HasMany(Oferta::class,'idCargo','idCargo');
    }
    
}
