<?php 
    session_start();

    if(isset($_SESSION["login"])){
        header("Location: index.php");
    }
    require 'functions.php';

    if(isset($_POST["Login"])) {
        $Username = $_POST["Username"];
        $Pass = $_POST["Pass"];

        $result = mysqli_query($db, "SELECT * FROM admin WHERE Username = '$Username'");
        if(mysqli_num_rows($result) === 1){

            $row = mysqli_fetch_assoc($result);
            $_SESSION["Nama"] = $row["Nama"];

            if(password_verify($Pass, $row["Pass"])){
                // Set session
                $_SESSION["login"] = true;

                header("Location: index.php");
                exit;
            }
        }

        $error = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style-tambah.css">
    <title>Universitas Pamekasan | Halaman Login</title>
</head>
<body>
<!-- Navbar -->
<nav>
    <div class="logo">
        <h2>Database Universitas Pamekasan</h2>
    </div>
    <ul>
        <li><a href="registrasi.php">Daftar</a></li>
    </ul>
</nav>
<!-- Akhir Navbar -->

<!-- Content -->
<div class="container">
    <h1>Halaman Login</h1>

    <?php if(isset($error)) : ?>
        <p style="color:red; font-style:italic;">username/password salah</p>
    <?php endif; ?>

    <form action="" method="post">
        <ul>
            <li>
                <label for="Username">Username</label>
                <input type="text" name="Username" id="Username" required autocomplete="off" placeholder="masukkan username">
            </li>
            <li>
                <label for="Pass">Password</label>
                <input type="password" name="Pass" id="Pass" required autocomplete="off" placeholder="masukkan password">
            </li>
            <li>
                <button type="submit" name="Login">Login</button>
            </li>
        </ul>
    </form>
</div>
<!-- Akhir Content -->

<!-- Footer -->
<footer>
    <div class="mhs">
        <ul>
            <li><h4>Mahasiswa</h4></li>
            <li><a href="">Tambah Mahasiswa</a></li>
            <li><a href="">Ubah Mahasiswa</a></li>
            <li><a href="">Hapus Mahasiswa</a></li>
        </ul>
    </div>
    <div class="akun">
        <ul>
            <li><h4>Akun</h4></li>
            <li><a href="">Profil</a></li>
            <li><a href="">Edit</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="cari">
        <ul>
            <li><h4>Cari Sekarang</h4></li>
            <li><p>Mencari daftar mahasiswa di Universitas Pamekasan</p></li>
            <li>
                <form action="">
                    <input type="text">
                    <button type="submit">Cari</button>
                </form>
            </li>
        </ul>
    </div>
    <div class="foot">
        <div class="line"></div>
        <p>Copyright © 2021 Universitas Pamekasan.</p>
    </div>
</footer>
<!-- Akhir Footer -->
</body>
</html>