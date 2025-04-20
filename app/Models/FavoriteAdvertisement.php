<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteAdvertisement extends Model
{
    /** @use HasFactory<\Database\Factories\FavoriteAdvertisementFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'advertisement_id',
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
