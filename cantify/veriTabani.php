
<?php

$login = false;


if( isset($_COOKIE['mail']) && isset($_COOKIE['sifre'])){
    if( $_COOKIE['mail']!='' && $_COOKIE['sifre']!='') $login = true;
}



//VERITABANI AYARLARI ------>
$server = ".\ "; //Veritabanı sunucusu, Bizimkisi MSSQL Management Studio daoldugudan '.\SQLEXPRESS' yazdik.
$database = "podcasts"; //Baglanilacak veritabanı.
$db_kullaniciadi = ""; //Veritabanı kullanici adi, bizimkisi MSSQL Management Studioda local oldugundan bir kullanici adi belirtmemize gerek yok.
$db_sifre = ""; //Veritabanı sifresi, bizimkisi MSSQL Management Studio da localoldugundan bir sifre belirtmemize gerek yok.
$baglanti = null; //Veritabanı bağlantımızı bu değişkende tutup her seferinde onunüzerinden işlemleri yapacağız.
//VERITABANINA BAGLANMA ------->

try {
$baglanti = new PDO("sqlsrv:Server=$server;Database=$database", $db_kullaniciadi,$db_sifre); //Veritabanina baglanilir.

} catch ( Exception $e ){
//DB Baglanti saglanmadi.
$mesaj = "Veri Tabanına Baglanılamadı! HATA: ".$e->getMessage();
die($mesaj."<br>");
 }
 


 function sayfayaYonlendir($sayfaLink)
 {
    header('Location: '.$sayfaLink);
 }

 function GirisYap($baglanti,$mail,$sifre)
 {
    
    $stmt = $baglanti->prepare("SELECT * FROM users where password='$sifre' and mail='$mail'"); //SQL Kodu uygulanir.
    $stmt->execute(); //SQL kodu calistirilir.
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //Butun sonuc getirilir.
    $count = $stmt->rowCount(); //Kac satir sonuc cikmis sayisini getirir.
    if($count > 0) //SQL Arama sonucu olarak 0 dan fazla sonuc geldiyse boyle bir  kullanici var demektir.
    {
   //Kullanıcı bilgilerini doğru yazdığına gore bunları 1 saatliğine çerezlerde tutup 1 saat boyunca giriş yapmasına gerek kalmadan sitede durmasını sağlarız
   setcookie("mail", $result[0]["mail"], time() + 3600);
   setcookie("cerezid", $result[0]["users_id"], time() + 3600);
   setcookie("cerezname", $result[0]["name"]." ".$result[0]["surname"], time() + 3600);
   setcookie("nicknameid", $result[0]["nickname"], time() + 3600);
   setcookie("sifre", $result[0]["password"], time() + 3600);
   $login = true; //kullanıcı girdi
   sayfayaYonlendir('index.php');
   return true;
       }else
   {
    $login = false; //kullanıcı giriş yapamadı.
   return false;
   }
    }



 



?>