<?php

/*
1-) Veritabanı bağlantısını include et  
2-) Yönetici Oturum Kapat Butonuna tıklayınca oturum kapansın
3-) Oturum açılmamış ise oturum-ac.php sayfasına gönder
4-) fonksiyonlar.php sayfasını da include et
 */
include_once("inc-panel/yonetici-oturum.php");

// ------------------------------------------------------------

// Aktif Pasif Simgesine Tıklayınca durum güncelleme başlasın

$durum          = $_GET['durum'];
$durum_id       = $_GET['durum_id'];

if ( $durum_id > 0  ) {

    $durum_guncelle = $veritabani -> prepare ("update urunler set durum=:durum where urun_id=:urun_id");
    $durum_guncelle -> execute ( array("durum"=>$durum, "urun_id"=>$durum_id) );
    // header("location:urunler.php");

}


//--------------------------------------------------------------

// Ürün Sil simgesine tıklayınca Ürün Silme işlemi başladı

if (  $_GET['sil_id'] > 0 ) {
    
    $sil = $veritabani -> prepare ("delete from urunler where urun_id=:urun_id");
    $sonuc = $veritabani -> execute ( array("urun_id"=>$_GET['sil_id']) );

    if ( $sonuc ) {
        
        // Ürün Silinmiş ise Ürüne ait resim de silinsin
        $resim      = $_GET['resim'];
        unlink("../resimler/urun-resimleri/$resim");

    }

}


//--------------------------------------------------------------

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> Bilshop Yönetim Paneli - Ürünler </title>

<?php include_once ("inc-panel/aside.php"); ?>

        <div id="page_title">
            <h1> ÜRÜNLER </h1>
        </div>

        <div id="page_content">

            <table style="margin: 5px 0 15px 0;" width="100%">
                <tr>
                    <td>
                        <a href="urun-ekle.php" class="btn_ekle">
                            Yeni Ürün Ekle
                        </a>
                    </td>
                    <td align="right">
                        <form action="" method="post" id="form_ara">
                            <input type="text" name="aranan_urun" placeholder="Ürün Adı" required>
                            <button type="submit" name="buton_ara" id="btn_ara"><i class="fas fa-search"></i></button>
                        </form>
                    </td>
                </tr>
            </table>            
            
            <table width="100%" border="1" cellpadding="4" cellspacing="1">
                <tr>
                    <th>SIRA</th>
                    <th>KATEGORİ</th>
                    <th>ÜRÜN ADI</th>
                    <th>RESİM</th>
                    <th>FİYAT</th>
                    <th>A/P</th>
                    <th>GÜNCELLE</th>
                    <th>SİL</th>
                </tr>

                <?php  
                // Ürün Listeleme Döngüsü başladı
                // İki ayrı tabloyu tek bir SQL ile listemek için JOİN komutu kullanılır. JOIN için iki tabloda ortak bir alan olmalıdır.

                // $listele = $veritabani -> prepare ("select * from urunler order by sira_no");

                if ( isset($_POST["buton_ara"])  ) {
                    // Arama için SQL Sorgusu

                    $aranan_urun    = $_POST['aranan_urun'];

                    $listele = $veritabani -> prepare ("select urunler.urun_id, urunler.sira_no, urunler.urun_adi, urunler.resim, urunler.fiyat, urunler.durum, kategoriler.kategori_adi from urunler join kategoriler on urunler.kategori_id=kategoriler.kategori_id where kategori_adi like '%$aranan_urun%' or urun_adi like '%$aranan_urun%' order by sira_no");
                } else {
                    // Tüm Ürünleri Listeleme için SQL Sorgusu

                    $listele = $veritabani -> prepare ("select urunler.urun_id, urunler.sira_no, urunler.urun_adi, urunler.resim, urunler.fiyat, urunler.durum, kategoriler.kategori_adi from urunler join kategoriler on urunler.kategori_id=kategoriler.kategori_id order by sira_no");                    
                }
                

                $listele -> execute ();
                while ( $dizi = $listele -> fetch(PDO::FETCH_ASSOC) ) { 

                    $urun_id        = $dizi["urun_id"];
                    $sira_no        = $dizi["sira_no"];
                    $kategori_adi   = $dizi["kategori_adi"];
                    $urun_adi       = $dizi["urun_adi"];
                    $resim          = $dizi["resim"];
                    $fiyat          = $dizi["fiyat"];
                    $durum          = $dizi["durum"];

                ?>
                    <tr class="table">
                        <td> <?php echo $sira_no; ?> </td>
                        <td> <?php echo $kategori_adi; ?> </td>
                        <td> <?php echo $urun_adi; ?> </td>
                        <td align="center"> <img src="../resimler/urun-resimleri/<?php echo $resim; ?>" alt="" width="70"> </td>
                        <td align="right"><?php echo number_format($fiyat,2,",","."); ?></td>
                        <td align="center">
                            <?php if ( $durum == 1 ) { ?>
                                <a href="?durum=0&durum_id=<?php echo $urun_id; ?>">
                                    <i class="fas fa-check aktif"></i>
                                </a>
                            <?php } else { ?>    
                                <a href="?durum=1&durum_id=<?php echo $urun_id; ?>">
                                    <i class="fas fa-times pasif"></i>
                                </a>
                            <?php } ?>     
                        </td>
                        <td align="center">
                            <a href="urun-guncelle.php?guncelle_id=<?php echo $urun_id; ?>">
                                <i class="fas fa-edit guncelle"></i>
                            </a>
                        </td>
                        <td align="center">
                            <a href="?sil_id=<?php echo $urun_id; ?>&resim=<?php echo $resim; ?>" onclick="return confirm('Silmek istediğinizden eminmisiniz?')">
                                <i class="fas fa-trash-alt sil"></i>
                            </a>
                        </td>
                    </tr>
                <?php 
                } 
                // Ürün Listeleme Döngüsü bitti
                ?>

                <tr>
                    <td colspan="8" align="center">Toplam <?php echo $listele -> rowcount();  ?> ürün var.</td>
                </tr>
            </table>

        </div>        
    
    </div>


</div>


</body>
</html>
