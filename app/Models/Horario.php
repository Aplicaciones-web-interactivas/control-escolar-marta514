<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = ['user_id', 'materia_id', 'hora_inicio', 'hora_fin', 'dias'];

public function materia() {
    return $this->belongsTo(Materia::class);
}

public function usuario() {
    return $this->belongsTo(User::class, 'user_id');
}

public function grupos() {
    return $this->hasMany(Grupo::class);
}
}
