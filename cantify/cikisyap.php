<?php 

require_once 'veriTabani.php';

setcookie("mail", "", time() - 3600);
setcookie("sifre", "", time() - 3600);

setcookie("cerezid", "", time() - 3600);
setcookie("cerezname","", time() - 3600);
setcookie("nicknameid", "", time() - 3600);

sayfayaYonlendir('index.php');

?>
