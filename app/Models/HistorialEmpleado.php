<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialEmpleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'empleado_id', 'campo_modificado',
        'valor_anterior', 'valor_nuevo', 'fecha_modificacion',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
