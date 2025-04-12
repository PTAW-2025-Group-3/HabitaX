<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denunciation extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertisement_id',
        'reason_id',
        'desc',
        'report_state',
        'created_by',
        'validated_by',
        'submitted_at',
        'validated_at',
    ];

    protected $casts = [
        'report_state' => 'integer',
        'submitted_at' => 'datetime',
        'validated_at' => 'datetime',
    ];

    // Quem criou a denúncia
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Quem validou a denúncia
    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    // O motivo da denúncia
    public function reason()
    {
        return $this->belongsTo(DenunciationReason::class, 'reason_id');
    }

    // O anúncio que foi denunciado
    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id');
    }
}
