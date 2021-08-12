<div class="modal fade" id="modal-tambah-alamat"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header no-border">
          <h3 class="modal-title  w-100 text-center color-primary">Tambah Alamat</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body max-height-500">
            <div class="container no-padding">
                <form method="post" action="#" id="form_add_address">  
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="inputEmail">Nama Alamat</label>
                    <textarea class="form-control" name="address_name" placeholder="Cth : Alamat Rumah" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail">Alamat Lengkap</label>
                    <textarea class="form-control" name="address_detail" placeholder="JL. Bla Bla Bla No xx RT xx RW xx" minlength="10" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail">Provinsi</label>
                    <select id="provinsi" name="provinsi_id" class="form-control" required>
                      <option selected disabled>Pilih Provinsi</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail">Kota</label>
                    <select id="kota" name="kabupaten_kota_id" class="form-control" required>
                      <option selected disabled>Pilih Kabupaten/Kota</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail">Kecamatan</label>
                    <select id="kecamatan" name="kecamatan_id" class="form-control" required>
                      <option selected disabled>Pilih Kecamatan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail">Kelurahan</label>
                    <select id="kelurahan" name="kelurahan_desa_id" class="form-control">
                      <option selected disabled>Pilih Kelurahan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail">Kode Pos</label>
                    <select id="kodepos" name="kode_pos" class="form-control" required>
                      <option selected disabled>Pilih Kode Pos</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="namaLengkap">Keterangan Alamat</label>
                    <input type="text" name="address_info" class="form-control" id="keteranganAlamat" placeholder="Cth: Rumah Warna Hijau lumut" required>
                  </div>
                  <div class="form-group">
                    <label for="namaLengkap">Nama Kontak</label>
                    <input type="text" name="contact_person" class="form-control" id="namaKontak" placeholder="Cth: Andri" required>
                  </div>
                  <div class="form-group">
                    <label for="namaLengkap">Nomor Telepon</label>
                    <input type="text" name="phone_number" class="form-control" id="nomorTelepon" placeholder="Cth: 0827377666" required>
                  </div>
                  <div class="location-map-wrap">
                    <h6 class="color-primary">Tentukan Peta Lokasi</h6>
                    <p>Pastikan lokasi peta yang anda pilih sesuai dengan alamat yang di tuju</p>
                    <input id="pac-input" class="form-control form-control-map" type="text" placeholder="Cari Alamat" style="margin-top:10px;"/>
                    <input type="hidden" name="latitude" id="latitude_address" class="form-control" required value="">
                    <input type="hidden" name="longitude" id="longitude_address" class="form-control" required value="">
                    <div id="map_canvas" style="width:100%;height:380px;margin-top:10px;"></div>
                    <!-- <div id="mapCanvas"></div> -->
                  </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <br>
                <center><span id="message_add_address" style="color:red;"></span></center>
            <br>
            <div class="modal-footer no-border">
                <button  class="btn btn-primary btn-block">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    var marker;
    var marker_add;
    var markers = [];

    function taruhMarker_add(map_add, posisiTitik){
        if( marker_add ){
            marker_add.setPosition(posisiTitik);
        } else {
        marker_add = new google.maps.Marker({
            position: posisiTitik,
            map: map_add
        });
        }
        map_add.setCenter(posisiTitik);
        markers.push(marker_add);
        document.getElementById("latitude_address").value = marker_add.position.lat();
        document.getElementById("longitude_address").value = marker_add.position.lng();
    }

    var map_add;
    function initialize() {
        var lat= -6.1826302;
        var lng= 106.6326605;
        var propertiMap = {
            center:new google.maps. LatLng(lat,lng),
            zoom:11,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        
        map_add = new google.maps.Map(document.getElementById("map_canvas"), propertiMap);
        
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                map_add.setCenter(pos);
                taruhMarker_add(map_add, pos);
            }, function() {
                handleLocationError(true, infoWindow, map_add.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map_add.getCenter());
        }
        // google.maps.event.addListener(map, 'click', function(event) {
        //     taruhMarker(this, event.latLng);            
        // });
        google.maps.event.addListener(map_add, 'click', function(event) {
            taruhMarker_add(this, event.latLng);
        });
        
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    function addmarker(latilongi) {
        marker_add = new google.maps.Marker({
            position: latilongi,
            title: 'new marker',
            draggable: true,
            map: map_add
        });
        map_add.setCenter(marker_add.getPosition())
    }
</script>

<!--add address-->
<script type="text/javascript">
    $(document).on('click', '#add-address', function () {
        $.ajax({
            type: 'GET',
            url: "{{env('URL_API')}}/" + "provinsi",
            cache: false, 
            success: function(html){
                $.each(html.data, function(key, item) {
                    $('#provinsi').append('<option value="'+item.provinsi_id+'">'+item.provinsi_name+'</option>')
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log('error');
                $('body').addClass('loaded');
                alert("Status: " + textStatus); 
                alert("Error: " + errorThrown); 
            }
        });

        $('#provinsi').on('change', function() {
        var url = "{{env('URL_API')}}/" + "kabkot/"+$(this).val();
        $.ajax({
            url: url,
            type: "GET",
            success: function(html){
                console.log(html);
                $('#kota').empty().trigger('change');
                $('#kota').append('<option value="">Pilih Kabupaten/Kota</option>')
                $.each(html.data, function(key, item) {
                    $('#kota').append('<option value="'+item.kabupaten_kota_id+'">'+item.kabupaten_kota_name+'</option>')
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log('error');
                $('body').addClass('loaded');
                alert("Status: " + textStatus); 
                alert("Error: " + errorThrown); 
            }
        });
    })

    $('#kota').on('change', function() {
        var url = "{{env('URL_API')}}/" + "kecamatan/"+$(this).val();
        console.log($(this).val());
        if ($(this).val() == null) {
            $('#kecamatan').empty().trigger('change');
            $('#kecamatan').append('<option value="">Pilih Kecamatan</option>')
        } else {
            $.ajax({
                url: url,
                type: "GET",
                success: function(html){
                console.log(html);
                    $('#kecamatan').empty().trigger('change');
                    $('#kecamatan').append('<option value="">Pilih Kecamatan</option>')
                    $.each(html.data, function(key, item) {
                        $('#kecamatan').append('<option value="'+item.kecamatan_id+'">'+item.kecamatan_name+'</option>')
                    })
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

    $('#kecamatan').on('change', function() {
        var url = "{{env('URL_API')}}/" + "kelurahan/"+$(this).val();

        if ($(this).val() == null) {
            $('#kelurahan').empty().trigger('change');
            $('#kodepos').empty().trigger('change');
            $('#kelurahan').append('<option value="">Pilih Kelurahan</option>')
            $('#kodepos').append('<option value="">Pilih Kode Pos</option>')
        } else {
        $.ajax({
            url: url,
            type: "GET",
            
            success: function(html){
                console.log(html);
                
                $('#kelurahan').empty().trigger('change');
                $('#kodepos').empty().trigger('change');
                $('#kelurahan').append('<option value="">Pilih Kelurahan</option>')
                $('#kodepos').append('<option value="">Pilih Kode Pos</option>')
                $.each(html.data, function(key, item) {
                    $('#kelurahan').append('<option value="'+item.kelurahan_desa_id+'">'+item.kelurahan_desa_name+'</option>')
                    $('#kodepos').append('<option value="'+item.kode_pos+'">'+item.kode_pos+'</option>')
                })
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
    function selectedKabupaten($id, $value) {
        var url = "{{env('URL_API')}}/" + "kabkot/"+$id;
        $.ajax({
            url: url,
            success: function(r) {
                $('#kota').empty();
                $('#kota').append('<option value="">Pilih Kabupaten/Kota</option>')
                $.each(r.data, function(i, item){
                    $('#kota').append('<option value="'+item.kabupaten_kota_id+'">'+item.kabupaten_kota_name+'</option>')
                });
                $('#kota').val($value);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log('error');
                $('body').addClass('loaded');
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
                $('#kecamatan').empty();
                $('#kecamatan').append('<option value="">Pilih Kecamatan</option>')
                $.each(r.data, function(i, item){
                    $('#kecamatan').append('<option value="'+item.kecamatan_id+'">'+item.kecamatan_name+'</option>')
                });
                $('#kecamatan').val($value);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log('error');
                $('body').addClass('loaded');
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
                $('#kelurahan').empty();
                $('#kodepos').empty();
                $('#kelurahan').append('<option value="">Pilih kelurahan</option>')
                $('#kodepos').append('<option value="">Pilih Kode Pos</option>')
                $.each(r.data, function(key, item) {
                    $('#kelurahan').append('<option value="'+item.kelurahan_desa_id+'">'+item.kelurahan_desa_name+'</option>')
                    $('#kodepos').append('<option value="'+item.kode_pos+'">'+item.kode_pos+'</option>')
                });
                $('#kelurahan').val($value);
                $('#kodepos').val($kodepos);
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
    $('#form_add_address').submit(function (e) {
        e.preventDefault();
        console.log($(this).serialize());
        $('body').removeClass('loaded');
        $('#modal-tambah-alamat').modal('hide');
        $.ajax({
            type: "POST",
            url: "{{ url('/profile/addAddress') }}",
            data: $(this).serialize(),
            success: function (r) {
                $('body').addClass('loaded');
                if (r.code != 200) {
                    console.log(r.code);
                    $('#modal-tambah-alamat').modal('show');
                    document.getElementById("message_add_address").innerHTML = "Error code : "+r.code;
                } else {
                    if(r.isSuccess == true){
                        $('#modal-tambah-alamat').modal('hide');
                        document.getElementById("message_add_address").innerHTML = "";
                        //window.location = "{{ url('profile/address') }}";
                        
                        $("#modal-success-address").modal('show');
                        document.getElementById('message-success-address').innerHTML = "Data berhasil ditambahkan";
                    }else{
                        $('#modal-tambah-alamat').modal('show');
                        document.getElementById("message_add_address").innerHTML = r.message;
                    }
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log('error');
                $('body').addClass('loaded');
                alert("Status: " + textStatus); 
                alert("Error: " + errorThrown);  
                $("#modal-failed-address").modal('show');
                document.getElementById('message-success-address').innerHTML = "Data gagal ditambahkan";
            } 
        });
    });
</script>