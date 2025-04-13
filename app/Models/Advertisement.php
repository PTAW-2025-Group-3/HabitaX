<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    /**
     * Atributos que podem ser preenchidos em massa.
     */
    protected $fillable = [
        'reference',
        'title',
        'description',
        'transaction_type',
        'price',
        'state',
        'property_id',
    ];

    /**
     * Casts automáticos para tipos de dados.
     */
    protected $casts = [
        'price' => 'float',
    ];

    /**
     * Relação: este anúncio pertence a uma propriedade.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'advertisement_collection')
            ->withPivot('addedAt')
            ->withTimestamps();
    }
}
