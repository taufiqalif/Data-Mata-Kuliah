<?php 

require 'function/functions.php';

if(isset($_POST["register"])) {
    if(registrasi($_POST) > 0) {
        echo "
            <script>
                alert('user baru berhasil di tambahkan!');
                document.location.href = 'login.php';
            </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
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

  <title>Registrasi</title>
</head>

<body class="bg-secondary">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 mt-5 border border-5 rounded p-3 bg-light text-dark">
        <h2>Registrasi</h2>
        <form class="mt-3" action="" method="POST">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp">
          </div>
          <!-- <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
          </div> -->
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password">
          </div>
          <div class="mb-3">
            <label for="password2" class="form-label">Confirmasi password</label>
            <input type="password" class="form-control" name="password2" id="password2">
          </div>
          <!-- <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div> -->

          <button type="submit" name="register" class="btn btn-primary mb-2">Register</button>
          <p>Have an account already? <a href="login.php">Log in</a></p>
          <!-- <button type="submit" name="register" class="btn btn-primary">Register</button> -->
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