
<?php require_once 'veriTabani.php'; ?> 

<?php

$mesaj = "";

if(isset($_POST["isim"]) && isset($_POST["soyad"]) && isset($_POST["email"]) && isset($_POST["nick"]) && isset($_POST["password"])){

    #echo "<p>".$_POST["isim"]."</p>";
    #echo "<p>".$_POST["soyad"]."</p>";
    #echo "<p>".$_POST["email"]."</p>";
    #echo "<p>".$_POST["nick"]."</p>";
    #echo "<p>".$_POST["password"]."</p>";

    $stmt = $baglanti->prepare("INSERT INTO users (name, surname, mail, password, nickname ) VALUES (?,?,?,?,?)");
    try {
        $insert = $stmt->execute([$_POST["isim"], $_POST["soyad"], $_POST["email"], $_POST["password"], $_POST["nick"]]); 
    if ( $insert )
    {
         $mesaj = "<strong> KAYIT OLUNDUI! </strong> Nereye Koyduysan Ordadır Ailesine HoşGeldiniz.";
    }
    else
    {
         $mesaj = "<strong> KAYIT OLUNAMADI! </strong>";
    }
    } catch (\Throwable $th) {
       $mesaj =  "<strong> KAYIT OLUNAMADI! </strong>";
    }
    

}

    

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sign up - podcast</title>
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
        <div class="container py-5">
       


            <div class="row mb-4 mb-lg-5">

            

                <div class="col-md-8 col-xl-6 text-center mx-auto">
                <?php
                if ($mesaj != "") {?>
                <div  class="alert alert-primary alert-dismissible show fade text-center" role="alert">
                <?php echo $mesaj ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                    </button>
                    </div> <br>
                    
                    <?php   }  ?>
               
                

                    <p class="fw-bold text-success mb-2">KAYIT OL</p>
                    <h2 class="fw-bold">Hoş geldin</h2>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body text-center d-flex flex-column align-items-center">
                            <div class="bs-icon-xl bs-icon-circle bs-icon-primary shadow bs-icon my-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                                </svg>
                            </div>
                            <form method="post">
                                <div class="mb-3"><input class="form-control" type="text" name="isim" required placeholder="İsim"></div>
                                <div class="mb-3"><input class="form-control" type="text" name="soyad" required placeholder="Soyad"></div>
                                <div class="mb-3"><input class="form-control" type="email" name="email" required placeholder="Email"></div>
                                <div class="mb-3"><input class="form-control" type="text" name="nick" required placeholder="Nickname"></div>
                                <div class="mb-3"><input class="form-control" type="password" name="password" required placeholder="Password"></div>
                                <div class="mb-3"><button class="btn btn-primary shadow d-block w-100" type="submit">Kayıt Ol</button></div>
                                <p class="text-muted">Hesabınız var mı?&nbsp;&nbsp;<a href="login.html">Giriş yap</a></p>
                            </form>
                        </div>
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