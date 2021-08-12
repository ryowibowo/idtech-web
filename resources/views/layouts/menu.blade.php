<div class="row profile-login mb-4">
    <div class="col-md-4">
    <img class="rounded-circle img-responsive" alt="" src="">
    </div>
    <div class="col-md-8">
    <p class="profile-name">{{ @$profile->user_name}} </p>
    <p class="profile-name">Saldo : {{ @$profile->saldo}} </p>
    <a href="{{ url('/profile') }}" class="profile-link">Edit Profil</a>
    </div>
</div>
<div class="list-group">
    <a href="{{ url('/profile/saldo') }}" class="list-group-item list-group-item-action"><i class="fa fa-money"></i> Riwayat Saldo</a>
    <a href="{{ url('/profile/history') }}" class="list-group-item list-group-item-action"><i class="fa fa-history"></i> Riwayat Transaksi</a>
    <a href="{{ url('/profile/complaintHistory') }}" class="list-group-item list-group-item-action"><i class="fa fa-comment"></i> Riwayat Complain</a>
    <a href="{{ url('/profile/address') }}" class="list-group-item list-group-item-action"><i class="fa fa-map-marker"></i> Alamat Pengiriman</a>
    <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal-rubah-password" ><i class="fa fa-unlock-alt"></i> Ubah Kata Sandi</a>
</div>