<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Chat extends Model
{
    use HasFactory;
    public function messages(): MorphMany
    {
        return $this->morphMany(Message::class,'messageable');
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(ChatUser::class);
    }
}
