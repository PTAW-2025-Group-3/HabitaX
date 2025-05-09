<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'telephone',
        'message',
        'is_processed',
        'processed_by_id',
    ];

    protected $casts = [
        'is_processed' => 'boolean',
    ];

    public function processed_by()
    {
        return $this->belongsTo(User::class, 'processed_by_id');
    }
}
