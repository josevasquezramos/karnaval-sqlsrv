<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = ['proveedor_id', 'empleado_id', 'fecha', 'estado'];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'compra_detalle')
            ->withPivot('cantidad', 'precio_unitario')
            ->withTimestamps();
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(CompraDetalle::class);
    }

    public function getTotalAttribute(): float
    {
        return $this->detalles->sum(fn($detalle) => $detalle->cantidad * $detalle->precio_unitario);
    }
}
