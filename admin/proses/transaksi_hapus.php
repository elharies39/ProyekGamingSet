<?php

session_start();
if (!isset($_SESSION['login'])) {
  header("Location: ../../login.php");
  exit;
}

require_once("../../config/database.php");

$id = (isset($_GET["id"])) ? $_GET["id"] : false;
if ($id === false) {
  header("Location: ../transaksi.php");
  exit;
}

$transaksi = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM transaksi WHERE id = '{$id}' LIMIT 1"));
if (empty($transaksi)) {
  header("Location: ../transaksi.php");
  exit;
}

$query1 = mysqli_query($conn, "DELETE FROM transaksi WHERE id = '{$id}'");
$query2 = mysqli_query($conn, "DELETE FROM transaksi_item WHERE transaksi_id = '{$id}'");

header("Location: ../transaksi.php");
exit;
