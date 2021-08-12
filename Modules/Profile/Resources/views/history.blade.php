@section('title', env('APP_NAME') .' | Riwayat Transaksi')
@include('layouts.header')
<section class="breadcrumbs-wrap margin-b40">
  <div class="container-fluid background-gray-blue">
    <div class="container no-padding">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item "><a href="/" class="color-primary"><i class="fa fa-home"></i></a></li>
          <li class="breadcrumb-item" aria-current="page"><a href="{{ url('/profile') }}">Profil</a></li>
          <li class="breadcrumb-item active" aria-current="page">Riwayat Transaksi</li>
        </ol>
      </nav>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row user-profile mt-4 mb-5">
      <div class="col-md-3">
        @include('layouts.menu', array('profile' => $profile))
      </div>
      <div class="col-md-9">
        <div class="card">
          <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Semua</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Diproses</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-dikirim-tab" data-toggle="pill" href="#pills-dikirim" role="tab" aria-controls="pills-dikirim" aria-selected="false">Dikirim</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Selesai</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              <ul>
              {{-- @if(count(array($transaksi)) == 0) --}}
                  <!--<li>
                    <center>
                      <img src="<?php echo URL::to('/'); ?>/assets/img/img-default.jpg" style="width:300px;height:300px;">
                      <div style="color:#999;">Opps... tidak ada data dihalaman ini</div>
                    </center>
                    <br><br>
                  </li>-->
                {{-- @else --}}
                  @foreach ($transaksi as $row)
                  <li>
                    <a href="{{url('profile/detailOrder/'.$row['order_id'].'/'.$row['billing_code'])}}">
                      <p class="order-id">ORDER #{{$row["order_code"]}} {{  $row["is_return"] ? "(Barang Return)" : ""  }}</p>
                      <div class="row">
                        <div class="col-md-6">
                          <p>Tanggal</p>
                          <label>{{$row["order_date"]}}</label>
                          <p>Metode Pembayaran</p>
                          @if ($row["payment_method_id"] == 17)
                          <label style="color: red">{{$row["payment_method_name"]}}</label>
                          @else
                          <label>{{$row["payment_method_name"]}}</label>
                          @endif
                        </div>
                        <div class="col-md-6">
                          <p>Jumlah</p>
                          @if($row["grandtotal_payment"] == "0")
                          <label>Rp. {{$row["total_order"]}}</label>
                          @else
                          <label>Rp. {{$row["grandtotal_payment"]}}</label>
                          @endif
                          <p>Status</p>
                          @if ($row["order_status_id"] == 4)
                          <label class="order-selesai">{{$row["order_status_name"]}}</label>
                          @else
                          <label class="order-proses">{{$row["order_status_name"]}}</label>
                          @endif
                        </div>
                      </div>
                    </a>
                  </li>
                  @endforeach
                {{-- @endif --}}
              </ul>
            </div>

            <!-- di proses -->
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
              <ul>
                {{-- @if(count(array($transaksi)) == 1) --}}
                  <!--<li>
                    <center>
                      <img src="<?php echo URL::to('/'); ?>/assets/img/img-default.jpg" style="width:300px;height:300px;">
                      <div style="color:#999;">Opps... tidak ada data dihalaman ini</div>
                    </center>
                    <br><br>
                  </li>-->
                {{-- @else --}}
                  @foreach ($transaksi as $row)
                    @if ($row["order_status_id"] == 1)
                      <li>
                        <a href="{{url('profile/detailOrder/'.$row['order_id'].'/'.$row['billing_code'])}}">
                          <p class="order-id">ORDER #{{ $row["order_code"]}} {{  $row["is_return"] ? "(Barang Return)" : ""  }}</p>
                          <div class="row">
                            <div class="col-md-6">
                              <p>Tanggal</p>
                              <label>{{$row["order_date"]}}</label>
                              <p>Metode Pembayaran</p>
                              <label>{{$row["payment_method_name"]}}</label>
                            </div>
                            <div class="col-md-6">
                              <p>Jumlah</p>
                              <label>Rp. {{$row["grandtotal_payment"]}}</label>
                              <p>Status</p>
                              <label class="order-proses">{{$row["order_status_name"]}}</label>
                            </div>
                          </div>
                        </a>
                      </li>
                  @endif
                  @endforeach
                {{-- @endif --}}
              </ul>
            </div>

            <!--Dikirim-->
            <div class="tab-pane fade" id="pills-dikirim" role="tabpanel" aria-labelledby="pills-dikirim-tab">
              <ul>
                {{-- @if(count(array($transaksi)) == 1) --}}
                  <!--<li>
                    <center>
                      <img src="<?php echo URL::to('/'); ?>/assets/img/img-default.jpg" style="width:300px;height:300px;">
                      <div style="color:#999;">Opps... tidak ada data dihalaman ini</div>
                    </center>
                    <br><br>
                  </li>-->
               {{-- @else --}}
                  @foreach ($transaksi as $row)
                    @if ($row["order_status_id"] == 2)
                      <li>
                        <a href="{{url('profile/detailOrder/'.$row['order_id'].'/'.$row['billing_code'])}}">
                          <p class="order-id">ORDER #{{$row["order_code"]}} {{  $row["is_return"] ? "(Barang Return)" : ""  }}</p>
                          <div class="row">
                            <div class="col-md-6">
                              <p>Tanggal</p>
                              <label>{{$row["order_date"]}}</label>
                              <p>Metode Pembayaran</p>
                              <label>{{$row["payment_method_name"]}}</label>
                            </div>
                            <div class="col-md-6">
                              <p>Jumlah</p>
                              <label>Rp. {{$row["grandtotal_payment"]}}</label>
                              <p>Status</p>
                              <label class="order-proses">{{$row["order_status_name"]}}</label>
                            </div>
                          </div>
                        </a>
                      </li>
                  @endif
                  @endforeach
                {{-- @endif --}}
              </ul>
            </div>

            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
              <ul>
                {{-- @if(count(array($transaksi)) == 1)--}}
                  <!--<li>
                    <center>
                      <img src="<?php echo URL::to('/'); ?>/assets/img/img-default.jpg" style="width:300px;height:300px;">
                      <div style="color:#999;">Opps... tidak ada data dihalaman ini</div>
                    </center>
                    <br><br>
                  </li>-->
                {{-- @else --}}
                  @foreach ($transaksi as $row)
                    @if ($row["order_status_id"] == 4)
                      <li>
                        <a href="{{url('profile/detailOrder/'.$row['order_id'].'/'.$row['billing_code'])}}">
                          <p class="order-id">ORDER #{{$row["order_code"]}} {{  $row["is_return"] ? "(Barang Return)" : ""  }}</p>
                          <div class="row">
                            <div class="col-md-6">
                              <p>Tanggal</p>
                              <label>{{$row["order_date"]}}</label>
                              <p>Metode Pembayaran</p>
                              <label>{{$row["payment_method_name"]}}</label>
                            </div>
                            <div class="col-md-6">
                              <p>Jumlah</p>
                              <label>Rp. {{$row["grandtotal_payment"]}}</label>
                              <p>Status</p>
                              <label class="order-selesai">{{$row["order_status_name"]}}</label>
                            </div>
                          </div>
                        </a>
                      </li>
                    @endif
                  @endforeach
                {{-- @endif --}}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@include('layouts.footer')
@include('layouts.redirect_notification')
@include('layouts.redirect_chat')
@include('layouts.modals.modal_change_password')
