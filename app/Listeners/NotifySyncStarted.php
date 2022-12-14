<?php

namespace App\Listeners;

use App\Events\SyncStarted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Broadcast;
use Ratchet\Server\EchoServer;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;

class NotifySyncStarted
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
     * @param  \App\Events\SyncStarted  $event
     * @return void
     */
    public function handle(SyncStarted $event)
    {
        dump("Sync Started by dump");
        echo "Sync Started";
    }
}
