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



if(isset($_POST['submit'])){
  
   $idpembeli = $_SESSION['idpembeli'];
   $pembayaran = $_POST['pembayaran'];
   $tglorder = date('Y-m-d H:i:s');
  
   $cart_query = mysqli_query($conn, "SELECT * FROM `keranjang` WHERE idpembeli = '$idpembeli'");
   $grand_total = "SELECT SUM(subharga) FROM keranjang where idpembeli= '".$_SESSION["idpembeli"]."'";
   $result=$conn->query($grand_total); 
               while ($total = mysqli_fetch_array($result)) {
   if(mysqli_num_rows($cart_query) > 0){
    while($product_item = mysqli_fetch_assoc($cart_query)){
       $product_name[] = $product_item['judul'] .' ('. $product_item['quantity'] .') ';
       $price_total = $total['SUM(subharga)'];
    };
      };
    };
 
    $total_product = implode(', ',$product_name);
   $insert_order = mysqli_query($conn,"INSERT INTO `orderuser`(idpembeli, pembayaran, tglorder, totalproduk, totalharga) VALUES('$idpembeli', '$pembayaran', '$tglorder', '$total_product', '$price_total')") or die('query failed');
   if ($cart_query && $insert_order) {
      echo "
      <script>
      alert('Pembelian berhasil. Pembayaran dilakukan ketika barang telah sampai ke Anda');
      document.location.href = 'myorder.php';
      </script> ";
  }  else {
      echo "
      <script>
      alert('Pembelian gagal. Silahkan coba lagi.');
      document.location.href = 'keranjang.php';
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
   <title>My!Comic - Checkout</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
   

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


<div class="container">
<div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Keranjang</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
          <?php 
         
         $select_cart = query("SELECT * FROM `keranjang` where idpembeli= '".$_SESSION["idpembeli"]."'");
         $i =1;
         foreach ($select_cart as $row) :
         ?>
          <form action="" method="post">
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
                <h6 class="my-0">Produk <?=$i; ?></h6>
                <small class="text-muted"><?php echo $row['judul']; ?></small>
              </div>
              
              <span class="text-muted">Rp.<?php echo $row['subharga']; ?></span>
            </li>
            <?php $i++; ?>
            <?php endforeach; ?>
            <?php
               $grand_total = "SELECT SUM(subharga) FROM keranjang where idpembeli= '".$_SESSION["idpembeli"]."'";
               $result=$conn->query($grand_total); 
               while ($total = mysqli_fetch_array($result)) {
            ?>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total </span>
              <strong>Rp. <?php echo ($total['SUM(subharga)']); ?></strong>
            </li>
          </ul>
         <?php } ?>
        </div>
      <?php
        $order = query("SELECT * FROM pembeli where idpembeli='".$_SESSION["idpembeli"]."'") [0];
        ?>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Konfirmasi Data</h4>
          <p class="mb-3">Untuk perubahan data dapat dilakukan di <a href="profile.php?id=<?=$_SESSION["idpembeli"];?>">Setting Profile</a></p>
            <div class="row">

            <div class="mb-3">
              <p for="nama">Nama : <span class="text-muted"><?php echo $order["nama"]; ?></span></p>
             </div>
             <div class="mb-3">
              <p for="nohp">No. HP : <span class="text-muted"><?php echo $order["nohp"]; ?></span></p>
             </div>
             <div class="mb-3">
              <p for="alamat">Alamat : <span class="text-muted"><?php echo $order["alamat"]; ?></span></p>
              
             </div>
             <div class="mb-3">
              <p for="kodepos">Kode Pos : <span class="text-muted"><?php echo $order["kodepos"]; ?></span></p>
             </div>
             <div class="mb-3">
              <p for="negara">Negara : <span class="text-muted"><?php echo $order["negara"]; ?></span></p>
             </div>
           
           
             
            <h4 class="mb-3">Pembayaran</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit" name="pembayaran" type="radio" value="Cash On Delivery" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">Cash On Delivery</label>
                
              </div>
              <div class="custom-control custom-radio">
                <input id="debit" name="pembayaran" type="radio" value="Credit Card" class="custom-control-input" required>
                <label class="custom-control-label" for="debit">Credit card</label>
       

              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="pembayaran" type="radio" value="Debit Card" class="custom-control-input" required>
                <label class="custom-control-label" for="paypal">Debit Card</label>
     

              </div>
              
            </div>
                         
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Checkout</button>
          </form>
        </div>
      </div>

 <!-- custom js file link  -->
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="js/script.js"></script>

</body>
