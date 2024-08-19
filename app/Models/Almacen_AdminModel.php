<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen_AdminModel extends Model
{
    protected $table = 'almacen'; 
    protected $fillable = [
        'Nombre',
        'Cantidad',
        'codigo',
        'disponibilidad',
        'imagen', 
        'sub_area', 
    ];
}
