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
        'sub_area',
        'disponibilidad',  
        'imagen',   
    ];
}
