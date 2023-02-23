<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    use HasFactory;
    protected $table = 'ficha_registro';
    protected $primaryKey = 'idficha';
    protected $fillable = ['fecha_registro','ruta_certificado','idtipo'];
    public $timestamps = false;

}
