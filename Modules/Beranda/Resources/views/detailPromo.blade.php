@section('title', env('APP_NAME') .' | Detail Banner')
@include('layouts.header')
<section class="breadcrumbs-wrap margin-b20">
    <div class="container-fluid  breadcrumb-whitesmoke">
        <div class="container no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="{{url('beranda')}}" class="color-primary"><i class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Banner Promo</li>
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
    @if($error_banner != "")
    <div class="alert-group" style="width:100%">
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="margin-left:10px">×</button>
            <strong>Error!</strong> get banner<br>
            <a data-toggle="collapse" href="#collapseBanner" role="button" aria-expanded="false" aria-controls="collapseBanner">
                Detail
            </a>
            <div class="collapse" id="collapseBanner">
                <div class="card card-body">
                    {{$error_banner}}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<!-- End Error Notification -->

<div class="content-wrap article-wrap margin-tb50">
    <div class="container">
        <div class="row">
            <div class="col-md-4 ">
                <img src="{{$banner[0]['banner_image']}}" class="img-fluid no-margin">
            </div>
            <div class="col-md-8">
                <h1 class="color-primary">{{$banner[0]['banner_name']}}</h1>
                <p>
                    {{$banner[0]['banner_description']}}
                </p>
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