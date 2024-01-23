<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    public $table ='pago';
    protected $primaryKey = 'idSuedo';
    protected $fillable = ['idSuedo','periodo','idContrato','fechaRegistro','ingresos','descuentos','aportes','estado'];
    public $timestamps = false;

    public function contrato(){
        return $this->HasOne(Contrato::class,'idContrato','idContrato');
    }
}

