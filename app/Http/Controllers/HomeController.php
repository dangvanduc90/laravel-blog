<?php

namespace App\Http\Controllers;

use App\Events\OrderShipped;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
        return view('home');
    }

    /**
     *
     */
    public function ship()
    {
        $user = User::findOrFail(13);

        // dispatch User event
        event(new OrderShipped($user));
    }
}
