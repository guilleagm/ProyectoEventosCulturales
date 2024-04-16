<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    use HasFactory;

    protected $table = 'programacion';
    protected $fillable = ['id_evento', 'id_artista', 'fecha_hora'];

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento');
    }

    public function artista()
    {
        return $this->belongsTo(Artista::class, 'id_artista');
    }
}
