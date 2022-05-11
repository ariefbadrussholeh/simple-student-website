<?php
    // Koneksi Database
    $db = mysqli_connect("localhost", "root", "" , "php-dasar");

    // Query SELECT
    function query($query){
        global $db;
        $result = mysqli_query($db, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }

        return $rows;
    }

    // Query Insert
    function insert($data){
        global $db;
        
        $NRP = htmlspecialchars($data["NRP"]);
        $Nama = htmlspecialchars($data["Nama"]);
        $Email = htmlspecialchars($data["Email"]);
        $Jurusan = htmlspecialchars($data["Jurusan"]);
        $Alamat = htmlspecialchars($data["Alamat"]);
        
        $Foto = upload($NRP);

        //Upload foto
        if(!$Foto){
            return false;
        }
    
        $query = "INSERT INTO mahasiswa VALUES ('$NRP','$Nama','$Email','$Jurusan','$Alamat', '$Foto')";
        mysqli_query($db, $query);

        return mysqli_affected_rows($db);
    }

    function upload($NRP){
        $file_name = $_FILES['Foto']['name'];
        $file_size = $_FILES['Foto']['size'];
        $error = $_FILES['Foto']['error'];
        $tmp_loc = $_FILES['Foto']['tmp_name'];

        // Cek apakah gambar sudah dimasukkan
        if($error === 4){
            echo "
            <script>
                alert('pilih gambar terlebih dahulu');
            </script>
            ";
            return false;
        }

        // Cek ekstensi gambar
        $valid_extension = ["jpeg", "jpg", "png"];
        $exe = explode('.', $file_name);
        $exe = strtolower(end($exe));
        if(!in_array($exe, $valid_extension)){
            echo "
            <script>
                alert('masukkan file bertipe gambar');
            </script>
            ";
            return false;
        }

        // Cek ukuran file
        if($file_size > 1000000){
            echo "
            <script>
                alert('ukuran gambar terlalu besar, pastikan ukuran gambar kurang dari 1mb');
            </script>
            ";
            return false;
        }

        $file_name = $NRP.'.'.$exe;
        move_uploaded_file($tmp_loc, 'img/'.$file_name);

        return $file_name;
    }

    // Query Delete
    function delete($key, $Foto){
        global $db;

        $query = "DELETE FROM mahasiswa WHERE NRP = '$key'";
        mysqli_query($db, $query);

        unlink('img/'.$Foto);

        return mysqli_affected_rows($db);
    }

    // Query Update
    function update($data){
        global $db;

        $NRP = $data["NRP"];
        $Nama = htmlspecialchars($data["Nama"]);
        $Email = htmlspecialchars($data["Email"]);
        $Jurusan = htmlspecialchars($data["Jurusan"]);
        $Alamat = htmlspecialchars($data["Alamat"]);
        $foto_lama = htmlspecialchars($data["foto_lama"]);

        if($_FILES["Foto"]["error"] === 4){
            $Foto = $foto_lama;
        } else {
            unlink('img/'.$foto_lama);
            $Foto = upload($NRP);
        }

        $query = "UPDATE mahasiswa 
                SET Nama = '$Nama', Email = '$Email', Jurusan ='$Jurusan', Alamat = '$Alamat', Foto = '$Foto'
                WHERE NRP = $NRP";

        mysqli_query($db, $query);

        return mysqli_affected_rows($db);
    }

    // QUERY SEARCH
    function search($keyword){

        $query = "SELECT * FROM mahasiswa WHERE Nama LIKE '%$keyword%' OR
                                                Email LIKE '%$keyword%' OR
                                                Jurusan LIKE '%$keyword%' OR
                                                Alamat LIKE '%$keyword%' OR
                                                NRP LIKE '%$keyword%'";

        return query($query);
    }

    // Registrasi
    function register($data){
        global $db;

        $Nama = $data["Nama"];
        $Username = strtolower(stripslashes($data["Username"]));
        $Email = $data["Email"];
        $Pass = mysqli_real_escape_string($db, $data["Pass"]);
        $Konfirmasi_password = mysqli_real_escape_string($db, $data["Konfirmasi_password"]);
        

        // Cek username
        $result = mysqli_query($db, "SELECT Username FROM admin WHERE Username = '$Username'");
        if(mysqli_fetch_assoc($result)){
            echo "
            <script>
                alert('Username sudah terdaftar');
            </script>
            ";
            return false;
        }

        // Konfirmasi passwod
        if($Pass !== $Konfirmasi_password){
            echo "
            <script>
                alert('Konfirmasi password tidak sesuai');
            </script>
            ";
            return false;
        }

        // Enkripsi password
        $Pass = password_hash($Pass, PASSWORD_DEFAULT); 

        // Tambahkan ke database
        $query = "INSERT INTO admin VALUES ('$Nama', '$Username', '$Email', '$Pass')";
        mysqli_query($db, $query);

        return mysqli_affected_rows($db);

    }
?>