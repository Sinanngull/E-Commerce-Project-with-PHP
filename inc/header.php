
	<meta name="robots" content="index,follow">
	<meta name="author" content="Bilshop E-ticaret Sitesi">
	<meta name="rating" content="general">
	<meta name="revisit-after" content="4 days">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="fontawesome/css/all.min.css">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

	<script src="js/responsive-menu/modernizr.min.js"></script>

	<?php echo $google_dogrulama; ?>
	<?php echo $yandex_dogrulama; ?>
	<?php echo $bing_dogrulama; ?>
	<?php echo $tag_manager_head; ?>

</head>
<body>

	<?php echo $tag_manager_body; ?>

	<div id="header_top">
		<div class="container">
			<div id="header_top_flex">
				<div id="header_top_phone">
					<i class="fa-solid fa-phone"></i>
					<a href="tel:<?php echo telefon_temizle($telefon); ?>">
						<?php echo $telefon; ?>
					</a>
				</div>
				<div id="header_top_search">
					<form action="site-ici-arama.php" method="post">
						<input type="text" name="urun_ara" placeholder="Aranan Ürü">
						<button type="submit" id="btn_ara"><i class="fa-solid fa-magnifying-glass"></i></button>
					</form>
				</div>
				<nav id="header_top_sosyalmenu">
					<ul>
						<li><a href="" target="_blank" title="facebook" nofollow><i class="fa-brands fa-facebook-f"></i></a></li>						
						<li><a href="" target="_blank" title="twitter" nofollow><i class="fa-brands fa-twitter"></i></a></li>
						<li><a href="" target="_blank" title="instagram" nofollow><i class="fa-brands fa-instagram"></i></a></li>
						<li><a href="" target="_blank" title="linkedin" nofollow><i class="fa-brands fa-linkedin-in"></i></a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>

	<header>
		<div class="container">
			<div id="header_flex">
				<div id="header_logo">
					<a href="index.php">
						<img src="resimler/sablon-resimleri/<?php echo $logo; ?>" alt="">
					</a>
				</div>
				<nav id="header_menu">
					<ul id="menu">
						<li><a href="index.php">Anasayfa</a></li>
						<li><a href="">Kurumsal <i class="fa-solid fa-angle-down"></i></a> 
							<ul>

								<?php  
								// Veritabanıdaki sayfaları Listeleme başladı
								$sayfalar = $veritabani -> prepare ("select sayfa_ismi, sayfa_url from sayfalar where durum=1 order by sira_no asc");
								$sayfalar -> execute();
								while ( $sayfa_dizisi = $sayfalar -> fetch(PDO::FETCH_ASSOC) ) {

									$sayfa_ismi 	= $sayfa_dizisi["sayfa_ismi"];
									$sayfa_url 		= $sayfa_dizisi["sayfa_url"];

									echo "<li><a href='sayfalar.php?sayfa_url=$sayfa_url'>$sayfa_ismi</a></li>";
								}

								// Veritabanıdaki sayfaları Listeleme bitti
								?>
								
							</ul>
						</li>
						<li><a href="">Ürünlerimiz <i class="fa-solid fa-angle-down"></i></a>
							<ul>

								<?php  
								// Veritabanındaki Kategorileri Listeleme başladı
								$kategoriler = $veritabani -> prepare ("select kategori_adi, kategori_url from kategoriler where durum=1 order by sira_no asc");
								$kategoriler -> execute();
								while ( $kategori_dizisi = $kategoriler -> fetch(PDO::FETCH_ASSOC) ) {

									$menu_kategori_adi		= $kategori_dizisi["kategori_adi"];
									$kategori_url			= $kategori_dizisi["kategori_url"];

									echo "<li><a href='kategori-urunler.php?kategori_url=$kategori_url'>$menu_kategori_adi</a></li>";
								}


								// Veritabanındaki Kategorileri Listeleme bitti
								?>
									
							</ul>
						</li>
						<li><a href="">Üyelik <i class="fa-solid fa-angle-down"></i></a>
							<ul>
								<?php if ( $_SESSION['uye_ad_soyad'] == "" ) { ?>
									<li><a href="">Üye Ol</a></li>
									<li><a href="uye-girisi.php">Üye Girişi</a></li>
								<?php } else { ?>	
									<li><a href="">Sepet</a></li>
									<li><a href="">Profil</a></li>
									<li><a href="">Hesabım</a></li>
									<li><a href="">Oturumu Kapat</a></li>
								<?php } ?>	
							</ul>
						</li>
						<li><a href="iletisim.php">İletişim</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</header>