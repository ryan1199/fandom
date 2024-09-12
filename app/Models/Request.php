<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Request extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'fandom_id', 'title', 'description', 'command', 'result', 'status'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function fandom(): BelongsTo
    {
        return $this->belongsTo(Fandom::class);
    }
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }
}
