<?php

namespace Amitav\Watchdog;

use Illuminate\Database\Eloquent\Model;

class Watchdog extends Model
{

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
     * Set that there are no default timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
