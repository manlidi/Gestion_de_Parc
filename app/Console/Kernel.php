<?php

namespace App\Console;

use App\Models\Parameter;
use App\Mail\DailyNotificationEmail;
use Illuminate\Console\Scheduling\Schedule;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $notifs = Parameter::all();
        foreach($notifs as $notif){
            if ($notif->name == 'vidange'){
                $vidanges = NotificationController::vidangeNotif();
                if(count($vidanges) > 0){
                    $schedule->call(function() use ($vidanges) {
                        Mail::to('votre-email@gmail.com')->send(new DailyNotificationEmail(['notification' => $vidanges, 'type'=>'vidange']));
                    })->dailyAt($notif->time);
                }
            }
            if ($notif->name == 'assurance'){
                $assurences = NotificationController::assuranceNotif();
                if(count($assurences) > 0){
                    $schedule->call(function() use ($assurences) {
                        Mail::to('votre-email@gmail.com')->send(new DailyNotificationEmail(['notification' => $assurences, 'type'=>'assurance']));
                    })->dailyAt($notif->time);
                }
            }
            if ($notif->name == 'visite'){
                $visites = NotificationController::visiteNotif();
                if(count($visites) > 0){
                    $schedule->call(function() use ($visites) {
                        Mail::to('votre-email@gmail.com')->send(new DailyNotificationEmail(['notification' => $visites, 'type'=>'visite']));
                    })->dailyAt($notif->time);
                }
            }
            if ($notif->name == 'piece') {
                $pieces = NotificationController::pieceNotif();
                if(count($pieces) > 0){
                    $schedule->call(function() use ($pieces) {
                        Mail::to('votre-email@gmail.com')->send(new DailyNotificationEmail(['notification' => $pieces, 'type'=>'piece']));
                    })->dailyAt($notif->time);
                }
            }
            if ($notif->name == 'demande') {
                $demandes = NotificationController::rendreVehicule();
                if(count($demandes) > 0){
                    $schedule->call(function() use ($demandes) {
                        Mail::to('votre-email@gmail.com')->send(new DailyNotificationEmail(['notification' => $demandes, 'type'=>'demande']));
                    })->dailyAt($notif->time);
                }
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
