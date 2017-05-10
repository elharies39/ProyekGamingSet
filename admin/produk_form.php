<?php

require_once("../config/check_admin.php");
require_once("../config/database.php");

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

    <title>Form Produk Admin</title>

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
          <h1 class="page-header">Form Produk</h1>

          <form class="form-horizontal" method="post" action="proses/produk_form.php" enctype="multipart/form-data">
            <?php if ($id !== false) { ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <?php } ?>
            <div class="form-group">
              <label class="control-label col-sm-2" for="input-nama">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="input-nama" name="nama" value="<?php if ($id !== false) echo $produk["nama"]; ?>" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="input-harga">Harga</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="input-harga" name="harga" value="<?php if ($id !== false) echo $produk["harga"]; ?>" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="input-stok">Stok</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="input-stok" name="stok" value="<?php if ($id !== false) echo $produk["stok"]; ?>" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="input-deskripsi">Deskripsi</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="input-deskripsi" name="deskripsi" rows="7"><?php if ($id !== false) echo $produk["deskripsi"]; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="input-kategori">Kategori</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="input-kategori" name="kategori" value="<?php if ($id !== false) echo $produk["kategori"]; ?>" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="input-image">Upload Gambar</label>
              <div class="col-sm-10">
                <input type="file" id="input-image" name="image" accept="image/*" />
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Submit</button>
                <a class="btn btn-default" href="katalog.php">Cancel</a>
              </div>
            </div>
          </form>
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
