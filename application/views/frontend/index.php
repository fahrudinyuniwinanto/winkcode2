
			<!-- start banner Area -->
			<section class="banner-area relative" id="home"  style="background-image: url(<?=base_url()?>assets/blogsekolah/header/header_<?=$this->uri->segment(2) != "" ? $this->uri->segment(2) : "def"?>.jpg);">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-between">
						<div class="banner-content col-lg-9 col-md-12">
							<h1 class="text-uppercase">
								<div class="lnr lnr-graduation-hat"></div><?=data_app()?>
							</h1>
							<p class="pt-10 pb-10">
								<?=data_app("OPD_ADDR")?>
							</p>
							<a href="#" class="primary-btn text-uppercase">Lihat Sambutan Kepala <?=data_app()?></a>
						</div>
					</div>
				</div>
			</section>
			<!-- End banner Area -->

			<!-- Start feature Area -->
			<section class="feature-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-4">
							<div class="single-feature">
								<div class="title">
									<h4>Sekilas Info</h4>
								</div>
								<div class="desc-wrap">
									<p>
										Info selengkapnya mengenai <?=data_app()?>
									</p>
									<a href="#">Lihat selengkapnya</a>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="single-feature">
								<div class="title">
									<h4>Pengumuman</h4>
								</div>
								<div class="desc-wrap">
									<p>
										Pengumuman terbaru di <?=data_app()?>
									</p>
									<a href="#">Lihat Pengumuman</a>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="single-feature">
								<div class="title">
									<h4>Berita Lainnya</h4>
								</div>
								<div class="desc-wrap">
									<p>
										Berita lainnya yang ada di <?=data_app()?>
									</p>
									<a href="#">Lihat Berita</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End feature Area -->


			<!-- Start cta-one Area -->
			<section class="cta-one-area relative section-gap">
				<div class="container">
					<div class="overlay overlay-bg"></div>
					<div class="row justify-content-center">
						<div class="wrap">
							<h1 class="text-white"><?=data_app("SAMBUTAN_TITLE")?></h1>
							<p><img src="<?=base_url() . data_app('SAMBUTAN_FOTO')?>" class="img-thumbnail" width="500"/><p>
							<p><?=data_app("SAMBUTAN_BODY")?></p>
							<a class="primary-btn wh" href="#">selengkapnya</a>
						</div>
					</div>
				</div>
			</section>
			<!-- End cta-one Area -->

<!-- Start upcoming-event Area -->
			<section class="upcoming-event-area section-gap">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-70 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">Pengumuman</h1>
								<p>Informasi yang harus Anda tahu</p>
								<p><form class="form-wrap" action="<?=base_url()?>frontend/pengumuman">
								<button class="primary-btn text-uppercase">Lihat Selengkapnya >></button>
							</form></p>
							</div>
						</div>
					</div>								
					<div class="row">
						<div class="active-upcoming-event-carusel">
							<?php
foreach ($pengumuman as $v) {?>
							<div class="single-carusel row align-items-center">
								<div class="col-12 col-md-6 thumb">
									<img class="img-fluid" src="<?=base_url()?>assets/blogsekolah/pengumuman/<?=$v->nama_file?>" alt="">
								</div>
								<div class="detials col-12 col-md-6">
									<p>Diposting pada <?=tanggal_indo(date_format(date_create($v->created_at),"Y-m-d"))?></p>
									<a href="#"><h4>T<?=$v->judul?></h4></a>
									<p><?=$v->isi_pengumuman?></p>
								</div>
							</div>																					<?php } ?>	
						</div>
					</div>
				</div>	
			</section>
			<!-- End upcoming-event Area -->

			

			<!-- PRESTASI SISWA DAN GURU -->
			<!-- Start search-course Area -->
			<section class="search-course-area relative">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row justify-content-between align-items-center">
						<div class="col-lg-6 col-md-6 search-course-left">
							<h1 class="text-white">
								<?=data_app('APP_PENGHARGAAN_TITLE')?>
							</h1>
							<p>
								<?=data_app('APP_PENGHARGAAN_DESC')?>
							</p>
							<div class="row details-content">
								<div class="col single-detials">
									<span class="lnr lnr-graduation-hat"></span>
									<a href="#"><h4><?=data_app('PENGHARGAAN_SISWA_TITLE')?></h4></a>
									<p>
										<?=data_app('PENGHARGAAN_SISWA_DESC')?>
									</p>
								</div>
								<div class="col single-detials">
									<span class="lnr lnr-license"></span>
									<a href="#"><h4><?=data_app('PENGHARGAAN_PENGAJAR_TITLE')?></h4></a>
									<p>
										<?=data_app('PENGHARGAAN_PENGAJAR_DESC')?>
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 search-course-right section-gap">
							<form class="form-wrap" action="#">
								<h4 class="text-white pb-20 text-center mb-30"><?=data_app('TERKAIT_PENGHARGAAN_TITLE')?></h4>
								<?=data_app('TERKAIT_PENGHARGAAN_DESC')?>
								<button class="primary-btn text-uppercase">Lihat Selengkapnya</button>
							</form>
						</div>
					</div>
				</div>
			</section>
			<!-- End search-course Area -->


			<!-- Start upcoming-event Area -->
			<<!-- section class="upcoming-event-area section-gap">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-70 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">Upcoming Events of our Institute</h1>
								<p>If you are a serious astronomy fanatic like a lot of us</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="active-upcoming-event-carusel">
							<div class="single-carusel row align-items-center">
								<div class="col-12 col-md-6 thumb">
									<img class="img-fluid" src="<?=base_url()?>assets/vendor/education/img/e1.jpg" alt="">
								</div>
								<div class="detials col-12 col-md-6">
									<p>25th February, 2018</p>
									<a href="#"><h4>The Universe Through
									A Child S Eyes</h4></a>
									<p>
										For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
									</p>
								</div>
							</div>
							<div class="single-carusel row align-items-center">
								<div class="col-12 col-md-6 thumb">
									<img class="img-fluid" src="<?=base_url()?>assets/vendor/education/img/e2.jpg" alt="">
								</div>
								<div class="detials col-12 col-md-6">
									<p>25th February, 2018</p>
									<a href="#"><h4>The Universe Through
									A Child S Eyes</h4></a>
									<p>
										For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
									</p>
								</div>
							</div>
							<div class="single-carusel row align-items-center">
								<div class="col-12 col-md-6 thumb">
									<img class="img-fluid" src="<?=base_url()?>assets/vendor/education/img/e1.jpg" alt="">
								</div>
								<div class="detials col-12 col-md-6">
									<p>25th February, 2018</p>
									<a href="#"><h4>The Universe Through
									A Child S Eyes</h4></a>
									<p>
										For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
									</p>
								</div>
							</div>
							<div class="single-carusel row align-items-center">
								<div class="col-12 col-md-6 thumb">
									<img class="img-fluid" src="<?=base_url()?>assets/vendor/education/img/e1.jpg" alt="">
								</div>
								<div class="detials col-12 col-md-6">
									<p>25th February, 2018</p>
									<a href="#"><h4>The Universe Through
									A Child S Eyes</h4></a>
									<p>
										For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
									</p>
								</div>
							</div>
							<div class="single-carusel row align-items-center">
								<div class="col-12 col-md-6 thumb">
									<img class="img-fluid" src="<?=base_url()?>assets/vendor/education/img/e2.jpg" alt="">
								</div>
								<div class="detials col-12 col-md-6">
									<p>25th February, 2018</p>
									<a href="#"><h4>The Universe Through
									A Child S Eyes</h4></a>
									<p>
										For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
									</p>
								</div>
							</div>
							<div class="single-carusel row align-items-center">
								<div class="col-12 col-md-6 thumb">
									<img class="img-fluid" src="<?=base_url()?>assets/vendor/education/img/e1.jpg" alt="">
								</div>
								<div class="detials col-12 col-md-6">
									<p>25th February, 2018</p>
									<a href="#"><h4>The Universe Through
									A Child S Eyes</h4></a>
									<p>
										For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section> -->
			<!-- End upcoming-event Area -->


<!-- BERITA TERKINI -->
			<!-- Start blog Area -->
			<section class="blog-area section-gap" id="blog">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-70 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10"><?=data_app("BERITA_TITLE")?></h1>
								<p><?=data_app("BERITA_DESC")?></p>
								<p><form class="form-wrap" action="<?=base_url()?>frontend/list_berita">
								<button class="primary-btn text-uppercase">Lihat Selengkapnya >></button>
							</form></p>
							</div>
						</div>
					</div>
					<div class="row">
					<?php foreach (array_slice($berita, 0, 8) as $k => $v) {?>
						<div class="col-lg-3 col-md-6 single-blog">
							<div class="thumb">
								<img class="img-fluid" src="<?=base_url()?>assets/blogsekolah/berita/<?=$v->img != '' && file_exists('./assets/blogsekolah/berita/' . $v->img) ? $v->img : 'def_berita.png'?>" alt="">
							</div>
							<p class="meta"><?=$v->created_at?>  |  By <?=$v->created_by?></p>
							<a href="<?=base_url()?>frontend/single_berita/<?=$v->id_berita?>">
								<h5><?=$v->judul?></h5>
							</a>
							<p><?=substr($v->isi, 0, 200)?></p>
							<a href="<?=base_url()?>frontend/single_berita" class="details-btn d-flex justify-content-center align-items-center"><span class="details">Selengkapnya</span><span class="lnr lnr-arrow-right"></span></a>
						</div>
				<?php }?>

					</div>
				</div>
			</section>
			<!-- End blog Area -->


			<!-- Start cta-two Area -->
			<section class="cta-two-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-8 cta-left">
							<h1>Video terkait <?=data_app()?>?</h1>
						</div>
						<div class="col-lg-4 cta-right">
							<a class="primary-btn wh" href="<?=base_url()?>frontend/video">Selengkapnya</a>
						</div>
					</div>
				</div>
			</section>
			<!-- End cta-two Area -->

			<!-- start footer Area -->
