<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Fandom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description'
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }
    public function avatar(): MorphOne
    {
        return $this->morphOne(Avatar::class, 'avatarable');
    }
    public function cover(): MorphOne
    {
        return $this->morphOne(Cover::class, 'coverable');
    }
    public function publishes(): MorphMany
    {
        return $this->morphMany(Publish::class, 'publishable');
    }
    public function discusses(): HasMany
    {
        return $this->hasMany(Discuss::class);
    }
}
