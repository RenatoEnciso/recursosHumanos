<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actanacimiento extends Model
{
    use HasFactory;
    protected $table = 'acta_nacimiento';
    protected $primaryKey = 'idActa';
    public $timestamps = false;
    protected $fillable = [
        'fecha_nacimiento',
        'DNIPadre',
        'DNIMadre',
        'nombres',
        'domicilio',
        'sexo'
        ];

        public function Acta(){
            return $this->HasOne(Acta::class,'idActa','idActa');
        }
   

}
