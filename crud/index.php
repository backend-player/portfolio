<?php
include 'connection.php';
session_start();

// jika sudah login, tidak bisa mengakses index.php
if(isset($_SESSION["username"])){
    header("Location: data-barang.php");
    exit;
}

// jika tombol login ditekan
if(isset($_POST["login"])){
    //   konversi karakter khusus menjadi entitas HTML
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    
    // // ambil password dari tabel user
    $sql = "SELECT username, password FROM user WHERE username = '$username' ";
    $result = mysqli_query($conn, $sql);
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $hashed_password = $row["password"];
        }
    }


    if(empty($username)){
        $error_login = "Username belum diisi";
        } else if(empty($password)){
            $error_login = "Password belum diisi";
            // jika password yang dimasukkan = password dari tabel user, login
            // jika hashed_password = null, tidak usah tampilkan warning
        } else if(password_verify($password, @$hashed_password)){
            $_SESSION["username"] = $username;
            header("Location:data-barang.php");
        } else {
            $error_login = "Username / password salah";
    }

}

// var_dump("USERNAME = " . $username);
// var_dump($_SESSION["username"]);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="flex-container">
    <div class="login">
            <form action="index.php" method="POST">
                <h2>Login</h2>

                <ul>
                    <li>
                        <label for="username">Username </label>
                        <input type="text" name="username" id="username">
                    </li>

                    <li>
                        <label for="password">Password </label>
                        <input type="password" name="password" id="password" required>
                    </li>
                    
                    <p><?php
                    if (isset($error_login)){
                        echo $error_login;
                    };
                    ?></p>

                    <button type="submit" name="login">Login</button>
                    <a href="user/register.php">Register</a>
                </ul>

            </form>
    </div>
</div>
    
</body>
</html>


