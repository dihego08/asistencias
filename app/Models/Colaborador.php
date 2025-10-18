<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    protected $table = 'colaboradores';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'dni', 'dni_archivo', 'nombres', 'apellido_paterno', 'apellido_materno', 'foto', 'fecha_nacimiento', 'lugar_nacimiento', 'id_estado_civil', 'celular', 'correo', 'brevette', 'direccion', 'telefono_emergencia', 'id_sistema_pension', 'id_entidad_pension', 'codigo', 'asegurado', 'proceso', 'sueldo', 'genero', 'estado_laboral', 'fecha_ingreso', 'fecha_salida', 'id_cargo', 'linea', 'estado', 'archivo', 'marcacion'
    ];
}