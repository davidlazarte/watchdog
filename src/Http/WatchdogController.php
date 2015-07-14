<?php

namespace Amitav\Watchdog\Http;

use Amitav\Watchdog\Watchdog;
use App\Http\Controllers\Controller;

class WatchdogController extends Controller
{
    /**
     * This page will show the listing of all the watchdog entries
     * currently present in the database.
     *
     * @return view
     */
    public function getWatchdogListing()
    {
        return view('watchdog::watchdog-listing');
    }
}
