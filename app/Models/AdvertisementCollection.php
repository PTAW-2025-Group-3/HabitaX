<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementCollection extends Model
{
    use HasFactory;

    /**
     * O nome da tabela (porque não segue o padrão Laravel).
     */
    protected $table = 'advertisement_collection';

    /**
     * Como não tem `id`, precisamos dizer que não tem chave primária incremental.
     */
    public $incrementing = false;

    /**
     * A chave primária composta.
     */
    protected $primaryKey = ['collection_id', 'advertisement_id'];

    /**
     * Desativa timestamps padrão (porque usas `addedAt`).
     */
    public $timestamps = false;

    /**
     * Atributos atribuíveis.
     */
    protected $fillable = [
        'collection_id',
        'advertisement_id',
        'addedAt',
    ];

    /**
     * Casts.
     */
    protected $casts = [
        'addedAt' => 'datetime',
    ];
}
