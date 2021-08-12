<?php

namespace Modules\Cart\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $client = new Client();
        //get Notif
        try {
            $getNotif = $client->request('POST', config('app.url_api') . '/notification', [
                'headers' =>[
                    'Accept' => 'application/json'
                ],
                'form_params' => [
                    "is_agent" => Session::get('is_agent'),
                    "user_id" => Session::get('user_id'),
                    "sort_by" => "",
                    "date_from" => "",
                    "date_to" => ""
                ]
            ]);
            $result = json_decode($getNotif->getBody()->getContents(), true);
            if ($result['isSuccess'] == true) {
                $this->data['notif'] = (Object) $result['data'];
            } else {
                return back()->with('error', $result['message']);
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return back()->with('error', $e->getMessage());
        }

        //get address
        try {
            $getAddress = $client->request('GET', config('app.url_api') . '/profile/address/'.Session::get('user_id'), [
                'headers' => [
                    "Authorization" => "Bearer ".Session::get('token'),
                ],
                'form_params' => []
            ]);
            $result = json_decode($getAddress->getBody()->getContents(), true);
            if ($result['isSuccess'] == true) {
                $this->data['address'] = (Object) $result['data'];
            } else {
                return back()->with('error', $result['message']);
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return back()->with('error', $e->getMessage());
        }

        //get  
        try {
            $user_id = Session::get('user_id');
            if($user_id == NULL){
                $this->data['cart'] = (Object) Session::get('cart');
            }else{
                $getCart = $client->request('POST', config('app.url_api') . '/getCart', [
                    'headers' => [
                        //"Content-Type" => "application/json",
                        "Accept" => "application/json"
                    ],
                    'form_params' => [
                        "is_agent" => "0",
                        "user_id" => "9",
                    ]
                ]);
                $result = json_decode($getCart->getBody()->getContents(), true);
                if ($result['isSuccess'] == true) {
                    $this->data['cart'] = (Object) $result['data'];
                } else {
                    return back()->with('error', $result['message']);
                }
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return back()->with('error', $e->getMessage());
        }
        
        //get total chat
        try {
            $getHeader = $this->client->request('GET', config('app.url_api') . '/getTotalChatByUserId/'.Session::get('user_id'), [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => []
            ]);
            $result = json_decode($getHeader->getBody()->getContents(), true);
            if ($getHeader->getStatusCode() == 200) {
                if ($result['status'] == 200) {
                    $this->data['total_chat'] = $result['data'];
                    $this->data['error_total_chat'] = "";
                } else {
                    $this->data['total_chat'] = 0;
                    $this->data['error_total_chat'] = $result['messages'];
                }
            } else {
                $this->data['total_chat'] = 0;
                $this->data['error_total_chat'] = $getHeader->getStatusCode();
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->data['total_chat'] = 0;
            $this->data['error_total_chat'] = $e->getMessage();
        }

        return view('cart::index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('cart::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('cart::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('cart::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
