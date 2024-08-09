<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Avatar extends Model
{
    use HasFactory;
    protected $fillable = [
        'avatarable_id', 'avatarable_type'
    ];
    public function avatarable(): MorphTo
    {
        return $this->morphTo();
    }
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
