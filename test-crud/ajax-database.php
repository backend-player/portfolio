<?php
include '../crud/connection.php';

$sql = "SELECT * FROM barang";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax Database</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .content {
            margin: 40px;
        }

        table {
            padding: 30px;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: lightblue;
        }

        button {
            margin-left: 80px;
        }
    </style>
</head>
<body>
    <div class="content">

        <input type="text" placeholder="Masukkan kata pencarian" id="input-keyword" onkeyup="tampilkanFilterData(this.value)">

        <button type="submit" onclick="tampilkanLimaData()">tampilkan 5 data pertama</button>
    
        <div class="ajax" id="lokasi-data-ajax">
            <table border="1" cellpadding="10" cellspacing="0" id="tabelBarang">
                <thead>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Tanggal Input Barang</th>
                </thead>
                
                <?php $i = 1; while($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row["nama"] ?></td>
                    <td><?php echo $row["jumlah"] ?></td>
        
                    <td>
                    <?php
                    $tanggal = date("d-m-Y", strtotime( $row["tanggal"] ));
        
                    // if($tanggal == "01-01-1970" || $tanggal == "30-11--0001") {
                    //     $tanggal = "NULL";
                    // }
        
                    echo $tanggal;
                    
                    ?>
                    </td>
                    
                </tr>
                <?php $i++; endwhile ?>
        
            </table>
        </div>

    </div>

    <script>
        function tampilkanLimaData(){
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById("lokasi-data-ajax").innerHTML = this.responseText;
            }
            xhttp.open("POST", "ajax-test.php");
            xhttp.send();
        }

        function tampilkanFilterData(keyword){
            if(keyword == ""){
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    document.getElementById("lokasi-data-ajax").innerHTML = this.responseText;
                }
                xhttp.open("POST", "ajax-test-default-table.php");
                xhttp.send();
                return;
            }
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById("lokasi-data-ajax").innerHTML = this.responseText;
            }
            xhttp.open("GET", "ajax-test-filter.php?keyword="+keyword);
            xhttp.send();
            console.log(keyword);
        }
    </script>
    
</body>
</html>