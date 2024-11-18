<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = ['ruc', 'razon_social', 'celular', 'direccion', 'estado'];

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}
