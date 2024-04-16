<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    use HasFactory;

    protected $table = 'favoritos';
    protected $primaryKey = ['id_usuario', 'id_artista'];
    public $incrementing = false;

    protected $fillable = ['id_usuario', 'id_artista'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function artista()
    {
        return $this->belongsTo(Artista::class, 'id_artista');
    }
}
