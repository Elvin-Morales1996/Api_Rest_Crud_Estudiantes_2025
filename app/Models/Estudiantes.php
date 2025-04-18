<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//esto se agrego
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Estudiantes extends Model
{
    //esto se agrego
    use HasFactory;
    protected $table = 'estudiantes'; //nombre de la tabla
    protected $fillable = [
        'nombre', //campos de la tabla estudiantes que queremos alterar
        'correo',
        'celular',
        'programacion'

    ];

}
