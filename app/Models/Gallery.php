<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'publish_id', 'tags', 'view'
    ];
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function publish(): BelongsTo
    {
        return $this->belongsTo(Publish::class, 'publish_id', 'id');
    }
}