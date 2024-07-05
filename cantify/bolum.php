<?php

print_r($_GET);

echo  "<hr>GELEN BOLUM ID: ".$_GET["bolum"];

$podcastId = $_GET["bolum"];
$kullaniciID = -1;

if( isset($_COOKIE['cerezid'])){
    if( $_COOKIE['cerezid']!='') {
        $kullaniciID = $_COOKIE['cerezid'];
    }
}



require_once 'veriTabani.php'; 

 if($podcastId != NULL){
  

 
      
                //GIRIS YAPAN KULLANICI ID' bilgili kullanici podcast i izlemis ise kacinci sn ye de kalmis history tablosundan cekip getirmek
                $stmt = $baglanti->prepare("SELECT h.video_zamani from history h where h.podcast_id = $podcastId and h.users_id = $kullaniciID"); //SQL Kodu uygulanir.
                $stmt->execute(); //SQL kodu calistirilir.
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //Butun sonuc getirilir.
                $count = $stmt->rowCount(); //Kac satir sonuc cikmis sayisini getirir.

                $videoZamani = 0;

                if($count > 0)
                {
                    $videoZamani = $result[0]["video_zamani"];
                    //video zamanini guncelle
                }


                $stmt = $baglanti->prepare("SELECT users.*, yorumlar.* FROM yorumlar JOIN users ON yorumlar.users_id = users.users_id WHERE yorumlar.podcast_id = $podcastId"); //SQL Kodu uygulanir.

                $stmt->execute(); //SQL kodu calistirilir.
                $yorumlar = $stmt->fetchAll(PDO::FETCH_ASSOC); //Butun sonuc getirilir.
              

    $stmt = $baglanti->prepare("SELECT * FROM  podcast where podcast.podcast_id = $podcastId"); //SQL Kodu uygulanir.
    $stmt->execute(); //SQL kodu calistirilir.
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //Butun sonuc getirilir.
    $count = $stmt->rowCount(); //Kac satir sonuc cikmis sayisini getirir.
    echo "Bulunan sonuc: $count adet.<br>";
    // print_r($result);
    echo "<br>";
   $bolum_sayisi = $result[0]["title"];
   $aciklama = $result[0]["explanation"];
   $baslik = $result[0]["baslik"];
   $likes = $result[0]["likes"];
   $konuk = $result[0]["guest"];
   $audio_load = $result[0]["audio_load"];

   if (isset($_GET['like'])) {
    // Tıklanan butonun ID'sini alın
    $id = $_GET['bolum'];
      $bolum_id = $id;
    $stmt = $baglanti->prepare("UPDATE podcast SET likes = likes + 1 WHERE podcast_id = $id"); //SQL Kodu uygulanir.
    
    
    $stmt->execute(); //SQL kodu calistirilir.
   }

   if (isset($_GET['yorum'])) {
    if($kullaniciID != -1){
      $id = $_GET['bolum'];
      $yorum = $_GET['yorum'];
        $bolum_id = $id;
     
      $stmt = $baglanti->prepare("UPDATE podcast SET likes = likes + 1 WHERE podcast_id = $id"); //SQL Kodu uygulanir.
      $stmt->execute(); //SQL kodu calistirilir.
    
      $stmt = $baglanti->prepare("INSERT INTO yorumlar (users_id, yorum, videonun_zamani, podcast_id ) VALUES (?,?,?,?)");
      
          $insert = $stmt->execute([$kullaniciID, $yorum, 0, $bolum_id]); 
 
    
    }
    else{
      
      sayfayaYonlendir('login.php');
    }
    
   }


 }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Product - podcast</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anton&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Comment.css">
    <link rel="stylesheet" href="assets/css/mp3.css">
    <link rel="stylesheet" href="assets/css/Pure-Css-List-Item-Special-Effect.css">
</head>

<body>

 <?php require_once 'header.php'; ?> 



    <section class="py-5">
        <header class="bg-dark py-5">
            <div class="container py-5">
                <div class="row py-5">
                    <div class="col-md-6 text-center text-md-start d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-md-start align-items-md-center justify-content-xl-end mb-4">
                        <div style="max-width: 450px;">
                       <?php
                        if($podcastId == NULL) {  ?>
                         <h1> SEN SAYFANIN AÇIĞINI ARAMAYA ÇALIŞAN Bİ ELEMANSIN SANIRIM .....BÖYLE Bİ SAYFA YOK.  </h1> 
                         
                                        <?php
                                       
                        } else {

                                          ?> 
                                             
                                      
                                                
                        
                            <p id= "bolum-no" class="fw-bold text-success mb-2"><?php echo  $bolum_sayisi ?></p>
                            <h2 class="fw-bold"><strong><?php echo  $baslik ?></strong><br></h2>
                            <p class="my-3"><?php echo  $aciklama ?><br><!-- partial:index.partial.html -->
                            <p id= "konuk" style ="display: none;" class="fw-bold text-success mb-2"><?php echo  $konuk ?></p> 
                            <p id= "audio-load" style ="display: none;" class="fw-bold text-success mb-2"><?php echo  $audio_load ?></p> 
                            <p id= "users-id" style ="display: none;" class="fw-bold text-success mb-2"><?php echo  $kullaniciID ?></p> 
                            <p id= "podcast-id" style ="display: none;" class="fw-bold text-success mb-2"><?php echo  $podcastId ?></p> 
                            <p id= "videozamani" style ="display: none;" class="fw-bold text-success mb-2"><?php echo  $videoZamani ?></p> 

                                       
                                          
<!-- Tracks used in this music/audio player application are free to use. I downloaded them from Soundcloud and NCS websites. I am not the owner of these tracks. -->

<div id="app-cover">
  
 
  <div id="player">
    <div id="player-track" style = "background-color: #26293d !important;">
      <div id="album-name" style = "color: #ffffff !important;"></div>
      <div id="track-name"></div>
      <div id="track-time">
        <div id="current-time" style = "color: #19f5aa !important;"></div>
        <div id="track-length"  style = "color: #19f5aa !important;"></div>
      </div>
      <div id="s-area">
        <div id="ins-time"></div>
        <div id="s-hover"></div>
        <div id="seek-bar"style = "background-color: #19f5aa !important;"></div>
      </div>
    </div>
    <div id="player-content" style = "position: relative !important; height: 100% !important;background-color: #26293d !important; box-shadow: 0 30px 20px #0000002e !important; border-radius: 25px !important; z-index: 2 !important;" >
      <div id="album-art" style = "box-shadow: 0 0 0 3px #ffffff !important;">
        <img src="assets/img/Nereye%20Koyduysan%20Ordadır%20logosda.png" class="active" id="_1">
        <img src="https://raw.githubusercontent.com/himalayasingh/music-player-1/master/img/_2.jpg" id="_2">
        <img src="https://raw.githubusercontent.com/himalayasingh/music-player-1/master/img/_3.jpg" id="_3">
        <img src="https://raw.githubusercontent.com/himalayasingh/music-player-1/master/img/_4.jpg" id="_4">
        <img src="https://raw.githubusercontent.com/himalayasingh/music-player-1/master/img/_5.jpg" id="_5">
        <div id="buffer-box">Yükleniyor...</div>
      </div>
      <div id="player-controls">
        <div class="control">
          <div class="button" id="play-previous" style = "background-color: #26293d !important">
            <i class="fas fa-backward"></i>
          </div>
        </div>
        <div class="control">
          <div class="button" id="play-pause-button" style = "background-color: #26293d !important">
            <i class="fas fa-play"></i>
          </div>
        </div>
        <div class="control">
          <div class="button" id="play-next" style = "background-color: #26293d !important">
            <i class="fas fa-forward"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><script src="./script.js"></script></p>
                            <form class="d-flex justify-content-center flex-wrap justify-content-md-start flex-lg-nowrap" method="get">
                                <input type="hidden" name="bolum" value="2">
                                <div class="my-2 me-2"></div>
                  <!--  like butonu -->      <div class="my-2">
                    <button class="btn btn-success shadow" type="submit" name="like" style="margin-right: 188px;margin-left: 7px;">LIKE - <?=$likes?>
                  
                   
                  </button>
              
                  

                  </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="p-5 mx-lg-5" style="background: url(&quot;assets/img/blob.svg&quot;) center / contain no-repeat;"><img src="assets/img/Nereye%20Koyduysan%20Ordadır%20logosda.png" style="width: 354px;"></div>
                    </div>
                </div>
            </div>
        </header>
    </section>
    
    <div class="container">
   
    <div class="bg-dark border rounded border-dark d-flex flex-column justify-content-between align-items-center flex-lg-row p-4 p-lg-5">
                <form style = "position: relative; margin: auto;" class="d-flex justify-content-center flex-wrap flex-lg-nowrap" method="GET">
                    
                <div class="my-2">
                <textarea style ="width: 600px" class="border shadow-sm form-control" rows = "1" cols = "50" name = "yorum" placeholder="yorum ekle..."></textarea>
                  <input type="text" name="bolum" value = "1">
                </div>
                    <div class="my-2">
                      <button class="btn btn-primary shadow ms-2" type="submit">YORUM EKLE</button>
                    </div>
                </form>
            </div>
                          <br><br>
	<h2 class="text-center">YORUM YAPANLAR</h2>
	
	<div class="card">


<?php 

foreach ($yorumlar as $index => $value) {

  $kAdi = $value["name"]." ".$value["surname"];
  $kNick = $value["nickname"];
  $kYorum = $value["yorum"];
  $yZaman =  $value["date"];


?>

  <div class="card-body">
	        <div class="row">
        	    <div class="col-md-2">
        	        <img src="assets\img\anonim.png" class="img img-rounded img-fluid"/>
        	        <p class="text-secondary text-center">26.12.2022 - 14:55:28</p>
        	    </div>
        	    <div class="col-md-10">
        	        <p>
        	            <a class="float-left" href="profil.php?nick=<?=$kNick?>">
                        <strong>
                          
                        <?=$kAdi?>
                      
                      </strong>
                      </a>
        	       </p>
        	       <div class="clearfix">

                 </div>
        	        <p>

                  <?=$kYorum?>

                  </p>
        	        <p>
        	            <a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
        	            <a class="float-right btn text-dark btn-success"> <i class="fa fa-heart"></i> Like</a>


                      <?php if ($kullaniciID != -1 && $value['users_id'] == $kullaniciID) : ?>
                      <form method="POST" style="display: inline;">
                      <input type="hidden" name="comment_id" value="<?= $value['yorum_id'] ?>">
                      <a class="float-right btn btn-danger"> <i class="fa fa-solid fa-trash"></i></a>

                    </form>
                      <?php endif; ?>



                      
        	       </p>
        	    </div>
	        </div><!-- ROW -->
	    </div><!-- CARD BODY -->
     
      <?php  } ?>

	    
	</div>
</div>
<?php } ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/bold-and-dark.js"></script>
    <script src="assets/js/mp3.js"></script>
</body>

</html>