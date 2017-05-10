<?php

session_start();

require_once("config/database.php");

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

    <title>Katalog</title>

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

      <h1 class="page-header">Katalog Produk</h1>

      <div class="featured-wrapper">
        <?php
        $katalog = mysqli_query($conn, "SELECT p.* FROM produk p LEFT JOIN transaksi_item ti ON p.id = ti.produk_id GROUP BY p.id ORDER BY ti.id DESC");
        while ($row = mysqli_fetch_array($katalog)) { ?>
        <div class="row">
          <div class="col-sm-2">
            <img class="img-circle" src="img/produk/<?php echo $row["image"]; ?>" alt="Generic placeholder image" style="width: 100%;">
          </div>
          <div class="col-sm-10">
            <h2><?php echo $row["nama"]; ?></h2>
            <p><?php echo (strlen($row["deskripsi"]) > 300) ? substr($row["deskripsi"], 0, 300).'...' : $row["deskripsi"]; ?></p>
            <p><a class="btn btn-default" href="detail.php?id=<?php echo $row["id"]; ?>" role="button">Selengkapnya »</a></p>
          </div>
        </div>
        <?php }?>
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
