<!-- Modal Rubah Password -->
<div class="modal fade" id="modal-reset" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable"role="document">
        <div class="modal-content">
            <div class="modal-header no-border">
                <h4 class="modal-title w-100 text-center color-primary" id="exampleModalLabel">Lupa Kata Sandi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <form method="post" action="#" id="forget-form" data-status="0">
                        {{ csrf_field() }}
                        <label for="emailaddress">Alamat Email</label>
                        <input type="hidden" name="username" id="emailaddress_forgot" placeholder="Alamat Email Anda"/>
                        <input type="email" disabled class="form-control" id="emailaddress_forgot_disabled" placeholder="Alamat Email Anda"/>
                        <span style="color: red; font-size: 12px; font-family: sans-serif;" id="message_failed_forgot"></span><br>
                        <small id="emailHelp" class="form-text text-muted"><p class="warning"></p></small>
                </div>
            </div>
            <div class="modal-footer no-border">
                <button type="submit" class="btn btn-primary btn-block" data-toggle="modal" id="btn_forget">Reset Kata Sandi</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#forget-form').submit(function (e) {
        e.preventDefault();
        console.log($(this).serialize());
        // var dataStatus = $('#dataStatus').val();
        console.log(dataStatus);
        $('body').removeClass('loaded');
        $('#modal-reset').modal('hide');
        $.ajax({
            type: "POST",
            url: "{{ url('/beranda/sendOTPReset') }}",
            data: $(this).serialize(),
            success: function (data) {
                $('body').addClass('loaded');
                if (data.code != 200) {
                    $('#modal-reset').modal('show');
                    document.getElementById("message_failed_forgot").innerHTML = data.message;
                    //  $('#modal-daftar').modal('hide');
                    //  $('#modal-gagal-daftar').modal('show');
                } else {
                    $('#modal-reset').modal('hide');
                    $('#modal-otp-forget').modal('show');
                    callTimerForget();
                }
            }
        });
    });
</script>


@include('layouts.modals.modal_otp_forgot')