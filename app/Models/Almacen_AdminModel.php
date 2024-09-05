<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen_AdminModel extends Model
{
    protected $table = 'almacen'; 
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
