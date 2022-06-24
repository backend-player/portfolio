<?php
include 'connection.php';
session_start();

// // cek apakah user sudah login
if(!isset($_SESSION["username"])){
    header("Location: ../index.php");
  };

$id = $_GET['id'];

// sebelum hapus barang, tambah log barang (nama barang dan jumlah)
$username = $_SESSION["username"];
$timezone = time() + (60 * 60 * 7);
$tanggal_lengkap = gmdate("Y/m/d H:i:sa", $timezone);

$sql = "INSERT INTO log_barang (user, aksi, nama_barang, jumlah, tanggal) 
          SELECT '$username', 'menghapus', nama, jumlah, '$tanggal_lengkap' FROM barang 
          WHERE id = '$id' ";
$result = mysqli_query($conn, $sql);


// jika log barang berhasil ditambahkan, hapus barang dari database
if($result) {
  echo "<script>
            alert('Data berhasil dihapus'); 
            window.location.href='data-barang.php';
          </script>";
  $sql2 = "DELETE FROM barang WHERE id = '$id' ";
  $result2 = mysqli_query($conn, $sql2);
} else {
  echo "<script>
          alert('Data gagal dihapus'); 
          window.location.href='data-barang.php';
        </script>";
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus</title>
</head>
<body>
    
</body>
</html>