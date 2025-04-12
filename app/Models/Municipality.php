<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser preenchidos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'district_id'];

    /**
     * Relação: Um município pertence a um distrito.
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Relação: Um município tem muitas freguesias (parishes).
     */
    public function parishes()
    {
        return $this->hasMany(Parish::class);
    }
}
