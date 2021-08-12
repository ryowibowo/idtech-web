<!-- Modal Daftar -->
{{-- <form method="post" action="#" id="register_form"> --}}
    <div class="modal fade" id="modal-daftar"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">

                <div class="modal-header no-border">
                    <h3 class="modal-title w-100 text-center color-primary" id="exampleModalLabel">Daftar</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="container no-padding">
                        <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Individu</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Perusahaan</a>
                            </li>
                          </ul>
                          <br>
                          <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <form method="post" action="#" id="register_form" enctype="multipart/form-data">
                                         {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="emailaddress">Nama Lengkap</label>
                                            <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap Anda" required/>
                                            <small id="emailHelp" class="form-text text-muted"><p class="warning"></p></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailaddress">NPWP</label>
                                            <input type="number" name="npwp" class="form-control" placeholder="NPWP Anda">
                                            <small id="emailHelp" class="form-text text-muted"><p class="warning"></p></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailaddress">Email</label>
                                            <input class="form-control" name="email" type="email" placeholder="Email Anda" required/>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailaddress">Nomor Seluler</label>
                                            <input class="form-control" name="phone_number" type="number" placeholder="Nomor Seluler" required/>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailaddress">Password</label>
                                            <input class="form-control" name="password" type="password" placeholder="Password Anda" required/>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailaddress">Konfirmasi Password</label>
                                            <input class="form-control" name="confirm_password" type="password" placeholder="Konfirmasi Password Anda" required/>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                            <label class="form-check-label" for="exampleCheck1">Setuju dengan Syarat & Ketentuan</label>
                                        </div>
                                        <div class="clearfix"></div>
                                    <input type="submit" style="display: none" id="btn-submitform1">
                                    </form>    
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                    <form method="post" action="#" id="register_form2" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="emailaddress">Nama Perusahaan / Organisasi</label>
                                            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Nama Perusahaan Anda" required/>
                                            <small id="emailHelp" class="form-text text-muted"><p class="warning"></p></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailaddress">NPWP Perusahaan</label>
                                            <input type="number" id="npwp" name="npwp" class="form-control" placeholder="NPWP Perusahaan Anda" required/>
                                            <small id="emailHelp" class="form-text text-muted"><p class="warning"></p></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailaddress">Nama PIC</label>
                                            <input type="text" id="pic" name="pic" class="form-control" placeholder="Nama PIC Anda" required/>
                                            <small id="emailHelp" class="form-text text-muted"><p class="warning"></p></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailaddress">Email</label>
                                            <input class="form-control" id="email" name="email" type="email" placeholder="Email Anda" required/>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailaddress">Nomor Seluler</label>
                                            <input class="form-control" id="phone_number" name="phone_number" type="number" placeholder="Nomor Seluler" required/>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailaddress">Password</label>
                                            <input class="form-control" id="password" name="password" type="password" placeholder="Password Anda" required/>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailaddress">Konfirmasi Password</label>
                                            <input class="form-control" id="confirm_password" name="confirm_password" type="password" placeholder="Konfirmasi Password Anda" required/>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="emailaddress">Alamat NPWP</label>
                                            <textarea class="form-control" id="npwp_address" name="npwp_address" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input id="npwp_image" type="file" name="npwp_image" class="form-control" required>
                                        </div>

                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                            <label class="form-check-label" for="exampleCheck1">Setuju dengan Syarat & Ketentuan</label>
                                        </div>
                                        <div class="clearfix"></div>
                                        <input type="submit" style="display: none" id="btn-submitform2">
                                    </form>
                                </div>
                          </div>

                        
                        {{-- <div class="form-group">
                            <label for="emailaddress">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap Anda" required/>
                            <small id="emailHelp" class="form-text text-muted"><p class="warning"></p></small>
                        </div>
                        <div class="form-group">
                            <label for="emailaddress">Email</label>
                            <input class="form-control" name="email" type="email" placeholder="Email Anda" required/>
                        </div>
                        <div class="form-group">
                            <label for="emailaddress">Nomor Seluler</label>
                            <input class="form-control" name="phone_number" type="number" placeholder="Nomor Seluler" required/>
                        </div>
                        <div class="form-group">
                            <label for="emailaddress">Password</label>
                            <input class="form-control" name="password" type="password" placeholder="Password Anda" required/>
                        </div>
                        <div class="form-group">
                            <label for="emailaddress">Konfirmasi Password</label>
                            <input class="form-control" name="confirm_password" type="password" placeholder="Konfirmasi Password Anda" required/>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                            <label class="form-check-label" for="exampleCheck1">Setuju dengan Syarat & Ketentuan</label>
                        </div>

                        <div class="clearfix"></div> --}}
                    </div>
                </div>
                <div class="modal-footer no-border">
                    <button type="button" id="btn-submit" class="btn btn-primary btn-block" data-toggle="modal">Daftar</button>
                </div>

            </div>
        </div>
    </div>
{{-- </form> --}}
<script>
    $('#btn-submit').on('click', function(e){
        e.preventDefault();
        if ($('#pills-home').hasClass("active")) {
            $('#btn-submitform1').click();
        }else{
            $('#btn-submitform2').click();
            // $('#register_form2').submit();
        }
        
    });
    $('#register_form').submit(function (e) {
        try{
            e.preventDefault();
            console.log($(this).serialize());
            $('#modal-daftar').modal('hide');
            $('body').removeClass('loaded');
            $.ajax({
                type: "POST",
                url: "{{ url('/beranda/register') }}",
                data: $(this).serialize(),
                success: function (r) {
                    $('body').addClass('loaded');
                    if (r.code != 200) {
                        $('#modal-daftar').modal('hide');
                        $('#modal-gagal-daftar').modal('show');
                        document.getElementById("message_failed").innerHTML = "Error Code "+r.code;
                        console.log("error");
                    } else {
                        console.log("success");
                        if(r.isSuccess == false){
                            console.log("false");
                            $('#modal-daftar').modal('hide');
                            $('#modal-gagal-daftar').modal('show');
                            document.getElementById("message_failed").innerHTML = r.message;
                        }else{
                            console.log("true");
                            $('#modal-daftar').modal('hide');
                            $('#modal-sukses-daftar').modal('show');
                        }
                    }
                }
            });
        }catch(e){
            $('#modal-daftar').modal('hide');
            $('#modal-gagal-daftar').modal('show');
            document.getElementById("message_failed").innerHTML = e;
            console.log("catch");
        }
    });

    $('#register_form2').submit(function (e) {
        try{
            e.preventDefault();
            // console.log($(this).serialize());
            $('#modal-daftar').modal('hide');
            $('body').removeClass('loaded');
            
            var nama_lengkap = $('#nama_lengkap').val();
            var npwp = $('#npwp').val();
            var pic = $('#pic').val();
            var email = $('#email').val();
            var phone_number = $('#phone_number').val();
            var password = $('#password').val();
            var confirm_password = $('#confirm_password').val();
            var npwp_address = $('#npwp_address').val();
            var npwp_image  = $('#npwp_image').prop('files')[0];

            var form_data = new FormData();

            form_data.append('nama_lengkap', nama_lengkap);
            form_data.append('npwp', npwp);
            form_data.append('pic', pic);
            form_data.append('email', email);
            form_data.append('phone_number', phone_number);
            form_data.append('password', password);
            form_data.append('confirm_password', confirm_password);
            form_data.append('npwp_address', npwp_address);
            form_data.append('npwp_image', npwp_image);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ url('/beranda/register') }}",
                data:form_data,
                contentType: false,
                processData: false,
                success: function (r) {
                    $('body').addClass('loaded');
                    if (r.code != 200) {
                        $('#modal-daftar').modal('hide');
                        $('#modal-gagal-daftar').modal('show');
                        document.getElementById("message_failed").innerHTML = "Error Code "+r.code;
                        console.log("error");
                    } else {
                        console.log("success");
                        if(r.isSuccess == false){
                            console.log("false");
                            $('#modal-daftar').modal('hide');
                            $('#modal-gagal-daftar').modal('show');
                            document.getElementById("message_failed").innerHTML = r.message;
                        }else{
                            console.log("true");
                            $('#modal-daftar').modal('hide');
                            $('#modal-sukses-daftar').modal('show');
                        }
                    }
                }
            });
        }catch(e){
            $('#modal-daftar').modal('hide');
            $('#modal-gagal-daftar').modal('show');
            document.getElementById("message_failed").innerHTML = e;
            console.log("catch");
        }
    });
</script>

<script>
$(document).on('click', '#button_failed_ok', function () {
    $('#modal-daftar').modal('show');
    $('#modal-gagal-daftar').modal('hide');
});

$(document).on('click', '#button_success_ok', function () {
    $('#modal-login').modal('show');
    $('#modal-sukses-daftar').modal('hide');
});
</script>


<!-- Modal Sukses Registration -->
<div class="modal fade" id="modal-sukses-daftar" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header no-border">
                <h4 class="modal-title w-100 text-center color-primary" id="exampleModalLabel">Konfirmasi </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center><p> Selamat, Anda terdaftar di website IDtech Solusi. Silahkan login</p></center>
            </div>
            <div class="modal-footer no-border">
                <a class="btn btn-primary btn-block" data-dismiss="modal" id="button_success_ok">OK</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-gagal-daftar" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header no-border">
                <h4 class="modal-title w-100 text-center color-primary" id="exampleModalLabel">Konfirmasi </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center><p id="message_failed"></p></center>
            </div>
            <div class="modal-footer no-border">
                <a class="btn btn-primary btn-block" data-dismiss="modal" id="button_failed_ok">OK</a>
            </div>
        </div>
    </div>
</div>