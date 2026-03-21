<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    // Indicar a Laravel el nombre real de la tabla
    protected $table = 'calificaciones';

    protected $fillable = ['grupo_id', 'user_id', 'calificacion'];

    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function grupo() {
        return $this->belongsTo(Grupo::class);
    }
}
