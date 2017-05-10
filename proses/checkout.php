<?php

session_start();

require_once("../config/database.php");
require_once("../config/functions.php");

if (!isset($_SESSION["items"])) {
  header("Location: ../katalog.php");
  exit;
}

$pembeli_nama   = $_POST["pembeli_nama"];
$pembeli_no_hp  = $_POST["pembeli_no_hp"];
$pembeli_email  = $_POST["pembeli_email"];
$pembeli_alamat = $_POST["pembeli_alamat"];
$tanggal        = date("Y-m-d H:i:s");
do {
  $no_transaksi   = generateRandomStringNum(15);
  $check = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM transaksi WHERE no_transaksi = '{$no_transaksi}'"));
} while (!empty($check));

$query = mysqli_query($conn, "INSERT INTO transaksi (no_transaksi, pembeli_nama, pembeli_no_hp, pembeli_email, pembeli_alamat, tanggal, total,id_status) VALUES ('{$no_transaksi}', '{$pembeli_nama}', '{$pembeli_no_hp}', '{$pembeli_email}', '{$pembeli_alamat}', '{$tanggal}', '0','1')");

$query2 = true;
$query3 = true;
if ($query) {
  $new_id = mysqli_insert_id($conn);
  $total_all = 0;
  $produk = mysqli_query($conn, "SELECT * FROM produk WHERE id IN (".implode(",", array_keys($_SESSION["items"])).")");
  foreach ($produk as $row) {
    $tmp_jumlah = $_SESSION["items"][$row["id"]];
    $total_all += $tmp_jumlah * $row["harga"];
    $query2 = $query2 && mysqli_query($conn, "INSERT INTO transaksi_item (transaksi_id, produk_id, jumlah, harga) VALUES ('{$new_id}', '{$row["id"]}', '{$tmp_jumlah}', '{$row["harga"]}')");
  }
  if ($query2) {
    $query3 = mysqli_query($conn, "UPDATE transaksi SET total = '{$total_all}' WHERE id = '{$new_id}'");
  }
}

unset($_SESSION["items"]);

header("Location: ../transaksi.php?no={$no_transaksi}");
exit;
