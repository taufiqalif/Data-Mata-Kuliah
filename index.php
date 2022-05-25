<?php
session_start();

if( !isset($_SESSION["login"]) ) {
  header("Location: ./login.php");
  exit;
}

require 'function/functions.php';


// pagination
// konfigurasi

$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM matkul"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

$matkul = query("SELECT * FROM matkul LIMIT $awalData, $jumlahDataPerHalaman");


// tombol cari ditekan
if( isset($_POST["cari"]) ) {
    $matkul = cari($_POST["keyword"]);
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

  <!-- icont -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">

  <!-- my css -->
  <link rel="stylesheet" href="css/dashboard.css">

  <title>Data Mata Kuliah</title>
</head>

<body>

  <!-- header -->

  <?php require('partials/header.php') ?>


  <!-- akhie header -->

  <div class="container-fluid">

    <div class="row">

      <!-- sidebar -->
      <?php require('partials/sidebar.php') ?>

      <!-- akhir sidebar -->


      <!-- konten -->

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="row border-bottom mb-3">
          <div class="col">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
              <h1 class="h2">Data Mata Kuliah</h1>
            </div>
          </div>
          <div class="col">
            <form method="POST" action="" class="col-12 col-lg-auto mb-3 mt-3 mb-lg-0 me-lg-3">
              <div class="input-group mb-3">
                <input class="form-control" name="keyword" type="text" value="" aria-label="readonly input example"
                  placeholder="Search..." autofocus autocomplete="off">
                <button class="btn btn-outline-secondary" type="submit" name="cari">Search</button>
              </div>
            </form>
          </div>
        </div>



        <a href="./crud/tambah.php" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i></a>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">NO.</th>
                <th scope="col">Nama File</th>
                <th scope="col">Mata Kuliah</th>
                <th scope="col">Semester</th>
                <th scope="col">File</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>

              <?php foreach($matkul as $row ): ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $row["nama"]; ?></td>
                <td><?= $row["mata_kuliah"]; ?></td>
                <td><?= $row["semester"]; ?></td>
                <td><?= $row["file"]; ?></td>
                <td>
                  <a href="crud/ubah.php?id=<?= $row["id"]; ?>" class="btn btn-primary"><i
                      class="bi bi-pencil-square"></i></a>
                  <a href="crud/lihat.php?id=<?= $row["id"]; ?>" class="btn btn-success"><i
                      class="bi bi-eye-fill"></i></a>
                  <a href="crud/hapus.php?id=<?= $row["id"]; ?>" class="btn btn-danger"><i
                      class="bi bi-trash3-fill"></i></a>
                </td>
              </tr>
              <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>

          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <?php if($halamanAktif > 1): ?>
              <li class="page-item">
                <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <?php endif; ?>
              <?php for($i = 1; $i <= $jumlahHalaman; $i++): ?>
              <?php if($i == $halamanAktif): ?>
              <li class="page-item active">
                <a class="page-link" href="?halaman=<?= $i ?>"><?= $i; ?></a>
              </li>
              <?php else: ?>
              <li class="page-item">
                <a class="page-link" href="?halaman=<?= $i ?>"><?= $i; ?></a>
              </li>
              <?php endif; ?>
              <?php endfor; ?>
              <?php if($halamanAktif < $jumlahHalaman): ?>
              <li class="page-item">
                <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </nav>
        </div>
      </main>

      <!-- akhir konten -->

    </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>

  <script src="js/dashboard.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
    integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
    integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
  </script>
  <script src="dashboard.js"></script>
</body>

</html>