<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    public $tries = 3;
    public $timeout = 60; // 60s

    /**
     * SendWelcomeEmail constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo 'Start send email';
        $email = new WelcomeEmail($this->user);
        Mail::to($this->user->email)->later(Carbon::now()->addMinutes(5), $email);
        echo 'End send email';
    }
}
