@section('title', env('APP_NAME') .' | Produk')
@include('layouts.header')
<div class="content-wrap">
    <section class="breadcrumbs-wrap">
        <div class="container-fluid breadcrumb-whitesmoke">
            <div class="container no-padding">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item "><a href="{{url('beranda')}}" class="color-primary"><i class="fa fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Search Produk</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

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
        @if($error_category != "")
        <div class="alert-group" style="width:100%">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="margin-left:10px">×</button>
                <strong>Error!</strong> get category<br>
                <a data-toggle="collapse" href="#collapseCategory" role="button" aria-expanded="false" aria-controls="collapseCategory">
                    Detail
                </a>
                <div class="collapse" id="collapseCategory">
                    <div class="card card-body">
                        {{$error_category}}
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
                <strong>Error!</strong> get category<br>
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

    <!-- kategori -->
    <div class="container category">
        <div class="row">
            <div class="col-sm-12 main-contents">
                <div class="nonloop owl-carousel owl-theme">

                    @foreach ($category as $data_category)
                    <div class="item">
                        <!--<div class="item-category">-->
                        <a href="{{url('product/searchByTag/'.$data_category['category_id'])}}" class="col category-product">
                            <div class="circle-wrap" style="height:80px;width:80px">
                                @if(url_exists($data_category['category_image']))
                                <img class="img-responsive" src="{{$data_category['category_image']}}" alt="" style="height:80px;width:80px">
                                @else
                                <img class="img-responsive" src="<?php echo URL::to('/'); ?>/assets/img/img-default.jpg" alt="" style="height:80px;width:80px">
                                @endif
                            </div>
                            <label>{{$data_category['category_name']}}</label>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="owl-theme">
                    <div class="owl-controls">
                        <div class="custom-nav owl-nav"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- produk -->
    <section>
        <div class="container">
            <div class="form-inline section-text">
                <a href="#"><strong class="">Hasil pencarian produk </strong></a>
                <span class="right-filter">
                    <!--<a href="#"><i class="ic-sort"></i></a>-->
                    <a href="#"><i class="ic-filter open_modal_sorting"></i></a>
                </span>
            </div>

            @if(count((array)$product) < 1)
            <div class="row">
                <div class="col-sm-4">&nbsp;</div>
                <div class="col-sm-4">
                    <center>
                      <img src="<?php echo URL::to('/'); ?>/assets/img/img-default.jpg" style="width:300px;height:300px;">
                      <div style="color:#999;">Opps... produk yang anda cari tidak ditemukan</div>
                    </center>
                </div>
                <div class="col-sm-4">&nbsp;</div>
            </div>
            <br><br>
            <!--<p style="color: red; font-family: sans-serif;">Produk yang anda cari tidak ditemukan</p>-->
            @else
            <div class="row">
                @foreach($product as $data_product)
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
<!--                                    <form class="form-btn-chat" action="#" method="post" style="padding-bottom: 5px;">
                                        <input type="hidden" name="product_id" value="{{$data_product['product_id']}}"/>
                                        <input type="hidden" name="user_id" value="{{Session::get('user_id')}}"/>
                                        <button class="btn btn-warning btn-block" type="submit" style="color: white;">Chat</button>
                                    </form>
                                    @if($data_product['product_stock'] == "0" || $data_product['product_stock'] == 0)
                                    <a class="btn btn-danger btn-block" >Kosong</a>
                                    @else
                                    <a class="btn btn-primary btn-block open_modal_product" data-id="{{$data_product['product_id']}}" data-stock="{{$data_product['product_stock']}}" data-user="10" data-agent="0" >Beli</a>
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
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <!-- Button trigger modal -->
    @if($total_cart != 0)
    <button type="button" class="btn btn-cart" data-toggle="modal" data-target="#shoppingCart" data-backdrop="static" data-keyboard="false" data-badge="{{$total_cart}}">
        <i class="ic-shop-cart"></i>
    </button>
    @else
    <button type="button" class="btn btn-cart" data-toggle="modal" data-target="#shoppingCart" data-backdrop="static" data-keyboard="false">
        <i class="ic-shop-cart"></i>
    </button>
    @endif
</div>

<div id="modal_sorting" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="failedPickingFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row">
                        <h4 style="margin-bottom: 5px;">Urutkan Berdasarkan</h4>
                    </div>
                </div>
                <button type="button" id="closeModalEdit" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container no-padding">
                    <div class="btn-group-toggle">
                        <div class="varian-wrap">

                            <div class="container">
                                <form id="formSorting" role="form" method="post" action="" class="form-style" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <input type="radio" name="sorting" id="sorting" value="nama_asc">
                                        </div>
                                        <div class="col-sm-10">
                                            Nama Produk A~Z
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="radio" name="sorting" id="sorting" value="nama_desc">
                                        </div>
                                        <div class="col-sm-10">
                                            Nama Produk Z~A
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="radio" name="sorting" id="sorting" value="harga_asc">
                                        </div>
                                        <div class="col-sm-10">
                                            Harga Termurah
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="radio" name="sorting" id="sorting" value="harga_desc">
                                        </div>
                                        <div class="col-sm-10">
                                            Harga Termahal
                                        </div>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <div class="row">
                                            <div class="col-sm-12 no-padding-left no-padding-right">
                                                <div>
                                                    <button type="submit" class="btn btn-secondary btn-block" style="width: 100%;"> <i class="fa fa-check" style="color: black;"></i> Submit </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12" style="text-align: center;">
                        <span style="color: red; font-size: 12px; font-family: sans-serif; text-align: center;" id="status_message_add_tocart"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
<script>
    $(document).on('click', '.open_modal_sorting', function () {
        $('body').addClass('loaded');
        $('#modal_sorting').modal('show');
    });
    
    $('#formSorting').on('submit', function(e) {
        e.preventDefault();

        var url = "{{ route('searchByTag', $category_id) }}";
        url = url + "?sorting="+$('input[name="sorting"]:checked').val();

        window.location.href = url;
        // var url = "{{ url('/product/searchBySortTag')}}";
        // var sorting = $('input[name="sorting"]:checked').val();

        // $.ajax({
        //     type: 'post',
        //     url: url,
        //     headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        //     data: ({
        //         "_token": "{{ csrf_token() }}",
        //         "sorting": sorting,
        //     }),
        //     success: function (r) {
        //         $('body').addClass('loaded');
        //         if (r.status != 200) {
        //             Swal.fire(
        //                 'Gagal!',
        //                 'Terjadi Kesalahan Sistem Silahkan Coba Beberapa Saat Lagi',
        //                 'error'
        //             );
        //         } else {
        //             if(r.message == 'Success'){
        //                 console.log(r);
        //             }else{
        //                 Swal.fire(
        //                     'Gagal!',
        //                     'Terjadi Kesalahan Sistem Silahkan Coba Beberapa Saat Lagi',
        //                     'error'
        //                 );
        //             }
        //         }
        //     },
        // });
    });
</script>
@include('layouts.redirect_notification')
@include('layouts.redirect_chat')
@include('layouts.modals.modal_cart')
@include('layouts.modals.modal_product')
@include('layouts.modals.wishlist')
@if(!Session::has('user_id'))
@include('layouts.modals.modal_login')
@include('layouts.modals.modal_register')
@endif
