<?php

session_start();

if (isset($_SESSION["login"])) {
  header("Location: admin/index.php");
  exit;
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

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet" />

  </head>

  <body>

    <div class="container">

      <form class="form-signin" role="form" action="proses/login.php" method="post">
        <h2 class="form-signin-heading">Silakan Login <a class="btn btn-xs btn-default" href="index.php">Kembali</a></h2>
        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus />
        <input type="password" name="password" class="form-control" placeholder="Password" required />
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
