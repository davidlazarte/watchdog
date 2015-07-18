#Watchdog for Laravel 5

This is a developer's module which can be primarily used to record events which are happening throughout the application.

I like the Drupal's watchdog module a lot. It helps administrators and developers to get valuable information on what's happening through the application and if required they can log different activities. 

This module will help do the same. Although it will not do anything out of the box when installed, but using the helper function **watchdog** a developer can insert events to the database and then view them on the listing page. The details page also has the functionality to display the variable during the event. So if a content was added to the application, the entire Eloquent model can be passed to the function. Watchdog will save it in DB as serialized object. And when the entry is viewed, you will be presented with the object in a human readable format using **krumo** library. 