<?php
include '../connection.php';
session_start();

// // cek apakah user sudah login
if(!isset($_SESSION["username"])){
    header("Location: ../index.php");
  };

$id = $_GET['id'];

$sql = "DELETE FROM user WHERE id = '$id' ";
$result = mysqli_query($conn, $sql);

if($result){
    echo "<script>
            alert('Data berhasil dihapus'); 
            window.location.href='data-user.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus'); 
            window.location.href='data-user.php';
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