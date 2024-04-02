<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $fillable = [
        'url', 'imageable_id', 'imageable_type'
    ];
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
