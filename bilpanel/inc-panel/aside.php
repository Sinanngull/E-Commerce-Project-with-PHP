<link rel="stylesheet" type="text/css" href="css-panel/stiller.css">
<link rel="stylesheet" type="text/css" href="font-awesome/css/all.css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">

</head>

<body>


<div id="container" class="sablon_w">

<!-- ======================= Aside - Sol Menü Alanı ======================= -->    
    <aside>
        <div id="aside_logo">
            <a href="index.php"> <img src="resimler/sablon-resimleri/logo.png" alt=""> </a>

        </div>
        <div id="aside_yonetici">
            <img src="resimler/yonetici-resimleri/<?php echo $_SESSION["yonetici_resim"]; ?>" alt=""> <br>
            <strong>Yönetici : </strong> <?php echo $_SESSION['admin']; ?>
        </div>
        <div id="aside_menu_baslik">
            <h2>YÖNETİM MENÜSÜ</h2>
        </div>
        <div class="aside_menu">
            <ul>
                <li> <a href="index.php"> Anasayfa </a> </li>
                <li> <a href="kategoriler.php"> Kategoriler </a> </li>
                <li> <a href="urunler.php"> Ürünlerimiz </a> </li>
                <li> <a href="sayfalar.php"> Sayfalar </a> </li>
                <li> <a href="#"> Mesaj Formu </a> </li>
                <li> <a href="#"> İletişim </a> </li>
            </ul>
        </div>

        <div id="aside_menu_baslik">
            <h2>OTURUM İŞLEMLERİ</h2>
        </div>

        <div class="aside_menu">
            <ul>
                <li> <a href="../index.php" target="_blank"> Sitede Göster</a> </li>
                <li> <a href="?yonetici_oturum=kapat"> Oturumu Kapat</a> </li>
            </ul>
        </div>        

    </aside>

<!-- ======================= Content - İçerik Alanı ======================= --> 
    <div id="content">

        <div id="admin_panel_title">
           <h2>BİLSHOP ADMİN PANELİ</h2>
        </div>