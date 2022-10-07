<?php  

/*

// 1-) Veritabanı Bağlantısını include et. (baglan.php)
// 2-) fonksiyonlar.php dosyasını include et 
// 3-) Oturum İşlemlerini Kontrol et.
// 4-) Ortak Tanımları İnclude et

*/

include_once("inc/uye-oturum.php");

//------------------------------------------------------------


// Link ile gönderilen sayfa_url değişkenini $_GET ile çek. O sayfaya ait verileri veritababnından al.

$bilgiler = $veritabani -> prepare("select sayfa_title, description, sayfa_h1, sayfa_icerik, durum from sayfalar where sayfa_url=:sayfa_url");
$bilgiler -> execute( array("sayfa_url"=>$_GET['sayfa_url']) );
$bilgiler_dizisi = $bilgiler -> fetch(PDO::FETCH_ASSOC);

$sayfa_title 	= $bilgiler_dizisi["sayfa_title"];
$description 	= $bilgiler_dizisi["description"];
$sayfa_h1 		= $bilgiler_dizisi["sayfa_h1"];
$sayfa_icerik 	= $bilgiler_dizisi["sayfa_icerik"];
$durum 			= $bilgiler_dizisi["durum"];

?>

<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<meta name="language" content="tr">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> <?php echo $ortak_title." - ".$sayfa_title; ?> </title>
	<meta name="description" content="<?php echo $description; ?>">

<?php include_once("inc/header.php"); ?>

	<div id="page_title">
		<div class="container">
			<div id="page_title_flex">
				<h1><?php echo $sayfa_h1; ?></h1>
			</div>
		</div>
	</div>	

	<div id="content">
		
		<section id="sayfalar">
			<div class="container">
				
				<?php 

				if ( $durum==0 ) {
					echo "Bu sayfa yayından kaldırılmıştır";
				} else {
					echo $sayfa_icerik;
				}
				 
				?>
			</div>
		</section>

	</div>

<?php include_once("inc/footer.php"); ?>
	
</body>
</html>