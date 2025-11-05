<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopcion extends Model
{
    use HasFactory;

    protected $table = 'adopcions';

    protected $fillable = [
        'fecha_adopcion',
        'mascota_id',
        'persona_id',
        'observaciones',
        'lugar_adopcion',
        'contrato',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}
