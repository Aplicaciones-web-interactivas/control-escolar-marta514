<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';
protected $fillable = ['user_id', 'grupo_id'];

public function usuario() {
    return $this->belongsTo(User::class, 'user_id');
}

public function grupo() {
    return $this->belongsTo(Grupo::class);
}
}
