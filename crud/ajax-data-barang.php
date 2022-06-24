<?php
include 'connection.php';

$keyword = $_GET["keyword"];

// echo $keyword;

$sql = "SELECT * FROM barang where nama LIKE '%$keyword%' OR jumlah LIKE '%$keyword%' OR tanggal LIKE '%$keyword%' ";
$result = mysqli_query($conn, $sql);
?>

<table border="1" cellpadding="10" cellspacing="0" id="tabelBarang">
                <thead>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Tanggal Input Barang</th>
                    <th>Aksi</th>
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

                    <td>
                        <a class="button" href="edit-barang.php?id=<?php echo $row["id"] ?>">edit</a>
                        <a class="button" href="hapus-barang.php?id=<?php echo $row["id"] ?>" onclick="return confirm('Anda yakin ingin menghapus data?');">hapus</a>
                    </td>
                    
                </tr>
                <?php $i++; endwhile ?>
        
            </table>