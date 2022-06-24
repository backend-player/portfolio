<?php
include 'connection.php';
session_start();

// cek apakah user sudah login
if(!isset($_SESSION["username"])){
    header("Location: index.php");
};

// echo "<br>";
// echo "<br>";
// var_dump($_SESSION["username"]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2><?php echo "Selamat datang " . $_SESSION['username']; ?></h2>

    <div class="navbar">
        <ul>
            <li><a class="active" href="user/home-admin.php">Home</a></li>
            <li><a href="user/data-user.php">Data User</a></li>
            <li><a href="data-barang.php">Data Barang</a></li>
            <li style="float: right;"><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    
</body>
</html>


