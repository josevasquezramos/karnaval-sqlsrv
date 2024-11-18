<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cliente',
        'fecha',
        'descuento',
        'tipo_comprobante',
        'estado',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'pedido_detalle')
            ->withPivot('cantidad', 'precio_unitario')
            ->withTimestamps();
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(PedidoDetalle::class);
    }

    public function getTotalAttribute(): float
    {
        // Calcular el subtotal sumando el producto de cantidad y precio unitario de cada detalle
        $subtotal = $this->detalles->sum(fn($detalle) => $detalle->cantidad * $detalle->precio_unitario);

        // Aplicar el descuento
        $descuento = $this->descuento ?? 0; // Asegurarse de que el descuento no sea nulo
        $totalConDescuento = $subtotal - ($subtotal * ($descuento / 100));

        // Aplicar el impuesto del 18% si el tipo de comprobante es 'F' (Factura)
        if ($this->tipo_comprobante === 'F') {
            $totalConImpuesto = $totalConDescuento * 1.18;
        } else {
            $totalConImpuesto = $totalConDescuento;
        }

        return round($totalConImpuesto, 2); // Redondear a dos decimales
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
