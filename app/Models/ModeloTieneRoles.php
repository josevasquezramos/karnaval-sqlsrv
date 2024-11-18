<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloTieneRoles extends Model
{
    use HasFactory;

    protected $fillable = ['rol_id', 'modelo_id', 'modelo_type'];

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
}
