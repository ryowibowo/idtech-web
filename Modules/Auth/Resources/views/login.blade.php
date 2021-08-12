<!DOCTYPE html>
<html lang="en">
<head>
  <title>IDtech solusi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Muli:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/responsive.css">
</head>

<body>
    
  <!-- login -->
  <section>
    <div class="container">
      <div class="row align-items-center login-row">
        <div class="col-md-6 text-center">
          <img class="img-responsive" src="assets/img/ic-logo-big.svg" alt="">
        </div>
        <div class="col-md-6 login-card">
          <div class="card mx-auto">
            <div class="card-body">
              <h5 class="card-title">Log In</h5>
              <div class="form-group">
                <label for="exampleInputEmail1">Email / Nomor HP</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              </div>
              <div class="alert alert-danger text-center" role="alert">
                Email / Nomor HP atau Kata Sandi salah atau tidak terdaftar!
              </div>
              <div class="content-divider text-muted form-group">
                <span style="background-color: #fff;">Or</span>
              </div>
              <div class="form-group">
                <button type="btn" class="btn btn-block btn-white">
                  <img class="position-left" src="assets/img/brands-and-logotypes.png"></img>
                  Sign in with Google
                </button>
                <button type="btn" class="btn btn-block btn-white">
                  <img class="position-left" src="assets/img/facebook_logo.png"></img>
                  Sign in with Facebook
                </button>
                <button type="btn" class="btn btn-block btn-white">
                  <img class="position-left" src="assets/img/twitter_logo.png"></img>
                  Sign in with Twitter
                </button>
              </div>
            </div>
            <div class="card-footer">
              <label>Belum punya akun?<a href="daftar.html"> Daftar sekarang</a></label>
              <button class="btn btn-success btn-block" onclick="window.location.href='login-next.html';">Selanjutnya</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- footer -->
  <footer class="section-footer mt-5">
    <div class="container">
      <div class="row pt-3">
        <p class="col-md-12 text-center">© 2020 IDtech solusi. All right reserved.</p>
      </div>
    </div><!-- //container -->
  </footer>

  <script src="assets/js/jquery/jquery.min.js"></script>
  <script src="assets/js/bootstrap/bootstrap.min.js"></script>
  <script>
    // show hide password
    $(".show-password").on('click',function() {
      var $pwd = $(".pwd");
      if ($pwd.attr('type') == 'password') {
          $pwd.attr('type', 'text');
          $('.input-group-append i').addClass("ic-eye");
          $('.input-group-append i').removeClass("ic-eye-slash");
      } else if ($pwd.attr('type') == 'text') {
          $pwd.attr('type', 'password');
          $('.input-group-append i').addClass("ic-eye-slash");
          $('.input-group-append i').removeClass("ic-eye");
      }
    });
  </script>
</body>
</html>
