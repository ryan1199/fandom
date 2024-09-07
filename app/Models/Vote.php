<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'request_id', 'agree', 'disagree'
    ];
    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
