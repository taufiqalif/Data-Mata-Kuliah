<?php
session_start();

if( !isset($_SESSION["login"]) ) {
  header("Location: ./login.php");
  exit;
}

require '../function/functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
  // cek apakah data berhasil ditambahkan atau tidak
  if (tambah($_POST) > 0) {
    echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = '../index.php';
            </script>
        ";
  } else {
    echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = '../index.php';
            </script>
        ";
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

  <link rel="stylesheet" href="../css/dashboard.css">

  <title>Tambah Data</title>
</head>

<body>

  <!-- header -->

  <?php require('../partials/header.php') ?>


  <!-- akhie header -->


  <div class="container-fluid">
    <div class="row">

      <!-- sidebar -->
      <?php require('../partials/sidebar.php') ?>

      <!-- akhir sidebar -->

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
        </div>


        <a href="../index.php" class="btn btn-primary mb-3">Data Kuliah</a>

        <form action="" method="POST" enctype="multipart/form-data" style="width: 50% ;">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama file</label>
            <input type="text" name="nama" class="form-control" id="nama" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
            <input type="text" name="mata_kuliah" class="form-control" id="mata_kuliah" aria-describedby="emailHelp"
              required>
          </div>

          <div class="mb-3">
            <label for="semester" class="form-lable">Semester</label>
            <select class="form-select" aria-label="Default select example" name="semester" id="semester" required>
              <option selected>Pilih Semester</option>
              <option value="Semester-1">Semester 1</option>
              <option value="Semester-2">Semester 2</option>
              <option value="Semester-3">Semester 3</option>
              <option value="Semester-4">Semester 4</option>
              <option value="Semester-5">Semester 5</option>
              <option value="Semester-6">Semester 6</option>
              <option value="Semester-7">Semester 7</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="file" class="form-label">File</label>
            <input class="form-control" name="file" type="file" id="file" multiple required>
          </div>

          <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </form>

      </main>
    </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>

  <script src="../js/dashboard.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
    integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
    integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
  </script>
  <script src="dashboard.js"></script>
</body>

</html>