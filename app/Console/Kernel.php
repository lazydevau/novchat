<?php

namespace App\Console;

use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            // get current time
            $now = Carbon::now();

            // check if it's a new hour
            if ($now->isStartOfHour()) {
                // send hourly notifications to freemium users
                $freemiumUsers = User::role('freemium')->get();
                foreach ($freemiumUsers as $user) {
                    $this->sendNotifications($user);
                }
            }

            // send notifications to paid, enterprise, and admin users every minute
            $paidUsers = User::role('paid')->get();
            $enterpriseUsers = User::role('enterprise')->get();
            $adminUsers = User::role('admin')->get();
            $users = $paidUsers->merge($enterpriseUsers)->merge($adminUsers);
            foreach ($users as $user) {
                $this->sendNotifications($user);
            }
        })->everyMinute();


    }
    protected function sendNotifications(User $user)
    {
        // get user's saved searches
        $savedSearches = $user->savedSearches;

        // loop through saved searches
        foreach ($savedSearches as $search) {
            // get relevant RSS feeds based on saved search
            $feeds = DB::table('rssfeeds')
                ->where('title', 'like', '%' . $search->keyword . '%')
                ->whereIn('category', $search->categories)
                ->where('pubDate', '>', $search->lastSent)
                ->get();

            // send notification if there are any matches
            if ($feeds->count() > 0) {
                Notification::send($user, new NewRssFeedsNotification($feeds));
                $search->update(['lastSent' => Carbon::now()]);
            }
        }
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
