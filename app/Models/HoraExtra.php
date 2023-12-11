<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoraExtra extends Model
{
    use HasFactory;
    public $table ='horaExtra';
    protected $primaryKey = 'idHoraExtra';
    protected $fillable = ['idHoraExtra','idContrato','fecha','hora_inicio','hora_fin','descripcion','estado'];
    public $timestamps = false;

    public function contrato(){
        return $this->HasOne(Contrato::class,'idContrato','idContrato');
    }
}
