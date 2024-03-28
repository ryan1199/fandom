<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Publish extends Model
{
    use HasFactory;
    protected $fillable = [
        'publishable_id', 'publishable_type', 'visible'
    ];
    public function publishable(): MorphTo
    {
        return $this->morphTo();
    }
    public function post(): HasOne
    {
        return $this->hasOne(Post::class, 'publish_id', 'id');
    }
}
