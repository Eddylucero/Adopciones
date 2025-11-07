<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cirugia extends Model
{
    use HasFactory;

    protected $table = 'cirugias';

    protected $fillable = [
        'mascota_id',
        'fecha_cirugia',
        'duracion',
        'motivo',
        'estado',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}
