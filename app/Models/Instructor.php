<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $table = 'instructores'; // 👈 aquí forzamos el nombre correcto
    protected $fillable = ['nombre'];
}
