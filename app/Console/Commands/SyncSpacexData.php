<?php

namespace App\Console\Commands;

use App\Events\SyncStarted;
use App\Events\SyncFinished;
use App\Listeners\NotifySyncFinished;
use App\Models\tbl01;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use Pusher\Pusher;

class SyncSpacexData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spacex:syncData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync the data from the link with database with 3 minute periods';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Burada aynı kapsül adı ve seri numarasıyla ikinci bir data olamayacağını umdum.
        // Table ı kendim oluşturdum migrate yapmamız lazım
        $link = "https://api.spacexdata.com/v3/capsules";
        $pusher = new Pusher("03af2c540f7cf5eae906", "4cbcaf77a7a0e515f808", "1524899", array('cluster' => 'eu'));

        $data = json_decode(file_get_contents($link));

        event(new SyncStarted());
        $pusher->trigger('my-channel', 'my-event', array('message' => 'Sync Başladı -> '.Carbon::now()));

        foreach ($data as $item){
            tbl01::query()->firstOrCreate([
                "capsule_serial"         => $item->capsule_serial,
                "capsule_id"             => $item->capsule_id,
            ],[
                "status"                 => $item->status,
                "original_launch"        => Carbon::parse($item->original_launch),
                "original_launch_unix"   => $item->original_launch_unix,
                "missions"               => json_encode($item->missions),
                "landings"               => $item->landings,
                "type"                   => $item->type,
                "details"                => $item->details,
                "reuse_count"            => $item->reuse_count
            ]);
        }

        event(new SyncFinished("Mesaj Bitti"));
        $pusher->trigger('my-channel', 'my-event', array('message' => 'Sync Bitti  -> '.Carbon::now()));
        Log::channel('sync-finished')->info("Sync Bitti -> ".Carbon::now() . " Received json => " . json_encode($data));

        return Command::SUCCESS;
    }
}
