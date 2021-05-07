
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login <?=data_app()?></title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

<link href='https://fonts.googleapis.com/css?family=Raleway:300,200' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">


      <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
<link href="<?=base_url()?>assets/vendor/datepicker/css/datepicker3.css" rel="stylesheet">

</head>

<body>

  <div class="menu">
  <ul class="mainmenu clearfix" style="margin-left:-38px">
    <li class="menuitem"><?="Aplikasi ".data_app()?></li>
  </ul>
</div>

<div class="form">
    <form id="signup-form" method="post" action="<?=base_url()?>auth/login">
  <div class="forceColor"></div>
  <div class="topbar">
    <div class="spanColor"></div>
    <input type="text" class="input" id="username" name="username" placeholder="Username"/>
    <input type="password" class="input" id="password" name="password" placeholder="Password"/>
  </div>
  <button class="submit" id="submit" >Login</button>
</form>
</div>

  <script src="<?=base_url()?>assets/vendor/inspinia/js/jquery-2.1.1.js"></script>
  <script src="<?=base_url()?>assets/vendor/datepicker/js/bootstrap-datepicker.js"></script>
  <script src="<?=base_url()?>assets/js/sf.js"></script>
    <script  src="<?=base_url()?>assets/js/login.js"></script>





</body>

</html>
