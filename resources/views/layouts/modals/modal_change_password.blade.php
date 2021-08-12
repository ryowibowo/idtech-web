<!-- Modal Rubah Password -->
<div class="modal fade" id="modal-rubah-password" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header no-border">
        <h4 class="modal-title w-100 text-center color-primary" id="exampleModalLabel">Rubah Kata Sandi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <span style="color: red; font-size: 12px; font-family: sans-serif;" id="message_failed"></span>

        <div class="form-group">
        <form method="post" action="#" id="form_change_password">  
            {{ csrf_field() }}
            <label >Kata Sandi Lama</label>
            <input type="password" name="old_password" class="form-control " placeholder="Kata Sandi Lama Anda"/>
            <small id="emailHelp" class="form-text text-muted"><p class="warning"></p></small>
        </div>
        <div class="form-group">
            <label >Kata Sandi Baru</label>
            <input type="password" name="new_password" class="form-control " placeholder="Kata Sandi Baru Anda"/>
            <small id="emailHelp" class="form-text text-muted"><p class="warning"></p></small>
        </div>
        <div class="form-group">
            <label >Konfrimasi Kata Sandi Baru</label>
            <input type="password" name="confirm_password" class="form-control " placeholder="Konfrimasi  Kata Sandi Baru Anda"/>
            <small id="emailHelp" class="form-text text-muted"><p class="warning"></p></small>
        </div>
        </div>
        <div class="modal-footer no-border">
        <button type="submit" class="btn btn-primary btn-block" data-toggle="dismis">Update</button>
        </div>
    </form>
    </div>
    </div>
</div>

<script>
document.getElementById("message_failed").innerHTML = '';
$('#form_change_password').submit(function (e) {
    e.preventDefault();
    console.log($(this).serialize());
    $('#modal-rubah-password').modal('hide');
    $('body').removeClass('loaded');
    $.ajax({
        type: "POST",
        url: "{{ url('/profile/changePassword') }}",
        data: $(this).serialize(),
        success: function (r) {
            $('body').addClass('loaded');
            if (r.code != 200) {
                $('#modal-rubah-password').modal('show');
                document.getElementById("message_failed").innerHTML = "Error code : "+r.code;
            } else {
                if(r.isSuccess == true){
                    $("#modal-success-change").modal('show');
                    document.getElementById('message-success-change').innerHTML = "Data berhasil diupdate";
                }else{
                    $('#modal-rubah-password').modal('show');
                    document.getElementById("message_failed").innerHTML = r.message;
                }
            }
        },
        error: function(result){
            $('body').addClass('loaded');
            $("#modal-failed-address").modal('show');
            document.getElementById('message-success-address').innerHTML = "Data gagal diupdate";
        }
    });
});
</script>
<script>
$(document).on('click', '.btn-ok-change', function () {
  $(".modal-address").modal('hide');
  window.location = "{{ url('/profile') }}";
});
</script>

<div class="modal fade modal-change" id="modal-success-change" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center>
                  <img src="<?php echo URL::to('/'); ?>/assets/img/img_success.png" style="width:150px;height:150px;margin-bottom:20px">
                  <div style="color:#666;"><span id="message-success-change">Yeayyy... Sukses</span></div>
                </center>
            </div>
            <div class="modal-footer no-border">
                <a class="btn btn-primary btn-block btn-ok-change" data-dismiss="modal-success-change" class="">Oke, siap</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-change"id="modal-failed-change" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center>
                  <img src="<?php echo URL::to('/'); ?>/assets/img/img_failed.png" style="width:150px;height:150px;margin-bottom:20px">
                  <div style="color:#666;" id="message-failed-change"><span id="message-failed-change">Yahhh... Gagal</span></div>
                </center>
            </div>
            <div class="modal-footer no-border">
                <a class="btn btn-primary btn-block btn-ok-change" data-dismiss="modal-failed-change">Oke, siap</a>
            </div>
        </div>
    </div>
</div>