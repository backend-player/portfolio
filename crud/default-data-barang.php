<?php
include 'connection.php';

include 'pagination-barang.php';

$sql = "SELECT * FROM barang LIMIT $hasil_pertama_halaman, $hasil_per_halaman";
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

            <!-- menampilkan link halaman -->
                <div class="halaman">

            <?php
            if($halaman > 1) {
            echo '<a href="data-barang.php?halaman='.($halaman-1).'"> Sebelumnya </a>';
            }

            if($halaman < $jumlah_halaman) {
            $berikutnya = '<a href="data-barang.php?halaman='.($halaman+1).'"> Berikutnya </a>';
            }

            for($i = 1; $i <= $jumlah_halaman; $i++){
            if($i == $halaman){
                echo '<a class="active" href="data-barang.php?halaman='.$i.'"> '.$i.' </a>';
            } else {
                echo '<a href="data-barang.php?halaman='.$i.'"> '.$i.' </a>';
            }
            }

            if(isset($berikutnya)){
            echo $berikutnya;
            }
            ?>

            </div>