<?php

require '../function/functions.php';

// ambil data di URL
$id = $_GET["id"];

$fil = query("SELECT * FROM matkul WHERE id = $id")[0];

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
  <link rel="stylesheet" href="../css/dashboard.css">

  <title>Data Mata Kuliah</title>
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


      <!-- konten -->

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="row border-bottom mb-3">
          <div class="col">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
              <h1 class="h2"><?= $fil["nama"]; ?></h1>
            </div>
          </div>
        </div>
        <a href="../index.php" class="btn btn-primary mb-3"><i class="bi bi-arrow-left-square-fill"></i></a>

        <div class="row">
          <div class="col-10 mb-5">
            <embed src="../file/<?= $fil["file"]; ?>" type='application/pdf' width='100%' height='700px' />
          </div>
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