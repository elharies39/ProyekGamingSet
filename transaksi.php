<?php

session_start();

require_once("config/database.php");

$no_transaksi = "";
if (isset($_GET["no"])) {
  $no_transaksi = $_GET["no"];
  $transaksi = mysqli_fetch_array(mysqli_query($conn, "SELECT t.*,s.nama_status FROM transaksi t JOIN status s ON t.id_status = s.id WHERE t.no_transaksi = '{$no_transaksi}' LIMIT 1"));
  //$status = mysqli_fetch_array(mysqli_query($conn, "SELECT  FROM status WHERE id = 1"));
  if (empty($transaksi)) {
    header("Location: katalog.php");
    exit;
  }
  $transaksi_item = mysqli_query($conn, "SELECT p.*, ti.jumlah FROM transaksi_item ti JOIN produk p ON ti.produk_id = p.id WHERE ti.transaksi_id = '{$transaksi["id"]}'");
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
            <li><a href="keranjang.php">Keranjang</a></li>
            <li class="active"><a href="transaksi.php">Transaksi</a></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <h1 class="page-header">Data Transaksi</h1>

      <form class="form-horizontal" method="get" action="transaksi.php">
        <div class="form-group">
          <label class="control-label col-sm-2" for="input-no-transaksi">Nomor Transaksi</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="input-no-transaksi" name="no" value="<?php echo $no_transaksi; ?>" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Cari</button>
          </div>
        </div>
        <?php if (isset($transaksi)) { ?>
        <dl class="dl-horizontal">
          <dt>Tanggal</dt>
          <dd><?php echo $transaksi["tanggal"]; ?></dd>
          <dt>Nama Pembeli</dt>
          <dd><?php echo $transaksi["pembeli_nama"]; ?></dd>
          <dt>No. HP</dt>
          <dd><?php echo $transaksi["pembeli_no_hp"]; ?></dd>
          <dt>Email</dt>
          <dd><a href="mailto:<?php echo $transaksi["pembeli_email"]; ?>"><?php echo $transaksi["pembeli_email"]; ?></a></dd>
          <dt>Alamat</dt>
          <dd><?php echo $transaksi["pembeli_alamat"]; ?></dd>
          <dt>Status</dt>
          <dd><?php echo $transaksi["nama_status"]?></dd>
          <dt>Total</dt>
          <dd><?php echo number_format($transaksi["total"], 0, ",", "."); ?></dd>
        </dl>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              $total_all = 0;
              while ($row = mysqli_fetch_array($transaksi_item)) { ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row["kategori"]; ?></td>
                <td><?php echo $row["nama"]; ?></td>
                <td><?php echo number_format($row["harga"], 0, ",", "."); ?></td>
                <td><?php echo number_format($row["jumlah"], 0, ",", "."); ?></td>
                <td><?php echo number_format($row["jumlah"] * $row["harga"], 0, ",", "."); ?></td>
              </tr>
              <?php $total_all += $row["jumlah"] * $row["harga"]; } ?>
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <?php } ?>
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
