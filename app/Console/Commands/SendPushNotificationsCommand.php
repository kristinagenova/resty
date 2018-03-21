<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SendNotificationService;

class SendPushNotificationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends notifications to users using OneSignal';

    /**
     * Notification service
     *
     * @var SendNotificationService
     */
    protected $notificationService;

    /**
     * Create a new command instance.
     *
     * @return void
     *
     */
    public function __construct(SendNotificationService $notificationService)
    {
        parent::__construct();
        $this->notificationService = $notificationService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->notificationService->SendNotification();
    }
}
