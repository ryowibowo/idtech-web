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
          {{-- <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
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
          </ul> --}}
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              <ul>
                  @foreach ($saldo as $row)
                  <li>
                    <div class="row">
                        <div class="col-md-6">
                          
                            @if ($row["transaction_flag"] == "1")
                                @if($row["refund_id"] == null)
                                  <p>Nomor Pesanan</p>
                                  <label>{{ $row["order_code"] }}</label>
                                  <p>Tanggal</p>
                                  <label>{{ $row["order_date"] }}</label>
                                @else
                                  <p>Kode Pembayaran</p>
                                  <label>{{ $row["invoice_no"] }}</label>
                                  <p>Tanggal</p>
                                  <label>{{ $row["payment_date"] }}</label>
                                @endif
                            @else
                                  <p>Kode Pembayaran</p>
                                  <label>{{ $row["invoice_no"] }}</label>
                                  <p>Tanggal</p>
                                  <label>{{ $row["payment_date"] }}</label>
                            @endif
                           
                        </div>
                        <div class="col-md-6">
                            @if ($row["transaction_flag"] == "1")
                            <p style="color: green">Penambahan Saldo</p><br>
                            {{ $row["claimed_amount"] }}
                            @else
                            <p style="color: red">Pengurangan Saldo</p><br>
                            -{{ $row["claimed_amount"] }}
                            
                            @endif

                        </div>
                    </div>
                </li>
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
