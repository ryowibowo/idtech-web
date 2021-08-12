<?php

namespace Modules\Checkout\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Alert;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        // $address_id = $request->id_address;
        // dd($address_id);
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
            $getAddress = $client->request('GET', config('app.url_api') . '/profile/detailAddress/'.$request->address_id, [
                'headers' => [
                    "Authorization" => "Bearer ".Session::get('token'),
                ],
                'form_params' => []
            ]);
            $result = json_decode($getAddress->getBody()->getContents(), true);
            if ($result['isSuccess'] == true) {
                $this->data['address'] = (Object) $result['data'];
                $this->data['address_id'] = $request->address_id;
                //dd($this->data['address'] );
            } else {
                return back()->with('error', $result['message']);
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            //dd($e->getMessage());
            return back()->with('error', $e->getMessage());
        }

        //get cart
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
                        "is_agent" => Session::get('is_agent'),
                        "user_id" => Session::get('user_id')
                    ]
                ]);
                $result = json_decode($getCart->getBody()->getContents(), true);
                if ($result['isSuccess'] == true) {
                    $this->data['cart'] = (Object) $result['data'];
                    $qty = 0;
                    $total = 0;
                    $berat = 0;
                    foreach($result['data'] as $cart){
                        $total += $cart['warehouse_subtotal'];
                        foreach($cart['cart'] as $data_cart){
                            $qty += $data_cart['qty'];
                            $berat += $data_cart['product_pack_uom_value'];
                        }
                    }
                    $this->data['total_cart'] = $qty;
                    $this->data['total'] = $total;
                    $this->data['weight'] = $berat;
                } else {
                    return back()->with('error', $result['message']);
                }
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return back()->with('error', $e->getMessage());
        }

        //get shipment method
        try {
            $get = $client->request('GET', config('app.url_api') . '/shipmentMethod', [
                'headers' => [],
                'form_params' => []
            ]);
            $result = json_decode($get->getBody()->getContents(), true);
            if ($result['isSuccess'] == true) {
                $this->data['shipment'] = (Object) $result['data'];
            } else {
                return back()->with('error', $result['message']);
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return back()->with('error', $e->getMessage());
        }

        //get voucher
        try {
            $get = $client->request('POST', config('app.url_api') . '/voucher', [
                'headers' => [
                    "Authorization" => "Bearer ".Session::get('token')
                ],
                'form_params' => [
                    "user_id" => Session::get('user_id'),
                    "voucher_code" => "",
                    "subtotal" => "100000"
                ]
            ]);
            $result = json_decode($get->getBody()->getContents(), true);
            if ($result['isSuccess'] == true) {
                $this->data['voucher'] = (Object) $result['data'];
            } else {
                return back()->with('error', $result['message']);
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return back()->with('error', $e->getMessage());
        }

        //get payment method
        try {
            $get = $client->request('GET', config('app.url_api') . '/paymentMethod', [
                'headers' => [],
                'form_params' => []
            ]);
            $result = json_decode($get->getBody()->getContents(), true);
            if ($result['isSuccess'] == true) {
                $this->data['payment'] = (Object) $result['data'];
            } else {
                return back()->with('error', $result['message']);
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

        return view('checkout::index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('checkout::create');
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
        return view('checkout::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('checkout::edit');
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


    public function order(Request $request) {
        $client = new Client();
        try {
            $submit = $client->request('POST', config('app.url_api') . '/order', [
                'headers' => [
                    "Accept" => "application/json",
                    "Authorization" => "Bearer ".Session::get('token')
                ],
                'form_params' => [
                    "user_id" => Session::get('user_id'),
                    "payment_method_id" => $request->payment_id,
                    "data" => array([
                            "warehouse_id" => 1,
                            "shipment_method_id" => $request->shipment_method_id,
                            "shipment_price" => $request->shipment_method_price
                        ]),
                    "address_id" => $request->address_id,
                    "voucher_id" => $request->voucher_id,
                    "is_agent" => Session::get('is_agent'),
                    "cashback" => false
                ]
            ]);
            $result = json_decode($submit->getBody()->getContents(), true);
            if ($result['isSuccess'] == true) {
                $data = array(
                    'code' => 200,
                    'message' => $result['message']
                );
                 Alert::success('Success', "Transaksi berhasil diproses");
                 return redirect()->to('profile/history');
                 //return redirect()->route('profile/transaksi');
            } else {
                $data = array(
                    'code' => 400,
                    'message' => $result['message']
                );
                Alert::error('Error', "Transaksi gagal diproses");
                return back()->with('error', $result['message']);
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $data = array(
                'code' => 400,
                'message' => $e->getMessage()
            );
            Alert::error('Error', "Transaksi gagal diproses");
            return back()->with('error', $data['message']);
        }
    }
}
