<?php

session_start();

require_once("config/database.php");

if (!isset($_SESSION["items"])) {
  header("Location: katalog.php");
  exit;
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

    <title>Check Out</title>

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
            <li><a href="katalog.php">Katalog</a></li>
            <li class="active"><a href="keranjang.php">Keranjang</a></li>
            <li><a href="transaksi.php">Transaksi</a></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <h1 class="page-header">Check Out : Data Pembeli</h1>

      <form class="form-horizontal" method="post" action="proses/checkout.php">
        <div class="form-group">
          <label class="control-label col-sm-2" for="input-pembeli-nama">Nama</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="input-pembeli-nama" name="pembeli_nama" />
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="input-pembeli-no-hp">No. HP</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="input-pembeli-no-hp" name="pembeli_no_hp" />
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="input-pembeli-email">Email</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="input-pembeli-email" name="pembeli_email" />
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="input-pembeli-alamat">Alamat</label>
          <div class="col-sm-10">
            <textarea class="form-control" rows="7" id="input-pembeli-alamat" name="pembeli_alamat"></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Check Out & Beli</button>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $produk = mysqli_query($conn, "SELECT * FROM produk WHERE id IN (".implode(",", array_keys($_SESSION["items"])).")");
              $i = 1;
              $total_all = 0;
              while ($row = mysqli_fetch_array($produk)) { ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row["kategori"]; ?></td>
                <td><?php echo $row["nama"]; ?></td>
                <td><?php echo number_format($row["harga"], 0, ",", "."); ?></td>
                <td><?php echo number_format($_SESSION["items"][$row["id"]], 0, ",", "."); ?></td>
                <td><?php echo number_format($_SESSION["items"][$row["id"]] * $row["harga"], 0, ",", "."); ?></td>
              </tr>
              <?php $total_all += $_SESSION["items"][$row["id"]] * $row["harga"]; } ?>
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="clearfix text-right">
          <h4>Total : <?php echo number_format($total_all, 0, ",", "."); ?></h4>
        </div>
      </form>

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
