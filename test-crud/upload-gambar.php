<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "test_crud");

// cek koneksi ke database
// if($conn) {
//     echo "Koneksi berhasil";
// } else {
//     die("Koneksi gagal: " . mysqli_connect_error());
// }

// upload file
if(isset($_POST["kirim"])) {

    $nama = $_POST["nama"];

    $target_folder = "gambar/";
    $target_file = $target_folder . basename($_FILES["gambarUpload"]["name"]);
    $uploadOk = 1;
    $nama_ekstensi = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $bagian_path = pathinfo($target_file);
    // $nama_gambar = pathinfo($gambar, PATHINFO_FILENAME);
    $nama_gambar = $bagian_path["filename"];
    // $nama_gambar_dan_ekstensi = $nama_gambar . "." . $nama_ekstensi;
    $nama_gambar_dan_ekstensi = basename($target_file);


    $sql = "INSERT INTO user (gambar, nama) VALUES ('$nama_gambar_dan_ekstensi', '$nama')";
    if(mysqli_query($conn, $sql)) {
        move_uploaded_file($_FILES["gambarUpload"]["tmp_name"], $target_file);
        echo "Data berhasil dibuat";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // echo $nama_gambar;
    // echo $nama_ekstensi;
    // echo $nama_lengkap_gambar;
    // echo $ekstensiGambar;
    // echo $gambar;
    // echo basename($gambar);
    // echo $nama_gambar_dan_ekstensi;

    // cek apakah file merupakan gambar asli
    // if(isset($_POST["submit"])) {
        
    // }
}


$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);

// tampilkan jumlah data per baris
// echo "Jumlah data per baris = " . mysqli_num_rows($result);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Gambar</title>
    <style>
        table, td, th {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
    </style>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="nama">Nama</label>
        <input type="text" name="nama">
        <br><br>
        Pilih gambar:
        <br><br>
        <img width = "100px">
        <br>
        <input type="file" name="gambarUpload" id="gambarUpload">
        <br><br>
        <button type="submit" name="kirim" >Kirim</button>
    </form>

    <br><br><br>

    Data User
    <table>
        <tr>
            <th>Id</th>
            <th>Gambar</th>
            <th>Nama</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row["id"] ?></td>
                <td><img src="gambar/<?php echo $row["gambar"]; ?>"</td>
                <td><?php echo $row["nama"] ?></td>
            </tr>

        <?php endwhile ?>
    </table>
</body>

</html>