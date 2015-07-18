<?php

Route::get('watchdog/list', 'Amitav\Watchdog\Http\WatchdogController@getWatchdogListing');
Route::get('watchdog/entry/{id}', 'Amitav\Watchdog\Http\WatchdogController@getWatchdogEntryDetails');
Route::post('watchdog/clear-log', 'Amitav\Watchdog\Http\WatchdogController@clearWatchdogEntries');
Route::post('watchdog/filter', 'Amitav\Watchdog\Http\WatchdogController@getFilteredResult');
