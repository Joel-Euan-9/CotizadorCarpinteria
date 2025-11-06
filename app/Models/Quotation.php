<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
        'name',
        'customer',
        'creation_date',
        'expiration_date',
        'total',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'creation_date'   => 'date',
        'expiration_date' => 'date',
        'total'           => 'decimal:2',
    ];

    // --- NOTA ---
    // ¡Este modelo aún no tiene relaciones!
    // No sabe qué materiales o mano de obra le pertenecen.
}