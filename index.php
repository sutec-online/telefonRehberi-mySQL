<?php
ob_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "toor";
$dbname = "rehber";

try {
    $db = new PDO("mysql:host=".$dbhost.";dbname=".$dbname , $dbuser , $dbpass);
    $db->exec("set names utf8");
} catch (\PDOException $e) {
    die("Veritabani baglantisi sirasinda bir hata olustu!");
} catch (\Exception $e) {
    die("Bir hata olustu!");
}

function hataGoster($mesaj) {
    echo "<div class='alert alert-danger'>".$mesaj."</div>";
}

function yonlendir($adres) {
    header("Location: ".$adres);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Otopark Sistemi</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      padding-top: 40px;
    }
  </style>

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<div class="container">
    <?php
    $dosya = isset($_GET['do']) ? $_GET['do'] : "anasayfa"; // isset fonksiyonu bir değerin olup olmadığını kontrol eder. Eğer 'do' GET i varsa onu alacak yoksa 'anasayfa' değerini alacak.
    include "sayfalar/".$dosya.".php";
    ?>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>