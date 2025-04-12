<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser preenchidos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'municipality_id'];

    /**
     * Relação: Uma freguesia pertence a um município.
     */
    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
}
