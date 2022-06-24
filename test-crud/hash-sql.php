<?php
include '../connection.php';

// select admin5 dari tabel user
$sql = "SELECT username, password from user WHERE username = 'admin5' ";
$result = mysqli_query($conn, $sql);

$password = 1234;

$hashed_password_test = password_hash($password, PASSWORD_DEFAULT);

// jika usernya ada
if(mysqli_num_rows($result) > 0){
    echo "user berhasil dipilih";
} else {
    echo "user gagal dipilih";
}

echo "<br>";
echo "<br>";

// tampilkan data yang dipilih
while($row = mysqli_fetch_assoc($result)){
    echo "Username : " . $row["username"];
    echo "<br>";
    echo "Password : " . $password;
    echo "<br>";
    echo "Hashed password : " . $row["password"];
    echo "<br>";
    $password2 = $row["password"];
}


//   jika $password = $hashed_password
if(password_verify($password, $row["password"])){
    echo "password benar";
} else {
    echo "password salah";
}

//   jika $password = $hashed_password_test
if(password_verify($password, $hashed_password_test)){
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