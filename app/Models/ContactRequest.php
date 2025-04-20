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
        'sent_at',
        'state',
    ];

    /**
     * Casts automáticos.
     */
    protected $casts = [
        'sent_at' => 'datetime',
    ];

    /**
     * Relação: pedido foi criado por um utilizador.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relação: pedido está associado a um anúncio.
     */
    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }
}
