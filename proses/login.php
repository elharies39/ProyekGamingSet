<?php

require_once("../config/database.php");

$username = mysqli_real_escape_string($conn, $_POST["username"]);
$password = mysqli_real_escape_string($conn, $_POST["password"]);

$login = mysqli_query($conn, "SELECT * FROM admin WHERE username = '{$username}' AND password = '{$password}' LIMIT 1");
if ($row = mysqli_fetch_array($login)) {
  session_start();
  $_SESSION["login"] = [
    "id"        => $row["id"],
    "username"  => $row["username"]
  ];
  header("Location: ../admin/index.php");
  exit;
} else {
  header("Location: ../login.php");
  exit;
}
