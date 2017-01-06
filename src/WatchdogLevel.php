<?php

namespace davidlazarte\Watchdog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WatchdogLevel extends Model
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
    protected $table = 'watchdog_levels';
    /**
     * Database columns which the create method can fill.
     *
     * @var array
     */
    protected $fillable = ['level'];

}
