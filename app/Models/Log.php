<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Log extends Model
{
    use HasFactory;
    protected $fillable = [
        'message', 'logable_id', 'logable_type'
    ];
    public function logable(): MorphTo
    {
        return $this->morphTo();
    }
}
