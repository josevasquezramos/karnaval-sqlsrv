<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloTienePermisos extends Model
{
    use HasFactory;

    protected $fillable = ['permiso_id', 'modelo_id', 'modelo_type'];

    public function permiso()
    {
        return $this->belongsTo(Permiso::class);
    }
}
