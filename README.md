#Watchdog for Laravel 5

This module will help you log messages and different events in your application and store them in the DB to check them later. The functionality is very similar to the **Watchdog** functionality of Drupal.
 
To register this package with Laravel you need to add this line your provider's array:

    'Amitav\Watchdog\WatchdogServiceProvider'
    
This package has configuration files and migration files, so once the service provider is registered with your application, you need to run the following console command to publish the vendor files:

    php artisan vendor:publish
    
It will publish one config file "watchdog.php" inside config folder. And a migration file inside database/migrations folder.

There is also a Command which will clean up extra entries of the watchdog. The config file has a limit which is by default set to 1000. So every time the command will check if the count of watchdog. If it is more than the limit, it will remove the old entries.

To get this to working, add the following line inside the commands array. The final should look something like this:

    protected $commands = [
      \App\Console\Commands\Inspire::class,
      \Amitav\Watchdog\WatchdogCleanup::class,
    ];
    
Once this is done, inside the schedule function you need to add the entry of the command and also the frequency of execution. For example, to run it every hour, the entry will be something like:

    $schedule->command('watchdog:cleanup')->hourly();
    
