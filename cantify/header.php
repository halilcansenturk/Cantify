<?php 
require_once 'veriTabani.php';
?>

<nav class="navbar navbar-dark navbar-expand-md sticky-top navbar-shrink py-3" id="mainNav">
    <div class="container"><a class="navbar-brand d-flex align-items-center" href="/cantify/index.php">
        <img src="assets/img/Nereye%20Koyduysan%20Ordadır%20logosda.png" width="50" height="50" style="transform: translate(0px) translateX(-4px);">
        <span>NKO</span>
    </a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
            <span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul  class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Ana Sayfa</a></li>
                <li class="nav-item"><a class="nav-link active" href="bolumler.php">Bölümler</a></li>
                <li class="nav-item"><a class="nav-link " href="contacts.php">Hakkında</a></li>
                <li class="nav-item"><a class="nav-link " href="../../">Kişisel Profil</a></li>
            </ul>

            <?php
             $current_page_url = $_SERVER['REQUEST_URI'];
                if ($current_page_url != "/cantify/login.php" ) //Giriş sayfasına geldiğinde giriş butonu gözükmez
           { ?> 
           
  

           <?php if ($login == true) {

            $nick = $_COOKIE["nicknameid"];
            $name = $_COOKIE["cerezname"];

            echo ' <a  class="btn btn-primary shadow " role="button" href="cikisyap.php"> ÇIKIŞ YAP </a>';
            echo ' <a  class="btn btn-primary shadow " role="button" href="profil.php?nick='.$nick.'"> '.$name.' </a>';
           }else{

            echo ' <a  class="btn btn-primary shadow " role="button" href="login.php"> GİRİŞ YAP  </a> ';
           }
                ?>
         
       
            <?php  }?>
            <?php if (!$login == true) {
                 echo '<a style = "margin-left: 10px;" class="btn btn-primary shadow" role="button" href="signup.php">KAYIT</a>';
            }
           
            ?>
            
            
               

        </div>
    </div>
</nav>

