@section('title', env('APP_NAME') .' | Daftar Alamat Pengiriman')
@include('layouts.header')
<section class="breadcrumbs-wrap margin-b40">
  <div class="container-fluid background-gray-blue">
    <div class="container no-padding">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item "><a href="/" class="color-primary"><i class="fa fa-home"></i></a></li>
          <li class="breadcrumb-item "><a href="{{url('/profile')}}" class="color-primary">Profile</a></li>
          <li class="breadcrumb-item active" aria-current="page">Daftar Alamat Pengiriman</li>
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
          <div class="title-checkout-wrap" style="margin-top:10px;margin-right:10px;">
            <span class="float-right"> 
              <a href="#" id="add-address" class="btn btn-secondary" data-toggle="modal"  data-target="#modal-tambah-alamat"><i class="fa fa-plus"></i> Tambah Alamat</a>
            </span>
            <div class="clearfix"></div>
          </div>
          <ul class="alamat-kirim">
            @foreach ($address as $row)
            <li style="{{ $row['isMain'] ? 'border-color: #28a745;' :'' }}">
              <div class="dropdown dropleft">
                <div class="dropdown">
                    <a class="btn btn-secondary btn-sm"  type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-ellipsis-v"></i>
                    </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                    @if(!$row['isMain'])
                    <a href="#" id="set-utama" class="dropdown-item"  data-id="{{$row['address_id']}}" data-user="{{Session::get('user_id')}}" data-token="{{Session::get('token')}}" >
                      <i class="fa fa-map-marker"></i> Set Utama</a>
                    @endif
                    <a href="#" id="edit-address" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-alamat" data-id="{{$row['address_id']}}" data-user="{{Session::get('user_id')}}"><i class="fa fa-edit"></i> Edit Alamat</a>
                    <a href="#" id="delete-address" data-id="{{$row['address_id']}}" data-user="{{Session::get('user_id')}}" data-token="{{Session::get('token')}}" class="dropdown-item"><i class="fa fa-trash"></i> Hapus Alamat</a>
                  </div>
                </div>
              </div>
              <p class="order-id">
                {{$row["address_name"]}}

                @if($row['isMain'])
                  <span id="isMain" class="text-danger">(Alamat Utama)</span>
                @endif
              </p>
              
              <p>Penerima : {{$row["contact_person"]}}</p>
              <p>Nomor Telepon : {{$row["phone_number"]}}</p>
              <p>{{$row["address_detail"]}}, Kelurahan {{$row["kelurahan_desa_name"]}}, <br/>
                Kecamatan {{$row["kecamatan_name"]}}, <br/>
                Kab/Kota {{$row["kabupaten_kota_name"]}}, <br/>
                Provinsi {{$row["provinsi_name"]}}
              </p>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
@include('layouts.footer')
@include('layouts.redirect_notification')
@include('layouts.redirect_chat')
@include('layouts.modals.modal_change_password')
@include('layouts.modals.modal_add_address')
@include('layouts.modals.modal_edit_address')
<script>
$('#status_address').attr("style","display:none");
</script>
<script>
  $(document).on('click', '#delete-address', function () {
    if(confirm("Apakah anda yakin ingin menghapus data ini?") == true){
      var user_id = $(this).data('user');
      var address_id = $(this).data('id');
      var token = $(this).data('token');
      console.log(address_id);
      $('body').removeClass('loaded');

      var url = "{{env('URL_API')}}/" + "profile/deleteAddress";
      $.ajax({
        type: "POST",
        url: url,
        headers: {
          "Authorization": "Bearer " + token
        },
        data: {
          user_id: user_id,
          address_id: address_id
        },
        success: function (result){
          $('body').addClass('loaded');
          if(result.isSuccess == true){
            $("#modal-success-address").modal('show');
            document.getElementById('message-success-address').innerHTML = "Data berhasil dihapus";
          }else{
            $("#modal-failed-address").modal('show');
            document.getElementById('message-success-address').innerHTML = "Data gagal dihapus";
          }
        },
        error: function(result){
          $('body').addClass('loaded');
          $("#modal-failed-address").modal('show');
          document.getElementById('message-success-address').innerHTML = "Data gagal dihapus";
        }
      });
    }
  });

  $(document).on('click', '#set-utama', function () {
      var user_id = $(this).data('user');
      var address_id = $(this).data('id');
      var token = $(this).data('token');

      var url = "{{env('URL_API')}}/" + "profile/setMainAddress";
      $.ajax({
        type: "POST",
        url: url,
        headers: {
          "Authorization": "Bearer " + token
        },
        data: {
          user_id: user_id,
          address_id: address_id
        },
        success: function (result){
          console.log(result);
          $('body').addClass('loaded');
          if(result.isSuccess == true){
            $("#modal-success-address").modal('show');
            document.getElementById('message-success-address').innerHTML = "Data berhasil diubah";
          }else{
            $("#modal-failed-address").modal('show');
            document.getElementById('message-success-address').innerHTML = "Data gagal dihapus";
          }
        },
        error: function(result){
          $('body').addClass('loaded');
          $("#modal-failed-address").modal('show');
          document.getElementById('message-success-address').innerHTML = "Data gagal dihapus";
        }
      });
  });
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
