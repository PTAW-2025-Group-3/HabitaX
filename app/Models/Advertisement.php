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
        'created_by',
        'updated_by',
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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relação: atualizada por um utilizador.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'advertisement_collection')
            ->withPivot('addedAt')
            ->withTimestamps();
    }
}
