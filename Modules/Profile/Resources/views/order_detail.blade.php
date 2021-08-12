@section('title', env('APP_NAME') .' | Detail Transaksi')
@include('layouts.header')
<style>
#imagePreviewComplaintSatu,
#imagePreviewComplaintDua,
#imagePreviewComplaintTiga {
    width: 100px;
    height: 100px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    background-image: url('https://cdn1.iconfinder.com/data/icons/linkedin-ui-glyph/48/Sed-16-512.png');
}

.modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}

.breakdown-subtotal{
    margin-left: 1px;
    color: grey;
}
.text-grey{
    color: grey;
}
</style>
<section class="breadcrumbs-wrap margin-b20">
    <div class="container-fluid  breadcrumb-whitesmoke">
        <div class="container no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="index.html" class="color-primary"><i
                                class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ url('/profile/history') }}">Riwayat</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Order
                        #{{$transaction_detail->order_code}}</li>
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
                        @if($transaction_detail->payment_method_id == 17 && $transaction_detail->order_status_id == 5)
                        <div class="alert alert-danger" role="alert">
                            Mohon selesaikan pembayaran Anda sebelum tanggal {{$payment_order->expired_date}} WIB dengan
                            rincian sebagai berikut
                        </div>
                        <div class="container no-padding">
                            <div class="detil-wrap">
                                <ul class="list-group list-group-flush ">
                                    <li class="list-group-item">
                                        <div class="alert alert-info" role="info">
                                            Harap Transfer ke Rekening yang tersedia dibawah ini
                                        </div>
                                        @if(count((array) $rekening) > 0)
                                        @foreach ($rekening as $data_rekening)
                                    <li class="list-group-item">
                                        <label class="order-left"><b>{{$data_rekening['bank_name']}}
                                                ({{$data_rekening['person_name']}})</b></label>
                                        <label class="order-right">{{$data_rekening['account_number']}}</label>
                                    </li>
                                    @endforeach
                                    @else
                                    <li class="list-group-item">
                                        <label class="order-left"><b>Harap hubungi admin kami untuk no rekening
                                                tujuannya, terima kasih</b></label>
                                    </li>
                                    @endif
                                    </li>
                                    <li class="list-group-item">
                                        <label class="order-left">Jumlah yang harus dibayar</label>
                                        <label class="order-right">Rp.
                                            {{number_format($payment_order->grand_total)}}</label>
                                    </li>
                                    @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @elseif($message = Session::get('failed'))
                                    <div class="alert alert-danger alert-block">
                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @endif
                                    <form action="{{ url('/profile/updatePembayaran') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="card-body no-pad-bot">
                                            <div class="text-center mb-5">
                                                <div class="login-profile">
                                                    <input type="hidden" name="order_id"
                                                        value="{{$transaction_detail->order_id}}">
                                                    <input type="hidden" name="billing_code"
                                                        value="{{$transaction_detail->billing_code}}">
                                                    @if($pembayaran->upload_pembayaran != null ||
                                                    $pembayaran->upload_pembayaran != '')
                                                    <img id="imageResult" src="{{$pembayaran->upload_pembayaran}}"
                                                        alt="pembayaran" class="img-responsive" style="width: 50%">
                                                    {{-- <p>{{$profile->user_name}}</p> --}}
                                                    @endif
                                                    <input id="upload" type="file" name="upload_pembayaran"
                                                        onchange="readURL(this);" class="form-control border-0">
                                                </div>
                                            </div>
                                            <div><span style="color:red" id="message_profile"></span></div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-success btn-block"
                                                    onclick="window.location.href ='{{ url('/profile/history') }}';">Upload
                                                    Pembayaran</button>
                                            </div>
                                    </form>
                                </ul>
                            </div>
                            <br>
                            <div class="float-right no-padding res-multi-btn res-btn">
                                <div class="no-pad-right res-no-pad-xs display-inline-block">
                                    <a href=" {{ url('profile/invoice/'.$transaction_detail->order_id) }} "
                                        target="_blank" class="btn btn-print btn-success"><i
                                            class="fa fa-print"></i>&nbsp; Proforma Invoice</a>
                                    {{-- <button type="button" class="btn btn-print btn-info" id="submitPackingDetailButton"  {{ $order_master->is_printed_invoice == 1 ? 'disabled' : '' }}>><i
                                        class="fa fa-print"></i>Cetak Invoice</button> --}}
                                </div>
                            </div>
                            <br>
                        </div>
                        <br>
                        @elseif($transaction_detail->order_status_id == 5)
                        <div class="alert alert-danger" role="alert">
                            Mohon selesaikan pembayaran Anda sebelum tanggal {{$payment_order->expired_date}} WIB dengan
                            rincian sebagai berikut
                        </div>
                        <div class="container no-padding">
                            <div class="detil-wrap">
                                <ul class="list-group list-group-flush ">
                                    <li class="list-group-item">
                                        <label class="order-left">Transfer ke {{$payment_order->payment_type}}</label>
                                        <label class="order-right">{{$payment_order->account_number}}</label>
                                    </li>
                                    <li class="list-group-item">
                                        <label class="order-left">Jumlah yang harus dibayar</label>
                                        <label class="order-right">Rp.
                                            {{number_format($payment_order->grand_total)}}</label>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ $payment_order->payment_url }}" class="btn btn-success btn-block" style="margin-top:10px;">Selesaikan Pembayaran</a>
                                    </li>
                                    
                                    <!-- ddd -->
                                </ul>
                            </div>
                        </div>
                        <br>
                        @endif
                        <div class="title-checkout-wrap">
                            <h3 class="card-title color-primary float-left">Detail Order</h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="container no-padding">
                            <div class="detil-wrap">
                                <ul class="list-group list-group-flush ">
                                    <li class="list-group-item">
                                        <label class="order-left">ID Pesanan</label>
                                        <label class="order-right">{{$transaction_detail->order_code}}</label>
                                    </li>
                                    <li class="list-group-item">
                                        <label class="order-left">Tanggal</label>
                                        <label class="order-right">{{$transaction_detail->order_date}} WIB</label>
                                    </li>
                                    <li class="list-group-item">
                                        <label class="order-left">Pembayaran</label>
                                        <label class="order-right">{{$transaction_detail->payment_method_name}}</label>
                                    </li>
                                    <li class="list-group-item">
                                        <label class="order-left">Kontak</label>
                                        <label class="order-right">{{$transaction_detail->buyer_user_name}}</label>
                                    </li>
                                    <li class="list-group-item">
                                        <label class="order-left">Nomor HP</label>
                                        <label
                                            class="order-right">{{$transaction_detail->buyer_user_phone_number}}</label>
                                    </li>
                                    <li class="list-group-item">
                                        <label class="order-left">Email</label>
                                        <label class="order-right">{{$transaction_detail->buyer_user_email}}</label>
                                    </li>
                                    <li class="list-group-item">
                                        <label class="order-left">Alamat</label>
                                        <label class="order-right">{{$address->detail}}, <br />
                                            {{$address->district}}<br />
                                            Kecamatan {{$address->regency}}<br />
                                            kab/Kota {{$address->village}}<br />
                                            Provinsi {{$address->province}}<br />
                                            Kode Pos {{$address->postal_code}}<br />
                                        </label>
                                    </li>
                                    <li class="list-group-item">
                                        <label class="order-left">Status</label>
                                        @if ($transaction_detail->order_status_id == 4)
                                        <label
                                            class="order-right order-selesai">{{$transaction_detail->order_status_name}}</label>
                                        @else
                                        <label
                                            class="order-right order-proses">{{$transaction_detail->order_status_name}}</label>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="title-checkout-wrap margin-b20">
                            <h3 class="card-title color-primary"> Detail Belanja</h3>
                        </div>
                        <div class="card scroll-y margin-b20">
                            <ul class="list-group order-produk">
                                @foreach ($order_detail as $row)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="img-circle img-responsive" alt=""
                                                src="{{$row['product_image']}}">
                                        </div>
                                        <div class="col-md-9 item-amount">
                                            <h5>{{$row["product_name"]}}</h5>
                                            <div class="container no-padding">
                                                <div class="row">
                                                    <div class="col-sm-6 ">
                                                        <p>Rp.{{$row["purchased_price"]}} x
                                                            {{$row["purchased_quantity"]}}</p>
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <label class="float-right">Rp.{{$row["total_order"]}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                                <br />
                                <div style="padding:10px;">
                                    <div class="row">
                                        <div class="col-sm-6 ">
                                            <label class="float-left">Subtotal</label>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <label
                                                class="float-right"><b>Rp.{{$transaction_detail->total_price}}</b></label>
                                        </div>
                                    </div>
                                    @if($transaction_detail->pricing_include_tax)
                                    <div class="row breakdown-subtotal">
                                        <div class="col-sm-6 ">
                                            <label class="float-left">Dasar Pengenaan Pajak</label>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <label
                                                class="float-right">Rp.{{$transaction_detail->tax_basis}}</label>
                                        </div>
                                    </div>
                                    <div class="row breakdown-subtotal">
                                        <div class="col-sm-6 ">
                                            <label class="float-left">PPN {{ $transaction_detail->national_income_tax_percentage }}</label>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <label
                                                class="float-right">Rp.{{$transaction_detail->national_income_tax}}</label>
                                        </div>
                                    </div>
                                    @else
                                    <div class="row">
                                        <div class="col-sm-6 ">
                                            <label class="float-left">PPN {{ $transaction_detail->national_income_tax_percentage }}</label>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <label
                                                class="float-right"><b>Rp.{{$transaction_detail->national_income_tax}}</b></label>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-sm-6 ">
                                            <label class="float-left">Ongkos Kirim</label>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <label class="float-right">Rp.{{$transaction_detail->delivery_fee}}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 ">
                                            <label class="float-left">Biaya Admin</label>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <label
                                                class="float-right">Rp.{{ $transaction_detail->admin_fee }}</label>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-6 ">
                                            <label class="float-left">Asuransi</label>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <label class="float-right">Rp.{{$transaction_detail->asuransi}}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 ">
                                            <label class="float-left">Voucher</label>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <label class="float-right">
                                                -Rp.{{ $transaction_detail->discount }}
                                            </label>
                                        </div>
                                    </div>
                                    @if(intval($transaction_detail->detail_payment['balance_used']) > 0 && $transaction_detail->grandtotal_payment != "0")
                                    <div class="row">
                                        <div class="col-sm-6 ">
                                            <label class="float-left">Saldo terpakai</label>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <label class="float-right">
                                                -Rp.{{ $transaction_detail->detail_payment['balance_used'] }}
                                            </label>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </ul>
                        </div>
                        <div class="form-group">
                            <div class="total">
                                <label class="total-text mr-md-auto float-left ">Total Belanja</label>
                                <label class="total-price float-right">
                                    @if($transaction_detail->grandtotal_payment == "0")
                                        <b>Rp.{{$transaction_detail->detail_payment['balance_used']}}</b>
                                    @else
                                        <b>Rp.{{$transaction_detail->grandtotal_payment}}</b>
                                    @endif
                                </label>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        @if($transaction_detail->order_status_id == 3)
                        <form action="#" method="post" id="form_confirm">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$transaction_detail->order_id}}">
                            <button type="submit" class="btn btn-success btn-block">Konfirmasi Selesai</button>
                        </form>
                        <!-- <a href="javascript:void(0)" class="btn btn-secondary-line btn-block" data-toggle="modal"
                            data-target="#modal-komplain" style="margin-top:10px;">Komplain</a> -->
                            @if(empty($transaction_detail->complaint))
                                <a class="btn btn-secondary-line btn-block" id="btn_complaint" style="margin-top:10px;">Komplain</a>
                            @else
                                <a class="btn btn-secondary-line btn-block" id="btn_complaint" style="margin-top:10px;">Lihat Komplain</a>
                            @endif
                        <!--<a href="javascript:void(0)" class="btn btn-secondary-line btn-block open_modal_komplain" data-id="{{$transaction_detail->order_id}}" style="margin-top:10px;">Komplain</a>-->
                        @else
                        <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-lacak"
                            style="margin-bottom:10px;">Lacak Pesanan</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.footer')
@include('layouts.redirect_notification')

<!-- Modal Lacak Pesanan -->
<div class="modal fade" id="modal-lacak" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header no-border">
                <h4 class="modal-title w-100 text-center color-primary" id="exampleModalLabel">Lacak Pesanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card align-items-center no-border">
                    <ul class="timeline-icon">
                        <li class="active">
                            <div class="icon-circle">
                                @if($transaction_detail->order_status_id == 1 || $transaction_detail->order_status_id ==
                                2 || $transaction_detail->order_status_id == 3 || $transaction_detail->order_status_id
                                == 4)
                                <i class="ic-diproses-a"></i>
                                @else
                                <i class="ic-diproses"></i>
                                @endif
                            </div>
                            <p>Diproses</p>
                        </li>
                        <li>
                            <div class="icon-circle">
                                @if($transaction_detail->order_status_id == 2 || $transaction_detail->order_status_id ==
                                3 || $transaction_detail->order_status_id == 4)
                                <i class="ic-dikirim-a"></i>
                                @else
                                <i class="ic-dikirim"></i>
                                @endif
                            </div>
                            <p>Dikirim</p>
                        </li>
                        <li>
                            <div class="icon-circle">
                                @if($transaction_detail->order_status_id == 3 || $transaction_detail->order_status_id ==
                                4)
                                <i class="ic-sampai-a"></i>
                                @else
                                <i class="ic-sampai"></i>
                                @endif
                            </div>
                            <p>Sampai</p>
                        </li>
                        <li>
                            <div class="icon-circle">
                                @if($transaction_detail->order_status_id == 4)
                                <i class="ic-selesai-a"></i>
                                @else
                                <i class="ic-selesai"></i>
                                @endif
                            </div>
                            <p>Selesai</p>
                        </li>
                    </ul>

                    <ul class="timeline">
                        @foreach ($order_tracking as $row)
                        <li class="active">
                            <p><b>{{$row['order_status_name']}}</b></p>
                            <p>{{$row['order_status_description']}}</p>
                            <p>{{$row['created_date']}}</p>
                            @if($row['order_status_name'] == 'Pesanan Dikirim')
                            <p><b>Tracing Detail : </b></p>
                            <ul class="timeline">
                                @if(!empty($tracing))
                                    @foreach ($tracing->history as $rows)
                                   
                                    <li class="active">
                                        @if($shipment_method_id == 17)
                                            <p>{{ $rows['desc'] }}</p>
                                            <p>{{date('d-m-Y H:i', strtotime($rows['date']))}}</p>
                                        @elseif($shipment_method_id == 18)
                                            <p>{{$rows['message']['id']}}</p>
                                            <p>{{date('d-m-Y H:i', strtotime($rows['timestamp']))}}</p>
                                        @else
                                            <p style="color: red;"><b>Terjadi kesalahan dalam pemilihan kurir pengiriman, harap hubungi admin kami.</b></p>
                                        @endif
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="modal-footer no-border">
                <a href="{{ url('/beranda') }}" class="btn btn-primary btn-block" data-toggle="dismis">Pesan Lagi</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-komplain" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form action="{{ url('/profile/complaint') }}" method="post" enctype="multipart/form-data" id="form_complaint">
                {{ csrf_field() }}
                <input type="hidden" name="invoice_no" value="{{ $transaction_detail->billing_code }}"> 
                <input type="hidden" name="order_id" value="{{ $transaction_detail->order_id }}"> 
                <div class="modal-header no-border">
                    <h3 class="modal-title w-100 text-center color-primary">Komplain</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body max-height-500 p-0">
                    <div class="container form-komplain">
                        <div class="form-group" id="komplain">
                            <label for="inputEmail">Kode Pesanan</label>
                            <p><b>{{$transaction_detail->order_code}}</b></p>
                        </div>
                        <label class="mb-0">Pilih Produk Bermasalah</label>
                        @foreach ($order_detail as $key=>$row)
                        <div class="card border border-white mt-2 collapse{{$key}} card-collapse" data-id="{{$key}}">
                            <label class="btn btn-block btn-toggle mb-0" data-toggle="collapse" href="#collapse{{$key}}"
                                id="productComplaint{{$key}}" role="button" aria-expanded="false"
                                aria-controls="collapse{{$key}}">
                                <input type="radio" name="options" id="option{{$key}}}">
                                <span class="float-left ">
                                    <img src="{{$row['product_image']}}" alt="..." width="60">
                                    <input type="hidden" name="product_id[]" value="{{$row['product_id']}}" />
                                </span>
                                <span class="float-left pt-2 pl-2 komplain-title">
                                    <h6 class="color-primary ">{{$row["product_name"]}}</h6>
                                    <p class="float-left">{{$row["purchased_quantity"]}} x {{$row['product_weight']}}
                                        {{$row['product_weight_ons']}}</p>
                                    <p class="float-left ml-3">Rp {{$row['total_purchased_per_item']}}</p>
                                </span>
                                <i class="servicedrop{{$key}} fa fa-angle-right float-right pt-3"></i>
                                <div class="clearfix"></div>
                            </label>
                            <div class="collapse" id="collapse{{$key}}">
                                <div class="card card-body no-border bg-light">
                                    <div class="form-row">
                                        <div class="form-group col-9">
                                            <label>Masalah <span class="text-danger">*</span></label>
                                            <select id="issue_category_id{{$key}}" name="issue_category[]"
                                                class="form-control" onchange="counter_complaints(event);">
                                                <option value="">Pilih Masalah</option>
                                                @foreach($issue_category as $ic)
                                                <option value="{{ $ic['issue_category_id']}}">
                                                    {{ $ic['issue_category_name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="inputState">Jumlah</label>
                                            <select id="quantity{{$key}}" name="product_qty[]" class="form-control">
                                                <?php for($i=1; $i<=$row['purchased_quantity']; $i++){?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail">Detail Masalah <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="notes{{$key}}" name="notes[]"></textarea>
                                        <input type="hidden" name="order_id" value="{{$transaction_detail->order_id}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <br>
                        <div class="form-group mb-0">
                            <label for="inputEmail">Solusi Diinginkan <span class="text-danger">*</span></label>
                            <select id="issue_solution" name="issue_solution" class="form-control" required>
                                <option value="">Pilih Solusi</option>
                                @foreach($issue_solution as $is)
                                <option value="{{$is['issue_solution_id']}}">{{$is['issue_solution_name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inputEmail">Lampirkan Bukti (Minimal 1)</label>
                            <div class="clearfix"></div>
                            <div class="row daftar-bukti">
                                <span class="col-4">
                                    <!--<div class="img-thumbnail">-->
                                    <input id="uploadFileComplaintSatu" name="complain_pict[]" type="file"
                                        style="display: none;" />
                                    <!--sampe sini tinggal bikin upload gambar jadi di luar produk dan ada 3 gambar maksimal-->
                                    <!--<a class="btn-link my-auto" href="javascript:void(0)" id="imagePreviewComplaintSatu" style=""><i class="fa fa-camera text-muted" aria-hidden="true"></i></a>-->

                                    <div id="imagePreviewComplaintSatu"></div>
                                    <!--</div>-->
                                </span>
                                <span class="col-4">
                                    <!--<div class="img-thumbnail">-->
                                    <input id="uploadFileComplaintDua" type="file" name="complain_pict[]"
                                        style="display: none;" />
                                    <div id="imagePreviewComplaintDua"></div>
                                    <!--</div>-->
                                </span>
                                <span class="col-4" id="fileTiga">
                                    <!--<div class="img-thumbnail">-->
                                    <input id="uploadFileComplaintTiga" type="file" name="complain_pict[]"
                                        style="display: none;" />
                                    <div id="imagePreviewComplaintTiga"></div>
                                    <input type="hidden" id="counter_complaint"/>
                                    <!--</div>-->
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-border">
                    <button type="submit" class="btn btn-primary btn-block">Komplain</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Sukses Komplain-->
<div class="modal fade" id="modal-sukses" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header no-border">
                <h4 class="modal-title w-100 text-center color-primary" id="exampleModalLabel">Komplain Terkirim </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center>
                    <p>Mohon maaf atas<br>ketidaknyamanan Anda.<br>Tim kami akam memproses<br>maksimal 1 x 24 jam.</p>
                </center>
            </div>
            <div class="modal-footer no-border">
                <a class="btn btn-primary btn-block" href="transaksi.html">OK</a>
            </div>
        </div>
    </div>
</div>
@include('layouts.redirect_notification')
@include('layouts.redirect_chat')
<script>
@if(Session::has('success_complaint'))
   Swal.fire(
        "Berhasil",
        "{{ Session::get('success_complaint') }}",
        "success"
    );
@endif
@if(Session::has('error_complaint'))
   Swal.fire(
        "Gagal",
        "{{ Session::get('error_complaint') }}",
        "error"
    );
@endif

$('#form_confirm').submit(function(e) {
    e.preventDefault();
    console.log($(this).serialize());
    $('body').removeClass('loaded');
    console.log("{{url('/profile/confirmOrder')}}");
    $.ajax({
        type: "POST",
        url: "{{url('/profile/confirmOrder')}}",
        data: $(this).serialize(),
        success: function(r) {
            $('body').addClass('loaded');
            if (r.code != 200) {
                alert('Konfirmasi order gagal diproses');
            } else {
                if (r.isSuccess == true) {
                    alert('Transaksi anda telah selesai');
                    window.location = "{{url('/profile/history')}}";
                } else {
                    alert('Transaksi anda gagal diproses');
                }
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            $('body').addClass('loaded');
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }
    });
});
</script>
<script>
$("#modal-sukses").on('show.bs.modal', function() {
    $("#modal-komplain").modal("hide");
});

$('#btn_complaint').click(function(){
    @if(empty($transaction_detail->complaint))
        $('#modal-komplain').modal('show');
    @else
        window.location.href = "{{ route('profile-detail-complaint', ['id'=>$transaction_detail->complaint['complaint_id'], 'ticketing_num'=> $transaction_detail->complaint['ticketing_num']]) }}";
    @endif
});

$(function() {
    $("#upload_link").on('click', function(e) {
        e.preventDefault();
        $("#upload_complaint:hidden").trigger('click');
    });
});
</script>

<script>
$(function() {
    $("#uploadFileComplaintSatu").on("change", function() {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) {
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);

            reader.onloadend = function() {
                $("#imagePreviewComplaintSatu").css("background-image", "url(" + this.result + ")");
            }
        }
    });

    $("#uploadFileComplaintDua").on("change", function() {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) {
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);

            reader.onloadend = function() {
                $("#imagePreviewComplaintDua").css("background-image", "url(" + this.result + ")");
            }
        }
    });

    $("#uploadFileComplaintTiga").on("change", function() {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) {
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);

            reader.onloadend = function() {
                $("#imagePreviewComplaintTiga").css("background-image", "url(" + this.result + ")");
            }
        }
    });
});

$('#imagePreviewComplaintSatu').click(function() {
    $('#uploadFileComplaintSatu').click();
});
$('#imagePreviewComplaintDua').click(function() {
    $('#uploadFileComplaintDua').click();
});
$('#imagePreviewComplaintTiga').click(function() {
    $('#uploadFileComplaintTiga').click();
});
</script>

@foreach($order_detail as $key => $val)
    <script>
        var classCollapse{{$key}} = ".collapse" + "{{$key}}";
        var issue_category_id{{$key}} = "#issue_category_id" + "{{$key}}";
        var classServiceDrop{{$key}} = ".servicedrop" + "{{$key}}";
        var notes{{$key}} = "#notes" + "{{$key}}";
        $(document).ready(function() {
            $(classCollapse{{$key}}).on('show.bs.collapse', function(e) {
                $(issue_category_id{{$key}}).prop('required', true);
                $(notes{{$key}}).prop('required', true);
                $(classServiceDrop{{$key}}).addClass('fa-angle-down').removeClass('fa-angle-right');
            });

            $(classCollapse{{$key}}).on('hide.bs.collapse', function() {
                $(issue_category_id{{$key}}).prop('required', false);
                $(notes{{$key}}).prop('required', false);
                $(classServiceDrop{{$key}}).addClass('fa-angle-right').removeClass('fa-angle-down');
            });
        });
    </script>
@endforeach
                <script>
                $(function() {
                      $('#form_complaint').submit(function(e) {
                            
                            var valid = true;
                            $('span.error', this).remove();
                            if (!$('#uploadFileComplaintSatu').val()) {
                                  valid = false;
                                  $('<span class="col-12 error" style="color:red;" id="error-file">Mohon untuk Melampirkan Bukti Minimal Satu</span>').
                                        insertAfter('#fileTiga');
                            }
                            if($('#counter_complaint').val() == 0){
                                  valid = false;
                                  $('<span class="error" style="color:red;" id="error-data">Silahkan Pilih Produk Yang Bermasalah</span>').
                                        insertAfter('#komplain');
                            }

                            if(valid == true){
                                $(this).find('button[type=submit]').attr('disabled', true);
                            }
                            
                            return valid;
                      });
                });    
                </script>
                <script>
                function counter_complaints(e) {
                    $('#counter_complaint').val(1);
                }
                </script>