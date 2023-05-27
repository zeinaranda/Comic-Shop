<?php 

@include 'config.php';

$id=$_GET["id"];

$delete_query = mysqli_query($conn, "DELETE FROM `produk` WHERE idproduk = $id ") or die('query failed');
   if($delete_query){
    echo "
    <script>
    alert('Data Berhasil dihapus');
    document.location.href = 'kelola_komik.php';
    </script> ";
}  else {
    echo "
    <script>
    alert('Data Gagal dihapus');
    document.location.href = 'kelola_komik.php';
    </script> ";
   };
