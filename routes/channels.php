<?php

use App\Models\Discuss;
use App\Models\Fandom;
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
