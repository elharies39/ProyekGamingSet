<?php

session_start();

require_once("config/database.php");

$id = (isset($_GET["id"])) ? $_GET["id"] : false;
if ($id !== false) {
  $produk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM produk WHERE id = '{$id}' LIMIT 1"));
  if (empty($produk)) {
    header("Location: katalog.php");
    exit;
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Detail Produk</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <link href="css/index.css" rel="stylesheet" />

  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="katalog.php">Katalog</a></li>
            <li><a href="keranjang.php">Keranjang</a></li>
            <li><a href="transaksi.php">Transaksi</a></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <h1 class="page-header">Produk : <?php echo $produk["nama"]; ?></h1>

      <div class="featured-wrapper">
        <div class="row">
          <div class="col-sm-4">
            <img class="img-circle" src="img/produk/<?php echo $produk["image"]; ?>" alt="Generic placeholder image" style="width: 100%;">
          </div>
          <div class="col-sm-8">
            <h2><?php echo $produk["nama"]; ?></h2>
            <p><?php echo $produk["deskripsi"]; ?></p>
            <p>Harga : <?php echo number_format($produk["harga"], 0, ",", "."); ?></p>
            <p>Stok : <?php echo $produk["stok"]; ?></p>
            <p>Kategori : <?php echo $produk["kategori"]; ?></p>
            <p><a class="btn btn-success" href="proses/beli.php?id=<?php echo $produk["id"]; ?>" role="button">Beli</a></p>
          </div>
        </div>
      </div>

    </div><!-- /.container -->

    <!-- FOOTER -->
    <footer>
      <div class="container">
        <p class="text-muted">&copy; Copyright 2016 - Philo Mushofi El Haries (14523310) | Aji Rahadian Agung (14523295)</p>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/jquery/jquery-2.2.3.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
