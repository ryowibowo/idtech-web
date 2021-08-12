<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use App\Helpers\ApiClient;

class ProductController extends Controller {

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
        $api->getCategory();
        $api->getProduct();
        $api->getCart();
        $api->getTotalChat();
        
        return view('product::index', $api->data);
    }

    public function productSearch(Request $request) {
        $api = new ApiCLient();
        
        $api->getNotification();
        $api->getHeader();
        $api->getCategory();
        $api->getProductByNameNew($request->product_name);
        $api->getCart();
        $api->getTotalChat();
        $api->data['product_search'] = $request->product_name;

        return view('product::search', $api->data);
    }

    public function searchByCategory($id) {
        $api = new ApiCLient();
        
        $api->getNotification();
        $api->getHeader();
        $api->getCategory();
        $api->getProductByCategory($id);
        $api->getCart();
        $api->getTotalChat();
        $api->data['category_id'] = $id;

        return view('product::searchProductCategory', $api->data);
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

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create() {
        return view('product::create');
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
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id) {
        return view('product::edit');
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
    
    public function getProductById($id){
        $api = new ApiCLient();

        $api->getNotification();
        $api->getHeader();
        $api->getCategory();
        $api->getProductById($id);
        $api->getCart();
        $api->getTotalChat();
//        dd($api->data);
        
        return view('product::detail', $api->data);
    }
    
    public function dataProductSearchSortTag(Request $request){
        dd($request->all());
    }
}
