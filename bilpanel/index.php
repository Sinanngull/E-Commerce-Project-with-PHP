<?php

/*
1-) Veritabanı bağlantısını include et  
2-) Yönetici Oturum Kapat Butonuna tıklayınca oturum kapansın
3-) Oturum açılmamış ise oturum-ac.php sayfasına gönder
4-) fonksiyonlar.php sayfasını da include et
 */
include_once("inc-panel/yonetici-oturum.php");

// ------------------------------------------------------------


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> Bilshop Yönetim Paneli - Anasayfa </title>

<?php include_once ("inc-panel/aside.php"); ?>

        <div id="page_title">
            <h1> ANASAYFA </h1>
        </div>

        <div id="page_content">
            Sayfa içeriği
        </div>        
    
    </div>


</div>


</body>
</html>
