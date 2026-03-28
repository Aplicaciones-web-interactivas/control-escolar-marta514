<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarea extends Model
{
    use HasFactory;

    // Campos que permitimos llenar masivamente
    protected $fillable = ['grupo_id', 'titulo', 'descripcion', 'fecha_entrega'];

    // Relación: Una tarea pertenece a un grupo
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    // Relación: Una tarea tiene muchas entregas
    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }
}