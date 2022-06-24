<?php
include '../connection.php';

$username = "admin";
$password = "1234";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

//   jika $password = $hashed_password
if(password_verify($password, $hashed_password)){
    echo "password benar";
} else {
    echo "password salah";
}

echo "<br>";
echo "<br>";
var_dump($username);
echo "<br>";
echo "<br>";
var_dump($password);
echo "<br>";
echo "<br>";
var_dump($hashed_password);
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