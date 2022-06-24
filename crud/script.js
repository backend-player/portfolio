function liveSearch(keyword) {
    if(keyword == ""){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("ajax-data-barang").innerHTML = this.responseText;
        }
        // jika keyword kosong, gunakan default-data-barang.php untuk mengembalikan data default pada tabel data barang
        xhttp.open("POST", "default-data-barang.php");
        xhttp.send();
        return;
    }

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("ajax-data-barang").innerHTML = this.responseText;
    }
    xhttp.open("GET", "ajax-data-barang.php?keyword="+keyword);
    xhttp.send();
    // console.log(keyword);
    
}