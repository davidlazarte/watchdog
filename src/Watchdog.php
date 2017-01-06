<?php

namespace davidlazarte\Watchdog;

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
    protected $fillable = ['type', 'message', 'info', 'variables', 'incident_time'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'variables' => 'object',
    ];


    /**
     * User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function user()
    {
        return $this->belongsTo(Config::get('watchdog.user'));
    }

    /**
     * This function will return the list of watchdog entries from the DB
     *
     * @param $args
     * @return mixed
     */
    public function getWatchdogEntries($args)
    {
        $query = DB::table('watchdog');

        // checking if there are arguments present
        // to add conditions to the query
        if (!empty($args)) {
            foreach ($args as $key => $value) {
                $query->where($key, $value);
            }
        }

        $watchdogEntries = $query->orderBy('id', 'desc')
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
