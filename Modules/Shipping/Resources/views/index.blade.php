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

        <!-- Breadcrum-->
        <section class="breadcrumbs-wrap">
            <div class="container-fluid breadcrumb-whitesmoke">
            <div class="container no-padding">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="/" class="color-primary"><i class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengiriman</li>
                </ol>
                </nav>
            </div>
            </div>
        </section>
        <!-- end Breadcrum -->

        <!-- content -->
        <section>
            <div class="container">
            <div class="row order-detail mt-4 mb-5">
                <div class="col-md-12">
                    <div class="row">
                    <div class="col-lg-8">
                        <div class="title-checkout-wrap">
                        <h3 class="card-title color-primary float-left">Pengiriman</h3>
                        <span class="float-right"> <a href="#" id="add-address" class="btn btn-secondary" data-toggle="modal"  data-target="#modal-tambah-alamat"><i class="fa fa-plus"></i> Tambah Alamat</a></span>
                        <div class="clearfix"></div>
                        </div>
                        <div class="container no-padding">
                        <ul class="list-group list-alamat mt-2">
                            <?php $i = 1;?>
                            @foreach($address as $data_address)
                            <li>
                                <input type="radio" name="RadioInputName" value="Value{{$i}}" id="Radio{{$i}}" data-id="{{$data_address['address_id']}}" class="address_id">
                                <label class="list-group-item radius-5" for="Radio{{$i}}">
                                    <h4 class="order-id">{{$data_address['address_info']}}</h4>
                                    <p>{{$data_address['address_detail']}}, {{$data_address['kelurahan_desa_name']}}, {{$data_address['kecamatan_name']}}, {{$data_address['kabupaten_kota_name']}}, {{$data_address['provinsi_name']}}</p>
                                    <div class="margin-tb10"></div>
                                    <h6>Kontak</h6>
                                    <p>{{$data_address['contact_person']}}</p>
                                    <p>{{$data_address['phone_number']}}</p>
                                </label>
                            </li>
                            <?php 
                                $i++;
                            ?>
                            @endforeach
                        </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="title-checkout-wrap">
                        <h3 class="card-title color-primary">Detail Belanja</h3>
                        </div>
                        <div class="card scroll-y">
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

                        <div class="form-group">
                        <div class="total">
                            <label class="total-text mr-md-auto float-left ">Total Belanja</label>
                            <label class="total-price float-right">Rp {{number_format($total)}}</label>
                        </div>
                        <div class="clearfix"></div>
                        </div>
                        <form action="{{url('checkout') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="id_address" name="address_id">
                            <button type="submit" id="btn_next" class="btn btn-success btn-block" >Lanjut</button>
                        </form>
                        <!-- <a href="{{url('checkout') }}" class="btn btn-success btn-block" >Lanjut</a> -->
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

    <!-- Modal Tambah Alamat -->
  <div class="modal fade" id="modal-tambah-alamat"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header no-border">
          <h3 class="modal-title  w-100 text-center color-primary">Tambah Alamat</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body max-height-500">
            <div class="container no-padding">
                <form method="post" action="#" id="form_add_address">  
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="inputEmail">Nama Alamat</label>
                    <textarea class="form-control" name="address_name" placeholder="Cth : Alamat Rumah" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail">Alamat Lengkap</label>
                    <textarea class="form-control" name="address_detail" placeholder="Alamat Anda" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail">Provinsi</label>
                    <select id="provinsi" name="provinsi_id" class="form-control" required>
                      <option selected disabled>Pilih Provinsi</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail">Kota</label>
                    <select id="kota" name="kabupaten_kota_id" class="form-control" required>
                      <option selected disabled>Pilih Kabupaten/Kota</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail">Kecamatan</label>
                    <select id="kecamatan" name="kecamatan_id" class="form-control" required>
                      <option selected disabled>Pilih Kecamatan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail">Kelurahan</label>
                    <select id="kelurahan" name="kelurahan_desa_id" class="form-control">
                      <option selected disabled>Pilih Kelurahan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail">Kode Pos</label>
                    <select id="kodepos" name="kode_pos" class="form-control" required>
                      <option selected disabled>Pilih Kode Pos</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="namaLengkap">Keterangan Alamat</label>
                    <input type="text" name="address_info" class="form-control" id="keteranganAlamat" placeholder="Cth: Rumah Warna Hijau lumut" required>
                  </div>
                  <div class="form-group">
                    <label for="namaLengkap">Nama Kontak</label>
                    <input type="text" name="contact_person" class="form-control" id="namaKontak" placeholder="Cth: Andri" required>
                  </div>
                  <div class="form-group">
                    <label for="namaLengkap">Nomor Telepon</label>
                    <input type="text" name="phone_number" class="form-control" id="nomorTelepon" placeholder="Cth: 0827377666" required>
                  </div>
                  <div class="location-map-wrap">
                    <h6 class="color-primary">Tentukan Peta Lokasi</h6>
                    <p>Pastikan lokasi peta yang anda pilih sesuai dengan alamat yang di tuju</p>
                    <input id="pac-input" class="form-control form-control-map" type="text" placeholder="Cari Alamat" style="margin-top:10px;"/>
                    <input type="hidden" name="latitude" id="latitude_address" class="form-control" required value="">
                    <input type="hidden" name="longitude" id="longitude_address" class="form-control" required value="">
                    <div id="map_canvas" style="width:100%;height:380px;margin-top:10px;"></div>
                    <!-- <div id="mapCanvas"></div> -->
                  </div>
              <div class="clearfix"></div>
            </div>
        </div>
        <div class="modal-footer no-border">
          <button  class="btn btn-primary btn-block">Simpan</button>
        </div>
    </form>
      </div>
    </div>
  </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>

    <!-- Library  -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
    <script src="<?php echo URL::to('/'); ?>/assets/js/custom.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC47jAGLaWLGMQFZejIMdE_xUHNWCh-BsM&libraries=places"></script>


    <script>
     $('#btn_next').attr("disabled", true);
     $(document).on('click', '.address_id', function () {
        var address_id = $(this).data('id');
        $("#id_address").val(address_id);
        $('#btn_next').removeAttr('disabled');
     });
    </script>

    <script>
        var marker;
        var marker_add;
        var markers = [];

        function taruhMarker_add(map_add, posisiTitik){
            if( marker_add ){
                marker_add.setPosition(posisiTitik);
            } else {
            marker_add = new google.maps.Marker({
                position: posisiTitik,
                map: map_add
            });
            }
            map_add.setCenter(posisiTitik);
            markers.push(marker_add);
            document.getElementById("latitude_address").value = marker_add.position.lat();
            document.getElementById("longitude_address").value = marker_add.position.lng();
        }

        var map_add;
        function initialize() {
            var lat= -6.1826302;
            var lng= 106.6326605;
            var propertiMap = {
                center:new google.maps. LatLng(lat,lng),
                zoom:11,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            
            map_add = new google.maps.Map(document.getElementById("map_canvas"), propertiMap);
            
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map_add.setCenter(pos);
                    taruhMarker_add(map_add, pos);
                }, function() {
                    handleLocationError(true, infoWindow, map_add.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map_add.getCenter());
            }
            // google.maps.event.addListener(map, 'click', function(event) {
            //     taruhMarker(this, event.latLng);            
            // });
            google.maps.event.addListener(map_add, 'click', function(event) {
                taruhMarker_add(this, event.latLng);
            });
            
        }
        google.maps.event.addDomListener(window, 'load', initialize);
        function addmarker(latilongi) {
            marker_add = new google.maps.Marker({
                position: latilongi,
                title: 'new marker',
                draggable: true,
                map: map_add
            });
            map_add.setCenter(marker_add.getPosition())
        }
    </script>

    <!--add address-->
    <script type="text/javascript">
        $(document).on('click', '#add-address', function () {
            $.ajax({
            type: 'GET',
                url: "{{env('URL_API')}}/" + "provinsi",
                cache: false, 
                success: function(html){
                $.each(html.data, function(key, item) {
                    $('#provinsi').append('<option value="'+item.provinsi_id+'">'+item.provinsi_name+'</option>')
                });
            }
        });

            $('#provinsi').on('change', function() {
            var url = "{{env('URL_API')}}/" + "kabkot/"+$(this).val();
            $.ajax({
                url: url,
                type: "GET",
                success: function(html){
                console.log(html);
                    $('#kota').empty().trigger('change');
                    $('#kota').append('<option value="">Pilih Kabupaten/Kota</option>')
                    $.each(html.data, function(key, item) {
                        $('#kota').append('<option value="'+item.kabupaten_kota_id+'">'+item.kabupaten_kota_name+'</option>')
                    });
                }
            });
        })

        $('#kota').on('change', function() {
            var url = "{{env('URL_API')}}/" + "kecamatan/"+$(this).val();
            console.log($(this).val());
            if ($(this).val() == null) {
                $('#kecamatan').empty().trigger('change');
                $('#kecamatan').append('<option value="">Pilih Kecamatan</option>')
            } else {
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(html){
                    console.log(html);
                        $('#kecamatan').empty().trigger('change');
                        $('#kecamatan').append('<option value="">Pilih Kecamatan</option>')
                        $.each(html.data, function(key, item) {
                            $('#kecamatan').append('<option value="'+item.kecamatan_id+'">'+item.kecamatan_name+'</option>')
                        })
                    }
                });
            }
        });

        $('#kecamatan').on('change', function() {
            var url = "{{env('URL_API')}}/" + "kelurahan/"+$(this).val();

            if ($(this).val() == null) {
                $('#kelurahan').empty().trigger('change');
                $('#kodepos').empty().trigger('change');
                $('#kelurahan').append('<option value="">Pilih Kelurahan</option>')
                $('#kodepos').append('<option value="">Pilih Kode Pos</option>')
            } else {
            $.ajax({
                url: url,
                type: "GET",
                
                success: function(html){
                    console.log(html);
                    
                    $('#kelurahan').empty().trigger('change');
                    $('#kodepos').empty().trigger('change');
                    $('#kelurahan').append('<option value="">Pilih Kelurahan</option>')
                    $('#kodepos').append('<option value="">Pilih Kode Pos</option>')
                    $.each(html.data, function(key, item) {
                        $('#kelurahan').append('<option value="'+item.kelurahan_desa_id+'">'+item.kelurahan_desa_name+'</option>')
                        $('#kodepos').append('<option value="'+item.kode_pos+'">'+item.kode_pos+'</option>')
                    })
                }
            });
            }
        });
        function selectedKabupaten($id, $value) {
            var url = "{{env('URL_API')}}/" + "kabkot/"+$id;
            $.ajax({
            url: url,
            success: function(r) {
                $('#kota').empty();
                $('#kota').append('<option value="">Pilih Kabupaten/Kota</option>')
                $.each(r.data, function(i, item){
                    $('#kota').append('<option value="'+item.kabupaten_kota_id+'">'+item.kabupaten_kota_name+'</option>')
                });
                $('#kota').val($value);
            },
            error: function(err) {
                // kabupaten.prop('disabled', true);
            }
            });
        }

        function selectedKecamatan($id, $value) {
            var url = "{{env('URL_API')}}/" + "kecamatan/"+$id;
            $.ajax({
            url: url,
            success: function(r) {
                $('#kecamatan').empty();
                $('#kecamatan').append('<option value="">Pilih Kecamatan</option>')
                $.each(r.data, function(i, item){
                    $('#kecamatan').append('<option value="'+item.kecamatan_id+'">'+item.kecamatan_name+'</option>')
                });
                $('#kecamatan').val($value);
            },
            error: function(err) {
                // kabupaten.prop('disabled', true);
            }
            });
        }

        function selectedKelurahan($id, $value, $kodepos) {
            var url = "{{env('URL_API')}}/" + "kelurahan/"+$id;
            $.ajax({
            url: url,
            success: function(r) {
                console.log(r);
                $('#kelurahan').empty();
                $('#kodepos').empty();
                $('#kelurahan').append('<option value="">Pilih kelurahan</option>')
                $('#kodepos').append('<option value="">Pilih Kode Pos</option>')
                $.each(r.data, function(key, item) {
                    $('#kelurahan').append('<option value="'+item.kelurahan_desa_id+'">'+item.kelurahan_desa_name+'</option>')
                    $('#kodepos').append('<option value="'+item.kode_pos+'">'+item.kode_pos+'</option>')
                });
                $('#kelurahan').val($value);
                $('#kodepos').val($kodepos);
            },
            error: function(err) {
                // kabupaten.prop('disabled', true);
            }
            });
        }
        });
    </script>


    <script>
        $('#form_add_address').submit(function (e) {
            e.preventDefault();
            console.log($(this).serialize());
            $.ajax({
                type: "POST",
                url: "{{ url('/shipping/addAddress') }}",
                data: $(this).serialize(),
                success: function (r) {
                    if (r.code != 200) {
                    alert(r.message);
                    } else {
                        $('modal-tambah-alamat').modal('hide');
                        alert(r.message);
                        window.location = "{{ url('/shipping') }}";
                    }
                }
            });
        });
    </script>
    @include('layouts.redirect_notification')
    @include('layouts.redirect_chat')

    </body>
</html>
