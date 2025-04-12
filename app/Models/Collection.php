<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    /**
     * Atributos atribuíveis em massa.
     */
    protected $fillable = [
        'name',
        'description',
        'is_public',
        'created_by',
    ];

    /**
     * Casts automáticos.
     */
    protected $casts = [
        'is_public' => 'boolean',
    ];

    /**
     * Relação: a coleção foi criada por um utilizador.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function advertisements()
    {
        return $this->belongsToMany(Advertisement::class, 'advertisement_collection')
            ->withPivot('addedAt')
            ->withTimestamps();
    }

}
