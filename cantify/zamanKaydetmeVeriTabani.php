
<?php
require_once 'veriTabani.php';
// Veritabanı bağlantısını açın (önceki adımda yazdığımız kod burada da geçerli)

// Gelen POST parametresini alın
$time = $_POST['time'];
$kullaniciid = $_POST['user'];
$podcastid = $_POST['podcastid'];

//
$stmt = $baglanti->prepare("SELECT*FROM history WHERE users_id = $kullaniciid and podcast_id = $podcastid"); //SQL Kodu uygulanir.
$stmt->execute(); //SQL kodu calistirilir.
$result = $stmt->fetchAll(PDO::FETCH_ASSOC); //Butun sonuc getirilir.
$count = $stmt->rowCount(); //Kac satir sonuc cikmis sayisini getirir.

if($count > 0){
$update_query = "UPDATE history SET video_zamani = :time WHERE users_id = $kullaniciid and podcast_id = $podcastid";

$stmt = $baglanti->prepare($update_query);
$stmt->bindValue(':time', $time);
$stmt->execute();
}
else {

// Veritabanına dinlenen saniye süresini kaydetmek için bir sorgu çalıştırın
$query = "INSERT INTO history (video_zamani, podcast_id, users_id) VALUES (:time, :podcast, :user)";

$stmt = $baglanti->prepare($query);
$stmt->bindValue(':time', $time);
$stmt->bindValue(':podcast', $podcastid);
$stmt->bindValue(':user', $kullaniciid);

$stmt->execute();
}
//Bu kod, gelen time parametresini veritabanına kaydeder.
?>


