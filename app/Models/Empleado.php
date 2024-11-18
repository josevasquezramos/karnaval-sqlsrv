<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni', 'apellido_paterno', 'apellido_materno', 'nombres', 'celular',
        'fecha_nacimiento', 'direccion', 'correo', 'usuario', 'clave', 'estado',
    ];

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    public function historial()
    {
        return $this->hasMany(HistorialEmpleado::class);
    }
}
