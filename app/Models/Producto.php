<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'precio_unitario',
        'stock',
        'ubicacion_almacen',
        'id_categoria',
        'imagen',
        'estado',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function promociones()
    {
        return $this->hasMany(Promocion::class);
    }

    public function historialPrecios()
    {
        return $this->hasMany(HistorialPrecioProducto::class);
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_detalle')
            ->withPivot('cantidad', 'precio_unitario')
            ->withTimestamps();
    }

    public function compras(): BelongsToMany
    {
        return $this->belongsToMany(Compra::class, 'compra_detalle')
            ->withPivot('cantidad', 'precio_unitario')
            ->withTimestamps();
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(CompraDetalle::class);
    }
}
