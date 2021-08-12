@section('title', env('APP_NAME') .' | Tentang '. env('APP_NAME'))
@include('layouts.header')
<section class="breadcrumbs-wrap margin-b20">
    <div class="container-fluid breadcrumb-whitesmoke">
        <div class="container no-padding ">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="{{url('beranda')}}" class="color-primary"><i class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tentang {{env('APP_NAME')}}</li>

                </ol>
                <button class="pull-right">
                    <a href="{{url('aboutus/download')}}" class="color-primary"><i class="fa fa-download"></i></a>
                </button>
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

<div class="content-wrap about-wrap margin-tb50">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @if($about->image == null)
                <img src="<?php echo URL::to('/'); ?>/assets/img/img-about.jpg" class="img-fluid">
                @else
                <img src="{{$about->image}}" class="img-fluid">
                @endif
            </div>
            <div class="col-md-6">
                <h1 class="color-primary">{{$about->name}}</h1>
                <?= $about->about; ?>
            </div>
        </div>
    </div>
</div>

<div class="content-wrap competence-wrap margin-tb50">
    <div class="container">
        <div class="row">
            <div class="col-md-6" style="margin-top: 2.24%">
                <div class="col-md-12 img-quote">
                    <img width="37.75px" src="{{ asset('assets/img/vector.png')}}">
                </div>
                <div class="col-md-12 text-quote" >
                    <p class="competence-quote">
                        Bekerja sama dengan Principal Worldwide dengan teknologi yang inovatif, Untuk menyediakan solusi dan jasa di berbagai industri bisnis
                    </p>
                </div>
                <div class="col-md-12 img-quote-2">
                    <img  src="{{ asset('assets/img/charles-deluvio.png')}}">
                </div>
            </div>
            <div class="col-md-6" style="margin-top: 2.24%">
                <div class=" text-kompetensi">
                    <label class="label-kompetensi">Kompetensi</label>
                    <ul class="kompetensi-list">
                        <li><span class="text-list">Pengembangan software dan tenaga ahli</span></li>
                        <li><span class="text-list">Jasa jaringan dan data center</span></li>
                        <li><span class="text-list">Sistem integrator dan penyedia solusi end-to-end</span></li>
                        <li><span class="text-list">Penyedia hardware dan peripheral yang lengkap dan bervariasi</span></li>
                        <li><span class="text-list">Layanan solusi di sector Pemerintah dan Pendidikan</span></li>
                    </ul>
                </div>
                <div class=" text-kompetensi" style="padding-top: 20px;">
                    <label class="label-kompetensi">End-to-End Solution</label>
                    <ul class="kompetensi-list">
                        <li><span class="text-list">Infrastruktur hardware dan pengembangan aplikasi inhouse sesuai kebutuhan client</span></li>
                        <li><span class="text-list">E-Commerce development</span></li>
                        <li><span class="text-list">Hospitality solution dengan menyediakan Property Management System dan Channel Manager System dengan sistem SaaS</span></li>
                        <li><span class="text-list">Op-Ex (Operating Lease & managed Services), penyediaan hardware dengan sistem sewa</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-wrap product-solution-wrap margin-tb50">
    <div class="container">
        <div class="row">
            <label class="label-product-solution text-center">Produk & Solusi</label>
        </div>
        <div style="display: inline-flex;width: 100%">
            <div class="col-lg-6" style="margin-top: 2.24%;display: inline-flex;">
                <div class="col-md-3">
                    <img src="{{ asset('assets/img/icon-1.png')}}">
                </div>
                <div class="col-md-9">
                    <label class="label-product-solution-list">Software Development</label>
                    <ul class="product-solution-list">
                        <li><span class="text-list">Strategic Planning & Analysis</span></li>
                        <li><span class="text-list">Gives closer look to detailed process of project</span></li>
                        <li><span class="text-list">Ready to launch phase</span></li>
                        <li><span class="text-list">Never-ending proces of updating system periodically</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6" style="margin-top: 2.24%;display: inline-flex;">
                <div class="col-md-3">
                    <img src="{{ asset('assets/img/icon-2.png')}}">
                </div>
                <div class="col-md-9">
                    <label class="label-product-solution-list">IT System Consultant</label>
                    <ul class="product-solution-list">
                        <li><span class="text-list">Reduce Cost and Control Operating Expenses</span></li>
                        <li><span class="text-list">Reduce Downtime</span></li>
                        <li><span class="text-list">Obtain On-Demand Resources</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div style="display: inline-flex;width: 100%">
            <div class="col-lg-6" style="margin-top: 2.24%;display: inline-flex;">
                <div class="col-md-3">
                    <img src="{{ asset('assets/img/icon-3.png')}}">
                </div>
                <div class="col-md-9">
                    <label class="label-product-solution-list">OnlineShop B2C & B2BT</label>
                    <ul class="product-solution-list">
                        <li><span class="text-list">Free Delivery Jakarta Area</span></li>
                        <li><span class="text-list">Enterprise Payment Security</span></li>
                        <li><span class="text-list">Trusted Product Warranty</span></li>
                        <li><span class="text-list">Ease of Transactions</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6" style="margin-top: 2.24%;display: inline-flex;">
                <div class="col-md-3">
                    <img src="{{ asset('assets/img/icon-4.png')}}">
                </div>
                <div class="col-md-9">
                    <label class="label-product-solution-list">Business to Government</label>
                    <ul class="product-solution-list">
                        <li><span class="text-list">24/7 Costumer Services</span></li>
                        <li><span class="text-list">Many Product Choices</span></li>
                        <li><span class="text-list">Trusted Product Warranty</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-wrap product-solution-wrap margin-tb50">
    <div class="container">
        <div class="row">
            <label class="label-product-solution text-center">Pelanggan Kami</label>
        </div>
        @if(!empty($about->customer_icon))
            @foreach($about->customer_icon as $row)
                <div style="display: inline-flex;width: 100%;margin-top: 30px;">
                    @foreach($row as $value)
                        <div  class="col-lg-2">
                            <img width="40%"  src="{{ $value }}">
                        </div>
                    @endforeach
                </div><br>
            @endforeach
        @endif
    </div>
</div>
@include('layouts.footer')
@include('layouts.redirect_notification')
@if(!Session::has('user_id'))
@include('layouts.modals.modal_login')
@include('layouts.modals.modal_register')
@endif
