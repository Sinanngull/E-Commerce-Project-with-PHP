<?php

/*
1-) Veritabanı bağlantısını include et  
2-) Yönetici Oturum Kapat Butonuna tıklayınca oturum kapansın
3-) Oturum açılmamış ise oturum-ac.php sayfasına gönder
4-) fonksiyonlar.php sayfasını da include et
 */
include_once("inc-panel/yonetici-oturum.php");

// ------------------------------------------------------------

// Aktif / Pasif Simgesine Tıklayınca Durum Güncelleme başladı

if (  $_GET['durum_id'] > 0 ) {

    $durum_guncelle = $veritabani -> prepare ("update kategoriler set durum=:durum where kategori_id=:kategori_id");
    $durum_guncelle -> execute ( array("durum"=>$_GET['durum'], "kategori_id"=>$_GET['durum_id']) ); 
    // header("location:kategoriler.php");

}


// ------------------------------------------------------------

// Sil Simgesine tıklayınca Kategori Silme işlemi başladı

if ( $_GET['sil_id'] > 0 ) {
    
    $kategori_sil = $veritabani -> prepare ("delete from kategoriler where kategori_id=:kategori_id");
    $kategori_sil -> execute ( array("kategori_id"=>$_GET['sil_id']) );
    // header("location:kategoriler.php");

}


// ------------------------------------------------------------


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> Bilshop Yönetim Paneli - Kategoriler </title>

<?php include_once ("inc-panel/aside.php"); ?>

        <div id="page_title">
            <h1> KATEGORİLER </h1>
        </div>

        <div id="page_content">
            <table style="margin: 5px 0 15px 0;" width="100%">
                <tr>
                    <td>
                        <a href="kategori-ekle.php" class="btn_ekle">
                            Yeni Kategori Ekle
                        </a>
                    </td>
                    <td align="right">
                        <form action="" method="post" id="form_ara">
                            <input type="text" name="aranan_kategori" placeholder="Kategori Adı">
                            <button type="submit" name="buton_ara" id="btn_ara"><i class="fas fa-search"></i></button>
                        </form>
                    </td>
                </tr>
            </table>
            <table width="100%" border="1" cellpadding="4" cellspacing="1">
                <tr>
                    <th>KATEGORİ ID</th>
                    <th>SIRA NO</th>
                    <th>KATEGORİ ADI</th>
                    <th>KATEGORİ URL</th>
                    <th>DURUM</th>
                    <th>A / P</th>
                    <th>GÜNCELLE</th>
                    <th>SİL</th>
                </tr>

                <?php

                if ( isset($_POST["buton_ara"]) ) {
                    // Arama  İçin SQL Sorgusu
                    $aranan_kategori    = $_POST['aranan_kategori'];
                    $listele = $veritabani -> prepare ("select * from kategoriler where kategori_adi like '%$aranan_kategori%' order by sira_no asc");                
                } else {
                    // Tüm Kategorileri Listeleme için SQL Sorgusu
                    $listele = $veritabani -> prepare ("select * from kategoriler order by sira_no asc");                    
                }
                
                // Kategori listeleme başladı
                $listele -> execute();
                while ( $dizi = $listele -> fetch(PDO::FETCH_ASSOC) ) {

                    $kategori_id    = $dizi["kategori_id"];
                    $sira_no        = $dizi["sira_no"];
                    $kategori_adi   = $dizi["kategori_adi"];
                    $kategori_url   = $dizi["kategori_url"];
                    $durum          = $dizi["durum"];

                ?>
                    <tr class="table">
                        <td> <?php echo $kategori_id; ?> </td>
                        <td> <?php echo $sira_no; ?> </td>
                        <td> <?php echo $kategori_adi; ?> </td>
                        <td> <?php echo $kategori_url; ?> </td>
                        <td align="center"> <?php echo $durum; ?> </td>
                        <td align="center">

                            <?php if ( $durum == 1 ) {  ?>

                                <a href="?durum=0&durum_id=<?php echo $kategori_id; ?>">
                                    <i class="fas fa-check aktif"></i>
                                </a>

                            <?php } else { ?>

                                <a href="?durum=1&durum_id=<?php echo $kategori_id; ?>">
                                    <i class="fas fa-times pasif"></i>
                                </a>

                            <?php } ?>

                        </td>
                        <td align="center">
                            <a href="kategori-guncelle.php?guncelle_id=<?php echo $kategori_id; ?>">
                                <i class="fas fa-edit guncelle"></i>
                            </a>
                        </td>
                        <td align="center">
                            <a href="?sil_id=<?php echo $kategori_id; ?>" onclick="return confirm('Silmek istediğinizden eminmisiniz?')">
                                <i class="fas fa-trash-alt sil"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                }  
                // Kategori listeleme bitti
                ?>

                <tr>
                    <td colspan="8" align="center">Toplam <?php echo $listele -> rowcount(); ?> kategori var.</td>
                </tr>
            </table>
        </div>        
    
    </div>


</div>


</body>
</html>
