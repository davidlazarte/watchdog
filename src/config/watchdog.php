<?php

return [

    /**
     * The number of log entries to keep
     * in the watchdog table before the
     * cron deletes the old entries.
     */
    'log_limit' => 1000,

    /**
     * This configuration will extend
     * the master template if mentioned
     * or else it will just keep the
     * section as content.
     */
    'master_template' => '',

    /*
     * This configuration will extend
     * the user model
    */
    'user' => 'App\User',

];
