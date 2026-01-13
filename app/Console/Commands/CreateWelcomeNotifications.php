<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Console\Command;

class CreateWelcomeNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:welcome';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create welcome notifications for all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        
        foreach ($users as $user) {
            // Check if user already has a welcome notification
            if (!$user->notifications()->where('type', 'welcome')->exists()) {
                NotificationService::createWelcomeNotification($user);
            }
        }
        
        $this->info('Welcome notifications created for all users!');
    }
}
