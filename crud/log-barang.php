<?php
include 'connection.php';
session_start();

// cek apakah user sudah login
if(!isset($_SESSION["username"])){
  header("Location: index.php");
};

include 'pagination-barang.php';

//   menampilkan data dari log barang
$sql = "SELECT * FROM log_barang";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data User</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>


  <h2>Log Barang</h2>

  <div class="navbar">
    <ul>
      <li><a href="data-barang.php">Data Barang</a></li>
      <li><a href="user/data-user.php">Data User</a></li>
      <li><a class="active" href="log-barang.php">Log Barang</a></li>
      <li style="float: right;"><a href="logout.php">Logout</a></li>
    </ul>
  </div>
  

  <?php $i = 1; while($row = mysqli_fetch_assoc($result)) : ?>
    <p class="teks-log">
      <?php 
      $tanggal = date_create($row["tanggal"]);
      $nama_hari = date_format($tanggal, "l");
      if($row["aksi"] !== 'mengedit') {
        echo $row["user"] . " " . $row["aksi"] . " " . $row["nama_barang"] . " sebanyak " . $row["jumlah"] . " pada " . $nama_hari . ", " . date_format(date_create($row["tanggal"]), "d-m-Y H:i:s" );
      } else {
        echo $row["user"] . " " . $row["aksi"] . " " . $row["nama_barang"] . " sebanyak " . $row["jumlah"] . " menjadi " . $row["nama_barang_baru"] . " sebanyak " . $row["jumlah_baru"] . " pada " . $nama_hari . ", " . date_format(date_create($row["tanggal"]), "d-m-Y H:i:s" );
      };
      ?>
    </p>
  <?php $i++; endwhile ?>


</body>
</html>