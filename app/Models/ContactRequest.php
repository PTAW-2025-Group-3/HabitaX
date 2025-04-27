<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    use HasFactory;

    /**
     * Atributos atribuíveis em massa.
     */
    protected $fillable = [
        'advertisement_id',
        'created_by',
        'name',
        'email',
        'telephone',
        'message',
        'state',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
