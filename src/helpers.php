<?php

if (!function_exists('watchdog')) {

    /**
     * This is a helper function to add watchdog entry to any event
     * that occurs in the application.
     *
     * @param  string $message
     * @param  string $level
     * @param null $variable
     * @internal param array $variables
     */
    function watchdog($type, $message, $level = 1, $variable = null)
    {
        $user = Auth::user();
        $watchdog = new davidlazarte\Watchdog\Watchdog;
        $watchdog->message = $message;
        $watchdog->watchdog_level_id = $level;
        $watchdog->variable = ($variable) ? serialize($variable) : '';
        
        if (user)
            $watchdog->use_id = $user->id;
        
        $watchdog->incident_time = Carbon\Carbon::now();
        $watchdog->ip_address = \Request::getClientIp();
        $watchdog->save();
    }
}
