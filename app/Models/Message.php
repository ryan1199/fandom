<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'text', 'messageable_id', 'messageable_type'
    ];
    public function messageable(): MorphTo
    {
        return $this->morphTo();
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
