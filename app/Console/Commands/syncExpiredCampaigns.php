<?php

namespace App\Console\Commands;

use App\Models\Voyager\Campaign;
use Illuminate\Console\Command;

class syncExpiredCampaigns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:expired-campaigns';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync expired campaigns';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $nextDay=date('Y-m-d', strtotime(date('Y-m-d'). ' +0 day'));
        dump($nextDay);
        Campaign::wheredate('end_date', '<', $nextDay)->where('campaign_status', '!=', 'completed')->update(['campaign_status' => 'completed']);
        dump('Succes');
    }
}
