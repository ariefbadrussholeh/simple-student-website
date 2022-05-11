<?php 
    require 'functions.php';

    if (isset($_POST["Daftar"])){
        if(register($_POST) > 0) {
            echo "
            <script>
                alert('user baru berhasil ditambahkan');
            </script>
            ";
        } else {
            echo mysqli_error($db);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universitas Pamekasan | Halaman Registrasi</title>
</head>
<body>
    <h1>Halaman Registrasi</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="Nama">Nama</label>
                <input type="text" name="Nama" id="Nama" autocomplete="off" placeholder="masukkan nama" required>
            </li>
            <li>
                <label for="Username">Username</label>
                <input type="text" name="Username" id="Username" autocomplete="off" placeholder="contoh john_doul" required>
            </li>
            <li>
                <label for="Email">Email</label>
                <input type="text" name="Email" id="Email" autocomplete="off" placeholder="masukkan email" required>
            </li>
            <li>
                <label for="Pass">Password</label>
                <input type="password" name="Pass" id="Pass" autocomplete="off" placeholder="masukkan password" required>
            </li>
            <li>
                <label for="Konfirmasi_password">Konfirmasi Password</label>
                <input type="password" name="Konfirmasi_password" id="Konfirmasi_password" autocomplete="off" placeholder="konfirmasi password" required>
            </li>
            <li>
                <button type="submit" name="Daftar">Daftar</button>
            </li>
        </ul>
    </form>
</body>
</html>