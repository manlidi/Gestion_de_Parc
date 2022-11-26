<?php

namespace App\Console\Commands;

use App\Http\Controllers\MissionController;
use Illuminate\Console\Command;

class MissionCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mission:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //MissionController::finishMission();
    }
}
