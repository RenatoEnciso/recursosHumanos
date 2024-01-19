<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mano extends Model
{
    use HasFactory;
    protected $table = 'Mano';
    protected $primaryKey = 'idMano';
    public $timestamps = false;
    protected $fillable = [
        'ladoMano'
    ];

    public function huellas(){
        return $this->hasMany(Huella::class,'idMano ','idMano');
    }

}
