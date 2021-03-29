<?php

// panggil koneksi db
require "db.php";
// panggil file functions.php
require "functions.php";
// aktifkan session
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <?php require "headtags.php" ?>
</head>

<body>

    <!-- navbar -->
    <?php require "navbar.php" ?>

    <!-- body -->
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 bg-warning">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-white mt-5">Daftar Sebagai Pelamar</h1>
                            </div>
                            <a href="registrasi-pelamar.php" class="btn btn-light btn-user btn-block mt-3 mb-5">
                                Registrasi Pelamar
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 bg-primary">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-white mt-5">Daftar Sebagai Perusahaan</h1>
                            </div>
                            <a href="registrasi-perusahaan.php" class="btn btn-light btn-user btn-block mt-3">
                                Registrasi Perusahaan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end body -->


    <!-- footer -->
    <?php
    include 'footer.php';
    ?>
    <!-- end footer -->

</body>

</html>


<?php

// cek apakah sudah login atau belum
cekSudahLogin();

?>