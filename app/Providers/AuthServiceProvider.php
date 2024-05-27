<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Comment;
use App\Models\Discuss;
use App\Models\Fandom;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\DiscussPolicy;
use App\Policies\FandomPolicy;
use App\Policies\GalleryPolicy;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Fandom::class => FandomPolicy::class,
        Post::class => PostPolicy::class,
        Gallery::class => GalleryPolicy::class,
        Comment::class => CommentPolicy::class,
        Discuss::class => DiscussPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
