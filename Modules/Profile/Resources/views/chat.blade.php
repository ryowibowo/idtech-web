@section('title', env('APP_NAME') .' | Chat')
@include('layouts.header')
<style>
    .chat-online {
        color: #34ce57
    }

    .chat-offline {
        color: #e4606d
    }

    .chat-messages {
        display: flex;
        flex-direction: column;
        max-height: 800px;
        overflow-y: scroll
    }

    .chat-message-left,
    .chat-message-right {
        display: flex;
        flex-shrink: 0
    }

    .chat-message-left {
        margin-right: auto
    }

    .chat-message-right {
        flex-direction: row-reverse;
        margin-left: auto
    }
    .py-3 {
        padding-top: 1rem!important;
        padding-bottom: 1rem!important;
    }
    .px-4 {
        padding-right: 1.5rem!important;
        padding-left: 1.5rem!important;
    }
    .flex-grow-0 {
        flex-grow: 0!important;
    }
    .border-top {
        border-top: 1px solid #dee2e6!important;
    }
</style>
<section class="breadcrumbs-wrap margin-b40">
    <div class="container-fluid background-gray-blue">
        <div class="container no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="{{ url('/')}}" class="color-primary"><i class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chat</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row user-profile mt-4 mb-5">
            <div class="col-md-12">
                <main class="content">
                    <div class="container p-0">

                        <h1 class="h3 mb-3">Chat</h1>

                        <div class="card">
                            <div class="row g-0">
                                <div class="col-12 col-lg-12 col-xl-12">
                                    <div class="py-2 px-4 border-bottom d-none d-lg-block">
                                        <div class="d-flex align-items-center py-1">
                                            <div class="position-relative">
                                                <img src="{{ env('JUST_URL_API').'/img/icon-admin.png' }}" class="rounded-circle mr-1" alt="Sharon Lessman" width="50" height="50">
                                            </div>
                                            <div class="flex-grow-1 pl-3">
                                                <strong>Admin</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-relative">
                                        <div class="chat-messages p-4" id="div-chat">

                                        </div>
                                    </div>
                                    <form class="form-chat" id="message" action="#" method="post">
                                        <div class="flex-grow-0 py-3 px-4 border-top">
                                            <div class="input-group">
                                                <input type="text" name="chat" id="field-chat" class="form-control" placeholder="Type your message">
                                                <input type="hidden" name="user_id" value="{{ Session::get('user_id') }}" class="form-control">
                                                <button class="btn btn-primary" type="submit">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
@include('layouts.redirect_notification')
<script>
    $(document).ready(function () {
        var user_id = "{{ Session::get('user_id') }}";
        var user_image = "{{Session::get('user_image')}} ";
        if (user_image == ' ' || user_image == '') {
            user_image = "{{ env('JUST_URL_API').'/img/icon-user-default.png' }}";
        }
        $('body').addClass('loaded-chat');
        setInterval(function () {
            $.ajax({
                url: "{{ env('URL_API'). '/getChatByUserId/' }}" + encodeURI(user_id),
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $("#div-chat").empty();
                    if (data.status == 200) {
                        $.each(data.data, function (key, value) {
                            let apend_chat = '';
                            if (value.role == 1) {
                                apend_chat += '<div class="chat-message-left pb-4"><div><img src="' + user_image + '" class="rounded-circle mr-1" alt="dendry" width="40" height="40"> <div class="text-muted small text-nowrap mt-2"></div></div><div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3"><div class="font-weight-bold mb-1">You</div>' + value.chat + '</div></div>';
                            } else {
                                apend_chat += '<div class="chat-message-right pb-4"><div><img src="' + "{{ env('JUST_URL_API').'/img/icon-admin.png' }}" + '" class="rounded-circle mr-1" alt="Admin" width="40" height="40"> <div class="text-muted small text-nowrap mt-2"></div></div><div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3"><div class="font-weight-bold mb-1">Admin</div>' + value.chat + '</div></div>';
                            }
                            $('#div-chat').append(apend_chat);
                        });
                    }
                }
            });
        }, 5000);
        setTimeout(function () {
            $("#field-chat").focus();
            var scrollingElement = document.getElementById("div-chat");
            scrollingElement.scrollTop = scrollingElement.scrollHeight;
        }, 6000);
    });
</script>
<script>
    $(".form-chat").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: "{{ env('URL_API'). '/sendChatByCustomer' }}",
            type: "POST",
            data: form.serialize(),
            success: function (data) {
                if (data.status == 200) {
                    $("#field-chat").val('');
                    setTimeout(function () {
                        $("#field-chat").focus();
                        var scrollingElement = document.getElementById("div-chat");
                        scrollingElement.scrollTop = scrollingElement.scrollHeight;
                    }, 5000);
                } else {
                    alert('Ada yang salah cek coba');
                    console.log(data.message);
                }
            }
        });
    });
</script>