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
    function watchdog($message, $level = 'info', $variable = null)
    {
        $watchdog = new Amitav\Watchdog\Watchdog;
        $watchdog->message = $message;
        $watchdog->level = $level;
        $watchdog->variable = ($variable) ? serialize($variable) : '';
        $watchdog->incident_time = Carbon\Carbon::now();
        $watchdog->ip_address = \Request::getClientIp();
        $watchdog->save();
    }
}
