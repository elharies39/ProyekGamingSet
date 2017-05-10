<?php

require_once("../config/check_admin.php");
require_once("../config/database.php");

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

    <title>Katalog Admin</title>

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
            <li class="active"><a href="katalog.php">Katalog</a></li>
            <li><a href="transaksi.php">Transaksi</a></li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Katalog</h1>

          <a class="btn btn-success" href="produk_form.php">Tambah Produk</a>
          <div class="table-responsive">
            <?php $katalog = mysqli_query($conn, "SELECT * FROM produk"); ?>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Harga</th>
                  <th>Stok</th>
                  <th>Kategori</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; while ($row = mysqli_fetch_array($katalog)) { ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $row["nama"]; ?></td>
                  <td><?php echo $row["harga"]; ?></td>
                  <td><?php echo $row["stok"]; ?></td>
                  <td><?php echo $row["kategori"]; ?></td>
                  <td>
                    <a class="btn btn-xs btn-primary" href="produk_form.php?id=<?php echo $row["id"]; ?>">Edit</a>
                    <a class="btn btn-xs btn-danger" href="proses/produk_hapus.php?id=<?php echo $row["id"]; ?>">Hapus</a>
                  </td>
                </tr>
                <?php $i++; } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Harga</th>
                  <th>Stok</th>
                  <th>Kategori</th>
                  <th>Aksi</th>
                </tr>
              </tfoot>
            </table>
          </div>
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
