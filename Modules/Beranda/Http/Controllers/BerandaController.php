<?php

namespace Modules\Beranda\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Alert;
use App\Helpers\ApiClient;

class BerandaController extends Controller {

    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (Session::get('cart') == NULL) {
                $request->session()->put('cart', array());
                return $next($request);
            } else {
                return $next($request);
            }
        });
    }

    public function index() {
        $api = new ApiCLient();

        $api->getNotification();
        $api->getHeader();
        $api->getBanner();
        $api->getCategory();
        $api->getProduct();
        $api->getCart();
        $api->getTotalChat();
//        dd($api->data);
        
        return view('beranda::index', $api->data);
    }

    public function detailPromoById($id) {
        $api = new ApiCLient();
        
        $api->getNotification();
        $api->getHeader();
        $api->getTotalChat();
        $api->getBannerById($id);
        return view('beranda::detailPromo', $api->data);
    }

    public function register(Request $request) {
        $api = new ApiCLient();

        return $api->register($request);     
    }

    public function verifyUsername(Request $request) {
        $api = new ApiCLient();

        return $api->verifyUsername($request);
    }

    public function login(Request $request) {
        $api = new ApiCLient();

        return $api->login($request);
    }

    public function verifyOtp(Request $request) {
        $api = new ApiCLient();

        return $api->verifyOtp($request);
    }

    public function verifyForget(Request $request) {
        $api = new ApiCLient();

        return $api->verifyForget($request);
    }

    public function sendOTPReset(Request $request) {
        $api = new ApiCLient();

        return $api->sendOTPReset($request);
    }

    public function changeForgotPassword(Request $request) {
        $api = new ApiCLient();

        return $api->changeForgotPassword($request);
    }

    public function addToCart(Request $request) {
        $api = new ApiCLient();

        return $api->addToCart($request);
    }

    public function addUpdateCart(Request $request) {
        $api = new ApiCLient();

        return $api->addUpdateCart($request);
    }

    public function deleteCart(Request $request) {
        $api = new ApiCLient();

        return $api->deleteCart($request);
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create() {
        return view('beranda::create');
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
        return view('beranda::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id) {
        return view('beranda::edit');
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
