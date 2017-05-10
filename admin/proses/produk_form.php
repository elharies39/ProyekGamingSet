<?php

session_start();
if (!isset($_SESSION['login'])) {
  header("Location: ../../login.php");
  exit;
}

require_once("../../config/database.php");

$id = (isset($_POST["id"])) ? $_POST["id"] : false;
if ($id !== false) {
  $produk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM produk WHERE id = '{$id}' LIMIT 1"));
  if (empty($produk)) {
    header("Location: katalog.php");
    exit;
  }
}

$nama = $_POST["nama"];
$harga = $_POST["harga"];
$stok = $_POST["stok"];
$deskripsi = $_POST["deskripsi"];
$kategori = $_POST["kategori"];

if ($id === false) {
  $query1 = mysqli_query($conn, "INSERT INTO produk (nama, harga, stok, deskripsi, kategori) VALUES ('{$nama}', '{$harga}', '{$stok}', '{$deskripsi}', '{$kategori}')");
  $new_id = mysqli_insert_id($conn);
} else {
  $query1 = mysqli_query($conn, "UPDATE produk SET nama = '{$nama}', harga = '{$harga}', stok = '{$stok}', deskripsi = '{$deskripsi}', kategori = '{$kategori}', stok = '{$stok}' WHERE id = '{$id}'");
  $new_id = $id;
}

$do_upload = false;
if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
	do {
		$ext = substr(basename($_FILES['image']['name']), strrpos(basename($_FILES['image']['name']), '.')+1);
		if (empty($ext) || !in_array($ext, explode('|', 'jpg|jpeg|png|bmp|gif'))) {
			break;
		}

		if (strpos($_FILES['image']['type'], "image") === false) {
			break;
		}

		$do_upload = true;
		$image_name = "{$new_id}.{$ext}";
		$new_image_path = "../../img/produk/{$image_name}";
	} while (0);
}
$is_moved = false;
if ($do_upload === true) {
	$is_moved = move_uploaded_file($_FILES['image']['tmp_name'], $new_image_path);
	if ($is_moved) {
		$query2 = mysqli_query($conn, "UPDATE produk SET image = '{$image_name}' WHERE id = '{$new_id}'");
	}
}

header("Location: ../katalog.php");
exit;
