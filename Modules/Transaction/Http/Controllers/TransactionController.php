<?php

namespace Modules\Transaction\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use App\Helpers\ApiClient;

class TransactionController extends Controller {

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index() {
        return view('transaction::index');
    }

    public function shipping() {
        $api = new ApiCLient();

        $api->getNotification();
        $api->getHeader();
        $api->getAddress();
        $api->getCart();
        $api->getTotalChat();

        return view('transaction::shipping', $api->data);
    }

    public function addAddress(Request $request) {
        $api = new ApiCLient();

        return $api->getAddress($request);
    }

    public function checkout(Request $request) {
        $api = new ApiCLient();

        $api->getNotification();
        $api->getHeader();
        $api->getProfile();
        $api->getAddressById($request);
        $api->getCart();
        $api->getShipmentMethod();
        $api->getVoucher($request);
        $api->getPaymentMethod();
        $api->getAsuransi();
        $api->getTotalChat();
        $api->getListJne($api->data['zip_code'], $api->data['weight']);
        $api->getListAnterAja($api->data['zip_code'], $api->data['weight']);
        $api->courierMerge($api->data['jne'], $api->data['anterAja']);
        // $api->getTarifCodeDest($api->data['zip_code']);
        // dd($api->data);
        return view('transaction::checkout', $api->data);
    }

    public function order(Request $request) {
        $api = new ApiCLient();
//        $zip_code_dest = $request->zip_code_dest;
//        $weight = $request->weight;
//        $qty = $request->qty;
//        $data = array(
//            "url" => config('app.url_api') . '/orderViaJne',
//            "Authorization" => "Bearer " . Session::get('token'),
//            "user_id" => Session::get('user_id'),
//            "payment_method_id" => $request->payment_id,
//            "data" => array([
//                    "warehouse_id" => $request->warehouse_id,
//                    "shipment_method_id" => $request->shipment_method_id,
//                    "shipment_price" => $request->shipment_method_price
//                ]),
//            "address_id" => $request->address_id,
//            "voucher_id" => $request->voucher_id,
//            "asuransi" => $request->asuransi,
//            "is_agent" => Session::get('is_agent'),
//            "cashback" => false,
//            "use_balance" => $request->use_balance,
//            "zip_code_dest" => $zip_code_dest,
//            "weight" => $weight,
//            "qty" => $qty,
//            "shipment_method_name" => $request->shipment_method_name
//        );
////        dd(json_encode($data));
//        dd('maintenance');

        return $api->order($request);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create() {
        return view('transaction::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request) {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id) {
        return view('transaction::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id) {
        return view('transaction::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id) {
        //
    }

}
