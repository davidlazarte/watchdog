<?php

namespace Amitav\Watchdog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Watchdog extends Model
{

    /**
     * Set that there are no default timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
    /**
     * Database table the model will use.
     *
     * @var string
     */
    protected $table = 'watchdog';
    /**
     * Database columns which the create method can fill.
     *
     * @var array
     */
    protected $fillable = ['message', 'info', 'variable', 'incident_time'];

    /**
     * This function will return the list of watchdog entries from the DB
     *
     * @return mixed
     */
    public function getWatchdogEntries()
    {
        $watchdogEntries = DB::table('watchdog')
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($watchdogEntries->count() > 0) {
            return $watchdogEntries;
        }
    }

    /**
     * Empty the watchdog table.
     */
    public function clearLogMessages()
    {
        DB::table('watchdog')->truncate();

        return true;
    }
}
