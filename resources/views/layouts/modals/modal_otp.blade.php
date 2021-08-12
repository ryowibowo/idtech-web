<!-- Modal OTP  -->
<form method="post" action="#" id="form_otp">
    <div class="modal fade" id="modal-otp" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi OTP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container no-padding">
                        <div class="form">
                            <div class="align-items-center login-row otp edit-profile">
                                <div class="card mx-auto">
                                    <div class="card-body text-center no-pad-bot">
                                        <p>SMS Kode OTP telah dikirim<br>ke email <span id="email_otp"></span>,<br>Silahkan masukan Kode OTP Anda</p>
                                        <!--<p>SMS Kode OTP telah dikirim<br>ke Nomer 0877-6666-5555,<br>Silahkan masukan Kode OTP Anda</p>-->

                                        <div class="form-group digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off">
                                            <input class="otpColoumn" type="text" name="otp_code[]" maxlength="1" size="1" id="digit-1" data-next="digit-2" onkeypress='validate(event)'>
                                            <input class="otpColoumn" type="text" name="otp_code[]" maxlength="1" size="1" id="digit-2" data-next="digit-3" data-previous="digit-1" onkeypress='validate(event)'>
                                            <input class="otpColoumn" type="text" name="otp_code[]" maxlength="1" size="1" id="digit-3" data-next="digit-4" data-previous="digit-2" onkeypress='validate(event)'>
                                            <input class="otpColoumn" type="text" name="otp_code[]" maxlength="1" size="1" id="digit-4" data-next="digit-5" data-previous="digit-3" onkeypress='validate(event)'>
                                            <input class="otpColoumn" type="text" name="otp_code[]" maxlength="1" size="1" id="digit-5" data-next="digit-6" data-previous="digit-4" onkeypress='validate(event)'>
                                            <input class="otpColoumn" type="text" name="otp_code[]" maxlength="1" size="1" id="digit-6" data-previous="digit-5" onkeypress='validate(event)'>
                                            <div>
                                                <span style="color: red; font-size: 12px; font-family: sans-serif;" id="message_failed_otp"></span>
                                            </div>
                                        </div>
                                        <h4 id="time">05:00</h4>
                                        <a href="#" id="resendOtp"><i class="fa fa-undo"></i> &nbsp;&nbsp;Kirim Ulang OTP</a><br><br>
                                        <span style="color: red; font-size: 15px; font-family: sans-serif;" id="message_new_otp"></span><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-header">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    var timer;
    function startTimer(duration, display) {
        timer = duration;
        var minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.text(minutes + ":" + seconds);

            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

    function callTimer() {
        jQuery(function ($) {
            var fiveMinutes = 60 * 5,
            display = $('#time');
            startTimer(fiveMinutes, display);
        });
    }

    function resetTimer() {
        timer = 60 * 5;
    }
</script>

<script>
    document.getElementById("message_failed_otp").innerHTML = '';
    $('#form_otp').submit(function (e) {
        e.preventDefault();
        console.log($(this).serialize());
        $('#modal-otp').modal('hide');
        $('#modal-login').modal('hide');
        $('body').removeClass('loaded');
        $.ajax({
            type: "POST",
            url: "{{ url('/beranda/verifyOtp') }}",
            data: $(this).serialize(),
            success: function (r) {
                $('body').addClass('loaded');
                if (r.code != 200) {
                    $('#modal-otp').modal('show');
                    document.getElementById("message_new_otp").innerHTML = "";
                    document.getElementById("message_failed_otp").innerHTML = "Error code : "+r.code+", "+r.message;
                } else {
                    if(r.isSuccess == false){
                        $('#modal-otp').modal('show');
                        document.getElementById("message_new_otp").innerHTML = "";
                        document.getElementById("message_failed_otp").innerHTML = r.message;
                    }else{
                        window.location = "{{ url('/beranda') }}";
                    }
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log('error');
                $('body').addClass('loaded');
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            } 
        });
    });
</script>

<script>
    document.getElementById("message_new_otp").innerHTML = '';
    $(document).on('click', '#resendOtp', function () {
        var username = $("#emailaddress").val();
        var is_agent = "{{Session::get('is_agent')}}";
        $('#modal-otp').modal('hide');
        $('body').addClass('loaded');
        $('.otpColoumn').val('');
        var url = "{{env('URL_API')}}/" + "auth/resendOTP";
        $.post(url,
                {
                    "is_agent": is_agent,
                    "username": username
                }).done(function (data) {
                    $('body').addClass('loaded');
                    $('#modal-otp').modal('show');
                    if(data.isSuccess == true){
                        resetTimer();
                        document.getElementById("message_failed_otp").innerHTML = "";
                        document.getElementById("message_new_otp").innerHTML = data.message;
                    }else{
                        document.getElementById("message_failed_otp").innerHTML = "";
                        document.getElementById("message_new_otp").innerHTML = data.message;
                    }
                   
                }
            );
    });
</script>

<script>
$('.digit-group').find('input').each(function() {
	$(this).attr('maxlength', 1);
	$(this).on('keyup', function(e) {
		var parent = $($(this).parent());
		
        
		if(e.keyCode === 8 || e.keyCode === 37) {
			var prev = parent.find('input#' + $(this).data('previous'));
			
			if(prev.length) {
				$(prev).select();
			}
		} else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
            var next = parent.find('input#' + $(this).data('next'));
			
			if(next.length) {
				$(next).select();
			} else {
				if(parent.data('autosubmit')) {
					parent.submit();
				}
			}
		}
	});
});
</script>