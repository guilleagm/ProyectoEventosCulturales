<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionEntrada extends Model
{
    use HasFactory;

    protected $table = 'asignacion_entradas';

    protected $fillable = [
        'id_evento',
        'id_usuario',
        'num_entradas_asignadas',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
