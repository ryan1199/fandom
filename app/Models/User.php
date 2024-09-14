<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'ticket',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function getRouteKeyName()
    {
        return 'username';
    }
    public function avatar(): MorphOne
    {
        return $this->morphOne(Avatar::class, 'avatarable');
    }
    public function cover(): MorphOne
    {
        return $this->morphOne(Cover::class, 'coverable');
    }
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }
    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    public function publishes(): MorphMany
    {
        return $this->morphMany(Publish::class, 'publishable');
    }
    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }
    public function chats(): BelongsToMany
    {
        return $this->belongsToMany(Chat::class)->using(ChatUser::class);
    }
    public function follows(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follow', 'self_user_id', 'other_user_id')->using(Follow::class)->withTimestamps();
    }
    public function blocks(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'block', 'self_user_id', 'other_user_id')->using(Block::class)->withTimestamps();
    }
    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }
    public function bans(): HasMany
    {
        return $this->hasMany(Ban::class);
    }
}
