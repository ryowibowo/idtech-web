@section('title', env('APP_NAME') .' | Pengiriman')
@include('layouts.header')
<section class="breadcrumbs-wrap margin-b40">
  <div class="container-fluid background-gray-blue">
    <div class="container no-padding">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item "><a href="{{url('beranda')}}" class="color-primary"><i class="fa fa-home"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">Pengiriman</li>
        </ol>
      </nav>
    </div>
  </div>
</section>

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
                        <input type="radio" name="RadioInputName" value="Value{{$i}}" id="Radio{{$i}}" data-id="{{$data_address['address_id']}}" class="address_id" {{ $data_address['isMain'] ? 'checked' : ''}}>
                        <label class="list-group-item radius-5" for="Radio{{$i}}">
                            <h4 class="order-id">{{$data_address['address_info']}} 
                                @if($data_address['isMain'])
                                    <span id="isMain" class="text-danger">(Alamat Utama)</span>
                                @endif
                            </h4>
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
                    @php $out_of_stock=0; @endphp
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
                            @if($data_varian['out_of_stock'])
                                @php $out_of_stock++; @endphp
                                <div class="container no-padding">
                                    <label class="text-danger">Stok tidak tersedia!</label>
                                </div>
                            @endif
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </li>
                    @endforeach
                </ul>
                </div>

                <div class="form-group">
                <div class="total">
                    <label class="total-text mr-md-auto float-left ">Total Belanja</label>
                    <label class="total-price float-right">Rp {{number_format($subtotal)}}</label>
                </div>
                <div class="clearfix"></div>
                </div>
                <form id="formTransactionCheckout" action="{{url('transaction/checkout') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_address" name="address_id">
                    <input type="hidden" id="subtotal" name="subtotal" value="{{$subtotal}}">
                    <button id="btn_next" class="btn btn-success btn-block" >Lanjut</button>
                </form>
                <!--<a href="{{url('transaction/checkout') }}" class="btn btn-success btn-block" >Lanjut</a>-->
            </div>
            </div>
        </div>
    </div>
    </div>
</section>
@include('layouts.footer')
@include('layouts.modals.modal_add_address')

<script>
    $('#btn_next').attr("disabled", true);
    $('#btn_next').attr("style", "cursor: not-allowed;");
    $(document).on('click', '.address_id', function () {
        var address_id = $(this).data('id');
        $("#id_address").val(address_id);
        $('#btn_next').removeAttr('disabled');
        $('#btn_next').attr("style", "cursor: normal;");
    });

    $(document).on('click', '#btn_next', function(e){
        e.preventDefault();
        @if($out_of_stock > 0)
            Swal.fire(
                'Gagal!',
                'Stok tidak tersedia',
                'error'
            );
        @else
            $( "form#formTransactionCheckout" ).submit();
        @endif
    });

    @foreach($address as $data_address)

        @if($data_address['isMain'])
            $('input[data-id={{$data_address["address_id"]}}]').click();
        @endif
    @endforeach
</script>



<script>
$(document).on('click', '.btn-ok-address', function () {
  $(".modal-address").modal('hide');
  window.location = "{{ url('/profile/address') }}";
});
</script>

<div class="modal fade modal-address" id="modal-success-address" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center>
                  <img src="<?php echo URL::to('/'); ?>/assets/img/img_success.png" style="width:150px;height:150px;margin-bottom:20px">
                  <div style="color:#666;"><span id="message-success-address">Yeayyy... Sukses</span></div>
                </center>
            </div>
            <div class="modal-footer no-border">
                <a class="btn btn-primary btn-block btn-ok-address" data-dismiss="modal-success-address" class="">Oke, siap</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-address"id="modal-failed-address" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center>
                  <img src="<?php echo URL::to('/'); ?>/assets/img/img_failed.png" style="width:150px;height:150px;margin-bottom:20px">
                  <div style="color:#666;" id="message-failed-address"><span id="message-failed-address">Yahhh... Gagal</span></div>
                </center>
            </div>
            <div class="modal-footer no-border">
                <a class="btn btn-primary btn-block btn-ok-address" data-dismiss="modal-failed-address">Oke, siap</a>
            </div>
        </div>
    </div>
</div>
@include('layouts.redirect_notification')
@include('layouts.redirect_chat')

