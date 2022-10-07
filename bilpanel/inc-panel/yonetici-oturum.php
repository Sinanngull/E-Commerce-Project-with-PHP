<?php

// 1-) Veritabanı bağlantısını include et  
include_once("inc-panel/baglan.php");

// ------------------------------------------------------------

// 2-) Yönetici Oturum Kapat Butonuna tıklayınca oturum kapansın

if ( $_GET['yonetici_oturum'] == "kapat" ) {
    session_destroy();
    header("location:oturum-ac.php");
}

// ------------------------------------------------------------

// 3-) Oturum açılmamış ise oturum-ac.php sayfasına gönder
if ( $_SESSION['admin'] == "" ) {
    header("location:oturum-ac.php");
}

// ------------------------------------------------------------

// 4-) fonksiyonlar.php sayfasını da include et
include_once("inc-panel/fonksiyonlar.php");

?>