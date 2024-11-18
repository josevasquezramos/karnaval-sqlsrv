<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialPrecioProducto extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id', 'precio_anterior', 'precio_nuevo',
        'fecha_cambio', 'motivo_cambio',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
