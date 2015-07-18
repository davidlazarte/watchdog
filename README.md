#Watchdog for Laravel 5

This module will help you log messages and different events in your application and store them in the DB to check them later. The functionality is very similar to the **Watchdog** functionality of Drupal.
 
To register this package with Laravel you need to add this line your provider's array:

    'Amitav\Watchdog\WatchdogServiceProvider'
    
This package has configuration files and migration files, so once the service provider is registered with your application, you need to run the following console command to publish the vendor files:

    php artisan vendor:publish
    
When done correctly, it will publish one config file "watchdog.php" inside config folder. And a migration file inside database/migrations folder.

