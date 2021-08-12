@section('title', env('APP_NAME'))
@include('layouts.header')
<!-- Start Error Notification -->
<div class="row ml-auto pull-right" style="position:absolute; top: 10px !important; right: 25px !important;z-index:9999999">
    @if($error_notif != "")
    <div class="alert-group" style="width:100%">
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="margin-left:10px">×</button>
            <strong>Error!</strong> get notification<br>
            <a data-toggle="collapse" href="#collapseNotification" role="button" aria-expanded="false" aria-controls="collapseNotification">
                Detail
            </a>
            <div class="collapse" id="collapseNotification">
                <div class="card card-body">
                    {{$error_notif}}
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($error_product != "")
    <div class="alert-group" style="width:100%">
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="margin-left:10px">×</button>
            <strong>Error!</strong> get product<br>
            <a data-toggle="collapse" href="#collapseProduct" role="button" aria-expanded="false" aria-controls="collapseProduct">
                Detail
            </a>
            <div class="collapse" id="collapseProduct">
                <div class="card card-body">
                    {{$error_product}}
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($error_cart != "")
    <div class="alert-group" style="width:100%">
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="margin-left:10px">×</button>
            <strong>Error!</strong> get Cart<br>
            <a data-toggle="collapse" href="#collapseCart" role="button" aria-expanded="false" aria-controls="collapseCart">
                Detail
            </a>
            <div class="collapse" id="collapseCart">
                <div class="card card-body">
                    {{$error_cart}}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<!-- End Error Notification -->
<div class="content-wrap">
    <!-- start produk -->
    <section>
        <div class="container">
            <div class="form-inline section-text">
                <a href="{{url('product')}}"><strong class="">Wishlist </strong></a>
                <span class="right-filter">
                    <a href="#"><i class="ic-sort"></i></a>
                    <a href="#"><i class="ic-filter"></i></a>
                </span>
            </div>

            <div class="row">
                @foreach($product as $data_product)
                @if($data_product['wishlist'] == '1')
                    <div class="product-list" >
                        <div class="product-card-wrap"  data-id="{{$data_product['product_id']}}" data-stock="{{$data_product['product_stock']}}" data-user="10" data-agent="0">
                            <div class="product-card">
                                @if($data_product['product_discount'] > 0)
                                <span class="badge">{{$data_product['product_discount']}}</span>
                                @endif
                                <div class="hover-card">
                                    <a class="btn btn-wishlist {{$data_product['wishlist'] == '1' ? 'listed' : 'not_listed'}} float-right">
                                        <span class="fa fa-heart"></span>
                                    </a>
                                    <?php $url_product = url('/product').'/'.$data_product['product_id']; ?>
                                    <div class="wrap-button-view" onclick="location.href='{{$url_product}}';" style="cursor:pointer;">
<!--                                        @if($data_product['product_stock'] == "0" || $data_product['product_stock'] == 0)
                                        <a class="btn btn-danger btn-block" >Kosong</a>
                                        @else
                                        <a class="btn btn-primary btn-block" >Beli</a>
                                        @endif-->
                                    </div>
                                </div>
                                @if($data_product['product_image'] == '' || $data_product['product_image'] == null || config('app.just_url_api') == $data_product['product_image'] || !url_exists($data_product['product_image']))
                                    @if($data_product['product_stock'] == "0" || $data_product['product_stock'] == 0)
                                        <img class="img-thumbnail card-img-top smallimg" style="height: 200px;opacity:0.5" src="<?php echo URL::to('/'); ?>/assets/img/img-default.jpg" alt="">
                                    @else
                                        <img class="img-thumbnail card-img-top smallimg" style="height: 200px;" src="<?php echo URL::to('/'); ?>/assets/img/no-image.png" alt="">
                                    @endif
                                @else
                                    @if($data_product['product_stock'] == "0" || $data_product['product_stock'] == 0)
                                        <img class="img-thumbnail card-img-top smallimg" src="{{$data_product['product_image']}}" alt="" style="opacity:0.5">
                                    @else
                                        <img class="img-thumbnail card-img-top smallimg" src="{{$data_product['product_image']}}" alt="">
                                    @endif
                                @endif
                            </div>
                            <div class="card-block" onclick="location.href='{{$url_product}}';" style="cursor:pointer;">
                                <h4>{{$data_product['product_name']}}</h4>
                                @if($data_product['product_discount'] > 0)
                                <h1 class="font-weight-normal mb-0 float-left"><strike>{{$data_product['product_price_before_discount']}}</strike></h1>
                                @endif
                                <h5 class="float-left">{{$data_product['product_price_after_discount']}}</h5>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- end produk -->

    <!-- start button trigger modal cart -->
    @if($total_cart != 0)
    <button type="button" class="btn btn-cart" data-toggle="modal" data-target="#shoppingCart" data-backdrop="static" data-keyboard="false" data-badge="{{$total_cart}}">
        <i class="ic-shop-cart"></i>
    </button>
    @else
    <button type="button" class="btn btn-cart" data-toggle="modal" data-target="#shoppingCart" data-backdrop="static" data-keyboard="false">
        <i class="ic-shop-cart"></i>
    </button>
    @endif
    <!-- end button trigger modal cart -->
</div>
@include('layouts.footer')
@include('layouts.redirect_notification')
@include('layouts.redirect_chat')
@include('layouts.modals.modal_cart')
@include('layouts.modals.modal_product')
@include('layouts.modals.wishlist')
@if(!Session::has('user_id'))
@include('layouts.modals.modal_login')
@include('layouts.modals.modal_register')
@endif
