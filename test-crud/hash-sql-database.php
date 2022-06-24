<?php
include '../connection.php';

// select admin5 dari tabel user
$sql = "SELECT username, password from user";
$result = mysqli_query($conn, $sql);
$username = "admin4";
$password = 1234;

// ambil username dan password dari tabel user
$sql = "SELECT username, password from user WHERE username = '$username' ";
$result = mysqli_query($conn, $sql);

// jika usernya ada
if(mysqli_num_rows($result) > 0){
    echo "user berhasil dipilih";
    echo "<br>";
    echo "total = " . mysqli_num_rows($result);
} else {
    echo "user gagal dipilih";
}

echo "<br>";
echo "<br>";

// tampilkan data yang dipilih, ambil password dari tabel user
while($row = mysqli_fetch_assoc($result)){
    $hashed_password = $row["password"];

    echo "Username : " . $row["username"];
    echo "<br>";
    echo "Password : " . $password;
    echo "<br>";
    echo "Hashed password : " . $hashed_password;
    echo "<br>";
}


//   jika $password = $hashed_password
if(password_verify($password, $hashed_password)){
    echo "password benar";
} else {
    echo "password salah";
}


// echo "<br>";
// echo "<br>";
// var_dump($username);
// echo "<br>";
// echo "<br>";
// var_dump($password);
// echo "<br>";
// echo "<br>";
// var_dump($password2);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Hash</title>
</head>
<body>
    
</body>
</html>