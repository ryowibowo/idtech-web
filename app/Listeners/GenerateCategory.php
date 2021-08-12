<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateCategory
{
    protected $organizationId;
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        echo app('App\Http\Controllers\IntegrationTokopediaController')->testSchedule(1,'category listener start');        
        $this->organizationId=app('App\Http\Controllers\OrganizationController')->getOrganizationByName('TOKOPEDIA');
        echo app('App\Http\Controllers\IntegrationTokopediaController')->testSchedule(1,'set organizationId: '.$this->organizationId);        
        // dd(count($event->category['data']['categories']));      
        if($event->category!=null){  
            $this->scanCategory($event->category['data']['categories']);
        }        
    }
    public function scanCategory($data){
        echo app('App\Http\Controllers\IntegrationTokopediaController')->testSchedule(1,'scan category start');        
        for($i=0;$i<count($data);$i++){//--------------------check data categories
            $category =app('App\Http\Controllers\CategoryPerEcommerceController')->checkCategory($data[$i]['id'],$this->organizationId);
            if($category==null){//---------------------------------------------jika data belum ada
                //---------------------------------------------get schema
                $categorySchema = $this->getSchema($data[$i]['name'],null,1);                
                //----------------------------insert & get id dari tabel category
                $IdCategory=app('App\Http\Controllers\CategoryController')->addCategory($categorySchema);
                //----------------------------insert & ke tabel category ecommerce
                echo app('App\Http\Controllers\IntegrationTokopediaController')->testSchedule(1,'add to category ecommerce: '.$IdCategory);        
                $categoryEcommerceSchema=$this->getSchemaEcommerce($IdCategory,$data[$i]['id'],$data[$i]['name']);                
                app('App\Http\Controllers\CategoryPerEcommerceController')->addCategory($categoryEcommerceSchema);
                //-------------------------------check apakah punya child -- category level 2
                if($data[$i]['child']!=null){
                    //--------------------check data categories level 2
                    $this->compareCategoryLvl2($data[$i]['child'],$IdCategory);
                }                                    
            }
        }
    }
    public function compareCategoryLvl2($dataChild,$parent){
        echo app('App\Http\Controllers\IntegrationTokopediaController')->testSchedule(1,'category level 2 start');        
        for($x=0;$x<count($dataChild);$x++){
            $category =app('App\Http\Controllers\CategoryPerEcommerceController')->checkCategory($dataChild[$x]['id'],$this->organizationId);
            //jika category level 2 belum ada
            if($category==null){
                $categorySchema = $this->getSchema($dataChild[$x]['name'],$parent,2);
                //----------------------------insert & get id dari tabel category
                $IdCategory=app('App\Http\Controllers\CategoryController')->addCategory($categorySchema);
                //----------------------------insert & ke tabel category ecommerce                
                $categoryEcommerceSchema=$this->getSchemaEcommerce($IdCategory,$dataChild[$x]['id'],$dataChild[$x]['name']);                
                app('App\Http\Controllers\CategoryPerEcommerceController')->addCategory($categoryEcommerceSchema);                
                //-------------------------------check apakah punya child -- category level 3
                if($dataChild[$x]['child']!=null){
                    //---------------------------check data categories level 3
                    $this->compareCategoryLvl3($dataChild[$x]['child'],$IdCategory);
                }
            }
        }
    }
    public function compareCategoryLvl3($dataChild,$parent){
        echo app('App\Http\Controllers\IntegrationTokopediaController')->testSchedule(1,'category level 3 start');        
        for($y=0;$y<count($dataChild);$y++){
            $category =app('App\Http\Controllers\CategoryPerEcommerceController')->checkCategory($dataChild[$y]['id'],$this->organizationId);
            //jika category level 3 belum ada
            if($category==null){
                $categorySchema = $this->getSchema($dataChild[$y]['name'],$parent,3);
                //----------------------------insert & get id dari tabel category
                $IdCategory=app('App\Http\Controllers\CategoryController')->addCategory($categorySchema);
                //----------------------------insert & ke tabel category ecommerce
                $categoryEcommerceSchema=$this->getSchemaEcommerce($IdCategory,$dataChild[$y]['id'],$dataChild[$y]['name']);                
                app('App\Http\Controllers\CategoryPerEcommerceController')->addCategory($categoryEcommerceSchema);
            }
        }
    }
    public function getSchema($name,$parent,$level){
        return $schema = array(            
            'category_name'=>$name,
            'parent_category_id'=>$parent,
            'category_level'=>$level
        );        
    }
    public function getSchemaEcommerce($categoriId,$categoryEcommerceId,$categoryEcommerceName){
        return $schema = array(            
            'organization_id'=>$this->organizationId,
            'category_id'=>$categoriId,
            'category_id_ecommerce'=>$categoryEcommerceId,
            'category_name'=>$categoryEcommerceName,            
        );        
    }
}
