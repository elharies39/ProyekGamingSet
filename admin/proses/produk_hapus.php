<?php

session_start();
if (!isset($_SESSION['login'])) {
  header("Location: ../../login.php");
  exit;
}

require_once("../../config/database.php");

$id = (isset($_GET["id"])) ? $_GET["id"] : false;
if ($id === false) {
  header("Location: ../katalog.php");
  exit;
}

$produk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM produk WHERE id = '$id' LIMIT 1"));
if (empty($produk)) {
  header("Location: ../katalog.php");
  exit;
}

$query = mysqli_query($conn, "DELETE FROM produk WHERE id = '$id'");

header("Location: ../katalog.php");
exit;
