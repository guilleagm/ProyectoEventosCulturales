<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $table = 'noticias';
    protected $fillable = ['titulo','texto', 'id_artista', 'id_usuario'];

    public function artista()
    {
        return $this->belongsTo(Artista::class, 'id_artista');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
