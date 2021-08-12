<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckToken
{

    public function handle($request, Closure $next)
    {	
        // $user_id = '';
        // $agent_id = '';

        // if($request->get('user_id') != ''){
        //     $buruh_id = $request->get('buruh_id');  
        // }else if($request->get('agent_id') != ''){
        //     $agent_id = $request->get('agent_id');
        // }

        $token = $request->header('Authorization');
        if(empty($token)){
            return response()->json(['code' => 400, 'error' => 'Authorization Header is empty'], 400);
        }

        $split_token = explode(" ", $token);
        if(count($split_token) <> 2){
            return response()->json(['code' =>  400, 'error' => 'Invalid Authorization format'], 400);
        }

        if(trim($split_token[0]) <> 'Bearer'){
            return response()->json(['code' => 400, 'error' => 'Authorization header must be a Bearer'], 400);
        }

        $access_token = trim($split_token[1]);

        // dd($user_id);
        // $check = DB::table('ytk_buruh_user AS a')->join('ytk_agent_user AS b')->join('ytk_serikat_kerja AS c')->select('a.remember_token AS token_buruh', 'b.remember_token AS token_agent', 'c.remember_token AS token_seker')->where('a.remember_token', '=', $access_token)->orWhere('b.remember_token', '=', $access_token)->orWhere('c.remember_token', '=', $access_token)->first();

        if(!empty($request->get('user_id'))){
            $check = DB::table('00_customer')
            ->select('remember_token')
            ->where('remember_token', '=', $access_token)
            ->where('customer_id', '=', $request->get('user_id'))
            ->first();

            $check_agent = DB::table('98_user AS a')
            ->select('a.remember_token')
            ->leftJoin('00_organization as b', 'a.organization_id', '=', 'b.organization_id')
            ->where('b.organization_type_id', 2)
            ->where('a.remember_token', '=', $access_token)
            ->where('a.user_id', '=', $request->get('user_id'))
            ->first();
            // dd($check_agent);

            // if($check){
            //     dd("CUST");
            // }elseif($check_agent){
            //     dd("AGENT");
            // }else{
            //     dd("NOT FOUND");
            // }

            if(empty($check) && empty($check_agent)){
                return response()->json(['code' => 403, 'error' => 'Invalid Access Token or Invalid ID Credentials'], 403);
            }
        }else{
            return response()->json(['code' => 400, 'error' => 'ID Empty'], 400);
        }

        // return $next($request);    

        // if(!empty($request->user_id)){
        //     $check = DB::table('00_customer')
        //     ->select('remember_token')
        //     ->where('remember_token', '=', $access_token)
        //     ->where('customer_id', '=', $request->user_id)
        //     ->first();
            
        //     if(empty($check)){
        //         return response()->json(['code' => 403, 'error' => 'Invalid Access Token'], 403);
        //     }
        // }elseif(!empty($request->route('id'))){
        //     $check = DB::table('00_customer')->select('remember_token')->where('remember_token', '=', $access_token)->where('customer_id', '=', $request->route('id'))->first();
            
        //     if(empty($check)){
        //         return response()->json(['code' => 403, 'error' => 'Invalid Access Token'], 403);
        //     }
        // }else{
        //     return response()->json(['code' => 400, 'error' => 'Invalid ID Credentials'], 400);
        // }

        return $next($request);    
    }
}