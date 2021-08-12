@section('title', env('APP_NAME') .' | Notifikasi '. env('APP_NAME'))
@include('layouts.header')
<section class="breadcrumbs-wrap margin-b20">
    <div class="container-fluid breadcrumb-whitesmoke">
        <div class="container no-padding ">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="{{url('beranda')}}" class="color-primary"><i class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">List Notifikasi</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- Start Error Notification -->
<div class="row ml-auto pull-right" style="position:absolute; top: 10px !important; right: 25px !important;z-index:9999999">
    @if($error_notif != "")
    <div class="alert-group" style="width:100%">
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="margin-left:10px">×</button>
            <strong>Error!</strong> get notification<br>
            <a data-toggle="collapse" href="#collapseNotification" role="button" aria-expanded="false" aria-controls="collapseNotification">
                Detail
            </a>
            <div class="collapse" id="collapseNotification">
                <div class="card card-body">
                    {{$error_notif}}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<!-- End Error Notification -->

<div class="content-wrap about-wrap margin-tb50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach($notif as $nt)
                <ul style="list-style-type: none; padding: 0; margin: 0;">
                    <li style="border: 1px solid #ddd; margin-top: -1px; background-color: #f6f6f6;padding: 12px; text-decoration: none; font-size: 18px; color: black; display: block; position: relative;">
                        {{ $nt['message'] }}
                    </li>
                </ul>
                <div>
                    <span style="font-family: cursive; font-size: 70%;"><i>{{ date('d-m-Y H:i:s', strtotime($nt['created_date']))}}</i></span>
                </div>
                <br>
                @endforeach
            </div>

        </div>
    </div>
</div>
@include('layouts.footer')
@include('layouts.redirect_notification')
@if(!Session::has('user_id'))
@include('layouts.modals.modal_login')
@include('layouts.modals.modal_register')
@endif
