<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficina_AdminModel extends Model
{
    protected $table = 'oficina_administrativa'; 
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
