<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    protected $table = 'mascotas';
    
    protected $fillable = [
        'nombre',
        'especie',
        'raza',
        'edad',
        'sexo',
        'descripcion',
        'estado',
        'foto',
    ];

    public function adopciones()
    {
        return $this->hasMany(Adopcion::class);
    }

    public function cirugias()
    {
        return $this->hasMany(Cirugia::class);
    }

}
