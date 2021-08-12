<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use App\Helpers\ApiClient;
use Lang;
use Barryvdh\DomPDF\Facade as PDF;

class ProfileController extends Controller {

    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (Session::get('user_id') == NULL) {
                return redirect('beranda');
            } else {
                return $next($request);
            }
        });
    }
    
    public function index() {
        $api = new ApiCLient();

        $api->getNotification();
        $api->getHeader();
        $api->getProfile();
        $api->getTotalChat();

        return view('profile::index', $api->data);
    }

    public function complaintHistory(){
        $api = new ApiCLient();

        $api->getNotification();
        $api->getHeader();
        $api->getProfile();
        $api->getHistoryComplaint();
        $api->getTotalChat();

        return view('profile::complaint_history', $api->data);
    }

    public function detailComplaint($id, $ticketing_num) {
        $api = new ApiCLient();

        $api->getNotification();
        $api->getHeader();
        $api->getProfile();
        $api->getDetailComplaint($id);
        $api->getTotalChat();
        return view('profile::complaint_detail', $api->data);
    }

    public function address(){
        $api = new ApiCLient();

        $api->getNotification();
        $api->getHeader();
        $api->getProfile();
        $api->getProvince();
        $api->getAddress();
        $api->getTotalChat();
 
        return view('profile::address', $api->data);
    }

    public function history(Request $request){
        $api = new ApiCLient();

        $api->getNotification();
        $api->getHeader();
        $api->getProfile();
        $api->getHistoryTransaction($request);
        $api->getTotalChat();

        return view('profile::history', $api->data);
    }

    public function saldo(Request $request){
        $api = new ApiCLient();

        $api->getNotification();
        $api->getHeader();
        $api->getProfile();
        $api->getSaldo($request);
        $api->getTotalChat();

        return view('profile::saldo', $api->data);
    }

    public function detailOrder($id, $invoice_no, Request $request) {
        $api = new ApiCLient();

        $api->getNotification();
        $api->getHeader();
        $api->getRekening();
        $api->getPembayaran($id);
        $api->getProfile();
        $api->getTransaction($id);
        $api->getTransactionDetail($id);
        $api->orderTracking($id);
        $api->getPaymentOrder($invoice_no);
        $api->getTotalChat();
        $api->getCategoryComplaint();
        $api->getComplaintSolution();
        $shipment_method_id = $api->data['transaction_detail']->shipment_method_id;
        $api->getTracing($id,$shipment_method_id);
//        dd($api->data);
        return view('profile::order_detail', $api->data);
    }

    public function updateProfile(Request $request) {
        $api = new ApiCLient();

        return $api->updateProfile($request); 
    }

    public function updatePembayaran(Request $request) {
        $api = new ApiCLient();

        return $api->updatePembayaran($request); 
    }


    public function updateAddress(Request $request){
        $api = new ApiCLient();

        return $api->updateAddress($request); 
    }

    public function changePassword(Request $request) {
        $api = new ApiCLient();

        return $api->changePassword($request); 
    }

    public function getKota($provinsi_id){
        $api = new ApiCLient();

        return $api->getKota($request); 
    }

    public function addAddress(Request $request){
        $api = new ApiCLient();

        return $api->addAddress($request); 
    }

    public function confirmOrder(Request $request){
        $api = new ApiCLient();

        return $api->confirmOrder($request); 
    }

    public function wishlist(Request $request){
        $api = new ApiCLient();

        $api->getProduct();
        $api->getCart();
        $api->getNotification();
        $api->getHeader();
        $api->getTotalChat();

        return view('profile::wishlist', $api->data);
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create() {
        return view('profile::create');
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
        return view('profile::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id) {
        return view('profile::edit');
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

     public function invoice($id, Request $request)
    {
        $api = new ApiCLient();

        $api->getNotification();
        $api->getHeader();
        $api->getRekening();
        $api->getPembayaran($id);
        // $api->updatePembayaran($request, $id);
        $api->getProfile();
        $api->getTransaction($id);
        $api->getTransactionDetail($id);
        $api->orderTracking($id);
        $api->getTotalChat();
        $pdf = PDF::loadView('profile::invoice', $api->data)->setPaper('a4')->setWarnings(false);
        return $pdf->download('Proforma Invoice.pdf');
       // return view('profile::invoice', $api->data);
    }
    
    public function chat(){
        $api = new ApiCLient();

        $api->getNotification();
        $api->getHeader();
        $api->getRekening();
        $api->getProfile();
        $api->getChatByUserId(Session::get('user_id'));
        $api->getTotalChat();
        $api->updateTotalChat();

        return view('profile::chat', $api->data);
    }
    
    public function complaint(Request $request){
        $api = new ApiCLient();
        $api->insertComplaint($request);
        
        return redirect()->route('profile-detail-order',  [
            'id' => $request->order_id, 
            'invoice_no' => $request->invoice_no
        ]);
    }
}


