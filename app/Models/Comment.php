<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'commentable_id', 'commentable_type', 'reply_to', 'replied'
    ];
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function message(): MorphOne
    {
        return $this->morphOne(Message::class, 'messageable');
    }
    public function rates(): MorphMany
    {
        return $this->morphMany(Rate::class, 'rateable');
    }
}
