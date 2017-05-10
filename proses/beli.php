<?php

session_start();

require_once("../config/database.php");

$id = (isset($_GET["id"])) ? $_GET["id"] : false;
if ($id !== false) {
  $produk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM produk WHERE id = '{$id}' LIMIT 1"));
  if (empty($produk)) {
    header("Location: ../katalog.php");
    exit;
  }
}

$jumlah = (isset($_GET["jumlah"])) ? $_GET["jumlah"] : 1;
if (!isset($_SESSION["items"][$id])) {
  $_SESSION["items"][$id] = $jumlah;
} else {
  $_SESSION["items"][$id] += $jumlah;
}
if ($_SESSION["items"][$id] < 1) {
  unset($_SESSION["items"][$id]);
}
if (count($_SESSION["items"]) == 0) {
  unset($_SESSION["items"]);
}

header("Location: ../keranjang.php");
exit;
