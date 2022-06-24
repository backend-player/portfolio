<?php
include '../connection.php';
session_start();

//   menampilkan id dan user dari tabel user
  $sql = "SELECT id, username, password FROM user";
  $result = mysqli_query($conn, $sql);

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
  <h2>Tabel Data User</h2>
  
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <td>Id</td>
      <td>Username</td>
      <td>Password</td>
      <td>Aksi</td>
    </tr>

    <?php
      if(mysqli_num_rows($result) > 0){
        // echo "ada datanya";
        echo "Jumlah data : " . mysqli_num_rows($result);
      } else {
        echo "datanya tidak ada";
      }
      echo "<br>";
    ?>

    <?php while($row = mysqli_fetch_assoc($result)) : ?>
      <?php echo $row["username"]; ?>
      <tr>
      <td>Id</td>
      <td><?php echo $row["username"]; ?></td>
      <td>Password</td>
      <td>Aksi</td>
    </tr>

    <?php endwhile ?>
        <!-- <tr>
          <td>php$data[id]</td>
          <td>$row[username]</td>
          <td>$row[password]</td>
          <td>
            <a href='edit.php?id=$row[id]'>edit</a> |
            <a href='hapus.php?id=$row[id]'>hapus</a>
          </td>
        </tr>; -->


  </table>

</body>
</html>