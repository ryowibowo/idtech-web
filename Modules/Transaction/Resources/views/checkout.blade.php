
@section('title', env('APP_NAME') .' | Checkout')
@include('layouts.header')
<section class="breadcrumbs-wrap">
    <div class="container-fluid breadcrumb-whitesmoke">
    <div class="container no-padding">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="/" class="color-primary"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item "><a href="{{url('transaction/shipping')}}" class="color-primary">Pengiriman</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
        </nav>
    </div>
    </div>
</section>
<input type="hidden" id="sub_total" value="{{$subtotal}}">
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
                <h3 class="card-title color-primary">Detil Belanja</h3>
                </div>
                <div class="card scroll-y margin-b20 max-height-300">
                    <ul class="list-group order-produk">
                    @php $out_of_stock=0; @endphp
                    @foreach($cart as $key=>$data_cart)
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
                        <div class="subtotal-wrap">
                            <button class="btn_shipment btn btn-lg btn-gray-line btn-block" data-toggle="modal" data-warehouse="{{$data_cart['warehouse_id']}}" data-target="#modal-shipment-new{{$key}}"> <p class="float-left" id="txt_shipment">Pilih Pengiriman </p><i class="fa fa-angle-right float-right"></i></button><br>
                            @foreach($insurance as $data_insurance)
                                <input type="checkbox" id="asuransi" name="asuransi" value="" data-fix="{{$data_insurance['insurance_fix']}}" data-percent="{{$data_insurance['insurance_percent']}}">
                                <label for="asuransi">Asuransi</label><br>
                            @endforeach
                            <div class="container subtotal">
                                <div class="row">
                                    <div class="col-sm-6 no-padding"><p>Total Berat</p></div>
                                    <div class="col-sm-6 no-padding"><h6 class="float-right">{{$weight}} Kg</h6></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 no-padding"><p>Ongkos Kirim</p></div>
                                    <div class="col-sm-6 no-padding"><h6 class="float-right" id="txt_ongkir_{{$data_cart['warehouse_id']}}">Rp 0</h6></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 no-padding"><p>Subtotal</p></div>
                                    <div class="col-sm-6 no-padding"><h6 class="float-right">Rp {{number_format($total)}}</h6></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    </ul>
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
                        <div class="col-sm-6 no-padding"><h6 class="float-right" id="txt_total_harga">Rp {{number_format($subtotal)}}</h6></div>
                    </div>
                    @if($ppn > 0)
                    <div class="row">
                        <div class="col-sm-6 no-padding"><p>PPN {{ $ppn_percent }}</p></div>
                        <div class="col-sm-6 no-padding"><h6 class="float-right" id="txt_total_harga">Rp {{number_format($ppn)}}</h6></div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-6 no-padding"><p class="color-red">Potongan</p></div>
                        <div class="col-sm-6 no-padding"><h6 class="color-red float-right" id="txt_potongan">-Rp 0</h6></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 no-padding"><p>Total Ongkos Kirim</p></div>
                        <div class="col-sm-6 no-padding"><h6 class="float-right" id="txt_total_ongkir">Rp 0</h6></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 no-padding"><p>Asuransi</p></div>
                        <div class="col-sm-6 no-padding"><h6 class="float-right" id="txt_asuransi">Rp 0</h6></div>
                    </div>
                </div>
                <div class="form-group">
                <div class="total">
                    <label class="total-text mr-md-auto float-left ">Total Belanja</label>
                    <label class="total-price float-right" id="total_belanja">Rp 0</label>
                </div>
                <div class="clearfix"></div>
                </div>
                <button id="btn_payment" class="btn btn-success btn-block" data-toggle="modal"  data-target="#modal-payment">Pilih Pembayaran</button>
            </div>
            </div>
        </div>
    </div>
    </div>
</section>

<!--modal shipment new-->
@foreach($cart as $keys=>$data_cart)
<div class="modal fade" id="modal-shipment-new{{$keys}}" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
                <div class="modal-header no-border">
                    <h3 class="modal-title w-100 text-center color-primary">Pilih Pengiriman</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body max-height-500 p-0">
                    <div class="container form-shipment-new">
                        @foreach($allCourier as $key=>$ac)
                        <div class="card border border-white mt-2 collapse{{$key}} card-collapse" data-id="{{$key}}">
                            <label class="btn btn-block btn-toggle mb-0" data-toggle="collapse" href="#collapse{{$key}}"
                                id="shipmentMethod{{$key}}" role="button" aria-expanded="false" aria-controls="collapse{{$key}}">
                                <input type="radio" name="options" id="option{{$key}}}">
                                <span class="float-left ">
                                    <input type="hidden" name="product_id[]" value="{{$ac['id']}}" />
                                </span>
                                <span class="float-left pt-2 pl-2 komplain-title">
                                    <h6 class="color-primary ">{{$ac["providers"]}}</h6>
                                </span>
                                <i class="servicedrop{{$key}} fa fa-angle-right float-right pt-3"></i>
                                <div class="clearfix"></div>
                            </label>
                            <div class="collapse" id="collapse{{$key}}">
                                <div class="card card-body no-border bg-light">
                                    <div class="form-row">
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <div class="toggle-wrap">
                                                <div class="container">
                                                    <div class="row row-toggle ">
                                                        <?php $z = 1;?>
                                                        @foreach($ac['data'] as $dt)
                                                        <label class="btn btn-block btn-toggle">
                                                            @if($ac['id'] == "17")
                                                                <input type="radio" name="options" id="option{{$z}}" class="shipment_method" data-id="{{$ac['id']}}" data-name="{{$dt['service_display']}}" data-code="{{$dt['service_display']}}" data-providers="JNE" data-price="{{$dt['price']}}">
                                                                <p class="float-left" >{{$dt["service_display"]}} </p> &nbsp;
                                                                <?php if($dt["etd_from"] != null):?>
                                                                    <p class="">Rp {{number_format($dt["price"])}} (Estimasi sampai : {{$dt["etd_from"]}} - {{$dt["etd_thru"]}} hari)</p></span>
                                                                <?php else:?>
                                                                    <?php if($dt['service_code'] == 'SPS19'):?>
                                                                        <p class="">Rp {{number_format($dt["price"])}} (Estimasi waktu yang sudah disepakati)</p></span>
                                                                    <?php else:?>
                                                                        <p class="">Rp {{number_format($dt["price"])}} (Estimasi sampai : Tidak diketahui)</p></span>
                                                                    <?php endif;?>
                                                                <?php endif;?>
                                                            @elseif($ac['id'] == "18")
                                                                <input type="radio" name="options" id="option{{$z}}" class="shipment_method" data-id="{{$ac['id']}}" data-name="{{$dt['product_name']}}" data-code="{{$dt['product_code']}}" data-providers="Anter Aja" data-price="{{$dt['rates']}}">
                                                                <p class="float-left" >{{$dt["product_name"]}} </p> &nbsp;
                                                                <?php 
                                                                    $estimasi = str_replace('Day', 'Hari', $dt["etd"]);
                                                                    $estimasi = str_replace('0 Hari', 'Hari Ini', $estimasi);
                                                                ?>
                                                                <p class="">Rp {{number_format($dt["rates"])}} (Estimasi sampai : {{$estimasi}})</p></span>
                                                            @endif
                                                            <div class="clearfix"></div>
                                                        </label>
                                                        <?php $z++;?>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group" style="padding-top: 20px; padding-left: 20px;">
                    <p style="text-align: left; color: red;"><i class="fa fa-info"></i> Pemesanan lewat dari jam 14:00 akan dikirimkan besok</p>
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-primary btn-block" data-dismiss="modal">Pilih</button>
                </div>
        </div>
    </div>
</div>
@endforeach
<!-- end content -->
@include('layouts.footer')
<script>
    $('#btn_payment').attr("disabled", true);
    $('#btn_payment').attr("style", "cursor: not-allowed;");
    $('.btn_shipment').click(function() {
        var warehouse_id = $(this).data('warehouse');
        $('#warehouse_id').val(warehouse_id);
        
        //shipment
        var html = "";
        html += '<div class="modal fade" id="modal_kurir_'+$(this).data('warehouse')+'"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">';
        html += '<div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">';
        html += '<div class="modal-content">';
        html += '<div class="modal-header no-border">';
        html += '<h3 class="modal-title  w-100 text-center color-primary">Pilih Pengiriman</h3>';
        html += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
        html += '<span aria-hidden="true">&times;</span>';
        html += '</button>';
        html += '</div>';
        html += '<div class="modal-body ">';
        html += '<div class="info">';
        html += '<p><i class="fa fa-info"></i>Silakan pilih kurir pengiriman</p>';
        html += '</div>';
        html += '<div class="container no-padding">';
        html += '<div class="btn-group-toggle" data-toggle="buttons">';
        html += '<div class="toggle-wrap">';
        html += '<div class="container">';
        html += '<div class="row row-toggle ">';
        html += '<?php $i = 1;?>';
        html += '@foreach($allCourier as $ac)';
        html += '<label class="btn btn-block btn-toggle">';
        html += '<input type="radio" name="options" id="option{{$i}}" class="shipment_method" data-id="{{$ac['id']}}" data-name="{{$ac['providers']}}" data-price="0">';
//        html += '<span class="float-left">';
        html += '<p class="float-left" >{{$ac["providers"]}}</p>';
        html += '<i class="fa fa-angle-right float-right"></i>';
        html += '<div class="clearfix"></div>';
        html += '</label>';
        html += '<?php $i++;?>';
        html += '@endforeach';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="clearfix"></div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="modal-footer no-border">';
        html += '<button  class="btn btn-primary btn-block" data-dismiss="modal">Pilih</button>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        $('#call_modal_shipment').html(html);
    });
</script>
<div id="call_modal_shipment"></div>
<script>
$(document).on('click', '.shipment_method', function () {
    var shipment_method_id = $(this).data('id');
    var shipment_method_name = $(this).data('name');
    var shipment_method_code = $(this).data('code');
    var shipment_method_providers = $(this).data('providers');
    var shipment_method_price = $(this).data('price');
    $("#shipment_method_id").val(shipment_method_id);
    $('#txt_shipment').text(shipment_method_providers+" - "+shipment_method_name);
//    $('#txt_shipment').text(shipment_method_providers+" - "+shipment_method_name+" - Rp. "+numberWithCommas(shipment_method_price));
    $('#txt_ongkir').text("Rp. "+numberWithCommas(shipment_method_price));
    $('#txt_total_ongkir').text("Rp. "+numberWithCommas(shipment_method_price));
    $('#txt_total_ongkir_payment').text("Rp. "+numberWithCommas(shipment_method_price));
    $('#txt_total_ongkir_payment_final').text("Rp. "+numberWithCommas(shipment_method_price));
    $('#shipment_method_price').val(shipment_method_price);
    $('#shipment_method_name').val(shipment_method_name);
    $('#shipment_method_code').val(shipment_method_code);
    $('#shipment_method_providers').val(shipment_method_providers);
    
    total_ongkir = shipment_method_price;
    grandtotal = subtotal - potongan + total_ongkir + ppn;
    $("#total_belanja").text("Rp "+numberWithCommas(grandtotal));
    $("#txt_grandtotal").text("Rp "+numberWithCommas(grandtotal));
    $("#txt_grandtotal_final").text("Rp "+numberWithCommas(grandtotal));
    $('#btn_payment').attr("disabled", false);
    $('#btn_payment').attr("style", "cursor: normal;");
});
</script>
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
              @if(count((array)$voucher) > 0)
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
                              <div class="col-sm-12 padding-selected">
                                <label class="btn btn-block btn-toggle-promo">
                                    <input type="radio" name="options" id="option" class="voucher" data-id="0" data-amount="0"> 
                                    <span class="float-left"><h5>Belanja Tanpa Voucher</h5></span>
                                    <div class="clearfix"></div>
                                </label>
                              </div>
                          </div>
                          </div>
                      </div>
                  </div>
                  <div class="clearfix"></div>
              </div>
              @else
                  <div class="info">
                      <p><i class="fa fa-frown-o"></i>Maaf, tidak ada promo hari ini</p>
                  </div>
              @endif
          </div>
          @if(count((array)$voucher) > 0)
          <div class="modal-footer no-border">
              <button  class="btn btn-primary btn-block" data-dismiss="modal">Pilih</button>
          </div>
          @endif
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
                    <p class="float-left profile-saldo">{{ @$profile->saldo }}</p>
                  </span>
                  <label class="switch float-right" >
                    <input type="checkbox" id="use_balance_toggle">
                    <span class="slider round"></span>
                  </label>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="container no-padding margin-tb20">
                <button class="btn btn-lg btn-gray-line btn-block btn_payment_method" data-toggle="modal" data-target="#modal-option-payment"> 
                  <p class="float-left">Pilih Metode Pembayaran</p>
                  <i class="fa fa-angle-right float-right"></i>
                  <div class="clearfix"></div>
                </button>
              </div>
              <div class="container no-padding margin-tb20">
                <div class="row">
                        <div class="col-sm-12 ">
                        <h5 class="color-primary no-padding">Detil Pembayaran</h5>
                        </div>
                </div>
                <div class="subtotal-payment">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6 no-padding"><p>Sub Total</p></div>
                            <div class="col-sm-6 no-padding"><h6 class="float-right">Rp {{number_format($subtotal)}}</h6></div>
                        </div>
                        @if($ppn > 0)
                        <div class="row">
                            <div class="col-sm-6 no-padding"><p>PPN {{ $ppn_percent }}</p></div>
                            <div class="col-sm-6 no-padding"><h6 class="float-right">Rp {{number_format($ppn)}}</h6></div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-6 no-padding"><p class="color-red">Potongan</p></div>
                            <div class="col-sm-6 no-padding"><h6 class="color-red float-right" id="txt_potongan_payment">-Rp 0</h6></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 no-padding"><p>Total Ongkos Kirim</p></div>
                            <div class="col-sm-6 no-padding"><h6 class="float-right" id="txt_total_ongkir_payment">Rp 0</h6></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 no-padding"><p>Asuransi</p></div>
                            <div class="col-sm-6 no-padding"><h6 class="float-right" id="txt_asuransi_payment">Rp 0</h6></div>
                        </div>
                        <div class="row"><br></div>
                        <div class="row">
                            <div class="col-sm-6 no-padding"><p>Biaya Admin</p></div>
                            <div class="col-sm-6 no-padding"><h6 class="float-right">Rp 0</h6></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 no-padding"><p>Saldo Terpakai</p></div>
                            <div class="col-sm-6 no-padding"><h6 class="float-right txt_used_saldo">-Rp 0</h6></div>
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
  <script>
    $(document).on('click', '.btn_payment_method', function () {
        $('#modal-option-payment').modal('show');
        $('#modal-payment').modal('hide');
    });
  </script>
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
                <p><i class="fa fa-info"></i> Silakan pilih metode pembayaran</p>
              </div>
              <div class="container">
                <div class="btn-group-toggle" data-toggle="buttons">
                  <div class="toggle-wrap">
                      <div class="container no-padding">
                        <div class="row row-toggle ">
                            <?php $k = 1;?>
                            @foreach($payment as $data_payment)

                            <label class="btn btn-block btn-toggle {{ $data_payment['payment_method_name'] == 'Saldo' ? 'd-none':''}}">
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
              <button  class="btn btn-primary btn-block btn_choose_payment" data-toggle="modal" data-target="#modal-payment2">Pilih</button>
          </div>
      </div>
    </div>
  </div>
  <script>
    $(document).on('click', '.btn_choose_payment', function () {    
        $('#modal-option-payment').modal('hide');
        $('#modal-payment2').modal('show');
    });
  </script>
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
          <!-- <div class="container no-padding">
            <div class="saldo-wrap">
              <span class="float-left">
                <h6 class="color-primary ">Gunakan Saldo</h6>
                <p class="float-left profile-saldo">{{ @$profile->saldo }}</p>
              </span>
              <label class="switch float-right" >
                <input type="checkbox">
                <span class="slider round"></span>
              </label>
              <div class="clearfix"></div>
            </div>
          </div> -->
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
                <h5 class="color-primary no-padding">Detil Pembayaran</h5>
              </div>
            </div>
            <div class="subtotal-payment">
              <div class="container">
              <div class="row">
                    <div class="col-sm-6 no-padding"><p>Sub Total</p></div>
                    <div class="col-sm-6 no-padding"><h6 class="float-right">Rp {{number_format($subtotal)}}</h6></div>
                </div>
                @if($ppn > 0)
                <div class="row">
                    <div class="col-sm-6 no-padding"><p>PPN {{ $ppn_percent }}</p></div>
                    <div class="col-sm-6 no-padding"><h6 class="float-right">Rp {{number_format($ppn)}}</h6></div>
                </div>
                @endif
                <div class="row">
                    <div class="col-sm-6 no-padding"><p class="color-red">Potongan</p></div>
                    <div class="col-sm-6 no-padding"><h6 class="color-red float-right" id="txt_potongan_payment_final">-Rp 0</h6></div>
                </div>
                <div class="row">
                    <div class="col-sm-6 no-padding"><p>Total Ongkos Kirim</p></div>
                    <div class="col-sm-6 no-padding"><h6 class="float-right" id="txt_total_ongkir_payment_final">Rp 0</h6></div>
                </div>
                <div class="row">
                    <div class="col-sm-6 no-padding"><p>Asuransi</p></div>
                    <div class="col-sm-6 no-padding"><h6 class="float-right" id="txt_asuransi_payment_final">Rp 0</h6></div>
                </div>
                <div class="row"><br></div>
                <div class="row">
                    <div class="col-sm-6 no-padding"><p>Biaya Admin</p></div>
                    <div class="col-sm-6 no-padding"><h6 class="float-right" id="txt_biaya_admin_final">Rp 0</h6></div>
                </div>
                <div class="row">
                    <div class="col-sm-6 no-padding"><p>Saldo Terpakai</p></div>
                    <div class="col-sm-6 no-padding"><h6 class="float-right txt_used_saldo">-Rp 0</h6></div>
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
      <br>
        <center><span style="color:red" id="message_failed_payment"></span></center>
      <br>
      <form action="#" method="POST" id="form_payment">
      {{ csrf_field() }}
        <div class="modal-footer no-border">
            <input type="hidden" name="warehouse_id" id="warehouse_id" id="warehouse_id">
            <input type="hidden" name="address_id" id="address_id" value="{{$address_id}}">
            <input type="hidden" name="shipment_method_id" id="shipment_method_id">
            <input type="hidden" name="shipment_method_price" id="shipment_method_price">
            <input type="hidden" name="shipment_method_name" id="shipment_method_name">
            <input type="hidden" name="shipment_method_code" id="shipment_method_code">
            <input type="hidden" name="shipment_method_providers" id="shipment_method_providers">
            <input type="hidden" name="voucher_id" id="voucher_id">
            <input type="hidden" name="asuransi" id="asuransi_input">
            <input type="hidden" name="payment_id" id="payment_id">
            <input type="hidden" name="admin_fee" id="admin_fee">
            <input type="hidden" name="use_balance" id="use_balance">
            <input type="hidden" name="zip_code_dest" id="zip_code_dest" value="{{$zip_code}}">
            <input type="hidden" name="weight" id="weight" value="{{$weight}}">
            <input type="hidden" name="qty" id="qty" value="{{$total_cart}}">
            <button type="submit" class="btn btn-primary btn-block" id="pay1" data-toggle="modal" data-target="#modal-bayar" >Bayar</button>           
        </div>
      </form>
  </div>
  </div>
</div>
<script>
    $(document).on('click', '.btn_payment_method', function () {
        $('#modal-option-payment').modal('show');
        $('#modal-payment2').modal('hide');
    });
  </script>
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
    <script>  
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        var subtotal = $('#sub_total').val();
        var potongan     = 0;
        var total_ongkir = 0;
        var grandtotal   = 0;
        var asuransi     = 0;
        var ppn          = parseInt("{{ $ppn }}");
        var saldo        = parseInt("{{ @$profile->total_balance}}");
        var used_saldo   = 0;


        grandtotal = subtotal - potongan + total_ongkir + ppn;
        $("#total_belanja").text("Rp "+numberWithCommas(grandtotal));
        $("#txt_grandtotal").text("Rp "+numberWithCommas(grandtotal));
        $("#txt_grandtotal_final").text("Rp "+numberWithCommas(grandtotal));
        
        $(document).on('click', '.voucher', function () {
            // if($("#asuransi").prop('checked') == true){
            //     var asuransi = 0;
            //     console.log(asuransi);
            //     asuransi = 0.2/100 * subtotal + 5000;
            // } else {
            //     asuransi = 0;
            // }
            var voucher_id = $(this).data('id');
            var voucher_amount = $(this).data('amount');
            console.log(voucher_amount);
            $("#voucher_id").val(voucher_id);
            $("#txt_potongan").text("Rp "+numberWithCommas(voucher_amount));
            $("#txt_potongan_payment").text("Rp "+numberWithCommas(voucher_amount));
            $("#txt_potongan_payment_final").text("Rp "+numberWithCommas(voucher_amount));
            potongan = voucher_amount;
            grandtotal = subtotal - potongan + total_ongkir + asuransi + ppn;
            $("#total_belanja").text("Rp "+numberWithCommas(grandtotal));
            $("#txt_grandtotal").text("Rp "+numberWithCommas(grandtotal));
            $("#txt_grandtotal_final").text("Rp "+numberWithCommas(grandtotal));
        });

        $('#asuransi').change(function() {
            if($("#asuransi").prop('checked') == true){
                // var asuransi = 0;
                var insurance_fix = $(this).data('fix');
                var insurance_percent = $(this).data('percent');
                asuransi = subtotal * insurance_percent/100 + insurance_fix;
                console.log(asuransi);
                // $("#asuransi").val(asuransi);
                $("#txt_asuransi").text("Rp "+numberWithCommas(asuransi));
                $("#txt_asuransi_payment").text("Rp "+numberWithCommas(asuransi));
                $("#txt_asuransi_payment_final").text("Rp "+numberWithCommas(asuransi));
                // potongan = voucher_amount;
                grandtotal = subtotal - potongan + total_ongkir + asuransi + ppn;
                $("#total_belanja").text("Rp "+numberWithCommas(grandtotal));
                $("#txt_grandtotal").text("Rp "+numberWithCommas(grandtotal));
                $("#txt_grandtotal_final").text("Rp "+numberWithCommas(grandtotal));
            }else{
                asuransi = 0;
                $("#txt_asuransi").text("Rp "+numberWithCommas(asuransi));
                grandtotal = subtotal - potongan + total_ongkir + asuransi + ppn;
                $("#total_belanja").text("Rp "+numberWithCommas(grandtotal));
                $("#txt_grandtotal").text("Rp "+numberWithCommas(grandtotal));
                $("#txt_grandtotal_final").text("Rp "+numberWithCommas(grandtotal));
            }
        });

         $('#use_balance_toggle').change(function() {
            if($("#use_balance_toggle").prop('checked') == true){
                used_saldo = saldo;
                if(saldo >= grandtotal){
                    used_saldo = grandtotal;

                    var elSaldo      = $('.payment_id[data-name=Saldo]');
                    var payment_id   = elSaldo.data('id');
                    var payment_name = elSaldo.data('name');
                    var payment_desc = elSaldo.data('desc');
                    var payment_logo = elSaldo.data('image');
                    var payment_fee  = elSaldo.data('fee');

                    grandtotal       = grandtotal - used_saldo;
                    grandtotal_final = grandtotal + payment_fee;
                    
                    if(grandtotal_final == 0){

                    }
                    $("#payment_id").val(payment_id);
                    $("#payment_image").attr("src", payment_logo);
                    $("#payment_name").text(payment_name);
                    $("#payment_desc").text(payment_desc);
                    $("#txt_biaya_admin_final").text("Rp "+numberWithCommas(payment_fee));
                    $("#admin_fee").val(payment_fee);
                    $("#asuransi_input").val(asuransi);

                    if(grandtotal_final > 0){
                        $("#txt_grandtotal_final").text("Rp "+numberWithCommas(grandtotal_final));
                    }else{
                        $("#txt_grandtotal_final").text("Rp "+numberWithCommas(used_saldo));
                    }
                    
                    $('#modal-option-payment').modal('hide');
                    $('#modal-payment').modal('hide');
                    $('#modal-payment2').modal('show');

                    $('.txt_used_saldo').html("-Rp "+numberWithCommas(used_saldo));
                }else{
                    grandtotal = grandtotal-used_saldo;
                    
                    $('#txt_grandtotal').html("Rp "+numberWithCommas(grandtotal));
                    $('.txt_used_saldo').html("-Rp "+numberWithCommas(used_saldo));
                }

                $('#use_balance').val(1);
            }else{
                grandtotal = grandtotal+used_saldo;
                used_saldo = 0;

                $('#txt_grandtotal').html("Rp "+numberWithCommas(grandtotal));
                $('.txt_used_saldo').html("-Rp "+numberWithCommas(used_saldo));
                $('#use_balance').val(0);
            }
        });

        $('#modal-payment2').on('hidden.bs.modal', function (e) {
            if($("#use_balance_toggle").prop('checked') == true){
                $('#use_balance_toggle').click();
            }
        });

        $(document).on('click', '.payment_id', function () {
            var payment_id = $(this).data('id');
            var payment_name = $(this).data('name');
            var payment_desc = $(this).data('desc');
            var payment_logo = $(this).data('image');
            var payment_fee = $(this).data('fee');
            grandtotal_final = grandtotal + payment_fee;
            
            $("#payment_id").val(payment_id);
            $("#payment_image").attr("src", payment_logo);
            $("#payment_name").text(payment_name);
            $("#payment_desc").text(payment_desc);
            $("#txt_biaya_admin_final").text("Rp "+numberWithCommas(payment_fee));
            $("#admin_fee").val(payment_fee);
            $("#asuransi_input").val(asuransi);
            $("#txt_grandtotal_final").text("Rp "+numberWithCommas(grandtotal_final));
        });
    </script>
    <script>
    $('#form_payment').submit(function (e) {
        e.preventDefault();
        @if($out_of_stock > 0)
            Swal.fire(
                'Gagal!',
                'Stok tidak tersedia',
                'error'
            );
        @else
            $('body').removeClass('loaded');
            $('#modal-payment2').modal('hide');
            $.ajax({
                type: "POST",
                url: "{{ url('/transaction/order')}}",
                data: $(this).serialize(),
                success: function (r) {
                    console.log(r);
                    $('body').addClass('loaded');
                    if (r.code == 200) {
                        if (r.isSuccess == true) {
                            // Swal.fire(
                            //     'Berhasil',
                            //     'Transaksi berhasil diproses!',
                            //     'success'
                            // );
                            document.getElementById("message_failed_payment").innerHTML = "";
                            window.location = r.redirect_url;
                        }else{
                            Swal.fire(
                                'Gagal',
                                r.message,
                                'error'
                            );
                            location.reload();
                            // $('#modal-payment2').modal('show');
                            // document.getElementById("message_failed_payment").innerHTML = r.message;
                        }
                    } else {
//                        Swal.fire(
//                            'Gagal',
//                            'Telah terjadi kegagalan sistem, silakan coba lagi!',
//                            'error'
//                        );
                        Swal.fire(
                            'Gagal',
                            'Sistem sedang maintenance, harap coba di lain waktu, terima kasih',
                            'error'
                        );
                        // $('#modal-payment2').modal('show');
                        // document.getElementById("message_failed_payment").innerHTML = r.code;
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    console.log('ee');
                    $('body').addClass('loaded');
                    alert("Status: " + textStatus); 
                    alert("Error: " + errorThrown); 
                }
            });
        @endif
    });

    $('#form_complaint').submit(function (e) {
        e.preventDefault();
  
        $('body').removeClass('loaded');
        $('#modal-komplain').modal('hide');
        
        $.ajax({
            type: "POST",
            url: "{{ url('/transaction/order')}}",
            data: $(this).serialize(),
            success: function (r) {
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log('ee');
                $('body').addClass('loaded');
                alert("Status: " + textStatus); 
                alert("Error: " + errorThrown); 
            }
        });
    });
    </script>
    @foreach($allCourier as $key => $val)
        <script>
            var classCollapse{{$key}} = ".collapse" + "{{$key}}";
            var classServiceDrop{{$key}} = ".servicedrop" + "{{$key}}";
            $(document).ready(function() {
                $(classCollapse{{$key}}).on('show.bs.collapse', function(e) {
                    $(classServiceDrop{{$key}}).addClass('fa-angle-down').removeClass('fa-angle-right');
                });

                $(classCollapse{{$key}}).on('hide.bs.collapse', function() {
                    $(classServiceDrop{{$key}}).addClass('fa-angle-right').removeClass('fa-angle-down');
                });
            });
        </script>
    @endforeach
    @include('layouts.redirect_notification')
    @include('layouts.redirect_chat')