<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Discuss extends Model
{
    use HasFactory;
    protected $fillable = [
        'fandom_id', 'name', 'visible'
    ];  
    public function fandom(): BelongsTo
    {
        return $this->belongsTo(Fandom::class);
    }
    public function messages(): MorphMany
    {
        return $this->morphMany(Message::class,'messageable');
    }
}
