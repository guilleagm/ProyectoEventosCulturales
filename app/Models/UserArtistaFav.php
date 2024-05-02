<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserArtistaFav extends Model
{
    use HasFactory;

    protected $table = 'usuario_artista_favorito';

    protected $fillable = [
        'id_usuario',
        'id_artista',
    ];

    // Relación con el modelo User (Usuario)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Relación con el modelo Artista
    public function artista()
    {
        return $this->belongsTo(Artista::class, 'id_artista');
    }
}
