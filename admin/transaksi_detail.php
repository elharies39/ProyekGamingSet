<?php

require_once("../config/check_admin.php");
require_once("../config/database.php");

$id = (isset($_GET["id"])) ? $_GET["id"] : false;
if ($id === false) {
  header("Location: ../transaksi.php");
  exit;
}

$transaksi = mysqli_fetch_array(mysqli_query($conn, "SELECT t.*,s.* FROM transaksi t JOIN status s ON t.id_status = s.id WHERE t.id = '{$id}' LIMIT 1"));
if (empty($transaksi)) {
  header("Location: ../transaksi.php");
  exit;
}

$items = mysqli_query($conn, "SELECT ti.id as item_id, ti.jumlah, p.* FROM transaksi_item ti JOIN produk p ON ti.produk_id = p.id WHERE ti.transaksi_id = '{$id}'");

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

    <title>Lihat Transaksi Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/admin.css" rel="stylesheet">

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Admin</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="katalog.php">Katalog</a></li>
            <li class="active"><a href="transaksi.php">Transaksi</a></li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Lihat Transaksi</h1>

          <section>
            <dl class="dl-horizontal">
              <dt>Tanggal</dt>
              <dd><?php echo $transaksi["tanggal"]; ?></dd>
              <dt>Nomor Transaksi</dt>
              <dd><?php echo $transaksi['no_transaksi']?></dd>
              <dt>Nama Pembeli</dt>
              <dd><?php echo $transaksi["pembeli_nama"]; ?></dd>
              <dt>No. HP</dt>
              <dd><?php echo $transaksi["pembeli_no_hp"]; ?></dd>
              <dt>Email</dt>
              <dd><a href="mailto:<?php echo $transaksi["pembeli_email"]; ?>"><?php echo $transaksi["pembeli_email"]; ?></a></dd>
              <dt>Alamat</dt>
              <dd><?php echo $transaksi["pembeli_alamat"]; ?></dd>
              <dt>Status</dt>
              <dd>
                <select>
                    <option name="statusnya"><?php echo $transaksi['nama_status']?></option>
                </select>  
              </dd>
              <dt>Total</dt>
              <dd><?php echo number_format($transaksi["total"], 0, ",", "."); ?></dd>
            </dl>
            <div class="table-responsive">
              <table class="table table-striped">
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
                  <?php $i=1; while ($row = mysqli_fetch_array($items)) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['kategori']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo number_format($row['harga']); ?></td>
                    <td><?php echo number_format($row['jumlah']); ?></td>
                    <td><?php echo number_format($row['harga'] * $row['jumlah']); ?></td>
                  </tr>
                  <?php $i++; } ?>
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
          </section>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/jquery/jquery-2.2.3.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
