@section('title', env('APP_NAME') .' | Detail Complaint')
@include('layouts.header')
<style>
#imagePreviewComplaintSatu,
#imagePreviewComplaintDua,
#imagePreviewComplaintTiga {
    width: 100px;
    height: 100px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    background-image: url('https://cdn1.iconfinder.com/data/icons/linkedin-ui-glyph/48/Sed-16-512.png');
}

.modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}

.breakdown-subtotal{
    margin-left: 1px;
    color: grey;
}
.text-grey{
    color: grey;
}
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
<link rel="stylesheet" href="<?php echo URL::to('/'); ?>/assets/css/magnific-popup.css">

<section class="breadcrumbs-wrap margin-b20">
    <div class="container-fluid  breadcrumb-whitesmoke">
        <div class="container no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="index.html" class="color-primary"><i
                                class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ url('/profile/history') }}">Riwayat</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Order
                        #{{$complaint_detail->order_code}}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row order-detail mt-4 mb-5">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="container no-padding">
                            <div class="row">
                                @if(!empty($complaint_detail->issue_attachment))
                                    @foreach($complaint_detail->issue_attachment as $attachment)
                                        <div class="col-md-4 product-card-wrap">
                                            <div class="product-card">
                                                <a href="{{ $attachment }}" data-group="1" class="popupImagesAttachment">
                                                    <img class="img-thumbnail card-img-top smallimg" style="height: 200px; cursor: default;" src="{{ $attachment }}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8">
                        <div class="title-checkout-wrap">
                            <h3 class="card-title color-primary float-left">Detail Complaint</h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="container no-padding">
                            <div class="detil-wrap">
                                <ul class="list-group list-group-flush ">
                                    @if(!empty($complaint_detail->issue_detail))
                                        @foreach($complaint_detail->issue_detail as $row)
                                            <li class="list-group-item">
                                                <div class="col-md-6 product-card-wrap">
                                                    <div class="product-card">
                                                        <a href="{{ $row['prod_image'] }}" data-group="1" class="popupImagesProduct">
                                                            <img class="img-thumbnail card-img-top smallimg" style="height: 200px; cursor: default;" src="{{ $row['prod_image'] }}" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>{{ $row['prod_name'] }}</h5>
                                                    <ul class="list-group list-group-flush ">
                                                        <li class="list-group-item">
                                                            <label class="order-left">Masalah</label>
                                                            <label class="order-right">{{ $row['issue_category_name'] }}</label>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <label class="order-left">Jumlah</label>
                                                            <label class="order-right">{{ $row['quantity'] }}</label>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <label class="order-left">Detail masalah</label>
                                                            <label class="order-right">{{ $row['issue_detail_notes'] }}</label>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                    
                                    <li class="list-group-item">
                                        <label class="order-left">Solusi yang diinginkan</label>
                                        <label class="order-right">{{ @$complaint_detail->issue_solution_name}}</label>
                                    </li>
                                    <li class="list-group-item">
                                        <label class="order-left">Status</label>
                                        @if ($complaint_detail->issue_status_name == "Selesai")
                                        <label class="order-right">{{ $complaint_detail->issue_status_name }}</label>
                                        @else
                                        <label class="order-right text-danger">{{ $complaint_detail->issue_status_name }}</label>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row user-profile mt-4 mb-5">
            <div class="col-md-12">
                <div class="title-checkout-wrap">
                    <h3 class="card-title color-primary float-left">Chat</h3>
                    <div class="clearfix"></div>
                </div>
                <main class="content">
                    <div class="container p-0">
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
                                                <input type="hidden" name="issue_id" value="{{ $complaint_detail->issue_id }}" class="form-control">
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
<section>
    <div class="container">
        <div class="row order-detail mt-4 mb-5">
            <div class="col-md-12">
            </div>
        </div>
    </div>
</section>
@include('layouts.footer')
@include('layouts.redirect_notification')

@include('layouts.redirect_notification')
@include('layouts.redirect_chat')
<script src="<?php echo URL::to('/'); ?>/assets/js/jquery.magnific-popup.js"></script>
<script>
    $(document).ready(function () {
        $('.popupImagesAttachment').magnificPopup({type:'image'});
        $('.popupImagesProduct').magnificPopup({type:'image'});

        var user_id    = "{{ Session::get('user_id') }}";
        var issue_id   = "{{ $complaint_detail->issue_id }}";
        var user_image = "{{ Session::get('user_image') }} ";
        if (user_image == ' ' || user_image == '') {
            user_image = "{{ env('JUST_URL_API').'/img/icon-user-default.png' }}";
        }
        $('body').addClass('loaded-chat');
        setInterval(function () {
            $.ajax({
                url: "{{ env('URL_API'). '/getChatComplaint/' }}" + encodeURI(issue_id),
                type: "GET",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    $("#div-chat").empty();
                    if (data.status == 200) {
                        $.each(data.data, function (key, value) {
                            let apend_chat = '';
                            if (value.customer_id != null) {
                                apend_chat += '<div class="chat-message-left pb-4"><div><img src="' + user_image + '" class="rounded-circle mr-1" alt="dendry" width="40" height="40"> <div class="text-muted small text-nowrap mt-2"></div></div><div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3"><div class="font-weight-bold mb-1">You</div>' + value.response + '</div></div>';
                            } else {
                                apend_chat += '<div class="chat-message-right pb-4"><div><img src="' + "{{ env('JUST_URL_API').'/img/icon-admin.png' }}" + '" class="rounded-circle mr-1" alt="Admin" width="40" height="40"> <div class="text-muted small text-nowrap mt-2"></div></div><div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3"><div class="font-weight-bold mb-1">Admin</div>' + value.response + '</div></div>';
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
    
    $('.popupImagesAttachment').magnificPopup({type: 'image'});
    $('.popupImagesProduct').magnificPopup({type: 'image'});
</script>
<script>
    $(".form-chat").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: "{{ env('URL_API'). '/sendChatComplaint' }}",
            type: "POST",
            data: form.serialize(),
            success: function (data) {
                console.log(data.status);
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