@section('title', env('APP_NAME') .' | Detail Produk')
@include('layouts.header')
<style>
    .comment {
	width: 400px;
	/*margin: 10px;*/
    }
    a.morelink {
        text-decoration:none;
        outline: none;
    }
    .morecontent span {
        display: none;
    }
</style>
<div class="content-wrap">
    <section class="breadcrumbs-wrap">
        <div class="container-fluid breadcrumb-whitesmoke">
            <div class="container no-padding">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item "><a href="{{url('beranda')}}" class="color-primary"><i class="fa fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product[0]['product_name']}}</li>
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

    <!-- produk -->
    <section>
        <div class="container">
            <div class="form-inline section-text">
                <a href="#"><strong class="">{{ $product[0]['product_name']}} </strong></a>
            </div>

            @if(count((array) $product) < 1)
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
                <div class="col-md-4">
                    <div class="product-card-wrap"  data-id="{{$data_product['product_id']}}" data-stock="{{$data_product['product_stock']}}" data-user="10" data-agent="0">
                        <div class="product-card">
                            @if($data_product['product_discount'] > 0)
                            <span class="badge">{{$data_product['product_discount']}}</span>
                            @endif
                            @if($data_product['product_image'] == '' || $data_product['product_image'] == null || config('app.just_url_api') == $data_product['product_image'])
                                <img class="img-thumbnail card-img-top smallimg" style="height: 200px; cursor: default;" src="<?php echo URL::to('/'); ?>/assets/img/no-image.png" alt="">
                            @else
                                <img class="img-thumbnail card-img-top smallimg" style="height: 300px; width:300px; cursor: default;" src="{{$data_product['product_image']}}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-8" data-toggle="buttons">
                    <table>
                        <tr>
                            <td>Berat</td>
                            <td>:</td>
                            <td>{{$data_product['product_bruto']}} Kg</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>:</td>
                            <td>{{$data_product['category']}}</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Deskripsi</td>
                            <td style="vertical-align: top;">:</td>
                            <td>
                                <div class="comment more">
                                    <?= str_replace("\r\n","<br>",$data_product['product_description'])?>
                                </div>
                            </td>
                        </tr>
                        <tr id="rowHarga">
                            <td>Harga</td>
                            <td>:</td>
                            <td>
                                <span id="product_price_before_discount" style="font-size: 12px; margin-left: 5px; text-decoration-line: line-through;"></span>
                                <h5 id="product_price_after_discount" style="margin-top: 10px;"></h5>
                            </td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td>:</td>
                            <td id="product_stock">Pilih varian terlebih dulu</td>
                        </tr>
                        
                    </table>
                    <hr>
                    <h2><b>Lokasi Gudang</b></h2>
                    @foreach($data_product['warehouse'] as $key=>$wr)
                    <h4>{{$wr['warehouse_name']}}</h4>
                    <p>{{$wr['warehouse_kota_name']}} {{$wr['warehouse_provinsi_name']}}</p>
                    <div class="toggle-wrap">
                        <div class="container no-padding">
                            <div class="row row-toggle ">
                                @foreach($data_product['warehouse'][$key]['varian'] as $keys=>$wv)
                                <div class="col-sm-3 padding-selected" onclick="chooseVarian('{{$wv['warehouse_id']}}','{{$wv['product_id']}}', '{{$wv['varian_price_before_discount']}}', '{{$wv['varian_price_after_discount']}}', '{{$wv['varian_stock']}}', '{{$wr['warehouse_name']}}', '{{$data_product['product_image']}}', '{{$data_product['product_name']}}', '{{$wv['varian_uom']}}', '{{$wv['varian_weight']}}')">
                                    <label class="btn btn-block btn-selected">
                                        <input type="radio" name="options" id="option{{$keys}}"> {{$wv['varian_name'].' '.$wv['varian_weight'].' '.$wv['varian_uom']}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <br>
                    <div class="col-sm-4">
                        <div class="add-cart">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button type="button" id="minus" disabled class="btn btn-default btn-number btn-left" data-type="minus">
                                        <i class="ic-cart-minus"></i>
                                    </button>
                                </span>
                                <input type="text" disabled id="quantity" name="quantity" value="0" class="form-control input-number" onchange="ubahQuantity()" />
                                <span class="input-group-btn">
                                    <button type="button" id="plus" class="btn btn-default btn-number btn-right" disabled data-type="plus">
                                        <i class="ic-cart-plus"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-6">
                                <form action="#" id="form_submit_add_cart" method="POST">
                                    <input type="hidden" id="warehouse_id" name="warehouse_id" />
                                    <input type="hidden" id="warehouse_name" name="warehouse_name" />
                                    <input type="hidden" id="product_id" name="product_id" />
                                    <input type="hidden" id="product_names" name="product_names" />
                                    <input type="hidden" id="product_images" name="product_images" />
                                    <input type="hidden" id="price_before_discounts" name="price_before_discounts" />
                                    <input type="hidden" id="price" name="price" />
                                    <input type="hidden" id="stock" name="stock" />
                                    <input type="hidden" id="qty" name="qty" />
                                    <input type="hidden" id="oums" name="oums" />
                                    <input type="hidden" id="oum_values" name="oum_values" />
                                    <input type="hidden" id="url_existing" name="url_existing" />
                                    <button type="submit" id="add_cart" class="btn btn-primary btn-block" disabled><i class="ic-shop-cart"></i> Tambahkan di Keranjang</button>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                <form class="form-btn-chat" action="#" method="post" style="padding-bottom: 5px;">
                                    <input type="hidden" name="product_id" value="{{$data_product['product_id']}}"/>
                                    <input type="hidden" name="user_id" value="{{Session::get('user_id')}}"/>
                                    <button class="btn btn-warning btn-block" type="submit" style="color: white;"><i class="fa fa-comments"></i> Chat</button>
                                </form>
                            </div>
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
@include('layouts.footer')
@include('layouts.redirect_notification')
<script>
    $(document).ready(function(){
        var product_price_after_discount = "{{$product[0]['product_price_after_discount']}}";
        var product_price_before_discount = "{{$product[0]['product_price_before_discount']}}";
        $('#product_price_before_discount').text(product_price_before_discount);
        var product_discount = "{{$product[0]['product_discount']}}";
        if (product_discount == 0 || product_price_after_discount == product_price_before_discount) {
            $('#product_price_before_discount').css("display", "none");
        } else {
            $('#product_price_before_discount').css("display", "block");
        }
        $('#product_price_after_discount').text(product_price_after_discount);
        $('#minus').attr("style", "cursor: not-allowed;"); 
        $('#plus').attr("style", "cursor: not-allowed;"); 
    });
</script>
<script>
    $(document).ready(function() {
	var showChar = 200;
	var ellipsestext = "...";
	var moretext = "Baca Selengkapnya";
	var lesstext = "Tampilkan Sedikit";
	$('.more').each(function() {
            var content = $(this).html();

            if(content.length > showChar) {
                var c = content.substr(0, showChar);
                var h = content.substr(showChar-1, content.length - showChar);
                var html = c + '<span class="moreelipses">'+ellipsestext+'</span>&nbsp;<span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">'+moretext+'</a></span>';
                $(this).html(html);
            }
	});

	$(".morelink").click(function(){
            if($(this).hasClass("less")) {
                    $(this).removeClass("less");
                    $(this).html(moretext);
            } else {
                    $(this).addClass("less");
                    $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
	});
    });
</script>
@include('layouts.redirect_chat')
@include('layouts.modals.modal_cart')
@include('layouts.modals.modal_product')
@include('layouts.modals.wishlist')
@if(!Session::has('user_id'))
@include('layouts.modals.modal_login')
@include('layouts.modals.modal_register')
<!--<script>
    $(".btn-selected-new").on("click",function(){
        $(this).addClass("clicked");
    });
</script>-->
@endif