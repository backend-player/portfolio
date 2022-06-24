<?php
include 'connection.php';
session_start();

// cek apakah user sudah login
if(!isset($_SESSION["username"])){
    header("Location: index.php");
};

// jika tombol tambah ditekan
if(isset($_POST["tambah"])){
    $tambah_nama_barang = htmlspecialchars($_POST["nama-barang"]);
    $tambah_jumlah_barang = htmlspecialchars($_POST["jumlah-barang"]);
    
    // cek apakah form sudah diisi semua
    if(empty($tambah_nama_barang) || empty($tambah_jumlah_barang)){
        $error_input = "Anda belum mengisi semua form";
    } else if(!ctype_digit($tambah_jumlah_barang)) {
        $error_input = "Jumlah harus berupa bilangan bulat";
    } else {
        // tambah data barang ke database
        $tanggal = date("Y/m/d");
        $sql = "INSERT INTO barang (nama, jumlah, tanggal) VALUES ('$tambah_nama_barang', '$tambah_jumlah_barang', '$tanggal')";
        
        if(mysqli_query($conn, $sql)){
            $success_input = "Input barang berhasil";
        } else {
            $error_input = "Input barang gagal";
        };

        // tambah log barang
        $username = $_SESSION["username"];
        $timezone = time() + (60 * 60 * 7);
        
        $tanggal_lengkap = gmdate("Y/m/d H:i:sa", $timezone);
        $sql2 = "INSERT INTO log_barang (user, aksi, nama_barang, jumlah, tanggal) 
                 VALUES ('$username', 'menambahkan', '$tambah_nama_barang', '$tambah_jumlah_barang', '$tanggal_lengkap')";

        if(mysqli_query($conn, $sql2)){
            $success_log = "Log barang berhasil dibuat";
        } else {
            $error_log = "Log barang gagal dibuat";
        };

    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="flex-container">
        <div class="login">
            <form action="tambah-barang.php" method="POST">
                <h2>Tambah Barang</h2>
                <ul>
                    <li>
                        <label>
                            Nama barang
                            <input type="text" name="nama-barang" autofocus value="<?php if(isset($tambah_nama_barang)){ echo $tambah_nama_barang; };?>">
                        </label>
                    </li>

                    <li>
                        <label>
                            Jumlah barang
                            <input type="text" name="jumlah-barang" value="<?php if(isset($tambah_jumlah_barang)){ echo $tambah_jumlah_barang; };?>">
                        </label>
                    </li>

                    <p><?php
                    if (isset($error_input)){
                        echo $error_input;
                    };
                    ?></p>

                    <p style="color: green;"><?php
                    if (isset($success_input)){
                        echo $success_input;
                    };
                    ?></p>


                    <p><?php
                    if (isset($error_log)){
                        echo $error_log;
                    };
                    ?></p>

                    <p style="color: green;"><?php
                    if (isset($success_log)){
                        echo $success_log;
                    };
                    ?></p>

                    

                    <button type="submit" name="tambah">Tambah</button>
                    
                    <a href="data-barang.php">Kembali</a>
                </ul>
            </form>
        </div>
    </div>

</body>
</html>