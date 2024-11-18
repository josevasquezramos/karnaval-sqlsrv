<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCambio extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'tipo_cambio';

    protected $fillable = [
        'moneda_origen',
        'moneda_destino',
        'tasa',
        'fecha',
    ];
}
