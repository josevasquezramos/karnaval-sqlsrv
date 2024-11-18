<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'rol_tiene_permisos');
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'modelo', 'modelo_tiene_roles')
                    ->withTimestamps();
    }
}
