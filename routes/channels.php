<?php

use App\Models\Chat;
use App\Models\Discuss;
use App\Models\Fandom;
use App\Models\Gallery;
use App\Models\Post;
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
Broadcast::channel('Fandom', function () {
    return true;
});
Broadcast::channel('DiscussDetails.{id}', function ($id) {
    return Discuss::find($id) != null;
});
Broadcast::channel('ChatDetails.{id}', function ($id) {
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
Broadcast::channel('User.{id}', function ($id) {
    return User::find($id) != null;
});
Broadcast::channel('UsersGallerySearch.{id}', function ($id) {
    return User::find($id) != null;
});
Broadcast::channel('UsersGalleryList.{id}', function ($id) {
    return User::find($id) != null;
});
Broadcast::channel('UsersPostSearch.{id}', function ($id) {
    return User::find($id) != null;
});
Broadcast::channel('UsersPostList.{id}', function ($id) {
    return User::find($id) != null;
});
Broadcast::channel('UsersPostCard.{id}', function ($id) {
    return User::find($id) != null;
});
Broadcast::channel('UsersProfile.{id}', function ($id) {
    return User::find($id) != null;
});
Broadcast::channel('UsersFandomList.{id}', function ($id) {
    return User::find($id) != null;
});
Broadcast::channel('UsersFollowedFollowing.{id}', function ($id) {
    return User::find($id) != null;
});
Broadcast::channel('Chat.{user}', function ($user) {
    return User::find($user) != null;
});
Broadcast::channel('FandomListRightSideNavigationBar.{id}', function ($id) {
    return Fandom::find($id) != null;
});
Broadcast::channel('FandomListLeftSideNavigationBar.{id}', function ($id) {
    return Fandom::find($id) != null;
});
Broadcast::channel('FandomDetails.{id}', function ($id) {
    return Fandom::find($id) != null;
});
Broadcast::channel('FandomProfile.{id}', function ($id) {
    return Fandom::find($id) != null;
});
Broadcast::channel('FandomMemberList.{id}', function ($id) {
    return Fandom::find($id) != null;
});
Broadcast::channel('FandomList.{id}', function ($id) {
    return Fandom::find($id) != null;
});
Broadcast::channel('FandomsGallerySearch.{id}', function ($id) {
    return Fandom::find($id) != null;
});
Broadcast::channel('FandomsGalleryList.{id}', function ($id) {
    return Fandom::find($id) != null;
});
Broadcast::channel('FandomsPostSearch.{id}', function ($id) {
    return Fandom::find($id) != null;
});
Broadcast::channel('FandomsPostList.{id}', function ($id) {
    return Fandom::find($id) != null;
});
Broadcast::channel('FandomsPostCard.{id}', function ($id) {
    return Fandom::find($id) != null;
});
Broadcast::channel('Comment.{id}', function ($id) {
    return Post::find($id) != null || Gallery::find($id) != null;
});
