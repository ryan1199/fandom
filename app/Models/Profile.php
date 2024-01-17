<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','avatar_id','cover_id','status','description'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function avatar(): HasOne
    {
        return $this->hasOne(Avatar::class);
    }
    public function cover(): HasOne
    {
        return $this->hasOne(Cover::class);
    }
}
