<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ban extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'fandom_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->orderBy('username', 'ASC');
    }
    public function fandom(): BelongsTo
    {
        return $this->belongsTo(Fandom::class)->orderBy('user', 'ASC');
    }
}
