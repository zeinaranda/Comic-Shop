<?php
    if (isset($_POST['search'])) {
        require_once 'config.php';
        $i = 1;
        $search = $_POST['search'];

        $query = mysqli_query($conn, "SELECT * FROM produk WHERE judul LIKE '%" . $search . "%'");
        while ($row = mysqli_fetch_object($query)) {
?>

            <div class="card " style="width: 17rem; ">
<img src="images/<?= $row->gambar; ?>"style= "max-width: 300px; height:400px;" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><a href="#"><?= $row->judul; ?></a></h5>
    <div class="overflow-auto" style="max-height: 100px; text-align :justify "><?= $row->ringkas; ?> 
   </div>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Price : Rp. <?= $row->harga; ?></li>
    <li class="list-group-item">Stock : <?= $row->stok; ?></li>
    <div class="card-body">
    <input type="hidden" name="idpembeli" value="<?=$_SESSION["idpembeli"] ; ?>">
    <a href="detail.php?id=<?=$row->idproduk; ?>">Lihat Detail</a>
  </div>
  </div>

        
<?php }
} ?>
