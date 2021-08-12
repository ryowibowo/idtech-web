<!-- Modal Edit Alamat -->
<div class="modal fade" id="modal-edit-alamat" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header no-border">
          <h3 class="modal-title  w-100 text-center color-primary">Edit Alamat</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body max-height-500">
          <div class="container no-padding">
              <form method="post" action="#" id="form_update_address">  
                {{ csrf_field() }}
                <input type="hidden" id="addressidEdit" name="address_id">
                <div class="form-group">
                  <label for="inputEmail">Nama Alamat</label>
                  <textarea class="form-control" name="address_name" id="namaAlamatEdit" placeholder="Cth : Alamat Rumah" required></textarea>
                </div>
                
                <div class="form-group">
                  <label for="namaLengkap">Nama Penerima</label>
                  <input type="text" name="contact_person" class="form-control" id="namaLengkapEdit" placeholder="Cth: Permata Putri">
                </div>
                <div class="form-group">
                  <label for="nomorHp">Nomor Handphone <span class="text-danger">*</span></label>
                  <input type="text" name="phone_number" class="form-control" id="nomorHpEdit" placeholder="Cth: 081200000000">
                </div>
                {{-- <div class="form-group">
                  <label for="inputEmail">Email</label>
                  <input type="email" class="form-control" id="inputEmailEdit" placeholder="Alamat Email">
                </div> --}}
                <div class="form-group">
                  <label for="inputEmail">Alamat Lengkap</label>
                  <textarea class="form-control" name="address_detail" id="alamatEdit" placeholder="JL. Bla Bla Bla No xx RT xx RW xx" minlength="10" required> Alamat Anda</textarea>
                </div>
                <div class="form-group">
                  <label for="inputEmail">Provinsi</label>
                  <select class="form-control" name="provinsi_id" id="provinsiEdit" required>
                    <option value="">Pilih Propinsi</option>
                    <!-- LOOPING DATA PROVINCE UNTUK DIPILIH OLEH CUSTOMER -->
                    @foreach ($provinces as $row)
                    <option value="{{$row["provinsi_id"]}}">{{$row["provinsi_name"]}}</option>
                    @endforeach
                </select>
                </div>
                <div class="form-group">
                  <label for="inputEmail">Kota</label>
                  <select name="kabupaten_kota_id" id="city_id" class="form-control">
                    <option value="">Pilih Kabupaten/Kota</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputEmail">Kecamatan</label>
                  <select name="kecamatan_id" id="kecamatanEdit" class="form-control">
                    <option selected>Piih Kecamatan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputEmail">Kelurahan</label>
                  <select name="kelurahan_desa_id" id="kelurahanEdit" class="form-control">
                    <option selected>Piih Kelurahan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputEmail">Kode Pos</label>
                  <select name="kode_pos" id="kodeposEdit" class="form-control">
                    <option selected>Piih Kode Pos</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="namaLengkap">Keterangan Alamat</label>
                  <input type="text" name="address_info" class="form-control" id="ketAlamat" placeholder="Cth: Rumah Warna Hijau lumut">
                </div>
                {{-- <div class="form-group">
                  <label for="namaLengkap">Nama Kontak</label>
                  <input type="text" class="form-control" id="namaLengkap" placeholder="Cth: Andri">
                </div>
                <div class="form-group">
                  <label for="namaLengkap">Nomor Telepon</label>
                  <input type="text" class="form-control" id="namaLengkap" placeholder="Cth: 0827377666">
                </div> --}}
                <div class="location-map-wrap">
                  <h6 class="color-primary">Tentukan Peta Lokasi</h6>
                  <p>Pastikan lokasi peta yang anda pilih sesuai dengan alamat yang di tuju</p>
                  <input id="pac-input" class="form-control form-control-map" type="text" placeholder="Cari Alamat"/>
                  <input type="hidden" name="latitude" id="latitude" class="form-control" required value="">
                  <input type="hidden" name="longitude" id="longitude" class="form-control" required value="">
                  <div id="googleMap_edit" style="width:100%;height:380px;"></div>
                  <!-- <div id="mapCanvas"></div> -->
                </div>
            <div class="clearfix"></div>
          </div>
        </div>
            <br>
                <center><span id="message_edit_address" style="color:red;"></span></center>
            <br>
        <div class="modal-footer no-border">
          <button type="submit" class="btn btn-primary btn-block">Update</button>
        </div>
      </form>

      </div>
    </div>
  </div>

  <script>
        var marker;
        var marker_edit;
        var markers = [];

        function taruhMarker_edit(map_edit, posisiTitik){
            if( marker_edit ){
                marker_edit.setPosition(posisiTitik);
            } else {
            marker_edit = new google.maps.Marker({
                position: posisiTitik,
                map: map_edit
            });
            }
            map_edit.setCenter(posisiTitik);
            markers.push(marker_edit);
            document.getElementById("latitude").value = marker_edit.position.lat();
            document.getElementById("longitude").value = marker_edit.position.lng();
        }

        var map_edit;
        function initialize() {
            var lat= -6.1826302;
            var lng= 106.6326605;
            var propertiMap = {
                center:new google.maps. LatLng(lat,lng),
                zoom:11,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            
            map_edit = new google.maps.Map(document.getElementById("googleMap_edit"), propertiMap);
            
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map_edit.setCenter(pos);
                    taruhMarker_edit(map_edit, pos);
                }, function() {
                    handleLocationError(true, infoWindow, map_edit.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map_edit.getCenter());
            }
            // google.maps.event.addListener(map, 'click', function(event) {
            //     taruhMarker(this, event.latLng);            
            // });
            google.maps.event.addListener(map_edit, 'click', function(event) {
                taruhMarker_edit(this, event.latLng);
            });
            
        }
        google.maps.event.addDomListener(window, 'load', initialize);
        function addmarker(latilongi) {
            marker_edit = new google.maps.Marker({
                position: latilongi,
                title: 'new marker',
                draggable: true,
                map: map_edit
            });
            map_edit.setCenter(marker_edit.getPosition())
        }
    </script>

<script>
  $(document).on('click', '#edit-address', function () {
    var address_id = $(this).data('id');
    var user_id = $(this).data('user');
    $('body').removeClass('loaded');

    var url = "{{env('URL_API')}}/" + "profile/detailAddress/"+address_id;
    $.get(url).done(function (data) {
      $('body').addClass('loaded');
      var gps_point = data.data.gps_point.split(',');
      console.log(data);
      
      $('#addressidEdit').val(data.data.address_id);
      $('#namaAlamatEdit').val(data.data.address_name);
      $('#namaLengkapEdit').val(data.data.contact_person);
      $('#nomorHpEdit').val(data.data.phone_number);
      $('#alamatEdit').val(data.data.address_detail);
      $('#ketAlamat').val(data.data.address_info);
      var provinsi_id = data.data.provinsi_id;
      var kabupaten_kota_id = data.data.kabupaten_kota_id;
      var kecamatan_id = data.data.kecamatan_id;
      var kelurahan_desa_id = data.data.kelurahan_desa_id;
      var kode_pos = data.data.kode_pos;
      $('#provinsiEdit').val(provinsi_id);
      selectedKabupaten(provinsi_id, kabupaten_kota_id);
      selectedKecamatan(kabupaten_kota_id, kecamatan_id);
      selectedKelurahan(kecamatan_id, kelurahan_desa_id, kode_pos);
      // initialize();
      taruhMarker_edit(map_edit, new google.maps.LatLng({lat: parseFloat(gps_point[0]), lng: parseFloat(gps_point[1])}));
      // $('#latitude').val(gps_point[0]);
      // $('#longitude').val(gps_point[1]);
    });

    // CHANGE PROVINSI KABUPATEN KELURAHAN KECAMATAN
    $('#provinsiEdit').on('change', function() {
        var url = "{{env('URL_API')}}/" + "kabkot/"+$(this).val();
        $.ajax({
            url: url,
            type: "GET",
            success: function(html){
            console.log(html);
                $('#city_id').empty().trigger('change');
                $('#city_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                $.each(html.data, function(key, item) {
                    $('#city_id').append('<option value="'+item.kabupaten_kota_id+'">'+item.kabupaten_kota_name+'</option>')
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); 
                alert("Error: " + errorThrown); 
            }
        });
    })

    $('#city_id').on('change', function() {
        var url = "{{env('URL_API')}}/" + "kecamatan/"+$(this).val();
        console.log($(this).val());
        if ($(this).val() == null) {
            $('#kecamatanEdit').empty().trigger('change');
            $('#kecamatanEdit').append('<option value="">Pilih Kecamatan</option>')
        } else {
            $.ajax({
                url: url,
                type: "GET",
                success: function(html){
                console.log(html);
                    $('#kecamatanEdit').empty().trigger('change');
                    $('#kecamatanEdit').append('<option value="">Pilih Kecamatan</option>')
                    $.each(html.data, function(key, item) {
                        $('#kecamatanEdit').append('<option value="'+item.kecamatan_id+'">'+item.kecamatan_name+'</option>')
                    })
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); 
                    alert("Error: " + errorThrown); 
                }
            });
        }
    });

    $('#kecamatanEdit').on('change', function() {
        var url = "{{env('URL_API')}}/" + "kelurahan/"+$(this).val();

        if ($(this).val() == null) {
            $('#kelurahanEdit').empty().trigger('change');
            $('#kodeposEdit').empty().trigger('change');
            $('#kelurahanEdit').append('<option value="">Pilih Kelurahan</option>')
            $('#kodeposEdit').append('<option value="">Pilih Kode Pos</option>')
        } else {
            $.ajax({
                url: url,
                type: "GET",
                success: function(html){
                    $('#kelurahanEdit').empty().trigger('change');
                    $('#kodeposEdit').empty().trigger('change');
                    $('#kelurahanEdit').append('<option value="">Pilih Kelurahan</option>')
                    $('#kodeposEdit').append('<option value="">Pilih Kode Pos</option>')
                    $.each(html.data, function(key, item) {
                        $('#kelurahanEdit').append('<option value="'+item.kelurahan_desa_id+'">'+item.kelurahan_desa_name+'</option>')
                        $('#kodeposEdit').append('<option value="'+item.kode_pos+'">'+item.kode_pos+'</option>')
                    })
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); 
                    alert("Error: " + errorThrown); 
                }
            });
        }
    });

    function selectedKabupaten($id, $value) {
        var url = "{{env('URL_API')}}/" + "kabkot/"+$id;
        $.ajax({
            url: url,
            success: function(r) {
                $('#city_id').empty();
                $('#city_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                $.each(r.data, function(i, item){
                    $('#city_id').append('<option value="'+item.kabupaten_kota_id+'">'+item.kabupaten_kota_name+'</option>')
                });
                $('#city_id').val($value);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); 
                alert("Error: " + errorThrown); 
            }
        });
    }

    function selectedKecamatan($id, $value) {
        var url = "{{env('URL_API')}}/" + "kecamatan/"+$id;
        $.ajax({
            url: url,
            success: function(r) {
                $('#kecamatanEdit').empty();
                $('#kecamatanEdit').append('<option value="">Pilih Kecamatan</option>')
                $.each(r.data, function(i, item){
                    $('#kecamatanEdit').append('<option value="'+item.kecamatan_id+'">'+item.kecamatan_name+'</option>')
                });
                $('#kecamatanEdit').val($value);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); 
                alert("Error: " + errorThrown); 
            }
        });
    }

    function selectedKelurahan($id, $value, $kodepos) {
        var url = "{{env('URL_API')}}/" + "kelurahan/"+$id;
        $.ajax({
        url: url,
        success: function(r) {
            console.log(r);
            $('#kelurahanEdit').empty();
            $('#kodeposEdit').empty();
            $('#kelurahanEdit').append('<option value="">Pilih kelurahan</option>')
            $('#kodeposEdit').append('<option value="">Pilih Kode Pos</option>')
            $.each(r.data, function(key, item) {
                $('#kelurahanEdit').append('<option value="'+item.kelurahan_desa_id+'">'+item.kelurahan_desa_name+'</option>')
                $('#kodeposEdit').append('<option value="'+item.kode_pos+'">'+item.kode_pos+'</option>')
            });
            $('#kelurahanEdit').val($value);
            $('#kodeposEdit').val($kodepos);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log('error');
            $('body').addClass('loaded');
            alert("Status: " + textStatus); 
            alert("Error: " + errorThrown); 
        }
    });
    }
});
</script>

<script>
  $('#form_update_address').submit(function (e) {
    e.preventDefault();
    console.log($(this).serialize());
    $('body').removeClass('loaded'); 
    $('#modal-edit-alamat').modal('hide');   
    $.ajax({
        type: "POST",
        url: "{{ url('/profile/updateAddress') }}",
        data: $(this).serialize(),
        success: function (r) {
            console.log(r);
            $('body').addClass('loaded');
            if (r.code != 200) {
                $('#modal-edit-alamat').modal('show');  
                document.getElementById("message_edit_address").innerHTML = "Error code : "+r.code;
            } else {
                if(r.isSuccess == true){
                    $('#modal-edit-alamat').modal('hide');
                    document.getElementById("message_edit_address").innerHTML = "";
                    
                    $("#modal-success-address").modal('show');
                    document.getElementById('message-success-address').innerHTML = "Data berhasil diupdate";
                }else{
                    $('#modal-edit-alamat').modal('show');  
                    document.getElementById("message_edit_address").innerHTML = "Error code : "+r.message;
                }
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log('error');
            $('body').addClass('loaded');
            alert("Status: " + textStatus); 
            alert("Error: " + errorThrown); 
            $("#modal-failed-address").modal('show');
            document.getElementById('message-success-address').innerHTML = "Data gagal diupdate";
        } 
    });
  });
</script>