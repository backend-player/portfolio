<?php
include 'connection.php';
session_start();

// // cek apakah user sudah login
if(!isset($_SESSION["username"])){
    header("Location: ../index.php");
  };

$id = $_GET['id'];

$sql = "SELECT nama, jumlah FROM barang WHERE id = '$id' ";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
    $nama_barang = $row["nama"];
    $jumlah_barang = $row["jumlah"];
}

// jika tombol update ditekan
if(isset($_POST["update"])){
    $update_nama_barang = htmlspecialchars($_POST["nama-barang"]);
    $update_jumlah_barang = htmlspecialchars($_POST["jumlah-barang"]);
    
    // cek apakah form sudah diisi semua
    if(empty($update_nama_barang) || empty($update_jumlah_barang)){
        $notifikasi_gagal = "Anda belum mengisi semua form";
    } else if(!is_numeric($update_jumlah_barang)) {
        $notifikasi_gagal = "Jumlah harus berupa angka";
    } else {
        // update data barang ke database
        $sql = "UPDATE barang SET nama = '$update_nama_barang', jumlah = '$update_jumlah_barang' WHERE id = $_GET[id]";

        if(mysqli_query($conn, $sql)){
            $notifikasi_berhasil = "Update berhasil";
        } else {
            $notifikasi_gagal = "Update gagal";
        };

        // tambah log barang
        $username = $_SESSION["username"];
        $timezone = time() + (60 * 60 * 7);
        
        $tanggal_lengkap = gmdate("Y/m/d H:i:sa", $timezone);
        $sql2 = "INSERT INTO log_barang (user, aksi, nama_barang, jumlah, tanggal, nama_barang_baru, jumlah_baru) 
                    VALUES ('$username', 'mengedit', '$nama_barang', '$jumlah_barang', '$tanggal_lengkap', 
                    '$update_nama_barang', '$update_jumlah_barang')";

        if(mysqli_query($conn, $sql2)){
            $success_log = "Log barang berhasil dibuat";
        } else {
            $error_log = "Log barang gagal dibuat";
        };

        $nama_barang = $update_nama_barang;
        $jumlah_barang = $update_jumlah_barang;
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="flex-container">
        <div class="edit-data-barang">
            <form action="edit-barang.php?id=<?php echo $id ?>" method="POST">
                <h2>Edit Data Barang</h2>
                <ul>
                    <li>
                        <label>
                            Nama barang
                            <input type="text" name="nama-barang" value="<?php if(isset($nama_barang)){ echo $nama_barang; };?>">
                        </label>
                    </li>

                    <li>
                        <label>
                            Jumlah barang
                            <input type="text" name="jumlah-barang" value="<?php if(isset($jumlah_barang)){ echo $jumlah_barang; };?>">
                        </label>
                    </li>

                    <p class="notifikasi-berhasil"><?php
                    if (isset($notifikasi_berhasil)){
                        echo $notifikasi_berhasil;
                    };
                    ?></p>

                    <p class="notifikasi-gagal"><?php
                    if (isset($notifikasi_gagal)){
                        echo $notifikasi_gagal;
                    };
                    ?></p>

                    <li>
                        <button class="button" type="submit" name="update">Update</button>
                    </li>

                    <li>
                        <a href="data-barang.php">Kembali</a>
                    </li>
                </ul>
            </form>
        </div>
    </div>

</body>
</html>