<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','role_id','fandom_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    public function fandom(): BelongsTo
    {
        return $this->belongsTo(Fandom::class);
    }
}
