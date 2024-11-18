<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'rol_tiene_permisos');
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'modelo', 'modelo_tiene_permisos')
                    ->withTimestamps();
    }
}
