<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acta_Defunsion extends Model
{
    use HasFactory;
    protected $table = 'acta_defuncion';
    protected $primaryKey = 'idActa';
    public $timestamps = false;
    protected $fillable = [
        'fecha_fallecido',
        'nombreDeclarante',
        'edad',
        'archivo_firma_declarante',
        'dniFallecido',
    ];
    public function Acta(){
        return $this->HasOne(Acta::class,'idActa','idActa');
    }
}


