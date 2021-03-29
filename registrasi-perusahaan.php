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
    <title>Registrasi Perusahaan</title>
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
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Daftar Sebagai Perusahaan!</h1>
                    </div>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="nama">Nama Perusahaan</label>
                            <input type="text" class="form-control" placeholder="" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="" name="email">
                        </div>
                        <div class="form-group">
                            <label for="telp">No. Telpon</label>
                            <input type="text" class="form-control" placeholder="" name="telp">
                        </div>
                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <input type="text" class="form-control" placeholder="" name="kota">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea type="text" class="form-control" placeholder="" name="alamat"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Perusahaan</label>
                            <textarea type="text" class="form-control" placeholder="" name="deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" placeholder="" name="password1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">Ulangi Password</label>
                            <input type="password" class="form-control" placeholder="" name="password2">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary" name="daftar">Registrasi</button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="login.php">Sudah Punya Akun? Login!</a>
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


if (isset($_POST["daftar"])) {
    // tangkap semua form
    $nama = htmlspecialchars($_POST["nama"]);
    $email = htmlspecialchars($_POST["email"]);
    $telp = htmlspecialchars($_POST["telp"]);
    $alamat = htmlspecialchars($_POST["alamat"]);
    $kota = htmlspecialchars($_POST["kota"]);
    $deskripsi = htmlspecialchars($_POST["deskripsi"]);
    $password1 = htmlspecialchars($_POST["password1"]);
    $password2 = htmlspecialchars($_POST["password2"]);

    // validasi
    if (validasiNama($nama) == true) {
        if (validasiTelp($telp) == true) {
            if (validasiAlamat($alamat) == true) {
                if (validasiDeskripsi($deskripsi) == true) {
                    if (validasiPassword($password1) == true) {
                        if (validasiPassword($password2) == true) {

                            // cek password
                            if ($password1 != $password2) {
                                echo "
                                        <script>
                                            Swal.fire('PENDAFTARAN GAGAL','Password Yang Anda Masukkan Tidak Sama','error');
                                        </script>
                                    ";
                            } else {
                                $password = password_hash($password1, PASSWORD_DEFAULT);
                                mysqli_query($db, "INSERT INTO perusahaan VALUES ('','$nama','$email','$telp','$kota','$alamat','$deskripsi','default.jpg','$password')");
                                echo mysqli_affected_rows($db);
                                if (mysqli_affected_rows($db) > 0) {
                                    echo "
                                            <script>
                                                Swal.fire('PENDAFTARAN BERHASIL','Silahkan Login Terlebih Dahulu','success').then(function() {
                                                    window.location = 'login.php';
                                                });
                                            </script>
                                        ";
                                } else {
                                    echo mysqli_error($db);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

?>