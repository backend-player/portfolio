<?php
include '../connection.php';
session_start();

// jika sudah login, tidak bisa mengakses index.php
if(isset($_SESSION["username"])){
    header("Location: home-admin.php");
    exit;
}

// jika tombol register ditekan
if(isset($_POST["register"])){
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $confirm_password = htmlspecialchars($_POST["confirm_password"]);

    $sql = "SELECT username FROM user WHERE username = '$username' ";
    $result = mysqli_query($conn, $sql);
    
    // cek apakah form sudah diisi semua
    if(empty($username) || empty($password) || empty($confirm_password)){
        $error_register = "Anda belum mengisi semua form";
    } else if(mysqli_num_rows($result) > 0){
        // cek apakah username tersedia
        $error_register = "Username sudah digunakan";
        // cek apakah username valid
    } else if(!preg_match('/^[A-Za-z0-9_-]+$/', $username)){
        $error_register = "Username hanya bisa menggunakan huruf dan angka";
    } else if($password != $confirm_password){
        // cek apakah password dan konfirmasi password sama
        $error_register = "Konfirmasi password salah";
    } else if(strlen($password) < 4){
        // cek apakah password valid
        $error_register = "Password minimal harus berisi 4 karakter";
    } else {
        // tambahkan username ke database, set gambar default
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (gambar, username, password)
        VALUES ('default.png', '$username', '$password')";

        if(mysqli_query($conn, $sql)){
            $success_register = "Registrasi berhasil";
        } else {
            $error_register = "Registrasi gagal";
        };
    }





}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="flex-container">
        <div class="login">
            <form action="register.php" method="POST">
                <h2>Register</h2>
                <ul>
                    <li>
                        <label>
                            Username
                            <input type="text" name="username" value="<?php if(isset($username)){ echo $username; };?>"><br><br>
                        </label>
                    </li>
                    <li>
                        <label>
                            Password
                            <input type="password" name="password"><br><br>
                        </label>
                    </li>
                    <li>
                        <label>
                            Konfirmasi password
                            <input type="password" name="confirm_password"><br><br>
                        </label>
                    </li>

                    <p><?php
                    if (isset($error_register)){
                        echo $error_register;
                    };
                    ?></p>

                    <p style="color: green;"><?php
                    if (isset($success_register)){
                        echo $success_register;
                    };
                    ?></p>

                    <button type="submit" name="register">Register</button>
                    <a href="../index.php">Login</a>
                </ul>
            </form>
        </div>
    </div>

</body>
</html>