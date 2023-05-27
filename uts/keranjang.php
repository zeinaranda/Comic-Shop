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
$id = $_SESSION["idpembeli"];

if( !isset($_SESSION["loginn"])) {
    header("Location: loginmember.php");
    exit;
}



if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `keranjang` WHERE idkeranjang = '$remove_id'");
   header('location:keranjang.php');
};



?>

<head>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Hey!Comic - My Cart</title>

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

<section class="shopping-cart">

   <h1 class="heading">Shopping Cart</h1>

<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Gambar</th>
      <th scope="col">Judul</th>
      <th scope="col">Harga</th>
      <th scope="col">Quantity</th>
      <th scope="col">Sub Harga</th>
      <th scope="col">Action</th>
    </tr>
  </thead>

  <tbody>
  <?php 
         
         $select_cart = query("SELECT * FROM `keranjang` where idpembeli= '".$_SESSION["idpembeli"]."'");
         $grand_total = 0;
         $i =1;
         foreach ($select_cart as $row) : 
         ?>
    <tr>
       
      <td scope="row"><?=$i; ?></td>
      <td><img src="images/<?php echo $row['gambar']; ?>"style= max-height:100px;></td>

      <td><?php echo $row['judul']; ?></td>

      <td>Rp.<?php echo ($row['harga']); ?></td>

      <td><?php echo $row['quantity']; ?></td>
               
      </td>

      <td>Rp. <?php echo $sub_total = number_format($row['harga'] * $row['quantity']); ?></td>

      <td><a href="keranjang.php?remove=<?php echo $row['idkeranjang']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
      
        </tr>
        <?php $i++; ?>
<?php endforeach; ?>
    <?php
         $grand_total = "SELECT SUM(subharga) FROM keranjang where idpembeli= '".$_SESSION["idpembeli"]."'";
         $result=$conn->query($grand_total); 
         while ($total = mysqli_fetch_array($result)) {
         ?>
      <tr class="table-active" style ="text : bold">
            <td><a href="member.php" class="option-btn" style="margin-top: 0;">Kembali</a></td>
            <td colspan="4">Total Harga</td>
            <td>Rp. <?php echo ($total['SUM(subharga)']); ?>/-</td>
            <td><a href="order.php" class="btn btn-primary" <?= ($grand_total > 1)?'':'disabled'; ?>>Lanjutkan Checkout</a></td>
      </tr>
  </tbody>
</table>
<?php
          }
          ?>


</section>

</div>


 <!-- custom js file link  -->
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="js/script.js"></script>


</body>
</html>