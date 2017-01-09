<?php

if (!function_exists('watchdog')) {

    /**
     * This is a helper function to add watchdog entry to any event
     * that occurs in the application.
     *
     * @param  string $type
     * @param  string $message
     * @param  int $level
     * @param null $variables
     * @internal param array $variables
     */
    function watchdog($type, $message, $level = 7, $variables = null)
    {
        $user = Auth::user();
        $watchdog = new davidlazarte\Watchdog\Watchdog;
        $watchdog->type = $type;
        $watchdog->message = $message;
        $watchdog->watchdog_level_id = $level;
        $watchdog->variables = $variables;
        
        if ($user)
            $watchdog->user_id = $user->id;
        
        $watchdog->incident_time = Carbon\Carbon::now();
        $watchdog->ip_address = \Request::getClientIp();
        $watchdog->save();
    }
}
