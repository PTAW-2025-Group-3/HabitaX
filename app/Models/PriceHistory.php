<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertisement_id',
        'price',
        'register_date',
    ];

    protected $casts = [
        'register_date' => 'datetime',
        'price' => 'float',
    ];

    /**
     * Relação: este histórico pertence a um anúncio.
     */
    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id');
    }
}
