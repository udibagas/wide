<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\VoucherGeneratedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class VoucherGeneratedListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $comment = $event->comment;
        $user = User::first();
        $user->notify(new VoucherGeneratedNotification());
    }
}
