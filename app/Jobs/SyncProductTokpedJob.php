<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\IntegrationECommerceController;

class SyncProductTokpedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $ecommerce;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ecommerce)
    {
        $this->ecommerce=$ecommerce;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {                               
        $controller = (new IntegrationECommerceController);        
        $controller->sync($this->ecommerce);
    }
}
