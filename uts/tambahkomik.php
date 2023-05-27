<?php
@include 'config.php';
session_start();

if( !isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


 
 if (isset($_POST["submit"])) {
    // cek apakah data berhasil di tambahkan atau tidak
    if (insertproduct($_POST) > 0) {
        echo "
				<script>
					alert('data berhasil ditambahkan!');
					document.location.href = 'kelola_komik.php';
				</script>
		";
    } else {
        echo "
		<script>
					alert('data gagal ditambahkan!');
					document.location.href = 'kelola_komik.php';
				</script>
		";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style3.css">
    <title>Halaman Admin - Tambah Komik</title>
</head>

<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="admin.php">
                        ADMIN
                    </a>
                </li>
                <li class="d-flex justify-content-center">
                    <img class="w-75 h-75 py-2" src="images/logo.png" alt="">
                </li>
                <li class="active">
                    <a href="kelola_komik.php">Kelola Data Komik</a>
                </li>
                <li>
                    <a href="daftarmember.php">Daftar Member</a>
                </li>
                <li>
                    <a href="daftarcart.php">Daftar Keranjang</a>
                </li>
                <li>
                    <a href="daftarorder.php">Daftar Pembelian</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <div id="header" class="sticky-top">
            <div class="d-flex justify-content-end">
                <a href="logout.php" class="btn btn-sm" style=" background: #f09f9b">Log Out</a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="card col-lg-12 p-3">
                        <h3>Tambah Komik</h3>
                        <hr>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="" class="form-label">Judul</label>
                                <input type="text" class="form-control" placeholder="Masukan Judul" name="judul">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Harga</label>
                                <input type="text" class="form-control" placeholder="Masukan Harga" name="harga">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Stok</label>
                                <input type="text" class="form-control" placeholder="Masukan Stok" name="stok">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Ringkasan</label>
                                <textarea type="text" class="form-control" placeholder="Masukan Ringkasan" name="ringkas"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>