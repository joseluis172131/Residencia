<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 

class Herramienta extends Model
{
    protected $table = 'paileria'; 
    protected $fillable = [
        'nombreherramienta',
        'cantidad',
        'codigo',
        'disponibilidad',
        'imagen',
        'sub_area',
        'numeroParte' 
    ];
}
