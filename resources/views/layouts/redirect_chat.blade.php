<script>
    $(".form-btn-chat").submit(function (e) {
        var user_id = "{{Session::get('user_id')}}";
        e.preventDefault();
        if (user_id == "") {
            $('#modal-must-login').modal('show');
        } else {
            $('body').addClass('loaded');
            var form = $(this);
            var url_chat = "{{ env('APP_URL')}}/profile/chat";
            $.ajax({
                url: "{{ env('URL_API'). '/sendChatByCustomerProduct' }}",
                type: "POST",
                data: form.serialize(),
                success: function (data) {
                    if (data.status == 200) {
                        $('body').removeClass('loaded');
                        window.location.href = url_chat;
                    } else {
                        alert('Ada yang salah cek coba');
                        console.log(data.message);
                    }
                }
            });
        }
    });
</script>