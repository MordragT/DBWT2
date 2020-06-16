<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Session;

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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('forall', function () {
    return true;
});

Broadcast::channel('ab_user.{id}', function ($_user, $id) {
    $current_id = Session::get('user_id');
    return $current_id === $id;
});
