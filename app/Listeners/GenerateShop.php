<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateShop
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {           
        //echo "\nstart listener shop";          
        if($event->shop!=null){                        
            for($i=0;$i<count($event->shop);$i++){//-------------------------------------check data shop -> organization                
                $organization=app('App\Http\Controllers\OrganizationController')->checkOrganizationEcommerce($event->shop[$i]['shopId'],"TOKPED-STORE");                
                if($organization==null&&$event->shop[$i]['shopId']==9238281){//---------------------------------------------jika data belum ada
                    //---------------------------------------------insert shop ke warehouse
                    $orgSchema = array(
                        'organization_code'=>$event->shop[$i]['shopId'],
                        'organization_name'=>$event->shop[$i]['shopName'],
                        'organization_desc'=>'TOKPED-STORE',
                        'organization_type_id'=>6                        
                    );                    
                    app('App\Http\Controllers\OrganizationController')->addOrganization($orgSchema);
                }
            }
        }else{//jika timeout
            echo app('App\Http\Controllers\IntegrationTokopediaController')->testSchedule(3,"\nshop sudah terdaftar");            
        }        
    }
}
