<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Passenger;
use App\Mail\NotificationMail;
use Mail;

class EmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email cron for sending notifications.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now('Europe/Berlin')->addDays(2)->format('d-m-y');
        $date1 = Carbon::createFromFormat('d-m-y', $today)->startOfDay();
        $outboundNotifications = Passenger::whereNot(function ($query) {
            $query->where('travel_date', null);
        })->get();

        foreach($outboundNotifications as $notification) {
            $travelDate = Carbon::parse($notification->travel_date)->format('d-m-y');
            $date2 = Carbon::createFromFormat('d-m-y', $travelDate)->startOfDay();
        
            if($date1->eq($date2)) {
                $title = 'Notification | '. $notification->fullName();
                $firstName = $notification->first_name;
                $lastName = $notification->last_name;
                $flight = $notification->flights()->where('direction', 'outbound')->first();
                $message = $notification->notification;

                Mail::to(['tarik@fibula.ba', 'omar@fibula.ba'])->send(new NotificationMail($title, $firstName, $lastName, $travelDate, $flight, $message));
            }
        }

        $inboundNotifications = Passenger::whereNot(function ($query) {
            $query->where('return_date', null);
        })->get();

        foreach ($inboundNotifications as $notification) {
            $returnDate = Carbon::parse($notification->return_date)->format('d-m-y');
            $date2 = Carbon::createFromFormat('d-m-y', $returnDate)->startOfDay();

            if($date1->eq($date2)) {
                $title = 'Notification | '. $notification->fullName();
                $firstName = $notification->first_name;
                $lastName = $notification->last_name;
                $flight = $notification->flights()->where('direction', 'inbound')->first();
                $message = $notification->notification;

                Mail::to(['tarik@fibula.ba', 'omar@fibula.ba'])->send(new NotificationMail($title, $firstName, $lastName, $returnDate, $flight, $message));
            }
        }

        return Command::SUCCESS;
    }
}
