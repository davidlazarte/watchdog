<?php

namespace Amitav\Watchdog\Http;

use Amitav\Watchdog\Watchdog;
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
//        watchdog('Adding new entry for variable', 'warning', Watchdog::find(1));
        $watchdogEntries = DB::table('watchdog')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('watchdog::watchdog-listing')
            ->with('watchdogEntries', $watchdogEntries)
            ->with('template', $this->template);
    }

    /**
     * This page will show details of a single watchdog entry.
     * The variable will also be shown in a presentable way
     * if the variable is present for that entry.
     *
     * @param $id
     * @return $this
     */
    public function getWatchdogEntryDetails($id)
    {
        // validate the id is valid
        if (!$entry = Watchdog::find($id)) {
            abort(500, 'An entry with this id is not found.');
        }

        return view('watchdog::watchdog-entry')
            ->with('entry', $entry)
            ->with('template', $this->template);
    }
}
