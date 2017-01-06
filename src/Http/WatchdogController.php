<?php

namespace davidlazarte\Watchdog\Http;

use davidlazarte\Watchdog\Watchdog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

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
        // this entire set of urls should be auth based.
        $this->middleware('auth');

        // setting up the master template if configure
        // or else it will be blank.
        if (Config::get('watchdog.master_template') != "") {
            $this->template = Config::get('watchdog.master_template');
        } else {
            $this->template = 'watchdog::watchdog-master';
        }
    }

    /**
     * This page will show the listing of all the watchdog entries
     * currently present in the database.
     *
     * @param Request $request
     * @return view
     */
    public function getWatchdogListing(Request $request)
    {
        // checking if filter is applied and it's value
        $args = [];
        if ($request->input('level')) {
            $args['level'] = $request->input('level');
        }

        // fetch the listing data from the model
        $watchdog = new Watchdog;

        if (!$watchdogEntries = $watchdog->getWatchdogEntries($args)) {
            $watchdogEntries = null;
        }

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

    /**
     * This is the url where I am clearing the log messages
     * when someone will click on the Clear log messages
     * button on the listing page.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearWatchdogEntries(Request $request)
    {
        $watchdog = new Watchdog;

        if (!$watchdog->clearLogMessages()) {
            abort(500, 'The log messages were not cleared.');
        }

        return redirect()->back();
    }

    public function getFilteredResult(Request $request)
    {
        if (!$request->input('level')) {
            return redirect()->back();
        }

        $string = http_build_query([
            'level' => $request->input('level'),
        ]);

        return redirect('watchdog/list?' . $string);
    }
}
