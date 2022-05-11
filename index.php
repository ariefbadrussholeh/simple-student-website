<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
}

require 'functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa");

if(isset($_POST["search"])){
    $mahasiswa = search($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
    <link rel="stylesheet" href="style/style.css" <?= time() ?>>
    <link rel="stylesheet" href="style/style-index.css" <?= time() ?>>

    <title>Universitas Pamekasan | Halaman Admin</title>
</head>
<body>
<!-- Navbar -->
<nav>
    <div class="logo">
        <h2>Database Universitas Pamekasan</h2>
    </div>
    <ul  style="justify-content: space-around;">
        <li>Halo, <?= $_SESSION["Nama"]; ?></li>
        <li>|</li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
<!-- Akhir Navbar -->

<!-- Content -->
<div class="container">

    <h1>Daftar Mahasiswa</h1>

    <header>
        <a href="tambah.php">+ Tambah Mahasiswa</a>
        <form action="" method="post">
            <input type="text" name="keyword" autofocus size="30" placeholder="masukkan keyword pencarian ..." autocomplete="off">
            <button type="submit" name="search">Cari</button>
        </form>
    </header>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr class="head">
            <th>No. </th>
            <th>Gambar</th>
            <th>NRP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
            <th>Alamat</th>
            <th id="aksi"></th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($mahasiswa as $row) : ?>
        <tr>
            <td class="center"><?= $i; ?></td>
            <td class="center"><img src="img/<?php echo $row["Foto"]?>" alt="" width="50px"></td>
            <td class="center"><?php echo $row["NRP"]?></td>
            <td><?php echo $row["Nama"]?></td>
            <td><?php echo $row["Email"]?></td>
            <td><?php echo $row["Jurusan"]?></td>
            <td><?php echo $row["Alamat"]?></td>
            <td class="center">
                <a href="ubah.php?NRP=<?php echo $row["NRP"]?>" >✏️</a> | 
                <a href="hapus.php?NRP=<?php echo $row["NRP"]?>&Foto=<?= $row["Foto"] ?>" onclick="return confirm('yakin?');">❌</a>
            </td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
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