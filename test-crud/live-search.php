<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Live Search</title>

    <style>
        input {
            margin: 30px 0px;
        }


    </style>

</head>
<body>

    <input type="text" placeholder="Cari data barang" id="myInput" onkeyup="myFunction()">

    <table border="1" cellpadding="10" cellspacing="0" id="myTable">

        <thead>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
        </thead>
        
        <tr>
            <td>001</td>
            <td>Alpha</td>
            <td>10</td>
        </tr>

        <tr>
            <td>002</td>
            <td>Beta</td>
            <td>9</td>
        </tr>

        <tr>
            <td>003</td>
            <td>Charlie</td>
            <td>8</td>
        </tr>

    </table>


    <script>
        function liveSearch() {
            var keyword, filter, tabel, tr, td, i, nilai_teks;

            keyword = document.getElementById("keywordBarang");
            filter = keyword.value.toUpperCase();
            tabel = document.getElementById("tabelBarang");
            tr = tabel.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    nilai_teks = td.textContent || td.innerText;
                    if (nilai_teks.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    }
                } else {
                    tr[i].style.display = "none";
                }
            }
            // tr[0].style.display = "";
            
            // if(typeof filter == "undefined" || filter == "" || filter == null) {
            //     for (i = 0; i < tr.length; i++) {
            //         tr[i].style.display = "";
            //     }
            // } else {
            //     for (i = 0; i < tr.length; i++) {
            //         tr[i].style.display = "none";
            //     }

            // if(typeof filter == "undefined" || filter == "" || filter == null) {
            //     for (i = 0; i < tr.length; i++) {
            //         tr[i].style.display = "";
            //     }
            // } else {
            //     for (i = 0; i < tr.length; i++) {
            //         td = tr[i].getElementsByTagName("td")[1];
            //         if (td) {
            //             nilai_teks = td.textContent || td.innerText;
            //             if (nilai_teks.toUpperCase().indexOf(filter) > -1) {
            //                 tr[i].style.display = "";
            //             }
            //         } else {
            //             tr[i].style.display = "none";
            //         }
            //     }
            //     tr[0].style.display = "";
            // }

            console.log("filter = " + filter);
            console.log("td");
            console.log(td);
            console.log("nilai_teks = " + nilai_teks);
            // console.log("textContent = " + td.textContent);
            // console.log("innerText = " + td.innerText);
            console.log("tr length = " + tr.length);
            console.log(nilai_teks.toUpperCase().indexOf(filter));
        }


        function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
        }
    </script>
</body>
</html>