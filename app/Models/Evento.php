<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'fecha',
        'categoria',
        'num_entradas_disponibles',
        'estado',
        'id_sede',
    ];

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'id_sede');
    }
    public function asignacionEntradas() {
        return $this->hasMany(AsignacionEntrada::class, 'id_evento');
    }
}
