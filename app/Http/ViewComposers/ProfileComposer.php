<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use App\User;

class ProfileComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(User $users)
    {
        // Dependencies automatically resolved by service container...
        $this->users = $users;
        Log::info("__construct Dependencies automatically resolved by service container...");
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('count', $this->users->count()); // pass param to view
        Log::info("compose Dependencies automatically resolved by service container...");
    }
}
