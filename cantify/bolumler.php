<?php require_once 'veriTabani.php'; 

//GIRIS YAPAN KULLANICI BILGILERI
$kullaniciID = -1;

if( isset($_COOKIE['cerezid'])){
    if( $_COOKIE['cerezid']!='') {
        $kullaniciID = $_COOKIE['cerezid'];
    }
}

 


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Services - podcast</title>
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

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">

<?php require_once 'header.php'; ?> 

    <section class="py-5" style="max-height: 100px;">
        <div class="container py-5" style="margin-bottom: 600px;height: 935.969px;">
            <div class="row mb-4 mb-lg-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <p class="fw-bold text-success mb-2" style="backdrop-filter: sepia(0%);font-weight: bold;font-size: 50px;">BÖLÜMLER</p>
                    <h3 class="fw-bold"></h3>
                </div>
            </div>
          


            <?php


                $stmt = $baglanti->prepare("SELECT * FROM podcast"); //SQL Kodu uygulanir.
                $stmt->execute(); //SQL kodu calistirilir.
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //Butun sonuc getirilir.
                $count = $stmt->rowCount(); //Kac satir sonuc cikmis sayisini getirir.
                echo "Bulunan sonuc: $count adet.<br>";
                //print_r($result);
                echo "<br>";
                
            //PODCASTLER LISTELENIR BUTUN BILGILERIYELE
            foreach ($result as $index => $value) {

                //ogren izledi mi izlemedi mi?
                //(select h.* from history h where h.podcast_id = 2 and h.users_id = 1)

                $podcastId = $value["podcast_id"];

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

            ?>

                         
                <?php

                 if($index %2 == 0){

                    ?>  
                <div class="row row-cols-1 row-cols-md-2 mx-auto" style="max-width: 900px;">
                <div class="col mb-5" style="text-align: center;"> 
                    <img src="assets/img/Nereye%20Koyduysan%20Ordadır%20logosda.png" style="width: 200px;">
                </div>      
                <div class="col d-md-flex align-items-md-end align-items-lg-center mb-5" style="text-align: left;"> <!-- DIV ICINDEKILERI sola CEKER -->
                    <div>
                        <h5 class="fw-bold">
                            
                        <?php
                                echo $value["title"];
                        ?>
                         

                        </h5>
                        <p class="text-muted mb-4">
                        <?php
                               echo $value["explanation"];
                               
                        ?>
                        </p>
                        
                        
                        <button onClick="parent.location='http://localhost/cantify/bolum.php?bolum=<?=$podcastId?>'" class="btn btn-primary shadow" type="button">
                            <?php 
                            
                            if($videoZamani == 0)
                                echo "Dinle";
                            else if($videoZamani == -1)
                                echo "Tekrar Dinle";
                            else
                                {
                                    $dakika = (int) ($videoZamani / 60);
                                    $saniye = $videoZamani % 60;
                                    echo "Kaldığın Yerden ($dakika:$saniye sn) Devam Et.";
                                }
                                ?>
                        </button>
                    </div>
                </div>
            </div>
                  
            <?php
                 }
                if($index %2 == 1){

            ?>


            <div class="row row-cols-1 row-cols-md-2 mx-auto" style="max-width: 900px;">
                <div class="col order-md-last mb-5" style="text-align: center;"> <!-- resmi sağa alır -->
                    <img src="assets/img/Nereye%20Koyduysan%20Ordadır%20logosda.png" style="width: 200px;">
                </div>
                 
                <div class="col d-md-flex align-items-md-end align-items-lg-center mb-5" style="text-align: right;"> <!-- DIV ICINDEKILERI SAG CEKER -->
                    <div>
                        <h5 class="fw-bold text-end"> <?= $value["title"]?>
                        </h5>
                        <p class="text-end text-muted mb-4"><?= $value["explanation"]?></p>
                    <button onClick="parent.location='http://localhost/cantify/bolum.php?bolum=<?=$podcastId?>'" class="btn btn-primary shadow" type="button">

                        <?php 
                        
                        if($videoZamani == 0)
                            echo "Dinle";
                        else if($videoZamani == -1)
                            echo "Tekrar Dinle";
                        else{

                        
                        $dakika = (int) ($videoZamani / 60);
                        $saniye = $videoZamani % 60;
                        echo "Kaldığın Yerden ($dakika:$saniye sn) Devam Et.";
                       
                        }   
                        ?>
                        
                        </button>
                    </div>
                    
                </div>
            </div>
           
           <?php
             }   
                }    
            ?>
           

        </div>
    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/bold-and-dark.js"></script>
    <script src="assets/js/mp3.js"></script>
</body>

</html>























