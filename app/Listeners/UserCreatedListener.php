<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Notifications\UserCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UserCreatedListener implements ShouldQueue
{
    use InteractsWithQueue;
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
     * @param  object  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        // Save user creation event data in the log file
        Log::info('User created', ['user' => $event->user->toArray()]);

        //send notification to the "notification" service
        $event->user->notify(new UserCreatedNotification($event->user));
    }
}
