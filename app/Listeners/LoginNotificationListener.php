<?php

namespace App\Listeners;

use App\Events\LoginNotificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginNotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LoginNotificationEvent  $event
     * @return void
     */
    public function handle(LoginNotificationEvent $event)
    {
        //
    }
}
