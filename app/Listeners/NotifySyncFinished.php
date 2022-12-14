<?php

namespace App\Listeners;

use App\Events\SyncFinished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifySyncFinished
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
     * @param  \App\Events\SyncFinished  $event
     * @return void
     */
    public function handle(SyncFinished $event)
    {
        dump("Sync Finished by dump");
        echo "Sync Finished";
    }
}
