<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser preenchidos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];

    /**
     * Relação: Um distrito tem muitos municípios.
     */
    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }
}
