<?php  
// 1-) Veritabanı Bağlantısını include et. (baglan.php)
include_once("bilpanel/inc-panel/baglan.php");

// 2-) fonksiyonlar.php dosyasını include et 
include_once("bilpanel/inc-panel/fonksiyonlar.php");

// 3-) Oturum İşlemlerini Kontrol et.


// 4-) Ortak Tanımları Veritabanından çek (Logo, Favicon, Title, Dogrulama Kodları, Tag Manager, İletişim Bilgileri) 
$ortak_bilgiler = $veritabani  -> prepare ("select * from ortak_tanimlar where ortak_id=1");
$ortak_bilgiler -> execute();
$ortak_dizisi = $ortak_bilgiler -> fetch (PDO::FETCH_ASSOC);

$ortak_title				= $ortak_dizisi["ortak_title"];
$anasayfa_description		= $ortak_dizisi["anasayfa_description"];
$google_dogrulama			= $ortak_dizisi["google_dogrulama"];
$yandex_dogrulama			= $ortak_dizisi["yandex_dogrulama"];
$bing_dogrulama				= $ortak_dizisi["bing_dogrulama"];	
$tag_manager_head			= $ortak_dizisi["tag_manager_head"];
$tag_manager_body			= $ortak_dizisi["tag_manager_body"];
$logo						= $ortak_dizisi["logo"];
$favicon					= $ortak_dizisi["favicon"];
$iletisim_title				= $ortak_dizisi["iletisim_title"];
$iletisim_description		= $ortak_dizisi["iletisim_description"];
$adres 						= $ortak_dizisi["adres"];
$telefon					= $ortak_dizisi["telefon"];
$gsm 						= $ortak_dizisi["gsm"];
$eposta 					= $ortak_dizisi["eposta"];
$goole_maps 				= $ortak_dizisi["goole_maps"];


?>