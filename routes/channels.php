<?php

use App\Models\Chat;
use App\Models\Discuss;
use App\Models\Fandom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('NewDiscussionMessage.{id}', function ($id) {
    return Discuss::find($id) != null;
});
Broadcast::channel('ResetDiscussion.{id}', function ($id) {
    return Discuss::find($id) != null;
});
Broadcast::channel('DeleteDiscussion.{id}', function ($id) {
    return Fandom::find($id) != null;
});
Broadcast::channel('CreateDiscussion.{id}', function ($id) {
    return Fandom::find($id) != null;
});
Broadcast::channel('NewChatMessage.{id}', function ($id) {
    return Chat::find($id) != null;
});
Broadcast::channel('Follow.{user1}', function (User $user, $user1) {
    return $user->id == $user1;
});
Broadcast::channel('Block.{user1}', function (User $user, $user1) {
    return $user->id == $user1;
});
Broadcast::channel('FollowUnfollowButton.{user1}.{user2}', function (User $user, $user1, $user2) {
    return $user->id == $user1 && User::find($user2) != null;
});
Broadcast::channel('BlockUnblockButton.{user1}.{user2}', function (User $user, $user1, $user2) {
    return $user->id == $user1 && User::find($user2) != null;
});
Broadcast::channel('User.{user1}', function ($user1) {
    return User::find($user1) != null;
});
Broadcast::channel('User.{user2}', function ($user2) {
    return User::find($user2) != null;
});
