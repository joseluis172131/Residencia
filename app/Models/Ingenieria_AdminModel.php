<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingenieria_AdminModel extends Model
{
    protected $table = 'ingenieria'; 
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
