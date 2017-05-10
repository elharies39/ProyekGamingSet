<?php

$db_server    = 'localhost';
$db_username  = 'root';
$db_password  = '';
$db_name      = 'proyek_si';

$conn = mysqli_connect($db_server, $db_username, $db_password) or die("Koneksi database gagal!");
mysqli_select_db($conn, $db_name);
