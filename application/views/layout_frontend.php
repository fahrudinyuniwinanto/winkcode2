	<?php
$this->load->model('Auth_model');
$this->load->model('Pengumuman_model');
$this->load->model('Berita_model');
$this->load->model('Galeri_model');
$this->load->model('Ptk_model');
$this->load->model('Siswa_model');
$this->load->model('Slider_model');

$pengumuman = $this->Pengumuman_model->get_all();
$berita     = $this->Berita_model->get_all();
$totSiswa   = $this->db->query("select * from siswa where alumni=1")->num_rows();
$totAlumni  = $this->db->query("select * from siswa where alumni=0")->num_rows();
$totPtk     = $this->Ptk_model->total_rows();
?>
	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="<?=base_url()?>assets/vendor/education/img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title><?=data_app()?></title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="<?=base_url()?>assets/vendor/education/css/linearicons.css">
			<link rel="stylesheet" href="<?=base_url()?>assets/vendor/education/css/font-awesome.min.css">
			<link rel="stylesheet" href="<?=base_url()?>assets/vendor/education/css/bootstrap.css">
			<link rel="stylesheet" href="<?=base_url()?>assets/vendor/education/css/magnific-popup.css">
			<link rel="stylesheet" href="<?=base_url()?>assets/vendor/education/css/nice-select.css">
			<link rel="stylesheet" href="<?=base_url()?>assets/vendor/education/css/animate.min.css">
			<link rel="stylesheet" href="<?=base_url()?>assets/vendor/education/css/owl.carousel.css">
			<link rel="stylesheet" href="<?=base_url()?>assets/vendor/education/css/jquery-ui.css">
			<link rel="stylesheet" href="<?=base_url()?>assets/vendor/education/css/main.css">
		</head>
<!-- overflow: hidden; => make window not scrollable -->
<body>

		<body>
		  <header id="header" id="home" class="header-scrolled">
	  		<div class="header-top">
	  			<div class="container">
			  		<div class="row">
			  			<div class="col-lg-6 col-sm-6 col-8 header-top-left no-padding">
			  				<ul>
								<li><a href="<?=data_app('APP_FB')?>"><i class="fa fa-facebook"></i></a></li>
								<li><a href="<?=data_app('APP_TWITTER')?>"><i class="fa fa-twitter"></i></a></li>
								<li><a href="<?=data_app('APP_IG')?>"><i class="fa fa-instagram"></i></a></li>
			  				</ul>
			  			</div>
			  			<div class="col-lg-6 col-sm-6 col-4 header-top-right no-padding">
			  				<a href="tel:<?=data_app('APP_TELP')?>"><span class="lnr lnr-phone-handset"></span> <span class="text"><?=data_app('APP_TELP')?></span></a>
			  				<a href="mailto:<?=data_app('APP_EMAIL')?>"><span class="lnr lnr-envelope"></span> <span class="text"><?=data_app('APP_EMAIL')?></span></a>
			  			</div>
			  		</div>
	  			</div>
			</div>
		    <div class="container main-menu">
		    	<div class="row align-items-center justify-content-between d-flex">
			      <div id="logo">
			        <a href="index.html"><img src="<?=base_url()?>assets/vendor/education/img/logo.png" alt="" title="" /></a>
			      </div>
			      <nav id="nav-menu-container">
			        <ul class="nav-menu">
			          <li><a href="<?=base_url()?>frontend">Home</a></li>
			          <li class="menu-has-children"><a href="">Direktori</a>
			            <ul>
			              <li><a href="<?=base_url()?>frontend/ptk">PTK</a></li>
			              <li><a href="<?=base_url()?>frontend/siswa">Siswa</a></li>
			              <li><a href="<?=base_url()?>frontend/alumni">Alumni</a></li>
			              <li class="menu-has-children"><a href="#">Prestasi</a>
			            <ul>
			              <li><a href="<?=base_url()?>frontend/prestasi_sekolah">Sekolah</a></li>
			              <li><a href="<?=base_url()?>frontend/prestasi_guru">Guru</a></li>
			              <li><a href="<?=base_url()?>frontend/prestasi_siswa">Siswa</a></li>
			            </ul>
			          </li>
			            </ul>
			          </li>
			          <li class="menu-has-children"><a href="#">Download</a>
			            <ul>
		              		<li><a href="<?=base_url()?>frontend/pengumuman">Pengumuman</a></li>
			            </ul>
			          </li>
			          <li><a href="<?=base_url()?>frontend/galeri">Galeri</a></li>
			          <li><a href="<?=base_url()?>frontend/video">Video</a></li>

			          <li><a href="<?=base_url()?>frontend/hubungi_kami">Hubungi Kami</a></li>
			        </ul>
			      </nav><!-- #nav-menu-container -->
		    	</div>
		    </div>
		  </header><!-- #header -->


	<div class="wrapper">
		<?php
// print_r($pengumuman);
$this->load->view($content);?>
		 <footer class="footer-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-2 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>Pengumuman</h4>
								<ul>
									<?php foreach (array_slice($pengumuman, 0, 4) as $v) {?>
									<li><a href="#"><?=substr($v->judul, 0, 80)?></a></li>
								<?php }?>
								</ul>
							</div>
						</div>
						<div class="col-lg-2 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>Berita</h4>
								<ul>
									<?php foreach (array_slice($berita, 0, 5) as $v) {?>
									<li><a href="<?=base_url()?>frontend/single_berita"><?=substr($v->judul, 0, 80)?></a></li>
								<?php }?>
								</ul>
							</div>
						</div>
						<div class="col-lg-2 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>Data Tahun Ajaran <?=intval(date('Y') - 1) . " / " . date('Y')?></h4>
								<ul>
									<li><a href="<?=base_url()?>frontend/siswa">Siswa <span class="badge badge-success"><?=$totSiswa?></span></a></li>
									<li><a href="<?=base_url()?>frontend/alumni">Alumni <span class="badge badge-success"><?=$totAlumni?></span></a></li>
									<li><a href="<?=base_url()?>frontend/ptk">PTK <span class="badge badge-success"><?=$totPtk?></span></a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-2 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>Menu Menarik</h4>
								<ul>
									<li><a href="<?=base_url()?>frontend/prestasi_sekolah">Prestasi Sekolah</a></li>
									<li><a href="<?=base_url()?>frontend/prestasi_guru">Prestasi Guru</a></li>
									<li><a href="<?=base_url()?>frontend/prestasi_siswa">Prestasi Siswa</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-4  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>Tentang <?=data_app()?></h4>
								<p><?=data_app('OPD_ADDR')?></p>
								<div class="" id="mc_embed_signup">
									<?php
$last_id_video = $this->db->select_max('id_video')->get('video')->row()->id_video;?>
									 <iframe width="350" height="225" src="<?=$this->db->where("id_video", $last_id_video)->get('video')->row()->link?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								</div>
							</div>
						</div>
					</div>
		</body>

	</div>

<div class="footer-bottom row align-items-center justify-content-between">
						<p class="footer-text m-0 col-lg-6 col-md-12"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
<a href="<?=base_url()?>frontend/login">Copyright</a> &copy;<script> 2019</script> All rights reserved | Developed by <a href="https://youtube.com/c/peternakkode" target="_blank">Peternak Kode</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
						<div class="col-lg-6 col-sm-12 footer-social">
							<a href="<?=data_app('APP_FB')?>"><i class="fa fa-facebook"></i></a>
							<a href="<?=data_app('APP_TWITTER')?>"><i class="fa fa-twitter"></i></a>
							<a href="<?=data_app('APP_IG')?>"><i class="fa fa-instagram"></i></a>
						</div>
					</div>
				</div>
			</footer>
			<!-- End footer Area -->


			<script src="<?=base_url()?>assets/vendor/education/js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="<?=base_url()?>assets/vendor/education/js/vendor/bootstrap.min.js"></script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="<?=base_url()?>assets/vendor/education/js/easing.min.js"></script>
			<script src="<?=base_url()?>assets/vendor/education/js/hoverIntent.js"></script>
			<script src="<?=base_url()?>assets/vendor/education/js/superfish.min.js"></script>
			<script src="<?=base_url()?>assets/vendor/education/js/jquery.ajaxchimp.min.js"></script>
			<script src="<?=base_url()?>assets/vendor/education/js/jquery.magnific-popup.min.js"></script>
    		<script src="<?=base_url()?>assets/vendor/education/js/jquery.tabs.min.js"></script>
			<script src="<?=base_url()?>assets/vendor/education/js/jquery.nice-select.min.js"></script>
			<script src="<?=base_url()?>assets/vendor/education/js/owl.carousel.min.js"></script>
			<script src="<?=base_url()?>assets/vendor/education/js/mail-script.js"></script>
			<script src="<?=base_url()?>assets/vendor/education/js/main.js"></script>
			</html>