<?php 

session_start();

if(!isset($_SESSION["signin"])) {
  header("Location: ../../sign/user_sign_in.php");
  exit;
}

if($_SESSION["level"] === "Admin") {
  echo "<script>alert('Anda Tidak Dapat Mengakses Halaman Ini');document.location.href = '../../index-admin.php';</script>";
}
if($_SESSION["level"] === "Pengajar") {
  echo "<script>alert('Anda Tidak Dapat Mengakses Halaman Ini');document.location.href = '../../index-pengajar.php';</script>";
}
if($_SESSION["level"] === "Pimpinan") {
  echo "<script>alert('Anda Tidak Dapat Mengakses Halaman Ini');document.location.href = '../../index-pimpinan.php';</script>";
}

require "../user_admin/pendaftar/pendaftar_functions.php";
$pendaftar = queryTampilPendaftar("SELECT * FROM tb_pendaftar");

if ( isset($_POST["cariPendaftar"]) ) {
	$pendaftar = cariPendaftar($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <style>
      a {
        text-decoration: none;
      }
    </style>

    <link rel="shortcut icon" href="../../src/img/logo-rjch-baru.png">

    <title>Partisipan - Tabel Data Pendaftar</title>

  </head>
  <body>

    <!-- NAVBAR -->
    <section id="navbar">
      <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
          <a href="https://rajawaliciptaharapan.com/" target="_blank">
            <img src="../../src/img/logo-rjch-baru.png" width="60px" alt="PT. Rajawali Cipta Harapan" class="mt-3"/>
          </a>
          <div class="btn-group ms-5 mt-2" role="group" aria-label="Button group with nested dropdown">
            <a class="btn-group" href="../../index-partisipan.php">
              <button type="button" class="btn btn-primary"><i class="bi bi-house-door-fill"></i> Beranda</button>
            </a>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-file-earmark-post-fill"></i> Data
              </button>
              <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <li>
                  <a class="dropdown-item text-primary" href="pendaftar_show.php"><i class="bi bi-person-fill"></i> Data Pendaftar</a>
                </li>
                <li>
                  <a class="dropdown-item text-primary" href="peserta_show.php"><i class="bi bi-person-circle"></i> Data Peserta</a>
                </li>
              </ul>
            </div>
            <a class="btn-group" href="profile_partisipan.php">
              <button type="button" class="btn btn-primary"><i class="bi bi-person-lines-fill"></i> Profil Saya</button>
            </a>
          </div>
          <ul class="navbar-nav ms-auto mb-2 mt-3 mb-lg-0">
            <li class="nav-item">
              <p class="nav-link fw-bold text-primary me-3 ">Website SIM Data Pelatihan Digital Marketing</p>
            </li>
          </ul>
        </div>
      </nav>
      <hr>
    </section>
    <!-- NAVBAR END -->

    <!-- BODY -->
    <section id="body">
      <div class="container">
        <h1 class="text-primary mb-5 text-center fw-bold">Tabel Data Pendaftar <br> Pelatihan Digital Marketing</h1>
        <div class="row">
          <div class="col-md-7">
          </div>
          <div class="col-md-5">
            <div class="input-group mb-3">
              <form action="" method="post" class="d-flex">         
                <input type="text" class="form-control" placeholder="Cari Nama Pendaftar" name="keyword" size="70" autocomplete="off" autofocus>
                <button class="btn btn-outline-primary ms-1" type="submit" name="cariPendaftar"><i class="bi bi-search"></i></button>
              </form>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kode Partisipan</th>
                <th scope="col">Nama Pendaftar</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Bidang Usaha</th>
              </tr>
            </thead>
            <?php $i = 1; ?>
            <?php foreach ($pendaftar as $row) : ?>
            <tbody>
              <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $row["kode_partisipan"]; ?></td>
                <td><?= $row["nama_pendaftar"]; ?></td>
                <td><?= $row["jenis_kelamin"]; ?></td>
                <td><?= $row["bidang_usaha"]; ?></td>
              </tr>
            </tbody>
            <?php $i++ ?>
            <?php endforeach; ?>
          </table>
          </div>
        </div>
      </div>
    </section>
    <!-- BODY END -->

    <!-- FOOTER -->
    <section class="footer mt-5 mb-3">
      <hr>
      <div class="container">
        <div class="row mt-3">
          <div class="col-md-2">
            <a href="https://rajawaliciptaharapan.com" target="_blank">
              <img src="../../src/img/logo-rjch-baru.png" alt="PT Rajawali Cipta Harapan" width="100px">
            </a>
          </div>
          <div class="col-md-10 justify-content-center mt-4">
            <p class="text-center text-primary fw-bold">Copyright <span class="fw-bolder">&copy;</span> 2021 PT. Rajawali Cipta Harapan</p>
          </div>
        </div>
      </div>
    </section>
    <!-- FOOTER END -->



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>

