<!-- Modal Login  -->
<div class="modal fade" id="modal-login" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header no-border">
                <h3 class="modal-title w-100 text-center color-primary" id="exampleModalLabel">Log In</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container no-padding">
                    <div class="form">
                        <form method="post" action="#" id="login_form" data-status="0">
                            {{ csrf_field() }}
                            <div class="inputs"> 
                                <div class="form-group">
                                    <div class="email login-email">
                                        <input type="hidden" id='dataStatus' value='0'>
                                        <label for="emailaddress">Email / Nomor Handphone</label><br>
                                        <input type="text" name="username" class="first form-control " id="emailaddress" placeholder="Masukan Email Anda" required>
                                        <div><span style="color: red; font-size: 12px; font-family: sans-serif;" id="message_failed_verifyUsername"></span></div>
                                        <small id="emailHelp" class="form-text text-muted">
                                            <p class="warning"></p>
                                        </small>
                                        <button type="submit" class="btn btn-block btn-primary" style="margin-top:10px;">Selanjutnya</button>
                                        <span>
                                            <p>Belum punya akun? <a href="#" id="button-modal" class="color-green" data-toggle="modal"  data-target="#modal-daftar" >Daftar Sekarang</a></p>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="password login-email">
                                        <div class="filled-email">
                                            <label for="emailaddress">Email / Nomor Handphone</label>
                                            <input type="email" class="first form-control disabled" name="emailaddress_after" id="emailaddress_after" placeholder="aditya.perdana@gmail.com" disabled/>
                                        </div>  
                                        <label for="emailaddress">Kata Sandi</label><br>
                                        <input class="second form-control" type="password" name="password" id="password_after" placeholder="Enter Password"/>
                                        <div><span style="color: red; font-size: 12px; font-family: sans-serif;" id="message_failed_verifyPassword"></span></div>
                                        <button type="submit" class="btn btn-block btn-primary login" id="btn_login" >Log in</button>
                                        <!-- <button type="submit" class="btn btn-block btn-primary login"  onclick="doPreview();">Log in</button> -->
                                        <span><p>Lupa <a href="#" id="button-modal-reset" class="color-green"  data-toggle="modal"  data-target="#modal-reset">Kata Sandi?</a></p></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                    <div class="login-social-media">
                        <button type="button" class="btn btn-facebook btn-block margin-t10" onclick="alert('Sorry, this function Under Construction');"> <i class="fa fa-facebook" aria-hidden="true"></i> Log in melalui Facebook</button>
                        <button type="button" class="btn btn-google btn-block  margin-t10" onclick="alert('Sorry, this function Under Construction');"><i class="fa fa-google-plus" aria-hidden="true"></i> Log in melalui Google</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).on('click', '#button-modal', function () {
    $('#modal-daftar').modal('show');
    $('#modal-login').modal('hide');
});
</script>
<script>
$(document).ready(function(){
    $('#dataStatus').val(0);
});
</script>
<script>
    $('#login_form').submit(function (e) {
        e.preventDefault();
        console.log($(this).serialize());

        var dataStatus = $('#dataStatus').val();
        console.log("data status -> "+dataStatus);
        $('body').removeClass('loaded');
        $('#modal-login').modal('hide');
        var anjing = "{{ url('/beranda/verifyUsername')}}";
        console.log(anjing);
        if (dataStatus == 0) {
            $.ajax({
                type: "POST",
                url: "{{ url('/beranda/verifyUsername')}}",
                data: $(this).serialize(),
                success: function (r) {
                    $('body').addClass('loaded');
                    $('#modal-login').modal('show');
                    if (r.code != 200) {
                        document.getElementById("message_failed_verifyPassword").innerHTML = r.message;
                    } else {
                        if (r.isSuccess == false) {
                            document.getElementById("message_failed_verifyUsername").innerHTML = r.message;
                        }else{
                            document.getElementById("message_failed_verifyPassword").innerHTML = "";
                            $('#emailaddress_after').attr("placeholder", $('#emailaddress').val());
                            $('#emailaddress_after').val($('#emailaddress').val());
                            $('#emailaddress_forgot').val($('#emailaddress').val());
                            $('#emailaddress_forgot_disabled').val($('#emailaddress').val());
                            $('#login_form .inputs').addClass('shift');
                            $('#dataStatus').val('1');
                        }
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
            });
        } else {
            $.ajax({
                type: "POST",
                url: "{{ url('/beranda/login') }}",
                data: $(this).serialize(),
                success: function (r) {
                    $('body').addClass('loaded');
                    $('#modal-login').modal('show');
                    if (r.code != 200) {
                        document.getElementById("message_failed_verifyPassword").innerHTML = r.message;
                    } else {
                        if (r.isSuccess == false) {
                            document.getElementById("message_failed_verifyPassword").innerHTML = "Password salah, harap periksa kembali";
                        } else {
                            document.getElementById("message_failed_verifyPassword").innerHTML = "";
                            console.log('success');
                            callTimer();
                            $('#modal-login').modal('hide');
                            $('#modal-otp').modal('show');
                        }
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    console.log('error');
                    $('body').addClass('loaded');
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }       
            });
        }
    });
</script>

<script>
function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]/;
  if( !regex.test(key) ) {
    console.log('masuk sini');
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>

@include('layouts.modals.modal_otp')

@include('layouts.modals.modal_forgot_password')
<script>
    $('#button-modal-reset').click(function (e){
        $('#modal-login').modal('hide');
    });
</script>


