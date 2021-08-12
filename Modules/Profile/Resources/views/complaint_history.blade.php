@section('title', env('APP_NAME') .' | Riwayat Complain')
@include('layouts.header')
<section class="breadcrumbs-wrap margin-b40">
  <div class="container-fluid background-gray-blue">
    <div class="container no-padding">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item "><a href="/" class="color-primary"><i class="fa fa-home"></i></a></li>
          <li class="breadcrumb-item" aria-current="page"><a href="{{ url('/profile') }}">Profil</a></li>
          <li class="breadcrumb-item active" aria-current="page">Riwayat Complain</li>
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
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-semua" role="tab" aria-controls="pills-home" aria-selected="true">Semua</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-pending" role="tab" aria-controls="pills-profile" aria-selected="false">Pending</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-diproses" role="tab" aria-controls="pills-profile" aria-selected="false">Diproses</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-dikirim" role="tab" aria-controls="pills-contact" aria-selected="false">Dikirim</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-selesai" role="tab" aria-controls="pills-contact" aria-selected="false">Selesai</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-dikirim-tab" data-toggle="pill" href="#pills-ditolak" role="tab" aria-controls="pills-dikirim" aria-selected="false">Ditolak</a>
            </li>
          </ul> 
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-semua" role="tabpanel" aria-labelledby="pills-home-tab">
                <ul>
                @foreach ($complaint_history as $row)
                    <li>
                        <a href="{{ url('profile/detailComplaint/'.$row['issue_id'].'/'.$row['ticketing_num']) }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>ID Pesanan</p>
                                    <label>{{ $row["order_code"] }}</label>
                                    <p>Tanggal</p>
                                    <label>{{ $row["issue_date"] }}</label>
                                </div>
                                <div class="col-md-6">
                                    <p>Status</p>
                                    @if ($row["issue_status_name"] == "Selesai")
                                    <label class="order-selesai">{{ $row["issue_status_name"] }}</label>
                                    @else
                                    <label class="order-proses">{{ $row["issue_status_name"] }}</label>
                                    @endif
                                    <p>Solusi yang diinginkan</p>
                                    <label>{{$row["issue_solution_name"]}}</label>

                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
                </ul>
            </div>
            
            <!-- di proses -->
            <div class="tab-pane fade" id="pills-pending" role="tabpanel" aria-labelledby="pills-profile-tab">
                <ul>
                @foreach ($complaint_history as $row)
                    @if($row['issue_status_name'] == 'Pending')
                    <li>
                        <a href="{{ url('profile/detailComplaint/'.$row['issue_id'].'/'.$row['ticketing_num']) }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>ID Pesanan</p>
                                    <label>{{ $row["order_code"] }}</label>
                                    <p>Tanggal</p>
                                    <label>{{ $row["issue_date"] }}</label>
                                </div>
                                <div class="col-md-6">
                                    <p>Status</p>
                                    @if ($row["issue_status_name"] == "Selesai")
                                    <label class="order-selesai">{{ $row["issue_status_name"] }}</label>
                                    @else
                                    <label class="order-proses">{{ $row["issue_status_name"] }}</label>
                                    @endif
                                    <p>Solusi yang diinginkan</p>
                                    <label>{{$row["issue_solution_name"]}}</label>

                                </div>
                            </div>
                        </a>
                    </li>
                    @endif
                @endforeach 
                </ul>
            </div>
            
            <!--Diproses-->
            <div class="tab-pane fade" id="pills-diproses" role="tabpanel" aria-labelledby="pills-dikirim-tab">
                <ul>
                    @foreach ($complaint_history as $row)
                        @if($row['issue_status_name'] == 'Diproses')
                        <li>
                            <a href="{{ url('profile/detailComplaint/'.$row['issue_id'].'/'.$row['ticketing_num']) }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>ID Pesanan</p>
                                        <label>{{ $row["order_code"] }}</label>
                                        <p>Tanggal</p>
                                        <label>{{ $row["issue_date"] }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Status</p>
                                        @if ($row["issue_status_name"] == "Selesai")
                                        <label class="order-selesai">{{ $row["issue_status_name"] }}</label>
                                        @else
                                        <label class="order-proses">{{ $row["issue_status_name"] }}</label>
                                        @endif
                                        <p>Solusi yang diinginkan</p>
                                        <label>{{$row["issue_solution_name"]}}</label>

                                    </div>
                                </div>
                            </a>
                        </li>
                        @endif
                    @endforeach 
                </ul>
            </div>

            <!--Dikirim-->
            <div class="tab-pane fade" id="pills-dikirim" role="tabpanel" aria-labelledby="pills-dikirim-tab">
                <ul>
                    @foreach ($complaint_history as $row)
                        @if($row['issue_status_name'] == 'Dikirim')
                        <li>
                            <a href="{{ url('profile/detailComplaint/'.$row['issue_id'].'/'.$row['ticketing_num']) }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>ID Pesanan</p>
                                        <label>{{ $row["order_code"] }}</label>
                                        <p>Tanggal</p>
                                        <label>{{ $row["issue_date"] }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Status</p>
                                        @if ($row["issue_status_name"] == "Selesai")
                                        <label class="order-selesai">{{ $row["issue_status_name"] }}</label>
                                        @else
                                        <label class="order-proses">{{ $row["issue_status_name"] }}</label>
                                        @endif
                                        <p>Solusi yang diinginkan</p>
                                        <label>{{$row["issue_solution_name"]}}</label>

                                    </div>
                                </div>
                            </a>
                        </li>
                        @endif
                    @endforeach 
                </ul>
            </div>
            
            <div class="tab-pane fade" id="pills-selesai" role="tabpanel" aria-labelledby="pills-contact-tab">
                <ul>
                    @foreach ($complaint_history as $row)
                        @if($row['issue_status_name'] == 'Selesai')
                        <li>
                            <a href="{{ url('profile/detailComplaint/'.$row['issue_id'].'/'.$row['ticketing_num']) }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>ID Pesanan</p>
                                        <label>{{ $row["order_code"] }}</label>
                                        <p>Tanggal</p>
                                        <label>{{ $row["issue_date"] }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Status</p>
                                        @if ($row["issue_status_name"] == "Selesai")
                                        <label class="order-selesai">{{ $row["issue_status_name"] }}</label>
                                        @else
                                        <label class="order-proses">{{ $row["issue_status_name"] }}</label>
                                        @endif
                                        <p>Solusi yang diinginkan</p>
                                        <label>{{$row["issue_solution_name"]}}</label>

                                    </div>
                                </div>
                            </a>
                        </li>
                        @endif
                    @endforeach 
                </ul>
            </div>
            <div class="tab-pane fade" id="pills-ditolak" role="tabpanel" aria-labelledby="pills-contact-tab">
                <ul>
                    @foreach ($complaint_history as $row)
                        @if($row['issue_status_name'] == 'Ditolak')
                        <li>
                            <a href="{{ url('profile/detailComplaint/'.$row['issue_id'].'/'.$row['ticketing_num']) }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>ID Pesanan</p>
                                        <label>{{ $row["order_code"] }}</label>
                                        <p>Tanggal</p>
                                        <label>{{ $row["issue_date"] }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Status</p>
                                        @if ($row["issue_status_name"] == "Selesai")
                                        <label class="order-selesai">{{ $row["issue_status_name"] }}</label>
                                        @else
                                        <label class="order-proses">{{ $row["issue_status_name"] }}</label>
                                        @endif
                                        <p>Solusi yang diinginkan</p>
                                        <label>{{$row["issue_solution_name"]}}</label>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endif
                    @endforeach 
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
