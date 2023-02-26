<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acta_Matrimonio extends Model
{
    use HasFactory;
    protected $table = 'acta_matrimonio';
    protected $primaryKey = 'idActa';
    public $timestamps = false;
    protected $fillable = [
        'fecha_matrimonio',
        'DNIEsposo',
        'DNIEsposa',
    ];
}
