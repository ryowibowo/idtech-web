<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use App\Jobs\SyncProductTokpedJob;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\ConnectionException;

class IntegrationECommerceCommand extends Command
{
    public static $configScheduler;
    public static $ecommerceId;
    public static $TokpedConfig;
    public static $token;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'IntegrationECommerceCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        echo app('App\Http\Controllers\IntegrationECommerceController')->testSchedule(1,"\nDEBUG");
        //---------------check status schedule
        $this::$configScheduler = $this->getConfigScheduler();
        //----------------------------------status enable scheduler
        if($this::$configScheduler->global_parameter_value == "on"){    
        //--------------------------------set token integrator team        
            $getToken=$this->generateToken();                     
            $getAuth = explode(" ",$getToken['data']['token']);
            $this::$token = array_pop($getAuth);
            echo app('App\Http\Controllers\IntegrationECommerceController')->testSchedule(1,'schedule-start');
            $ecommerceList=config('global.ecommerce');
            //---------------looping ecommerce list
            for($i=0;$i<count($ecommerceList);$i++){            
                echo app('App\Http\Controllers\IntegrationECommerceController')->testSchedule(1,'start master product ecommerce: '.$ecommerceList[$i]);
                //--------------set ecommerce id variable
                $this::$ecommerceId=app('App\Http\Controllers\OrganizationController')->getOrganizationByName($ecommerceList[$i]);
                switch ($ecommerceList[$i]) {
                    case 'TOKOPEDIA':
                        $this::$TokpedConfig=$this->getConfigEcommerce('tokopedia');
                        break;
                    default:                        
                        break;
                }                
                //---------------check status sync master tokped
                if($this::$TokpedConfig->global_parameter_value=="on"){
                    //----------------------------------sync master product
                    app('App\Http\Controllers\IntegrationECommerceController')->sync($ecommerceList[$i]);      
                    // dispatch((new SyncProductTokpedJob($ecommerceList[$i])));
                    echo app('App\Http\Controllers\IntegrationECommerceController')->testSchedule(1,'end master product ecommerce: '.$ecommerceList[$i]);
                    DB::table('99_global_parameter')
                    ->where('global_parameter_name','tokopedia')
                    ->update(['global_parameter_value'=>'off']);
                }
                //----------------------------TOOLS generate product
                // $type=['parent','variant'];
                // for($x=0;$x<count($type);$x++){
                //     app('App\Http\Controllers\ToolsGenerateMasterProductController')->generate($type[$x]);
                // }                
                // //----------------------------------start sync order
                echo app('App\Http\Controllers\IntegrationECommerceController')->testSchedule(1,'start order ecommerce: '.$ecommerceList[$i]);
                app('App\Http\Controllers\IntegrationECommerceController')->syncOrder($ecommerceList[$i]);            
                echo app('App\Http\Controllers\IntegrationECommerceController')->testSchedule(1,'end order ecommerce: '.$ecommerceList[$i]);                
                //--------------------------------------sync single order status
                echo app('App\Http\Controllers\IntegrationECommerceController')->testSchedule(1,'check single order ecommerce: '.$ecommerceList[$i]);
                app('App\Http\Controllers\IntegrationECommerceController')->singleOrderTokpedSync();
                echo app('App\Http\Controllers\IntegrationECommerceController')->testSchedule(1,'check single order ecommerce DONE: '.$ecommerceList[$i]);
            }
        }                
    }
    public function getConfigScheduler(){
        return $this->getGlobalParameter('schedule_config');
    }
    public function getConfigEcommerce($ecommerce){
        $status = DB::table('99_global_parameter')
        ->select('global_parameter_value','global_parameter_desc','global_parameter_code')
        ->where('global_parameter_name','=',$ecommerce)
        ->first();
        return $status;
    }
    public function generateToken(){
        $credential=$this->getCredentialToken();
        $url=config('global.integrator_url_token').'/authenticate?username='.$credential->global_parameter_value.'&password='.$credential->global_parameter_code;
        try {
            $client= new Client();            
            $req = $client->request('GET', $url, [
                'headers' =>
                [
                ],
                'form_params' => [
                ]
                    ]
            );
            $response = json_decode($req->getBody()->getContents(), true);
            return $response;            
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {            
            $timeout =array(
                'data'=>null
            );              
            echo app('App\Http\Controllers\IntegrationECommerceController')->testSchedule(1,"\n".'| catch error api get token'.' |');            
            return $timeout;
        }
    }
    public function getCredentialToken(){
        return $this->getGlobalParameter('user_token_integrator');
    }
    public function getGlobalParameter($param){
        return DB::table('99_global_parameter')
        ->select('global_parameter_value','global_parameter_desc','global_parameter_code')
        ->where('global_parameter_name','=',$param)
        ->first();
    }
}
