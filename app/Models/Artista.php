<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'biografia',
        'genero',
        'id_usuario',
    ];
    public function usuario() {
        // Asume que cada artista tiene un usuario asociado
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
