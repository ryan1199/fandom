<?php

namespace App\Http\Middleware;

use App\Models\Ban;
use App\Models\Fandom;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsNotBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($request->route('fandom')) {
                $fandom = $request->route('fandom');
                $isUserIsBanned = Ban::where('user_id', $user->id)->where('fandom_id', $fandom->id)->first();
                if ($isUserIsBanned != null) {
                    return redirect()->route('home')->with('error', 'You are banned from ' . $fandom->name);
                }
                return $next($request);
            }
            if ($request->route('post')) {
                $post = $request->route('post');
                $postPublish = $post->publish;
                if ($postPublish != null) {
                    if ($postPublish->publishable_type == 'App\Models\Fandom') {
                        $fandom = Fandom::find($postPublish->publishable_id);
                        $isUserIsBanned = Ban::where('user_id', $user->id)->where('fandom_id', $fandom->id)->first();
                        if ($isUserIsBanned != null) {
                            return redirect()->route('home')->with('error', 'You are banned from ' . $fandom->name);
                        }
                    } else {
                        return $next($request);
                    }
                } else {
                    return $next($request);
                }
            }
            if ($request->route('gallery')) {
                $gallery = $request->route('gallery');
                $galleryPublish = $gallery->publish;
                if ($galleryPublish->publishable_type == 'App\Models\Fandom') {
                    $fandom = Fandom::find($galleryPublish->publishable_id);
                    $isUserIsBanned = Ban::where('user_id', $user->id)->where('fandom_id', $fandom->id)->first();
                    if ($isUserIsBanned != null) {
                        return redirect()->route('home')->with('error', 'You are banned from ' . $fandom->name);
                    }
                } else {
                    return $next($request);
                }
            }
        } else {
            return $next($request);
        }
    }
}
