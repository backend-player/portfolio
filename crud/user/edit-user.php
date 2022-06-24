<?php
include '../connection.php';
session_start();

// // cek apakah user sudah login
if(!isset($_SESSION["username"])){
    header("Location: ../index.php");
  };

$id = $_GET['id'];

$sql = "SELECT * FROM user WHERE id = '$id' ";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
    $gambar_db = $row["gambar"];
    $username_db = $row["username"];
    $password_db = $row["password"];
}

// jika tombol update ditekan
if(isset($_POST["update"])){
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $confirm_password = htmlspecialchars($_POST["confirm_password"]);

    // jika tidak mengupload gambar
    if(!file_exists ($_FILES["gambarUpload"]["tmp_name"]) ) {
        $gambar_upload = $gambar_db;


        // cek apakah form sudah diisi semua
        if(empty($username) || empty($password) || empty($confirm_password)){
            $notifikasi_gagal = "Anda belum mengisi semua form";
        } else if($password != $confirm_password){
            // cek apakah password dan konfirmasi password sama
            $notifikasi_gagal = "Konfirmasi password salah";
        } else if(strlen($password) < 4){
            // cek apakah password valid
            $notifikasi_gagal = "Password minimal harus berisi 4 karakter";
        } else {
            // update username ke database
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET gambar = '$gambar_upload', username = '$username', password = '$password' WHERE id = $_GET[id]";

            if(mysqli_query($conn, $sql)){
                $notifikasi_berhasil = "Update berhasil";
            } else {
                $notifikasi_gagal = "Update gagal";
            };
        }
        // var_dump($nama_gambar_dan_ekstensi);
        // var_dump($path_gambar);
        // echo "<br>";
        // var_dump($gambar_upload);
    }


    // jika mengupload gambar
    if(file_exists ($_FILES["gambarUpload"]["tmp_name"]) ) {
        // upload file
        $folder_tujuan = "../gambar/";
        // folder/file.ekstensi
        $path_gambar = $folder_tujuan . basename($_FILES["gambarUpload"]["name"]);
        $upload_ok = 1;
        $ekstensi_gambar = strtolower(pathinfo($path_gambar, PATHINFO_EXTENSION));

        // mengembalikan nama file dari path $gambar
        $nama_gambar_dan_ekstensi = basename($path_gambar);
        $nama_gambar = pathinfo($path_gambar, PATHINFO_FILENAME);

        // cek apakah file adalah gambar
        $check = @getimagesize($_FILES["gambarUpload"]["tmp_name"]);
        if($check == true) {
            // echo "file adalah gambar";
            $uploadOk = 1;
        } else {
            $update_gambar_gagal = "file bukan gambar";
            $uploadOk = 0;
        }

        // cek ukuran file
        if ($_FILES["gambarUpload"]["size"] > 1000000) {
            $update_gambar_gagal = "file terlalu besar (maksimal 1 Mb)";
            $upload_ok = 0;
        }

        // ekstensi file yang diperbolehkan
        if($ekstensi_gambar != "png" && $ekstensi_gambar != "jpg" && $ekstensi_gambar != "jpeg") {
            $update_gambar_gagal = "Maaf, hanya file PNG, JPG, dan JPEG yang diperbolehkan";
            $upload_ok = 0;
        }


        // cek apakah form sudah diisi semua
        if(empty($username) || empty($password) || empty($confirm_password)){
            $notifikasi_gagal = "Anda belum mengisi semua form";
        } else if($password != $confirm_password){
            // cek apakah password dan konfirmasi password sama
            $notifikasi_gagal = "Konfirmasi password salah";
        } else if(strlen($password) < 4){
            // cek apakah password valid
            $notifikasi_gagal = "Password minimal harus berisi 4 karakter";
        } else if($upload_ok != 1) {
            $update_gambar_gagal2 = "Gambar gagal diupload";
        } else {
            // cek apakah nama gambar sudah ada. jika sudah, tambahkan angka di belakangnya
            // echo file_exists("../gambar/nophoto.png");
            $i = 1;
            while(file_exists("../gambar/".$nama_gambar . "." . $ekstensi_gambar)) {
                $nama_gambar = $nama_gambar."($i)";
                $nama_gambar_dan_ekstensi = $nama_gambar . "." . $ekstensi_gambar;
                $i++;
            }


            // update username ke database
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET gambar = '$nama_gambar_dan_ekstensi', username = '$username', password = '$password' WHERE id = $_GET[id]";

            if(mysqli_query($conn, $sql)){
                $notifikasi_berhasil = "Update berhasil";
            } else {
                $notifikasi_gagal = "Update gagal";
            };

            // upload gambar
            if(move_uploaded_file($_FILES["gambarUpload"]["tmp_name"], $folder_tujuan . $nama_gambar_dan_ekstensi)) {
                // echo "File " . htmlspecialchars($nama_gambar_dan_ekstensi) . " berhasil diupload";
            } else {
                echo "Maaf, terjadi kesalahan saat mengupload file";
            }
        }

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
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    
    <div class="flex-container">
        <div class="edit-data-user">
            <form action="edit-user.php?id=<?php echo $id ?>" method="POST" enctype="multipart/form-data">
                <h2>Edit Data User</h2>
                <ul>
                    <li>
                        <label>
                            Username
                            <input type="text" name="username" value="<?php if(isset($username_db)){ echo $username_db; };?>">
                        </label>
                    </li>

                    <li>
                        <label>
                            Password
                            <input type="password" name="password">
                        </label>
                    </li>

                    <li>
                        <label>
                            Konfirmasi password
                            <input type="password" name="confirm_password">
                        </label>
                    </li>
                    
                    
                    Pilih gambar untuk upload:
                    <input type="file" name="gambarUpload" id="gambarUpload">
                    <img src="../gambar/<?php echo $gambar; ?>">
                    
                    

                    <p class="notifikasi-berhasil">
                        <?php
                        if(isset($notifikasi_berhasil)) {
                            echo $notifikasi_berhasil;
                        };
                        ?>
                    </p>

                    <p class="notifikasi-gagal">
                        <?php
                        if(isset($notifikasi_gagal)) {
                            echo $notifikasi_gagal;
                        };
                        ?>
                    </p>

                    <p class="notifikasi-gagal">
                        <?php
                        if(isset($update_gambar_gagal)) {
                            echo $update_gambar_gagal;
                        };
                        ?>
                    </p>

                    <p class="notifikasi-gagal">
                        <?php
                        if(isset($update_gambar_gagal2)) {
                            echo $update_gambar_gagal2;
                        };
                        ?>
                    </p>

                    <li>
                        <button class="button" type="submit" name="update">Update</button>
                    </li>

                    <li>
                        <a href="data-user.php">Kembali</a>
                    </li>
                    
                </ul>
            </form>
        </div>
    </div>

</body>
</html>