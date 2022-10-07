<?php  
// 1-) Seo-Url Fonksiyonu (Url Adreslerinde ve Resim Adlerını Düzeltme işlemlerinde kullan)

function seo_url ($degisken) {
	$degisken_kucuk = mb_strtolower($degisken,"utf8");
	$x = array ("ö","ü","ğ","ş","ç","ı","(",")","+","/",".","'",'"',"{","}","[","]"," ");
	$y = array ("o","u","g","s","c","i","-","-","-","-","-","-",'-',"-","-","-","-","-");
	$degisken_duzelt = str_replace($x, $y, $degisken_kucuk);
	return $degisken_duzelt;
}


// 2-) page_title alanındaki h1 içindeki yazıları büyük yaparken Küçük i Büyük I oluyor. Bulaşık Makinası - BULAŞIK MAKINESI oluyor. Küçük i Büyük İ olsun istiyorum
function sayfa_baslik_h1($degisken) {
	$degisken_duzelt 	= str_replace("i","İ",$degisken);
	$degisken_buyuk 	= mb_strtoupper($degisken_duzelt,"utf8");
	return $degisken_buyuk;
} 

// 3-) Telefon Numarası İçindeki Parantezleri, Tire işaretini ve boşlukları temizleyen fonksiyon
function telefon_temizle ($degisken) {
	$x = array (" ","(",")","-");
	$y = array ("","","","");
	$degisken_duzelt = str_replace($x,$y,$degisken);
	return $degisken_duzelt;
}

?>