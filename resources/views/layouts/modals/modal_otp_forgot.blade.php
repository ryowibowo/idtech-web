<!-- Modal OTP Forget  -->
<form method="post" action="#" id="form_otp-forget">
    <div class="modal fade" id="modal-otp-forget" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                        <p>Kode OTP telah dikirim<br>ke Email Anda,<br>Silahkan masukan Kode OTP Anda</p>

                                        <div class="form-group digit-group-forgot" data-group-name="digits">
                                            <input type="text" name="otp_code[]" maxlength="1" size="1" id="digit-1" data-next="digit-2" onkeypress='validate(event)'>
                                            <input type="text" name="otp_code[]" maxlength="1" size="1" id="digit-2" data-next="digit-3" data-previous="digit-1" onkeypress='validate(event)'>
                                            <input type="text" name="otp_code[]" maxlength="1" size="1" id="digit-3" data-next="digit-4" data-previous="digit-2" onkeypress='validate(event)'>
                                            <input type="text" name="otp_code[]" maxlength="1" size="1" id="digit-4" data-next="digit-5" data-previous="digit-3" onkeypress='validate(event)'>
                                            <input type="text" name="otp_code[]" maxlength="1" size="1" id="digit-5" data-next="digit-6" data-previous="digit-4" onkeypress='validate(event)'>
                                            <input type="text" name="otp_code[]" maxlength="1" size="1" id="digit-6" data-previous="digit-5" onkeypress='validate(event)'>
                                            <div>
                                                <span style="color: red; font-size: 12px; font-family: sans-serif;" id="message_failed_otp"></span>
                                            </div>
                                        </div>
                                        <h4 id="time_forget">05:00</h4>
                                        <a href="#" id="resendForgetOtp" onclick="resetOTP()"><i class="fa fa-undo"></i> &nbsp;&nbsp;Kirim Ulang OTP</a><br><br>
                                        <span style="color: red; font-size: 15px; font-family: sans-serif;" id="message_otp_forget"></span><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-header">
                    <button type="submit" class="btn btn-primary btn-block">Konfirmasi</button>
                </div>

            </div>
        </div>
    </div>
</form>

<script>
    var timerForget;
    function startTimerForget(duration, display) {
        timerForget = duration;
        var minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timerForget / 60, 10)
            seconds = parseInt(timerForget % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.text(minutes + ":" + seconds);

            if (--timerForget < 0) {
                timerForget = duration;
            }
        }, 1000);
    }

    function callTimerForget() {
        jQuery(function ($) {
            var fiveMinutes = 60 * 5,
            display = $('#time_forget');
            startTimerForget(fiveMinutes, display);
        });
    }

    function resetTimerForget() {
        timerForget = 60 * 5;
    }
</script>

<script>
    document.getElementById("message_forget_otp").innerHTML = '';
    $('#form_otp-forget').submit(function (e) {
        e.preventDefault();
        console.log($(this).serialize());
        $('body').removeClass('loaded');
        $('#modal-otp-forget').modal('hide');
        $.ajax({
            type: "POST",
            url: "{{ url('/beranda/verifyForget') }}",
            data: $(this).serialize(),
            success: function (r) {
                $('body').addClass('loaded');
                if (r.code != 200) {
                    $('#modal-otp-forget').modal('show');
                    document.getElementById("message_otp_forget").innerHTML = "";
                    document.getElementById("message_forget_otp").innerHTML = "Error code : "+r.code+", "+r.message;
                } else {
                    if(r.isSuccess == true){
                        $('#modal-otp-forget').modal('hide');
                        $('#modal-new-password').modal('show');
                    }else{
                        $('#modal-otp-forget').modal('show');
                        document.getElementById("message_otp_forget").innerHTML = "";
                        document.getElementById("message_forget_otp").innerHTML = r.message;
                    }
                }
            }
        });
    });
</script>

<script>
    document.getElementById("message_otp_forget").innerHTML = '';
    $(document).on('click', '#resendForgetOtp', function () {
        $('#modal-otp-forget').modal('hide');
        $('body').removeClass('loaded');
        var username = $("#emailaddress").val();
        var is_agent = "{{Session::get('is_agent')}}";

        var url = "{{env('URL_API')}}/" + "auth/sendOTPReset";
        $.post(url, {
                "is_agent": is_agent,
                "username": username
            }).done(function (data) {
                $('#modal-otp-forget').modal('show');
                $('body').addClass('loaded');
                if(data.isSuccess == true){
                    document.getElementById("message_forget_otp").innerHTML = '';
                    document.getElementById("message_otp_forget").innerHTML = data.message;
                    resetTimerForget();
                }else{
                    document.getElementById("message_forget_otp").innerHTML = '';
                    document.getElementById("message_otp_forget").innerHTML = data.message;
                }
            }
        );

    });
</script>
<script>
$('.digit-group-forgot').find('input').each(function() {
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

@include('layouts.modals.modal_reset_password')