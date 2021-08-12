<!-- Modal masukin password baru -->
<div class="modal fade" id="modal-new-password" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <span style="color: red; font-size: 12px; font-family: sans-serif;" id="message_new_password"></span><br>
                    <form method="post" action="#" id="new-password-form" data-status="0">
                        {{ csrf_field() }}
                        <label for="emailaddress">Masukan Password Baru</label>
                        <input type="password" name="new_password" class="form-control " id="emailaddress_forgot" placeholder="Masukan password"/>
                        <small id="emailHelp" class="form-text text-muted"><p class="warning"></p></small>

                        <label for="emailaddress">Konfirmasi Password</label>
                        <input type="password" name="confirm_password" class="form-control " id="" placeholder="Konfirmasi Password"/>
                        <small id="emailHelp" class="form-text text-muted"><p class="warning"></p></small>
                </div>
            </div>
            <div class="modal-footer no-border">
                <button type="submit" class="btn btn-primary btn-block" data-toggle="modal" id="btn_forget">Ubah Kata Sandi</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById("message_new_password").innerHTML = '';
    $('#new-password-form').submit(function (e) {
        e.preventDefault();
        console.log($(this).serialize());
        $('body').removeClass('loaded');
        $('#modal-new-password').modal('hide');
        $.ajax({
            type: "POST",
            url: "{{ url('/beranda/changeForgotPassword') }}",
            data: $(this).serialize(),
            success: function (r) {
                $('body').addClass('loaded');
                if (r.code != 200) {
                    $('#modal-konfirmasi-reset').modal('show');
                    document.getElementById("message_konfirmasi_reset").innerHTML = 'Password gagal diubah';

                } else {
                    if(r.isSuccess == true){
                        $('#modal-new-password').modal('hide');
                        $('#modal-konfirmasi-reset').modal('show');
                        document.getElementById("message_konfirmasi_reset").innerHTML = 'Password berhasil diubah';
                    }else{
                        $('#modal-konfirmasi-reset').modal('show');
                        document.getElementById("message_konfirmasi_reset").innerHTML = 'Password gagal diubah';
                    }
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            } 
        });
    });
</script>


<!-- Modal password berhasil dirubah-->
<div class="modal fade" id="modal-konfirmasi-reset" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header no-border">
                <h4 class="modal-title w-100 text-center color-primary" id="exampleModalLabel">Konfirmasi </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center><p id="message_konfirmasi_reset"> </p></center>
            </div>
            <div class="modal-footer no-border">
                <button type="button" class="btn btn-primary btn-block"  data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>