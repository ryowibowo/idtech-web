@section('title', env('APP_NAME') .' | Profil')
@include('layouts.header')
<section class="breadcrumbs-wrap margin-b40">
  <div class="container-fluid background-gray-blue">
    <div class="container no-padding">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item "><a href="{{url('beranda')}}" class="color-primary"><i class="fa fa-home"></i></a></li>
          <li class="breadcrumb-item " ><a href="{{url('profile')}}">Profil</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
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
          @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
            </div>
          @endif
          <section>
            <div class="container">
              <div class="row align-items-center login-row edit-profile">
                <div class="card mx-auto">
                  
                  <form action="{{ url('/profile/updateProfile') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body no-pad-bot">
                      <div class="text-center mb-5">
                        <div class="login-profile">
                          <img id="imageResult" src="{{$profile->user_image}}" alt="" class="rounded-circle img-responsive mb-2">
                          {{-- <p>{{$profile->user_name}}</p> --}}
                          <input id="upload" type="file" name="profile_picture" onchange="readURL(this);" class="form-control border-0">
                          <label for="upload" class="btn btn-success"><i class="ic-camera"></i></label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="nomorHP">Nama</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" value="{{$profile->user_name}}">
                      </div>

                      <div class="form-group">
                        <label for="nomorHP">Nomor HP</label>
                        <input type="text" name="phone_number" class="form-control" id="nomorHP" aria-describedby="emailHelp" value="{{$profile->user_phone_number}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$profile->user_email}}" disabled>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">NPWP</label>
                        <input type="text" class="form-control" name="npwp" id="npwp" aria-describedby="emailHelp" value="{{@$profile->npwp}}">
                      </div>
                      
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-success btn-block" onclick="window.location.href='{{ url('/profile') }}';">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</section>
@include('layouts.footer')
@include('layouts.redirect_notification')
@include('layouts.redirect_chat')
@include('layouts.modals.modal_change_password')

  {{-- <script>
    $('#update_form').submit(function (e) {
        console.log($(this).serialize());
        e.preventDefault();
        $('body').removeClass('loaded');
        $.ajax({
            type: "POST",
            url: "{{ url('/profile/updateProfile')}}",
            data: $(this).serialize(),
            success: function (r) {
              $('body').addClass('loaded');
              alert(r.code);
              if (r.code != 200) {
                console.log(r.code);
                document.getElementById("message_profile").innerHTML = r.message;
              } else {
                if (r.isSuccess == true) {
                console.log('success');
                  alert('success');
                }else{
                console.log('gagal');
                  alert('gagal');
                }
              }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }
          });
    });
  </script> --}}
