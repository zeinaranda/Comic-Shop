<?php
    if (isset($_POST['search'])) {
        require_once 'config.php';
        $i = 1;
        $search = $_POST['search'];

        $query = mysqli_query($conn, "SELECT * FROM produk WHERE judul LIKE '%" . $search . "%'");
        while ($row = mysqli_fetch_object($query)) {
?>
         <tr>
         <td><?= $i++; ?></td>
            <td><?= $row->judul; ?></td>
            <td><?= $row->harga; ?></td>
            <td><?= $row->stok; ?></td>
            <td><div class="overflow-auto" style="max-height: 100px; max-width: 400px; text-align :justify"><?= $row->ringkas; ?></td>
            <td><img src="images/<?= $row->gambar; ?>"height="100"></td>
            <td>
                 <a href="ubahkomik.php?id=<?php echo $row->idproduk; ?>" class="btn btn-primary btn-sm">Ubah</a>
                 <a href="hapuskeranjang.php?id=<?php echo $row->idproduk; ?> " onclick="return confirm('Yakin Ingin Menghapus Data?');" class="btn btn-danger btn-sm">Hapus</a>
            </td>
          </tr>
<?php }
} ?>
