<!DOCTYPE html>
<html lang="en">
<head>
  <title><?=data_app()?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
  <link rel="icon" type="image/png" href="<?=base_url()?>assets/vendor/login_v18/images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/vendor/login_v18/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/vendor/login_v18/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/vendor/login_v18/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/vendor/login_v18/vendor/animate/animate.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/vendor/login_v18/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/vendor/login_v18/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/vendor/login_v18/vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/vendor/login_v18/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/vendor/login_v18/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/vendor/login_v18/css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form class="login100-form validate-form" method="post" action="<?=base_url()?>auth/login">
        <?php if ($this->session->userdata('msgcaptcha') != '') {?>
                                <div class="alert alert-warning"><?=$this->session->userdata('msgcaptcha')?></div>
                 <?php }?>
          <span class="login100-form-title p-b-43">
            Login
          </span>


          <div class="wrap-input100 validate-input" data-validate = "Email wajib diisi">
            <input class="input100" type="text" name="username">
            <span class="focus-input100"></span>
            <span class="label-input100">Username</span>
          </div>


          <div class="wrap-input100 validate-input" data-validate="Password wajib diisi">
            <input class="input100" type="password" name="password">
            <span class="focus-input100"></span>
            <span class="label-input100">Password</span>
          </div>
          <div class="wrap-input100 validate-input" data-validate="Captcha wajib diisi">
            <input class="input100" type="text" name="cpt">
            <span class="focus-input100"></span>
            <?php
$cpt = generateCode();

?>
            <span class="label-input100"><?=$cpt['text'];?></span>
            <input type="hidden" name="rescpt" id="rescpt" value="<?=$cpt['res']?>" />
          </div>

          <div class="flex-sb-m w-full p-t-3 p-b-32">
            <div class="contact100-form-checkbox">
              <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
              <!-- <label class="label-checkbox100" for="ckb1">
                Remember me
              </label> -->
            </div>

            <div>
                        <a class="btn btn-link" href="<?=base_url()?>Auth/mintaAkun">
              Belum punya akun?
            </a>
            </div>
          </div>


          <div class="container-login100-form-btn">
            <button class="login100-form-btn">
              Login
            </button>
          </div>

          <!-- <div class="text-center p-t-46 p-b-20">
            <span class="txt2">
              or sign up using
            </span>
          </div>

          <div class="login100-form-social flex-c-m">
            <a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
              <i class="fa fa-facebook-f" aria-hidden="true"></i>
            </a>

            <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
          </div> -->
        </form>

        <div class="login100-more" style="background-image: url('<?=base_url()?>assets/img/img_login.jpg');">
        </div>
      </div>
    </div>
  </div>





<!--===============================================================================================-->
  <script src="<?=base_url()?>assets/vendor/login_v18/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="<?=base_url()?>assets/vendor/login_v18/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="<?=base_url()?>assets/vendor/login_v18/vendor/bootstrap/js/popper.js"></script>
  <script src="<?=base_url()?>assets/vendor/login_v18/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="<?=base_url()?>assets/vendor/login_v18/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="<?=base_url()?>assets/vendor/login_v18/vendor/daterangepicker/moment.min.js"></script>
  <script src="<?=base_url()?>assets/vendor/login_v18/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="<?=base_url()?>assets/vendor/login_v18/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="<?=base_url()?>assets/vendor/login_v18/js/main.js"></script>

</body>
</html>