<?php 

@include 'config.php';

$id=$_GET["id"];

$delete_query = mysqli_query($conn, "DELETE FROM `orderuser` WHERE idorder = $id ") or die('query failed');
   if($delete_query){
    echo "
    <script>
    alert('Data Berhasil dihapus');
    document.location.href = 'daftarorder.php';
    </script> ";
}  else {
    echo "
    <script>
    alert('Data Gagal dihapus');
    document.location.href = 'daftarorder.php';
    </script> ";
   };
