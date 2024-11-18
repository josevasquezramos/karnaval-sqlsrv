<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni', 'apellido_paterno', 'apellido_materno', 'nombres', 'celular', 'fecha_nacimiento',
        'direccion', 'correo', 'genero', 'usuario', 'clave', 'estado',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_cliente');
    }
}
