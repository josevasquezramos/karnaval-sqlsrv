<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion', 'descuento_porcentaje',
        'fecha_inicio', 'fecha_fin', 'producto_id',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
