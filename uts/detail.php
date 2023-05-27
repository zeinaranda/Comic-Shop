<?php
session_start();
@include 'config.php';

$username=$_SESSION['username'];
$query = "SELECT * FROM pembeli WHERE username='$username'";
$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0) {
    $data_pembeli = mysqli_fetch_array($result);
    $_SESSION["idpembeli"] = $data_pembeli["idpembeli"];
    $_SESSION["nama"] = $data_pembeli["nama"];
}


if( !isset($_SESSION["loginn"])) {
    header("Location: loginmember.php");
    exit;
}

$id = $_GET["id"];
$detail = query("SELECT * FROM produk where idproduk=$id")[0];

if(isset($_POST['add_to_cart'])){

    $product_judul = $_POST['product_judul'];
    $product_harga = $_POST['product_harga'];
    $product_gambar = $_POST['product_gambar'];
    $product_quantity = $_POST['product_quantity'];

    

    $select_cart = mysqli_query($conn, "SELECT * FROM `keranjang` WHERE judul = '$product_judul' AND idpembeli = '".$_SESSION["idpembeli"]."'");
    if(mysqli_num_rows($select_cart) > 0){
        echo "
        <script>
        alert('Produk sudah ada di Keranjang');
        document.location.href = 'member.php';
        </script> ";
     }else{
       $insert_product = mysqli_query($conn, "INSERT INTO `keranjang`(judul, harga, gambar, quantity, idpembeli, subharga) VALUES('$product_judul', '$product_harga', '$product_gambar', '$product_quantity', '".$_SESSION["idpembeli"]."', '$product_harga' * '$product_quantity')");
       echo "
        <script>
        alert('Produk Berhasil dimasukkan ke Keranjang');
        document.location.href = 'member.php';
        </script> ";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Hey!Comic - detail</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
   
<?php



?>

<header>

<ul class="nav justify-content-end" style="background-color: #000000;">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="member.php">Hey!Comic</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="logout.php">Log Out</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Hello! <?php echo $_SESSION["nama"]; ?></a>
  </li>
</ul>

    <div class="text-white" style="background-color: #cbcbc6;">
        <div class="container">
        <div class="nav justify-content-center">
            <img src="images/logo.png" class="py-3" style="max-width: 200px; max-height: 200px;" alt="">
</div>  
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000000;">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item mx-2">
                                <a class="nav-link active" aria-current="page" href="member.php">Home</a>
                            </li>
                            <li class="nav-item dropdown mx-2">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    My Profile
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="profile.php?id=2">Setting Profile</a></li>
                                    <li>
                                </ul>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link active" aria-current="page" href="myorder.php">My Order</a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link" href="keranjang.php">Cart</a>
                            </li>
                        </ul>
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>


<body>
<div class="container py-2">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb flex-nowrap">
                            <li class="breadcrumb-item"><a class="text-dark text-decoration-none" href="../index.php">Home</a></li>
                            <li class="breadcrumb-item text-decoration-none text-truncate"><a class="text-dark text-decoration-none" href="#">Produk</a></li>
                            <li class="breadcrumb-item active text-truncate" aria-current="page"><?php echo $detail["judul"]; ?></li>
                        </ol>
                    </nav>
                    <h3 class="py-3"><?php echo $detail["judul"]; ?></h3>
                    <div class="d-flex justify-content-center">
                            <img src="images/<?php echo $detail["gambar"]; ?>" style= max-height:500px;>
                        </div>
                    <br>
                    <p>Harga : <?php echo $detail["harga"]; ?></p>
                    
                    <p style="text-align :justify ">Ringkas : <br> <?php echo $detail["ringkas"]; ?></p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <div class="py-3">
                        <h4>Beli</h4>
                        <hr class="text-subline">
                        <dl>
                          
                                <form action="" method="post">
                                
                                    <input type="hidden" name="product_judul" value="<?php echo $detail['judul']; ?>">
                                    <input type="hidden" name="product_harga" value="<?php echo $detail['harga']; ?>">
                                    <input type="hidden" name="product_gambar" value="<?php echo $detail['gambar']; ?>">
                                    <input type="hidden" name="idpembeli" value="<?=$_SESSION["idpembeli"] ; ?>">
                                    <p>Stok : <?php echo $detail["stok"]; ?></p>
                                    <input type="number" name="product_quantity" placeholder="jumlah pembelian" value="<?php echo $select_cart['quantity']; ?>">
                                    <br><br>
                                    <input type="submit" class="btn btn-danger" value="add to cart" name="add_to_cart"
                                    <?php if($detail["stok"]!=0)
                                    {
                                        echo 'onclick="addtocart('.$detail["stok"].')"';
                                    }
                                    else {
                                        echo 'disabled=disabled';
                                    }?> >
                                     </form>
                           
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: #000000;;">
        © 2022 Copyright:
        <a class="text-white" href="">Hey! Comic</a>
    </div>
    <!-- Copyright -->

 <!-- custom js file link  -->
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="js/script.js"></script>


</body>