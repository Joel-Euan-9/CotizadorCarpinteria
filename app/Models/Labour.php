<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Labour extends Model
{
    use HasFactory;

    /**
     * El nombre de la tabla asociada con el modelo.
     * (Necesario porque tu migración usó 'labour' en singular).
     *
     * @var string
     */
    protected $table = 'labour';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'price',
        'charge_id', // Asumo que usaste 'charge_id' (singular)
    ];

    /**
     * Define la relación: Una Mano de Obra pertenece a un Cargo.
     */
    public function charge(): BelongsTo
    {
        // Usamos 'charge_id' como la llave foránea
        return $this->belongsTo(Charge::class, 'charge_id');
    }
}