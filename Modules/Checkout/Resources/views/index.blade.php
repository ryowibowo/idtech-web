<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @if($header->logo_page == null)
        <link rel="shortcut icon" href="<?php echo URL::to('/'); ?>/assets/img/favicon.png" type="image/x-icon">
        @else
        <link rel="shortcut icon" href="{{$header->logo_page}}" type="image/x-icon"> 
        @endif   
        <link href="https://fonts.googleapis.com/css2?family=Muli:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="<?php echo URL::to('/'); ?>/assets/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo URL::to('/'); ?>/assets/css/icons/fontawesome/styles.min.css">
        <link rel="stylesheet" href="<?php echo URL::to('/'); ?>/assets/css/style.css">
        <link rel="stylesheet" href="<?php echo URL::to('/'); ?>/assets/css/basic.css">
        <link rel="stylesheet" href="<?php echo URL::to('/'); ?>/assets/css/responsive.css">
        <link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.theme.default.min.css">
    </head>
    <?php
        $primaryColor = $header->primary_color;
        $secondaryColor = $header->secondary_color;
    ?>
    <style>
        .background-primary{
            background-color: <?php echo $primaryColor;?> !important;
        }
        .btn-secondary {
            background-color: <?php echo $secondaryColor;?> !important;
            border-color: <?php echo $secondaryColor;?> !important;
        }
        .btn-secondary:hover,
        .btn-secondary:focus,
        .btn-secondary:active {
            background-color: <?php echo $secondaryColor;?> !important;
            border-color: <?php echo $secondaryColor;?> !important;
        }
        .btn-secondary-line {
            border-color: <?php echo $secondaryColor;?> !important;
            color: <?php echo $secondaryColor;?> !important;
        }
        .btn-cart{
            background-color: <?php echo $primaryColor;?> !important;
        }
        .background-primary{
            background-color: <?php echo $primaryColor;?> !important;
        }
        .btn-primary {
            background-color: <?php echo $primaryColor;?> !important;
            border-color: <?php echo $primaryColor;?> !important;
        }
        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active {
            background-color: <?php echo $primaryColor;?> !important;
        }
        .section-text strong{
            color: <?php echo $primaryColor;?> !important;
        } 
        .text-success{
            color: <?php echo $primaryColor;?> !important;
        } 
        .color-primary{
            color: <?php echo $primaryColor;?> !important;
        }
        .category-product label:hover,
        .category-product label:focus,
        .category-product label:active{
            color: <?php echo $secondaryColor;?> !important;
        }
        .btn-default{
            background-color: <?php echo $secondaryColor;?> !important;
        }
        .btn-default:hover,
        .btn-default:focus,
        .btn-default:active {
            background-color: <?php echo $secondaryColor;?> !important;
        }
        .modal-title{
            color: <?php echo $primaryColor;?> !important;
        }
        .btn-success{
            background-color: <?php echo $primaryColor;?> !important;
            border-color: <?php echo $primaryColor;?> !important;
        }
        .btn-success:hover,
        .btn-success:focus,
        .btn-success:active {
            background-color: <?php echo $primaryColor;?> !important;
            border-color: <?php echo $primaryColor;?> !important;
        }
        .breadcrumb-item a{
            color: <?php echo $primaryColor;?> !important;
        }
        .breadcrumb-item a:hover{
            color: <?php echo $secondaryColor;?> !important;
        }
        .profile-link{
            color: <?php echo $primaryColor;?> !important;
        }
        .user-profile .nav-pills li a.active{
            color: <?php echo $primaryColor;?> !important;
            border-bottom: 3px solid <?php echo $primaryColor;?>;
        }
        .btn-selected:not(:disabled):not(.disabled).active, .btn-selected:not(:disabled):not(.disabled):active, .show > .btn-selected.dropdown-toggle {
            background-color: <?php echo $primaryColor;?> !important;
            border-color: <?php echo $primaryColor;?> !important;
        }
        ul.list-alamat.list-group input[type="radio"]:checked + .list-group-item {
            border: 1px solid <?php echo $primaryColor;?>;
        }
        .order-id{
            color: <?php echo $primaryColor;?> !important;
        }
        .btn-outline-secondary{
            background-color: <?php echo $secondaryColor;?> !important;
        }
        .btn-toggle:not(:disabled):not(.disabled).active, .btn-toggle:not(:disabled):not(.disabled):active, .show > .btn-toggle.dropdown-toggle {
            color: <?php echo $secondaryColor;?> !important;
            border: 2px solid <?php echo $secondaryColor;?> !important;
        }
        .btn-toggle.active span p {
            color: <?php echo $secondaryColor;?>;
        }
        .btn-toggle-promo:not(:disabled):not(.disabled).active, .btn-toggle-promo:not(:disabled):not(.disabled):active, .show > .btn-toggle-promo.dropdown-toggle {
            color: <?php echo $secondaryColor;?> !important;
            border-color: <?php echo $secondaryColor;?> !important;
        }
        .btn-toggle-promo.active span p {
            color: <?php echo $secondaryColor;?>;
        }
        .user-profile .card .tab-content ul li a label.order-proses, .user-profile .card ul.alamat-kirim li label.order-proses, .order-detail ul li label.order-right.order-proses {
            color: <?php echo $secondaryColor;?>;
        }
        .login-email p a {
            color: <?php echo $primaryColor;?> !important;
        }
        .login-row .card h4 {
            color: <?php echo $primaryColor;?> !important;
        }
        .background-primary .top-menu ul li a:hover, .background-secondary .top-menu ul li a:hover {
            color: <?php echo $primaryColor;?> !important;
        }
    </style>
    <style>
        .numberCircle {
            border-radius: 50%;
            width: 40px;
            /*height: 43px;*/
            background: #fff;
            border: 2px solid #666;
            color: red;
            text-align: center;
            float: right;
            background-color: #444446;
        }
    </style>
    <body>
        <?php
        function url_exists($url) {
            $hdrs = @get_headers($url);
        
            return is_array($hdrs) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$hdrs[0]) : false;
        }
        ?>
        <!-- Preloader -->
        <div id="loader-wrapper">
            <div id="loader">
                <div class="logo-preloader" style="text-align: center; line-height: 87px;">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="40px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve">
                    <g>
                        <path fill="<?php echo $secondaryColor;?>" d="M78.959,82.303C76.14,87.433,73.139,90,69.958,90c-1.82,0-4.319-0.988-7.501-2.961L14.041,56.398
                            c-1.547-0.988-2.932-2.567-4.16-4.737c-1.227-2.172-1.841-4.318-1.841-6.439c0-2.123,0.477-4.145,1.432-6.069
                            c0.955-1.924,1.931-3.282,2.932-4.071l1.5-1.332L62.457,2.961C65.457,0.985,67.912,0,69.821,0c3.273,0,6.318,2.565,9.138,7.697
                            c1.999,3.749,3,6.71,3,8.882c0,2.169-0.614,3.872-1.841,5.107c-1.227,1.233-3.069,2.54-5.523,3.923L40.227,45l34.368,19.391
                            c1.726,1.085,2.977,1.899,3.75,2.442c0.771,0.541,1.545,1.406,2.319,2.59c0.771,1.184,1.159,2.762,1.159,4.737
                            C81.823,76.134,80.868,78.847,78.959,82.303z"/>
                    </g>
                </svg>
                </div>
                <div class="loader loader-yukmarket">
                    <svg width="90px" height="90px" viewBox="0 0 50 50" fill="<?php echo $secondaryColor;?>">
                    <circle cx="25" cy="2.4" r="2.4"/>
                    <circle opacity="0.55" cx="25" cy="47.6" r="2.4"/>
                    <circle opacity="0.9" cx="13.7" cy="5.4" r="2.4"/>
                    <path d="M38.4,43.4 C39,44.5 38.6,46 37.5,46.7 C36.4,47.3 34.9,46.9 34.2,45.8 C33.6,44.7 34,43.2 35.1,42.5 C36.2,41.9 37.7,42.3 38.4,43.4 Z"
                          opacity="0.45"/>
                    <path d="M6.6,11.6 C7.7,12.2 8.1,13.7 7.5,14.9 C6.9,16 5.4,16.4 4.2,15.8 C3.1,15.2 2.7,13.7 3.3,12.5 C4,11.3 5.5,11 6.6,11.6 Z"
                          opacity="0.8"/>
                    <path d="M45.8,34.2 C46.9,34.8 47.3,36.3 46.7,37.5 C46.1,38.6 44.6,39 43.4,38.4 C42.3,37.8 41.9,36.3 42.5,35.1 C43.1,34 44.6,33.5 45.8,34.2 Z"
                          opacity="0.35"/>
                    <circle  opacity="0.7" cx="2.4" cy="25" r="2.4"/>
                    <circle  opacity="0.2" cx="47.6" cy="25" r="2.4"/>
                    <path d="M4.2,34.2 C5.3,33.6 6.8,34 7.5,35.1 C8.1,36.2 7.7,37.7 6.6,38.4 C5.5,39 4,38.6 3.3,37.5 C2.6,36.4 3.1,34.9 4.2,34.2 Z"
                          opacity="0.65"/>
                    <path d="M43.4,11.6 C44.5,11 46,11.4 46.7,12.5 C47.3,13.6 46.9,15.1 45.8,15.8 C44.7,16.4 43.2,16 42.5,14.9 C41.9,13.8 42.3,12.3 43.4,11.6 Z"
                          opacity="0.1"/>
                    <path d="M11.6,43.4 C12.2,42.3 13.7,41.9 14.9,42.5 C16,43.1 16.4,44.6 15.8,45.8 C15.2,46.9 13.7,47.3 12.5,46.7 C11.4,46 11,44.5 11.6,43.4 Z"
                          opacity="0.6"/>
                    <path d="M34.2,4.2 C34.8,3.1 36.3,2.7 37.5,3.3 C38.6,3.9 39,5.4 38.4,6.6 C37.8,7.7 36.3,8.1 35.1,7.5 C34,6.9 33.5,5.4 34.2,4.2 Z"
                          fill="#FFF"/>
                    </svg>
                    <center><span >Loading...</span></center>
                </div>
            </div>
            <div class="bg-preloader"></div>
        </div>

        <!-- navbar -->
        <nav class="navbar navbar-light  sticky-top  justify-content-between" id="sticky-top">
            <div class="container-fluid background-primary">
                <div class="container padding-tb5">
                    <div class="col-md-6 no-padding">
                        <div class="download-app">
                            <!--<p>Unduh Yukmarket app di </p>
                            <a href="https://play.google.com/store/apps/details?id=id.co.indocyber.yukmarket" class="small-app-download" target="_blank">
                                <img src="<?php echo URL::to('/'); ?>/assets/img/download-google-play.png">
                            </a>
                            <a href="https://play.google.com/store/apps/details?id=id.co.indocyber.yukmarket" class="small-app-download">
                                <img  src="<?php echo URL::to('/'); ?>/assets/img/download-app-store.png" target="_blank">
                            </a>-->
                        </div>
                    </div>
                    <div class="col-md-6 no-padding">
                        <div class="menu float-right">
                            <div class="navbar-nav-scroll">
                                <div class="top-menu">
                                    <ul class="navbar-nav bd-navbar-nav flex-row">
                                        <li class="nav-item"><a class="nav-link " href="{{ url('/product') }}">Produk</a></li>
                                        <li class="nav-item"><a class="nav-link " href="{{ url('/aboutus') }}">Tentang {{env('APP_NAME')}}</a></li>
                                        <li class="nav-item"><a class="nav-link " href="{{ url('/help') }}">Bantuan</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container padding-tb20">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">
                                <a href="{{url('beranda')}}" class="navbar-brand"><img class="logo" src="<?php echo URL::to('/'); ?>/assets/img/logo-IDtech-solusi.jpg"></a>
                            </div>
                        </div>
                        <form method="POST" action="{{url('product/searching')}}" class="col-md-6 search-product">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="inner-addon left-addon">
                                    <i class="fa fa-search" aria-hidden="true" style="padding-top:3px;"></i>
                                    <input class="form-control" name="product_name" type="search" id="product_search" placeholder="Cari barang" aria-label="Search">
                                    <button type="submit" hidden>test</button>
                                </div>
                            </div>
                        </form>
                        @if(Session::has('user_id'))
                        <div class="col-md-3 sm-35 float-right">
                            <div class="row btn-member">
                                <div class="col-md-2">
                                    <ul class="navbar-nav nav-notif">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="notif"></span>
                                                <i class="fa fa-bell text-success" style="font-size:24px;"></i>
                                            </a>
                                            <ul class="dropdown-menu notify-drop">
                                                <div class="drop-content">
                                                    @foreach($notif as $nt)
                                                    @if($nt['is_read'] == 0)
                                                    <li class="new">
                                                        @else
                                                    <li>
                                                        @endif
                                                        <a href="#">
                                                            <p class="notif-title">{{$nt['title']}}</p>
                                                            <p class="notif-status">{{$nt['message']}}</p>
                                                            <label class="text-muted notif-date">{{date('d M Y H:i:s', strtotime($nt['created_date']))}}</label>
                                                        </a>
                                                    </li>
                                                    @endforeach 
                                                    <div class="notify-drop-footer">
                                                        <a href=""><i class="fa fa-eye"></i> Sudah dibaca semua</a>
                                                        <a href="" class="right"><i class="fa fa-eye"></i> Lihat semua</a>
                                                    </div>
                                                </div>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
<!--                                <div class="col-md-2">
                                    <ul class="navbar-nav nav-notif" style="padding-top: 2px; padding-left: 10px;">
                                        <a href="{{ url('profile/chat') }}">
                                            <i class="fa fa-comment text-success" style="font-size:24px;"></i>
                                        </a>
                                    </ul>
                                </div>-->
                                <div class="col-md-10">
                                    <ul class="navbar-nav nav-profil">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0px">
                                                <img src="{{Session::get('user_image')}}" width="30" height="30" class="rounded-circle mr-2">
                                                {{Session::get('user_name')}}
                                                <div class="arrow-down float-right"><i class="fa fa-angle-down"></i></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                <a class="dropdown-item" href="{{ url('profile/history') }}">Riwayat Transaksi</a>
                                                <a class="dropdown-item" href="{{ url('profile/wishlist') }}">Wishlist</a>
                                                <a class="dropdown-item " href="{{ url('profile/chat') }}">Chat <div class="numberCircle" style="background-color: #444446;">{{ $total_chat }}</div></a>
                                                <a class="dropdown-item " href="{{url('profile')}}">Pengaturan</a>
                                                <a class="dropdown-item" href="{{url('auth/logout')}}">Keluar</a>
                                            </div>
                                        </li>   
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-md-3 sm-35 float-right">
                            <div class="row btn-member">
                                <div class="col reg-btn">
                                    <a href="#" class="btn btn-secondary-line btn-block" data-toggle="modal"  data-target="#modal-daftar">Daftar</a>
                                </div>
                                <div class="col log-btn">
                                    <a href="#" class="btn btn-secondary btn-block" data-toggle="modal"  data-target="#modal-login">Masuk</a>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </nav>

        <!-- breadcumb -->
        <section class="breadcrumbs-wrap">
            <div class="container-fluid breadcrumb-whitesmoke">
            <div class="container no-padding">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="/" class="color-primary"><i class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item "><a href="pengiriman.html" class="color-primary">Pengiriman</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
                </nav>
            </div>
            </div>
        </section>
        <!-- end breadcumb -->

        <input type="hidden" id="sub_total" value="{{$total}}">

        <!-- content -->
        <section>
            <div class="container">
            <div class="row order-detail mt-4 mb-5">
                <div class="col-md-12">
                    <div class="row">
                    <div class="col-lg-8">
                        <div class="title-checkout-wrap">
                        <h3 class="card-title color-primary float-left">Pengiriman</h3>
                        <div class="clearfix"></div>
                        </div>
                        <div class="container no-padding">
                        <ul class="list-group list-alamat mt-2">
                            <li>
                            <label class="list-group-item radius-5" >
                                <h4 class="order-id">{{$address->address_info}}</h4>
                                <p>{{$address->address_detail}}, {{$address->kelurahan_desa_name}}, {{$address->kecamatan_name}}, {{$address->kabupaten_kota_name}}, {{$address->provinsi_name}} </p>
                                <div class="margin-tb10"></div>
                                <h6>Kontak</h6>
                                <p>{{$address->contact_person}}</p>
                                <p>{{$address->phone_number}}</p>
                            </label>
                            </li>
                        </ul>
                        
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="title-checkout-wrap">
                        <h3 class="card-title color-primary">Detail Belanja</h3>
                        </div>
                        <div class="card scroll-y margin-b20 max-height-300">
                            <ul class="list-group order-produk">
                            @foreach($cart as $data_cart)
                            <li class="list-group-item">
                                <h4 class="color-primary">{{$data_cart['warehouse_name']}}</h4>
                                @foreach($data_cart['cart'] as $data_varian)
                                <div class="row">
                                    <div class="col-md-3">
                                    <img class="img-circle img-responsive" alt="" src="{{$data_varian['product_image']}}">
                                    </div>
                                    <div class="col-md-9 item-amount">
                                    <h5>{{$data_varian['product_name']}}</h5>
                                    <div class="container no-padding">
                                        <div class="row">
                                        <div class="col-sm-6 ">
                                            <p>{{$data_varian['qty']}} x {{$data_varian['product_pack_uom_value']}} {{$data_varian['product_pack_uom_name']}}</p>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <label class="float-right">Rp {{number_format($data_varian['subtotal'])}}</label>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                @endforeach
                            </li>
                            @endforeach
                            </ul>
                        </div>
                        <div class="subtotal-wrap">
                            <button class="btn btn-lg btn-gray-line btn-block" data-toggle="modal" data-target="#modal-kurir"> <p class="float-left" id="txt_shipment">Pilih Pengiriman </p><i class="fa fa-angle-right float-right"></i></button>
                            <div class="container subtotal">
                                <div class="row">
                                    <div class="col-sm-6 no-padding"><p>Total Berat</p></div>
                                    <div class="col-sm-6 no-padding"><h6 class="float-right">{{$weight}} Kg</h6></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 no-padding"><p>Ongkos Kirim</p></div>
                                    <div class="col-sm-6 no-padding"><h6 class="float-right" id="txt_ongkir">Rp 0</h6></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 no-padding"><p>Subtotal</p></div>
                                    <div class="col-sm-6 no-padding"><h6 class="float-right">Rp {{number_format($total)}}</h6></div>
                                </div>
                            </div>
                        </div>
                        <div class="total-wrap">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Pilih Kode Promo" >
                                <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2" data-toggle="modal"  data-target="#modal-kode-promo">Cek Promo</button>
                                </div>
                            </div>
                        </div>
                        <div class="container subtotal border-bottom-gray">
                            <div class="row">
                                <div class="col-sm-6 no-padding"><p>Total Harga</p></div>
                                <div class="col-sm-6 no-padding"><h6 class="float-right" id="txt_total_harga">Rp {{number_format($total)}}</h6></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 no-padding"><p class="color-red">Potongan</p></div>
                                <div class="col-sm-6 no-padding"><h6 class="color-red float-right" id="txt_potongan">-Rp 0</h6></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 no-padding"><p>Total Ongkos Kirim</p></div>
                                <div class="col-sm-6 no-padding"><h6 class="float-right" id="txt_total_ongkir">Rp 0</h6></div>
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="total">
                            <label class="total-text mr-md-auto float-left ">Total Belanja</label>
                            <label class="total-price float-right" id="total_belanja">Rp 0</label>
                        </div>
                        <div class="clearfix"></div>
                        </div>
                        <a href="#" class="btn btn-success btn-block" data-toggle="modal"  data-target="#modal-payment">Pilih Pembayaran</a>
                    </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- end content -->
        
        <!-- footer -->
        <footer class="section-footer mt-3 ">
            <div class="container">
                <div class="row border-top padding-tb20">
                    <div class="col no-padding">
                        <nav class="nav mr-md-auto">
                            <a class="nav-link" href="#">Kebijakan Privasi</a>
                            <a class="nav-link" href="#">Syarat & Ketentuan</a>
                        </nav>
                    </div>

                    <div class="col no-padding">
                        <p class="col-md-12 text-right no-padding">© 2020 IDtech solusi. All right reserved.</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </footer>
    </div>

    <!-- modal pengiriman -->
    <div class="modal fade" id="modal-kurir"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
          <div class="modal-header no-border">
          <h3 class="modal-title  w-100 text-center color-primary">Pilih Pengiriman</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body ">
              <div class="info">
                  <p><i class="fa fa-info"></i>Silakan pilih kurir pengiriman</p>
              </div>
              <div class="container no-padding">
                  <div class="btn-group-toggle" data-toggle="buttons">
                      <div class="toggle-wrap">
                          <div class="container">
                          <div class="row row-toggle ">
                            <?php $i = 1;?>
                              @foreach($shipment as $data_shipment)
                              <label class="btn btn-block btn-toggle">
                                  <input type="radio" name="options" id="option{{$i}}" class="shipment_method" data-id="{{$data_shipment['shipment_method_id']}}" data-name="{{$data_shipment['shipment_method_name']}}" data-price="{{$data_shipment['price']}}"> 
                                  <span class="float-left">
                                      <h6 >{{$data_shipment['shipment_method_name']}}</h6>
                                      <p class="">Rp {{number_format($data_shipment['price'])}}</p></span>
                                  <i class="fa fa-angle-right float-right"></i>
                                  <div class="clearfix"></div>
                              </label>
                              <?php $i++;?>
                              @endforeach
                          </div>
                          </div>
                      </div>
                  </div>
                  <div class="clearfix"></div>
              </div>
          </div>
          <div class="modal-footer no-border">
              <button  class="btn btn-primary btn-block" data-dismiss="modal">Pilih</button>
          </div>
      </div>
      </div>
    </div>

    <!-- modal promo -->
    <div class="modal fade" id="modal-kode-promo"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
          <div class="modal-header no-border">
          <h3 class="modal-title  w-100 text-center color-primary">Pilih Promo</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body ">
              <div class="info">

                  <p><i class="fa fa-info"></i>Kamu Bisa pilih promo biar makin hemat</p>
              </div>
              <div class="container no-padding">
                  <div class="btn-group-toggle" data-toggle="buttons">
                      <div class="toggle-wrap">
                          <div class="container">
                          <div class="row row-toggle ">
                              <?php $j = 1;?>
                              @foreach($voucher as $data_voucher)
                              <div class="col-sm-12 padding-selected">
                                <label class="btn btn-block btn-toggle-promo">
                                    <input type="radio" name="options" id="option{{$j}}" class="voucher" data-id="{{$data_voucher['voucher_id']}}" data-amount="{{$data_voucher['amount']}}"> 
                                    <span class="float-left"><h5>{{$data_voucher['voucher_code']}}</h5></span>
                                    <span class="float-right"><p>Potongan Rp {{number_format($data_voucher['amount'])}}</p></span>
                                    <div class="clearfix"></div>
                                </label>
                              </div>
                              <?php $j++;?>
                              @endforeach
                          </div>
                          </div>
                      </div>
                  </div>
                  <div class="clearfix"></div>
              </div>
          </div>
          <div class="modal-footer no-border">
              <button  class="btn btn-primary btn-block" data-dismiss="modal">Pilih</button>
          </div>
      </div>
      </div>
  </div>

  <!-- modal pembayaran -->
  <div class="modal fade" id="modal-payment"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
          <div class="modal-header no-border">
          <h3 class="modal-title  w-100 text-center color-primary">Pilih Pembayaran</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body ">
              <div class="container no-padding">
                <div class="saldo-wrap">
                  <span class="float-left">
                    <h6 class="color-primary ">Gunakan Saldo</h6>
                    <p class="float-left">Rp 0</p>
                  </span>
                  <label class="switch float-right" >
                    <input type="checkbox">
                    <span class="slider round"></span>
                  </label>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="container no-padding margin-tb20">
                <button class="btn btn-lg btn-gray-line btn-block" data-toggle="modal" data-target="#modal-option-payment"> 
                  <p class="float-left">Pilih Metode Pembayaran </p>
                  <i class="fa fa-angle-right float-right"></i>
                  <div class="clearfix"></div>
                </button>
              </div>
              <div class="container no-padding margin-tb20">
                  <div class="row">
                    <div class="col-sm-12 ">
                      <h5 class="color-primary no-padding">Detail Pembayaran</h5>
                    </div>
                  </div>
                  <div class="subtotal-payment">
                    <div class="container">
                      <div class="row">
                          <div class="col-sm-6 no-padding"><p>Sub Total</p></div>
                          <div class="col-sm-6 no-padding"><h6 class="float-right">Rp {{number_format($total)}}</h6></div>
                      </div>
                      <div class="row">
                          <div class="col-sm-6 no-padding"><p class="color-red">Potongan</p></div>
                          <div class="col-sm-6 no-padding"><h6 class="color-red float-right" id="txt_potongan_payment">-Rp 0</h6></div>
                      </div>
                    <div class="row">
                        <div class="col-sm-6 no-padding"><p>Biaya Admin</p></div>
                        <div class="col-sm-6 no-padding"><h6 class="float-right">Rp 0</h6></div>
                    </div>
                      <div class="row">
                          <div class="col-sm-6 no-padding"><p>Total Ongkos Kirim</p></div>
                          <div class="col-sm-6 no-padding"><h6 class="float-right" id="txt_total_ongkir_payment">Rp 0</h6></div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="form-group no-margin">
                <div class="total">
                  <label class="total-text mr-md-auto float-left"><h5 class="no-margin">Total Belanja</h5></label>
                  <label class="total-price float-right"><h5 class="no-margin" id="txt_grandtotal">Rp 160.000</h5></label>
                </div>
                <div class="clearfix"></div>
              </div>
          </div>
          <div class="modal-footer no-border">
              <button  class="btn btn-primary btn-block" disabled data-dismiss="modal">Bayar</button>
          </div>
      </div>
      </div>
  </div>

  <!-- modal option payment -->
  <div class="modal fade" id="modal-option-payment"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
          <div class="modal-header no-border ">
            <h3 class="modal-title  w-100 text-center color-primary">Pilih Metode Pembayaran</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body ">
              <div class="info">
                <p><i class="fa fa-info"></i>Silakan pilih metode pembayaran</p>
              </div>
              <div class="container">
                <div class="btn-group-toggle" data-toggle="buttons">
                  <div class="toggle-wrap">
                      <div class="container no-padding">
                        <div class="row row-toggle ">
                            <?php $k = 1;?>
                            @foreach($payment as $data_payment)
                            <label class="btn btn-block btn-toggle">
                                <input type="radio" name="options" id="option{{$k}}" class="payment_id" data-id="{{$data_payment['payment_method_id']}}" data-name="{{$data_payment['payment_method_name']}}" data-desc="{{$data_payment['payment_method_desc']}}" data-image="{{$data_payment['payment_logo']}}" data-fee="{{$data_payment['admin_fee']}}"> 
                                <span class="logo-bank float-left">
                                  <img src="{{$data_payment['payment_logo']}}">
                                </span>
                                <span class="float-left">
                                    <h6>{{$data_payment['payment_method_name']}}</h6>
                                    <p>{{$data_payment['payment_method_desc']}}</p>
                                </span>
                                <i class="fa fa-angle-right float-right"></i>
                                <div class="clearfix"></div>
                            </label>
                            <?php $k++;?>
                            @endforeach
                        </div>
                      </div>
                  </div>
              </div>
              <div class="clearfix"></div>
              </div>
          </div>
          <div class="modal-footer no-border">
              <button  class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-payment2">Pilih</button>
          </div>
      </div>
    </div>
  </div>

  <!-- Modal Payment dengan logo yang dipilih-->
<div class="modal fade" id="modal-payment2"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
  <div class="modal-content">
      <div class="modal-header no-border ">
      <h3 class="modal-title  w-100 text-center color-primary">Pembayaran</h3>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body ">
          <div class="container no-padding">
            <div class="saldo-wrap">
              <span class="float-left">
                <h6 class="color-primary ">Gunakan Saldo</h6>
                <p class="float-left">Rp 0</p>
              </span>
              <label class="switch float-right" >
                <input type="checkbox">
                <span class="slider round"></span>
              </label>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="container no-padding margin-tb10">
            <div class="btn-group-toggle" data-toggle="buttons">
              <div class="toggle-wrap">
                  <div class="container no-padding">
                    <div class="row row-toggle no-margin">
                        <label class="btn btn-block btn-toggle border1 disabled">
                            <input type="radio" name="options" id="option1"> 
                            <span class="logo-bank float-left">
                              <img src="../assets/img/bank/bca.png" id="payment_image">
                            </span>
                            <span class="float-left">
                                <h6 id="payment_name"></h6>
                                <p id="payment_desc"></p>
                            </span>
                            <i class="fa fa-angle-right float-right"></i>
                            <div class="clearfix"></div>
                        </label>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="container no-padding margin-tb20">
            <div class="row">
              <div class="col-sm-12 ">
                <h5 class="color-primary no-padding">Detail Pembayaran</h5>
              </div>
            </div>
            <div class="subtotal-payment">
              <div class="container">
              <div class="row">
                    <div class="col-sm-6 no-padding"><p>Sub Total</p></div>
                    <div class="col-sm-6 no-padding"><h6 class="float-right">Rp {{number_format($total)}}</h6></div>
                </div>
                <div class="row">
                    <div class="col-sm-6 no-padding"><p class="color-red">Potongan</p></div>
                    <div class="col-sm-6 no-padding"><h6 class="color-red float-right" id="txt_potongan_payment_final">-Rp 0</h6></div>
                </div>
                <div class="row">
                    <div class="col-sm-6 no-padding"><p>Biaya Admin</p></div>
                    <div class="col-sm-6 no-padding"><h6 class="float-right" id="txt_biaya_admin_final">Rp 0</h6></div>
                </div>
                <div class="row">
                    <div class="col-sm-6 no-padding"><p>Total Ongkos Kirim</p></div>
                    <div class="col-sm-6 no-padding"><h6 class="float-right" id="txt_total_ongkir_payment_final">Rp 0</h6></div>
                </div>
              </div>
            </div>
        </div>
        <div class="form-group no-margin">
          <div class="total">
            <label class="total-text mr-md-auto float-left"><h5 class="no-margin">Total Belanja</h5></label>
            <label class="total-price float-right"><h5 class="no-margin" id="txt_grandtotal_final">Rp 0</h5></label>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <form action="{{url('checkout/order')}}" method="POST">
      {{ csrf_field() }}
        <div class="modal-footer no-border">
            <input type="hidden" name="address_id" id="address_id" value="{{$address_id}}">
            <input type="hidden" name="shipment_method_id" id="shipment_method_id">
            <input type="hidden" name="shipment_method_price" id="shipment_method_price">
            <input type="hidden" name="voucher_id" id="voucher_id">
            <input type="hidden" name="payment_id" id="payment_id">
            <input type="hidden" name="admin_fee" id="admin_fee">
            <button type="submit" class="btn btn-primary btn-block" id="pay1" data-toggle="modal" data-target="#modal-bayar" >Bayar</button>           
        </div>
      </form>
  </div>
  </div>
</div>


<!-- Modal Konfirmasi Pembayaran -->
<!-- <div class="modal fade" id="modal-bayar"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header no-border">
        <h3 class="modal-title  w-100 text-center color-primary">Konfirmasi Pembayaran</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body ">
            <div class="info-payment">
                <h5>Menunggu Pembayaran</h5>
                <p>Mohon selesaikan pembayaran Anda sebelum tanggal 25 09 2020 WIB dengan riincian:</p>
                <div class="clearfix"></div>
                <span class="info-bank">
                  <p>Transfer ke BCA Virtual Account</p>
                  <div class="input-group input-clone">
                    <input type="text" class="form-control" placeholder="059755504975" disabled>
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary btn-outline-clone" type="button" ><i class="fa fa-clone" aria-hidden="true"></i></button>
                    </div>
                  </div>
                  <p>Jumlah yang harus dibayar</p>
                  <div class="input-group input-clone">
                    <input type="text" class="form-control" placeholder="Rp 160.000" disabled>
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary btn-outline-clone" type="button" ><i class="fa fa-clone" aria-hidden="true"></i></button>
                    </div>
                  </div>
                </span>
            </div>
            <div class="container no-padding">
                
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="modal-footer no-border">
            <a href="{{url('product') }}"  class="btn btn-primary btn-block">Kembali Belanja</a>
        </div>
    </div>
    </div>
</div> -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>

    <!-- Library  -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
    <script src="<?php echo URL::to('/'); ?>/assets/js/custom.js"></script>

    <script>  
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    var subtotal = $('#sub_total').val();
    var potongan = 0;
    var total_ongkir = 0;
    var grandtotal = 0;

    grandtotal = subtotal - potongan + total_ongkir;
    $("#total_belanja").text("Rp "+numberWithCommas(grandtotal));
    $("#txt_grandtotal").text("Rp "+numberWithCommas(grandtotal));
    $("#txt_grandtotal_final").text("Rp "+numberWithCommas(grandtotal));

     $(document).on('click', '.shipment_method', function () {
        var shipment_method_id = $(this).data('id');
        var shipment_method_name = $(this).data('name');
        var shipment_method_price = $(this).data('price');
        $("#shipment_method_id").val(shipment_method_id);
        $('#txt_shipment').text(shipment_method_name+" - Rp. "+numberWithCommas(shipment_method_price));
        $('#txt_ongkir').text("Rp. "+numberWithCommas(shipment_method_price));
        $('#txt_total_ongkir').text("Rp. "+numberWithCommas(shipment_method_price));
        $('#txt_total_ongkir_payment').text("Rp. "+numberWithCommas(shipment_method_price));
        $('#txt_total_ongkir_payment_final').text("Rp. "+numberWithCommas(shipment_method_price));
        $('#shipment_method_price').val(shipment_method_price);
        
        total_ongkir = shipment_method_price;

        grandtotal = subtotal - potongan + total_ongkir;
        $("#total_belanja").text("Rp "+numberWithCommas(grandtotal));
        $("#txt_grandtotal").text("Rp "+numberWithCommas(grandtotal));
        $("#txt_grandtotal_final").text("Rp "+numberWithCommas(grandtotal));
     });

     $(document).on('click', '.voucher', function () {
        var voucher_id = $(this).data('id');
        var voucher_amount = $(this).data('amount');
        console.log(voucher_amount);
        $("#voucher_id").val(voucher_id);
        $("#txt_potongan").text("Rp "+numberWithCommas(voucher_amount));
        $("#txt_potongan_payment").text("Rp "+numberWithCommas(voucher_amount));
        $("#txt_potongan_payment_final").text("Rp "+numberWithCommas(voucher_amount));

        potongan = voucher_amount;

        grandtotal = subtotal - potongan + total_ongkir;
        $("#total_belanja").text("Rp "+numberWithCommas(grandtotal));
        $("#txt_grandtotal").text("Rp "+numberWithCommas(grandtotal));
        $("#txt_grandtotal_final").text("Rp "+numberWithCommas(grandtotal));
     });

     $(document).on('click', '.payment_id', function () {
        var payment_id = $(this).data('id');
        var payment_name = $(this).data('name');
        var payment_desc = $(this).data('desc');
        var payment_logo = $(this).data('image');
        var payment_fee = $(this).data('fee');

        $("#payment_id").val(payment_id);
        $("#payment_image").attr("src", payment_logo);
        $("#payment_name").text(payment_name);
        $("#payment_desc").text(payment_desc);
        $("#txt_biaya_admin_final").text("Rp "+numberWithCommas(payment_fee));
        $("#admin_fee").val(payment_fee);
     });
    </script>
    @include('layouts.redirect_notification')
    </body>
</html>
