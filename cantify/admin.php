<?php 

require_once 'veriTabani.php';

//title=&manset=&konuk=&aciklama=&muzik=&mp3-dosya=&resim=&resim-dosya=
if(isset($_GET["title"]) && isset($_GET["manset"]) && isset($_GET["konuk"]) && isset($_GET["aciklama"]) ){


    $title = $_GET["title"];
    $manset = $_GET["manset"];
    $konuk = $_GET["konuk"];
    $aciklama = $_GET["aciklama"];
    $muzik = "0";
    $resim = "0";

    if( $_GET["muzik"] != "")
    {
        $muzik =  $_GET["muzik"];
    }else if($_GET["mp3-dosya"] != "")
    {
        $muzik =  $_GET["mp3-dosya"];
    }

    if( $_GET["resim"] != "")
    {
        $resim =  $_GET["resim"];
    }else if($_GET["resim-dosya"] != "")
    {
        $resim =  $_GET["resim-dosya"];
    }
    // Check the value of each parameter
    if (empty($title)) 
    {echo "FORM ALANLARINI, title BİLGİLERİNİ DOLDUR!!!!!";
    // The title parameter is empty
    // ...
  } else if (empty($manset)) {
    echo "FORM ALANLARINI, masnet BİLGİLERİNİ DOLDUR!!!!!";
    // The manset parameter is empty
    // ...
  } else if (empty($konuk)) {
    echo "FORM ALANLARINI, konuk BİLGİLERİNİ DOLDUR!!!!!";

    // The aciklama parameter is empty
  // ...
} else if (empty($muzik)) {
    // The muzik parameter is empty
    echo "FORM ALANLARINI, muzik BİLGİLERİNİ DOLDUR!!!!!";

  } else if (empty($resim)) {
    echo "FORM ALANLARINI, resim BİLGİLERİNİ DOLDUR!!!!!";

  } else {
    echo "FORM ALANLARINI, boş BİLGİLERİNİ DOLDUR!!!!!";

  }


    if (empty($title) || empty($manset) || empty($konuk) || empty($aciklama) || empty($muzik) || empty($resim) ) {
        echo "FORM ALANLARINI, BÖLÜM BİLGİLERİNİ DOLDUR!!!!!";
    }else{
        
    
        $stmt = $baglanti->prepare("INSERT INTO podcast (listened,sez_id,admin_id,likes,title, baslik, guest, explanation, audio_load, image, date) VALUES (0,1,1,0,?,?,?,?,?,?,(SELECT GETDATE()))");
        $insert = $stmt->execute([$title, $manset, $konuk, $aciklama, $muzik, $resim]); 
        if ( $insert )
        {
            echo "KAYIT BASARILI";
        }else
        {
            echo "Kayıt olurken DB yazma sorunu bir şeyler ters gitti.... ";
        }

    
    }



}






?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Contacts - podcast</title>
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


<?php 
require_once 'header.php';

?>

    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <p class="fw-bold text-success mb-2">admin</p>
                    <h2 class="fw-bold">YENI BÖLÜM KAYIT</h2>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-xl-4">
                    <div>
                        <form class="p-3 p-xl-4" method="get">
                            <div class="mb-3"><input class="form-control" type="text" id="idtitle" name="title" placeholder="Bölüm Sayısı"></div>
                            <div class="mb-3"><input class="form-control" type="text" id="idmanset" name="manset" placeholder="manşet"></div>
                            <div class="mb-3"><input class="form-control" type="text" id="idkonuk" name="konuk" placeholder="konuk"></div>
                            <div class="mb-3"><textarea class="form-control" id="idaciklama" name="aciklama" rows="6" placeholder="Açıklama"></textarea></div>
                            <div class="mb-3">  
                                <input class="form-control" type="text" id="idmuzik" name="muzik" placeholder="MP3 Linki yapıştır veya seç">
                                 <input type="file" id="mp3-dosya" name="mp3-dosya" accept="audio/mpeg,audio/mp3">
                           </div>
                            <div class="mb-3">  
                                <input class="form-control" type="text" id="idresim" name="resim" placeholder="Resim Linki yapıştır veya seç">
                                 <input type="file" id="resim-dosya" name="resim-dosya" accept="image/jpeg,image/png">
                            </div>
                          
                            <div><button class="btn btn-primary shadow d-block w-100" type="submit">Send </button></div>
                        </form>
                    </div>
                </div>
               
            </div>
        </div>
    </section>
    <footer class="bg-dark"></footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/bold-and-dark.js"></script>
    <script src="assets/js/mp3.js"></script>
</body>

</html>