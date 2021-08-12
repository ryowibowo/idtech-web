<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\IntegrationTokopediaController;

class IntegrationTokped extends Command
{
    public static $debugMode;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'IntegrationTokped';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'scan data api tokopedia';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {        
        //echo ('now:'.date(now()).' 5 menit yang lalu:'.date(now()->subMinute(5) ) );
        $statusScan =app('App\Http\Controllers\IntegrationTokopediaController')->getStatusScanTokopedia();        
        $this::$debugMode = $statusScan->global_parameter_desc;                
        if($statusScan->global_parameter_value == "on"){
            $tes =app('App\Http\Controllers\IntegrationTokopediaController')->testSchedule(1,'schedule-start');            
            $productList =app('App\Http\Controllers\IntegrationTokopediaController')->sync();            
        }                
    }
}
