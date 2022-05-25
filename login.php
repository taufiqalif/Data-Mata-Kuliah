<?php 
session_start();  // session_start() untuk memulai session
require 'function/functions.php'; // require untuk memanggil file functions.php

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  // ambil usernam berdasarkan id
  $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);

  // cek cookie dan username
  if( $key === hash('sha256', $row['username']) ) {
    $_SESSION['login'] = true;
  }
}

if( isset($_SESSION["login"]) ) {
  header("Location: ./index.php");
  exit;
}


if( isset($_POST["login"]) ) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

  // cek username
  if( mysqli_num_rows($result) === 1 ) {
    // cek password
    $row = mysqli_fetch_assoc($result);
    if( password_verify($password, $row["password"]) ) {
      // set session
      $_SESSION["login"] = true;

      // cek remember me
      if( isset($_POST["remember"]) ) {
        setcookie('id', $row['id'], time() + 60);
        setcookie('key', hash('sha256', $row["username"]), time() + 60);
      }

      header("Location: ./index.php");
      exit;
    }
  }

  $error = true;
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Login</title>
</head>

<body class="bg-secondary">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-lg-4 mt-5 border border-5 rounded p-3 bg-light text-dark">
        <h2>Login</h2>
        <?php if(isset($error)): ?>
        <div class="alert alert-danger" role="alert">
          Username / Password salah!
        </div>
        <?php endif; ?>
        <form class="mt-3" action="" method="POST">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp">
            <div class="mb-3 mt-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" name="remember" id="remember">
              <label class="form-check-label" for="remember">Remember Me</label>
            </div>

            <button type="submit" name="login" class="btn btn-primary mb-3">Login</button>
            <p>Don't have an account? <a href="registrasi.php">Sign up</a></p>
            <!-- <button type="submit" name="login" class="btn btn-primary">Login</button> -->
        </form>
      </div>
    </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
</body>

</html>