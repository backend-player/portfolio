<?php
include 'connection.php';
session_start();

// cek apakah user sudah login
if(!isset($_SESSION["username"])){
  header("Location: index.php");
};

include 'pagination-barang.php';

//   menampilkan id dan user dari tabel user
$sql = "SELECT id, nama, jumlah, tanggal FROM barang LIMIT $hasil_pertama_halaman, $hasil_per_halaman";
$result = mysqli_query($conn, $sql);


// Jika tombol cari ditekan
// if(isset($_POST["cari-btn"])) {
//   $cari = $_POST["cari"];

//   $sql = "SELECT * FROM barang WHERE nama LIKE '%$cari%' LIMIT $hasil_pertama_halaman, $hasil_per_halaman";
//   $result = mysqli_query($conn, $sql);
  
//   // perbarui pagination
//   $jumlah_data = mysqli_num_rows($result);

//   // jumlah halaman tersedia
//   $jumlah_halaman = ceil($jumlah_data / $hasil_per_halaman);

//   // ambil nomor halaman saat ini
//   if(!isset($_GET["halaman"])){
//     $halaman = 1;
//   } else {
//     $halaman = $_GET["halaman"];
//   }

//   // data pertama pada database
//   $hasil_pertama_halaman = ($halaman-1) * $hasil_per_halaman;


//   // Jika form cari belum diisi
//   if(empty($cari)){
//     $error_pencarian = "anda belum mengisi pencarian";
//   } else if(mysqli_num_rows($result) == 0) {
//     // Cek apakah ada data yang sesuai dengan kata pencarian
//     $error_pencarian = "data tidak ditemukan";
//   }
// }
  
  
//   tampilkan data jika ada
// if(mysqli_num_rows($result) > 0){
//   // echo "ada datanya";
//   while($row = mysqli_fetch_assoc($result)){
//       // echo "id: " . $row["id"] . " username: " . $row["username"] . " password: " . $row["password"]  . "<br>";
//   }
// } else {
//   echo "datanya tidak ada";
// }

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


  <h2>Tabel Data Barang</h2>

  <div class="navbar">
    <ul>
      <li><a class="active"  href="data-barang.php">Data Barang</a></li>
      <li><a href="user/data-user.php">Data User</a></li>
      <li><a href="log-barang.php">Log Barang</a></li>
      <li style="float: right;"><a href="logout.php">Logout</a></li>
    </ul>
  </div>
  
  <div class="tabel-data-user">

    <a class="tambah-data-barang" href="tambah-barang.php">Tambah Barang</a>

    <form action="data-barang.php" method="POST">
      <label>
        <input class="cari-user" type="text" id="keywordBarang" onkeyup="liveSearch(this.value)" name="cari" placeholder="Cari data barang">
        <!-- <button class="button-cari" type="submit" name="cari-btn">Cari</button> -->
      </label>
    </form>

    <div id = "ajax-data-barang">
      <table border="1" cellpadding="10" cellspacing="0" id="tabelBarang">
        <thead>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Jumlah Barang</th>
          <th>Tanggal Input Barang</th>
          <th>Aksi</th>
        </thead>
      
        <?php $i = 1; while($row = mysqli_fetch_assoc($result)) : ?>
          <?php
            $nama = $row["nama"];
            $jumlah = $row["jumlah"]
          ?>
          
          <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $nama ?></td>
            <td><?php echo $jumlah ?></td>
    
            <td>
              <?php
              $tanggal = date("d-m-Y", strtotime( $row["tanggal"] ));
    
              if($tanggal == "01-01-1970" || $tanggal == "30-11--0001") {
                $tanggal = "NULL";
              }
    
              echo $tanggal;
              
              ?>
            </td>
            
            <td>
              <a class="button" href="edit-barang.php?id=<?php echo $row["id"] ?>">edit</a>
              <a class="button" href="hapus-barang.php?id=<?php echo $row["id"] ?>" onclick="return confirm('Anda yakin ingin menghapus data?');">hapus</a>
            </td>
          </tr>
        <?php $i++; endwhile ?>
  
      </table>

      <!-- menampilkan link halaman -->
      <div class="halaman">

      <?php
      if($halaman > 1) {
        echo '<a href="data-barang.php?halaman='.($halaman-1).'"> Sebelumnya </a>';
      }

      if($halaman < $jumlah_halaman) {
        $berikutnya = '<a href="data-barang.php?halaman='.($halaman+1).'"> Berikutnya </a>';
      }

      for($i = 1; $i <= $jumlah_halaman; $i++){
        if($i == $halaman){
          echo '<a class="active" href="data-barang.php?halaman='.$i.'"> '.$i.' </a>';
        } else {
          echo '<a href="data-barang.php?halaman='.$i.'"> '.$i.' </a>';
        }
      }

      if(isset($berikutnya)){
        echo $berikutnya;
      }
      ?>

      </div>

    </div>

  </div>

  

  <script src="script.js"></script>
</body>
</html>