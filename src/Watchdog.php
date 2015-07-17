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

    public function getWatchdogEntries()
    {
        $watchdogEntries = DB::table('watchdog')->paginate(5);

        return $watchdogEntries;
    }
}
