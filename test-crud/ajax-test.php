<?php
include '../crud/connection.php';

$sql = "SELECT * FROM barang LIMIT 0, 5";
$result = mysqli_query($conn, $sql);
?>

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