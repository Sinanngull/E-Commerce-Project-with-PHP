<?php  
error_reporting(0);
session_start();
ob_start();

// Hosting Firmasındaki MYSQL Bilgileri ile Aşağıdakileri güncelleyin.
$sunucu		= "localhost"; // MYSQL Sunucu adı 
$database	= "bilshop_2022"; // MYSQL Veritabanı adı 
$kullanici	= "root"; // MYSQL Kullanıcı adı 
$sifre 		= ""; // MYSQL Kullanıcı Şifresi 

try {
	$veritabani = new PDO ("mysql:host=$sunucu; dbname=$database; charset=utf8","$kullanici","$sifre");
	// echo "Tamam";	
} catch (PDOException $hata) {
	echo "HATA : Veritabanına bağlanılamadı. Bize 0 212 291 72 02 nolu telefondan ulaşabilirsiniz";	
}



?>