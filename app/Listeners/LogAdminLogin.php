<?php

namespace App\Listeners;

use App\Events\AdminLoggedIn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;

class LogAdminLogin
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
     * @param  \App\Events\AdminLoggedIn  $event
     * @return void
     */
    public function handle(AdminLoggedIn $event)
    {
        try {
            $adminId = $event->admin->admin_id;
            $logMessage = "Admin '{$adminId}' logged in.";
            Log::info($logMessage);
        }
        catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
