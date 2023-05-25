<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = ['alumno_nombre', 'alumno_apellido', 'alumno_dni', 'alumno_nivel', 'alumno_nacimiento'];
    public $timestamps = true;
}
