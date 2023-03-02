<?php

namespace App\Console;

use App\Models\Parameter;
use App\Mail\DailyNotificationEmail;
use Illuminate\Console\Scheduling\Schedule;
use App\Http\Controllers\NotificationController;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $notifs = Parameter::all();
        foreach($notifs as $notif){
            if ($notif->name == 'vidange'){
                $vidanges = NotificationController::vidangeNotif();
                if(count($vidanges) > 0){
                    $schedule->email(new DailyNotificationEmail(['notification' => $vidanges, 'type'=>'vidange']))->dailyAt($notif->time);
                }

            }
            if ($notif->name == 'assurance'){
                $assurences = NotificationController::assuranceNotif();
                if(count($assurences) > 0){
                    $schedule->email(new DailyNotificationEmail(['notification' => $assurences, 'type'=>'vidange']))->dailyAt($notif->time);
                }
            }
            if ($notif->name == 'visite'){
                $visites = NotificationController::visiteNotif();
                if(count($visites) > 0){
                    $schedule->email(new DailyNotificationEmail(['notification' => $visites, 'type'=>'vidange']))->dailyAt($notif->time);
                }
            }
            if ($notif->name == 'piece') {
                $pieces = NotificationController::pieceNotif();
                if(count($pieces) > 0){
                    $schedule->email(new DailyNotificationEmail(['notification' => $pieces, 'type'=>'piece']))->dailyAt($notif->time);
                }
            }
            if ($notif->name == 'mission') {
                
            }
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
