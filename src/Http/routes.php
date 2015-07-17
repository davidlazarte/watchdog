<?php

Route::get('watchdog/list', 'Amitav\Watchdog\Http\WatchdogController@getWatchdogListing');
Route::get('watchdog/entry/{id}', 'Amitav\Watchdog\Http\WatchdogController@getWatchdogEntryDetails');
