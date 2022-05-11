<?php 
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
    }

    require 'functions.php';

    $NRP = $_GET["NRP"];
    $mhs = query("SELECT * FROM mahasiswa WHERE NRP = $NRP")[0];

    if(isset($_POST["submit"])){
        
        if(update($_POST) > 0) {
            echo "
            <script>
                alert('data berhasil diupdate');
                document.location.href='index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('data gagal diupdate');
                // document.location.href='index.php';
            </script>
            ";
        }
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
    <title>Universitas Isol | Update Data Mahasiswa</title>
</head>
<body>
<!-- Navbar -->
<nav>
    <div class="logo">
        <h2>Database Universitas Pamekasan</h2>
    </div>
    <ul>
        <li>Halo, <?= $_SESSION["Nama"]; ?></li>
        <li>|</li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
<!-- Akhir Navbar -->

<!-- Content -->
<div class="container">
    <h1>Update Data Mahasiswa</h1>
    <a href="index.php">kembali ke halaman admin</a>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <input type="hidden" name="NRP" value="<?= $mhs["NRP"]; ?>">
            <input type="hidden" name="foto_lama" value="<?= $mhs["Foto"]; ?>">
            <li>
                <label for="NRP">NRP: </label>
                <input type="text" name="NRP" id="NRP" disabled value="<?= $mhs["NRP"]; ?>">
            </li>
            <li>
                <label for="Nama">Nama: </label>
                <input type="text" name="Nama" id="Nama" required value="<?= $mhs["Nama"]; ?>" autocomplete="off">
            </li>
            <li>
                <label for="Email">Email: </label>
                <input type="text" name="Email" id="Email" required value="<?= $mhs["Email"]; ?>" autocomplete="off">
            </li>
            <li>
                <label for="Jurusan">Jurusan: </label>
                <input type="text" name="Jurusan" id="Jurusan" required value="<?= $mhs["Jurusan"]; ?>" autocomplete="off">
            </li>
            <li>
                <label for="Alamat">Alamat: </label>
                <input type="text" name="Alamat" id="Alamat" required value="<?= $mhs["Alamat"]; ?>" autocomplete="off">
            </li>
            <li>
                <label for="Foto">Foto</label> <br>
                <img src="img/<?= $mhs["Foto"]; ?>" width="50px" alt="" style="display:block; margin:auto">
                <input type="file" name="Foto" id="Foto">
            </li>
            <li>
                <button type="submit" name="submit">Update Data</button>
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