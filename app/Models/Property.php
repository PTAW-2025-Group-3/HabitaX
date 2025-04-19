<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    /**
     * Atributos que podem ser preenchidos em massa.
     */
    protected $fillable = [
        'title',
        'country',
        'total_area',
        'images',
        'is_active',
        'is_verified',
        'property_type_id',
        'parish_id',
        'created_by',
        'updated_by',
    ];

    /**
     * Casts automáticos de campos JSON e booleanos.
     */
    protected $casts = [
        'images' => 'json',
        'is_active' => 'boolean',
        'is_verified' => 'boolean',
    ];

    /**
     * Relação: propriedade pertence a um tipo.
     */
    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'type_property');
    }

    /**
     * Relação: propriedade pertence a uma freguesia.
     */
    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }

    /**
     * Relação: criada por um utilizador.
     */
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

    public function property_type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function parameters()
    {
        return $this->hasMany(PropertyParameter::class);
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function priceHistory()
    {
        return $this->hasMany(PriceHistory::class);
    }

    public function verifications()
    {
        return $this->hasMany(PropertyVerification::class);
    }

}
