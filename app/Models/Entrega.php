<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entrega extends Model
{
    use HasFactory;

    // Campos que Laravel permite guardar (Importante para el Controller)
    protected $fillable = ['tarea_id', 'user_id', 'archivo_path'];

    // Relación: Una entrega pertenece a un alumno (User)
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    // Relación: Una entrega pertenece a una tarea específica
    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }
}