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
<title> Bilshop Yönetim Paneli - Ürün Güncelle </title>

<?php include_once ("inc-panel/aside.php"); ?>

        <div id="page_title">
            <h1> ÜRÜN GÜNCELLE </h1>
        </div>

        <div id="page_content">

            <?php

            // Link ile gönderilen guncelle_id değişkenini $_GET ile çek ve o ürüne ait bilgileri veritabanından al.
            $bilgiler = $veritabani -> prepare ("select * from urunler where urun_id=:urun_id");
            $bilgiler -> execute ( array("urun_id"=>$_GET["guncelle_id"]) );
            $dizi       = $bilgiler -> fetch (PDO::FETCH_ASSOC);

            $kategori_id    = $dizi['kategori_id'];
            $sira_no        = $dizi['sira_no'];
            $urun_adi       = $dizi['urun_adi'];
            $description    = $dizi['description'];
            $urun_aciklama  = $dizi['urun_aciklama'];
            $fiyat          = $dizi['fiyat'];
            $kdv_oran       = $dizi['kdv_oran'];
            $stok_miktari   = $dizi['stok_miktari'];
            $durum          = $dizi['durum'];   
            $resim          = $dizi['resim'];   
                     

            // Butona basınca formdan bilgileri $_POST ile çek
            if ( isset($_POST["btn_guncelle"]) ) {
                
                // Formdan bilgileri $_POST ile çek
                $kategori_id    = $_POST['kategori_id'];
                $sira_no        = $_POST['sira_no'];
                $urun_adi       = $_POST['urun_adi'];
                $description    = $_POST['description'];
                $urun_aciklama  = $_POST['urun_aciklama'];
                $fiyat          = $_POST['fiyat'];
                $kdv_oran       = $_POST['kdv_oran'];
                $stok_miktari   = $_POST['stok_miktari'];
                $durum          = intval($_POST['durum']); // durum seçilirse 1 gönderiyor. Seçilmez ise boş gönderiyor. Veritabanında durum hücresinin veritipi int (sayı) olduğu için intval fonksiyonu ile boşluk sayıya çevrilir.
                
                
                // Resim Bilgisini $_FILES ile çek
                $resim_dizisi   = $_FILES['resim'];
                $tmp_name       = $resim_dizisi["tmp_name"];
                $name           = $resim_dizisi["name"];
                $size           = $resim_dizisi["size"];

                // Resim Uzantısını al
                $name_dizisi    = pathinfo($name);
                $uzanti         = $name_dizisi["extension"];

                if ( $name == "" ) {
                // Resim Seçilmemiş ise RESİMSİZ güncelleme başladı
                    
                    $resimsiz_guncelle = $veritabani -> prepare ("update urunler set kategori_id=:kategori_id, sira_no=:sira_no, urun_adi=:urun_adi, description=:description, urun_aciklama=:urun_aciklama, fiyat=:fiyat, kdv_oran=:kdv_oran, stok_miktari=:stok_miktari, durum=:durum where urun_id=:urun_id");
                    $sonuc = $resimsiz_guncelle -> execute ( array("kategori_id"=>$kategori_id, "sira_no"=>$sira_no, "urun_adi"=>$urun_adi, "description"=>$description,  "urun_aciklama"=>$urun_aciklama, "fiyat"=>$fiyat, "kdv_oran"=>$kdv_oran, "stok_miktari"=>$stok_miktari, "durum"=>$durum, "urun_id"=>$_GET["guncelle_id"] ) );

                    if ($sonuc) {
                        echo "Ürün bilgileri güncellendi";
                        header("refresh:3;url=urunler.php");
                    } else {
                        echo "HATA : Ürün bilgileri güncellenemedi";
                    }
                    

                // Resimsiz güncelleme bitti   
                } else {
                // Resim Seçilmiş ise RESİMLİ güncelleme başladı
                    if (  $uzanti != "jpg" and $uzanti != "jpeg" and $uzanti != "gif" and $uzanti != "png" ) {
                        echo "HATA : Resim jpg, jpeg, gif, png uzantılı olmalıdır";
                    } elseif ( $size > 2097152 ) {
                        echo "HATA : Resim 2 MB'dan küçük olmalıdır";
                    } else {

                        // 1-) Resim Adını SEO Uyumlu hale getir
                        $yeni_resim_adi     = seo_url($urun_adi).".".$uzanti;

                        // 2-) Ekleme için SQL Sorgusu
                        $resimli_guncelle = $veritabani -> prepare ("update urunler set kategori_id=:kategori_id, sira_no=:sira_no, urun_adi=:urun_adi, description=:description, resim=:resim, urun_aciklama=:urun_aciklama, fiyat=:fiyat, kdv_oran=:kdv_oran, stok_miktari=:stok_miktari, durum=:durum where urun_id=:urun_id");
                        $sonuc = $resimli_guncelle -> execute ( array("kategori_id"=>$kategori_id, "sira_no"=>$sira_no, "urun_adi"=>$urun_adi, "description"=>$description, "resim"=>$yeni_resim_adi, "urun_aciklama"=>$urun_aciklama, "fiyat"=>$fiyat, "kdv_oran"=>$kdv_oran, "stok_miktari"=>$stok_miktari, "durum"=>$durum, "urun_id"=>$_GET['guncelle_id'] ) );


                         if ( $sonuc ) {
                            echo "Ürün Güncellendi <br>";
                            // 3-) Ürün Güncellendiği İçin Resmi Upload Et
                            $yukle = move_uploaded_file($tmp_name, "../resimler/urun-resimleri/$yeni_resim_adi");
                            if ( $yukle ) {
                                echo "Resim Güncellendi";
                                header("refresh:3;url=urunler.php");
                            } else {
                                echo "HATA : Resim Güncellenemedi";
                            }
                            

                         } else {
                            echo "HATA : Ürüm Güncellenemedi";
                         }                         
                // Resimli güncelleme bitti.
                    }     
                }
                

            }


            ?>

            <form action="" method="post" class="form" enctype="multipart/form-data">

                <p>
                    <strong>Ürün Kategorisi :</strong> <br>
                    <select name="kategori_id">
                        <option value=""> -- Kategori Seç -- </option>
                        
                        <?php  
                        // Kategori Listeleme başladı
                        $kategoriler = $veritabani -> prepare ("select * from kategoriler order by kategori_adi asc");
                        $kategoriler -> execute();
                        while ( $dizi = $kategoriler -> fetch(PDO::FETCH_ASSOC) ) {
                            
                            $kat_adi   = $dizi["kategori_adi"];
                            $kat_id    = $dizi["kategori_id"];

                            if ( $kategori_id == $kat_id  ) {
                                $onay = "selected";
                            } else {
                                $onay = "";
                            }
                            

                            echo "<option value='$kat_id' $onay>$kat_adi</option>";
                        } 
                        // Kategori Listeleme bitti
                        ?>
                        
                    </select>
                </p>

                <p>
                    <strong>Sıra No :</strong> <br>
                    <input type="number" name="sira_no" required placeholder="Sıra No" value="<?php echo $sira_no; ?>">
                </p>

                <p>
                    <strong>Ürün Adı :</strong> <br>
                    <textarea name="urun_adi" rows="1" required placeholder="Ürün Adı"><?php echo $urun_adi; ?></textarea>
                </p> 

                <p>
                    <strong>Meta Description :</strong> <br>
                    <textarea name="description" rows="3" required placeholder="Meta Description"><?php echo $description; ?></textarea>
                </p>

                <p>
                    <img src="../resimler/urun-resimleri/<?php echo $resim; ?>" width="150" alt=""> <br>
                    <strong>Ürün Resmi :</strong> <br>
                    <input type="file" name="resim">
                </p> 

                <p>
                    <strong>Ürün Açıklama :</strong> <br>
                    <?php
 
                    // Include CKEditor class.
                     
                    include("ckeditor/ckeditor.php");
                     
                    $ckeditor = new CKEditor();
                     
                    //ckeditor klasörümüz eğer klasörümüz aynıysa değiştirmeyelim
                     
                    $ckeditor->basePath = 'ckeditor/';
                     
                    //Ckfinder ile ilgili değişkenler eğer dosya ve klasör isimlerinde değişiklik yoksa aynen devam edelim
                     
                    $ckeditor->config['filebrowserBrowseUrl'] = 'ckfinder/ckfinder.html';
                     
                    $ckeditor->config['filebrowserImageBrowseUrl'] = 'ckfinder/ckfinder.html?type=Images';
                     
                    $ckeditor->config['filebrowserImageUploadUrl'] = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
                     
                    //ckeditor temamız daha fazlası için ckeditor/skins klasörüne bakın
                     
                    $ckeditor->config['skin'] = 'office2003';
                     
                    //Editör genişlik değerimiz
                     
                    $ckeditor->config['width'] = 800;
                     
                    //aciklama name yine sahip textarea oluşturuyor
                     
                    $ckeditor->editor('urun_aciklama',$urun_aciklama);
                     
                    ?>
                </p>                                                              

                <p>
                    <strong>Fiyat :</strong> <br>
                    <input type="text" name="fiyat" required placeholder="12500.78" value="<?php echo $fiyat; ?>">
                </p>

                <p>
                    <strong>KDV Oranı :</strong> <br>
                    <input type="number" name="kdv_oran" required placeholder="KDV Oranı" value="<?php echo $kdv_oran; ?>">
                </p>

                <p>
                    <strong>Stok Miktarı :</strong> <br>
                    <input type="number" name="stok_miktari" required placeholder="Stok Miktarı" value="<?php echo $stok_miktari; ?>">
                </p> 

                <p>
                    <strong>Durum :</strong> <br>
                    <input type="checkbox" name="durum" value="1" <?php if ($durum == 1) { echo "checked"; } ?>> Aktif / Pasif
                </p>                              

                <p>
                    <input type="submit" name="btn_guncelle" value="ÜRÜN GÜNCELLE">
                </p>
                
            </form>
        </div>        
    
    </div>


</div>


</body>
</html>
