<?php

namespace App\Http\Controllers;

use App\Notifications\NotificationUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class UserController extends Controller
{
    use Notifiable;

    public function notification()
    {
        $user = User::find(1);
        $user->notify(new NotificationUser($user));
    }
}
