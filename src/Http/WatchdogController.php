<?php

namespace Amitav\Watchdog\Http;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class WatchdogController extends Controller
{
    /**
     * Template which will be used as master template.
     *
     * @var null
     */
    protected $template = null;

    public function __construct()
    {
        if (Config::get('watchdog.master_template') != "") {
            $this->template = Config::get('watchdog.master_template');
        }
    }

    /**
     * This page will show the listing of all the watchdog entries
     * currently present in the database.
     *
     * @return view
     */
    public function getWatchdogListing()
    {
        $watchdogEntries = DB::table('watchdog')->paginate(5);
//        dump($watchdogEntries);

        return view('watchdog::watchdog-listing')
            ->with('watchdogEntries', $watchdogEntries)
            ->with('template', $this->template);
    }
}
