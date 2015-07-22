<?php
/**
 * Created by PhpStorm.
 * User: amitav
 * Date: 7/22/15
 * Time: 10:37 AM
 */

namespace Amitav\Watchdog;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class WatchdogCleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'watchdog:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up the old watchdog entries. The max number will be taken from the config file';

    /**
     * The maximum entries the table should have. Reaching this limit,
     * old entries will be deleted.
     *
     * @var int
     */
    protected $limit;

    /**
     * Get the count of watchdog entries.
     * @var int
     */
    protected $count;

    /**
     * Setting up some of the values required for the command.
     */
    public function __construct()
    {
        $this->limit = config('watchdog.log_limit');
    }

    /**
     * Execute the command.
     */
    public function handle()
    {
        if ($this->checkIfDeletionRequired()) {
            $this->deleteExtraEntires();
        }
    }

    /**
     * Check if there is a requirement to delete any watchdog entries.
     *
     * @return bool
     */
    private function checkIfDeletionRequired()
    {
        $this->count = DB::table('watchdog')->count();

        if ($this->count > $this->limit) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function will delete the extra watchdog entries
     * based on the count of the current watchdog table.
     */
    private function deleteExtraEntires()
    {
        $take = $this->count - $this->limit;
        $this->comment($take);

        $data = DB::table('watchdog')
            ->orderBy('id', 'asc')
            ->take($take)
            ->get();

        $ids = [];

        foreach ($data as $entry) {
            $ids[] = $entry->id;
        }

        DB::table('watchdog')->whereIn('id', $ids)->delete();
    }
}