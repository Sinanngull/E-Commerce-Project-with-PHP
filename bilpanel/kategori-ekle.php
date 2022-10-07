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
<title> Bilshop Yönetim Paneli - Yeni Kategori Ekle </title>

<?php include_once ("inc-panel/aside.php"); ?>

        <div id="page_title">
            <h1> KATEGORİ EKLE </h1>
        </div>

        <div id="page_content">

            <?php  
            // Butona basılmış ise formdan bilgileri çek
            if ( isset($_POST["btn_ekle"]) ) {
               // Formdan bilgileri $_POST ile çek
                $sira_no        = $_POST['sira_no'];
                $kategori_adi   = $_POST['kategori_adi'];
                $description    = $_POST['description'];
                $durum          = intval($_POST['durum']); //durum seçildiği zaman 1 gönderecek. Seçilmediği zaman boş gelecek. Boşluk da bir sayı olmadığı için  intval() fonksiyonu ile boşluk değeri sıfıra çevrilir. intval değeri sayıya çevirir. 

                $ekle = $veritabani -> prepare ("insert into kategoriler set sira_no=:sira_no, kategori_adi=:kategori_adi, kategori_url=:kategori_url, description=:description, durum=:durum");
                $sonuc = $ekle -> execute ( array("sira_no"=>$sira_no, "kategori_adi"=>$kategori_adi, "kategori_url"=>seo_url($kategori_adi), "description"=>$description, "durum"=>$durum ) );

                if ( $sonuc ) {
                    echo "Kategori eklendi";
                    header("refresh:3;url=kategoriler.php");
                } else {
                    echo "HATA : Kategori eklenemedi";
                }

            //---------------------------------------------------------------    
            }
            ?>
            
            <form action="" method="post" class="form">
                
                <p>
                    <strong>Sıra No :</strong> <br>
                    <input type="number" name="sira_no" maxlength="8" placeholder="Sıra No" required value="<?php echo $sira_no; ?>">
                </p>

                <p>
                    <strong>Kategori Adı :</strong> <br>
                    <input type="text" name="kategori_adi" maxlength="70" placeholder="Kategori Adı" required value="<?php echo $kategori_adi; ?>">
                </p>

                <p>
                    <strong>Meta Description :</strong> <br>
                    <textarea name="description" rows="4" required placeholder="Meta Description"><?php echo $description; ?></textarea>
                </p>

                <p>
                    <strong>Durum :</strong> <br>
                    <input type="checkbox" name="durum" value="1" <?php if ($durum == 1) { echo "checked"; } ?> > Aktif / Pasif 
                </p>

                <p>
                    <input type="submit" value="YENİ KATEGORİ EKLE" name="btn_ekle">
                </p>

            </form>

        </div>        
    
    </div>


</div>


</body>
</html>
