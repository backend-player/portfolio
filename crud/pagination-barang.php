<?php
// Pagination

// hasil per halaman
$hasil_per_halaman = 5;

// cari jumlah data di database
$sql = "SELECT * FROM barang";
$result = mysqli_query($conn, $sql);
$jumlah_data = mysqli_num_rows($result);

// jumlah halaman tersedia
$jumlah_halaman = ceil($jumlah_data / $hasil_per_halaman);

// ambil nomor halaman saat ini
if(!isset($_GET["halaman"])){
  $halaman = 1;
} else {
  $halaman = $_GET["halaman"];
}

// data pertama pada database
$hasil_pertama_halaman = ($halaman-1) * $hasil_per_halaman;

?>