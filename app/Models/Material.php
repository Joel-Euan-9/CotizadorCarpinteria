<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Material extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'categories_id', // Asumo que usaste 'category_id' (singular)
    ];

    /**
     * Define la relación: Un Material pertenece a una Categoría.
     */
    public function category(): BelongsTo
    {
        // Usamos 'category_id' como la llave foránea
        return $this->belongsTo(Category::class, 'categories_id');
    }
}