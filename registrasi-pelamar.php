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
    <title>Registrasi Pelamar</title>
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
                        <h1 class="h4 text-gray-900 mb-4">Daftar Sebagai Pelamar!</h1>
                    </div>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
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
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" id="" class="form-control">
                                <option value="pria">Laki-Laki</option>
                                <option value="wanita">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea type="text" class="form-control" placeholder="" name="alamat"></textarea>
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
        <!--  end body -->

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

// jika tombol daftar sudah di klik
if (isset($_POST["daftar"])) {

    // tangkap semua isi form
    $nama = htmlspecialchars($_POST["nama"]);
    $email = htmlspecialchars($_POST["email"]);
    $telp = htmlspecialchars($_POST["telp"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $alamat = htmlspecialchars($_POST["alamat"]);
    $password1 = htmlspecialchars($_POST["password1"]);
    $password2 = htmlspecialchars($_POST["password2"]);

    // validasi form
    if (validasiNama($nama) == true) {
        if (validasiTelp($telp) == true) {
            if (validasiAlamat($alamat) == true) {
                if (validasiPassword($password1) == true) {
                    if (validasiPassword($password2) == true) {
                        // cek apakah email sudah terdaftar
                        $cekEmail = mysqli_query($db, "SELECT * FROM pelamar WHERE email = '$email'");
                        if (mysqli_num_rows($cekEmail) == 1) {
                            // jika email sudah terdaftar
                            echo "
                                <script>
                                    Swal.fire(
                                        'PENDAFTARAN GAGAL',
                                        'Email Sudah Terdaftar',
                                        'error'
                                    );
                                </script>
                            ";
                        } else {
                            // jika email belum terdaftar
                            if ($password1 != $password2) {
                                // jika password tidak sama
                                echo "
                                    <script>
                                        Swal.fire(
                                            'PENDAFTARAN GAGAL',
                                            'Password Tidak Sama',
                                            'error'
                                        );
                                    </script>
                                ";
                            } else {
                                // jika password sama
                                // pendaftaran berhasil

                                $password = password_hash($password1, PASSWORD_DEFAULT);
                                mysqli_query($db, "INSERT INTO pelamar 
                                VALUES 
                                ('','$nama','$email','$telp','$gender','$alamat','default.jpg','','$password')");

                                echo "
                                    <script>
                                        Swal.fire('PENDAFTARAN BERHASIL','Silahkan Login Terlebih Dahulu','success').then(function() {
                                            window.location = 'login.php';
                                        });
                                    </script>
                                ";
                            }
                        }
                    }
                }
            }
        }
    }
}

?>