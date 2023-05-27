<?php

@include 'config.php';
 
$select_rows = mysqli_query($conn, "SELECT * FROM keranjang") or die('query failed');
$row_count = mysqli_num_rows($select_rows);

$komik = array_reverse(query("SELECT * FROM produk"));

if(isset($_POST['add_to_cart'])){

   $judul = $_POST['judul'];
   $harga = $_POST['harga'];
   $gambar = $_POST['gambar'];
   $stok = $_POST['stok'];
   $ringkas = $_POST['ringkas'];
   $quantitas = $_POST['quantitas'];

   $select_cart = mysqli_query($conn, "SELECT * FROM keranjang WHERE name = '$judul'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO keranjang (nama, harga, gambar, quantitas) VALUES('$judul', '$harga', '$gambar', '$quantitas')");
      $message[] = 'product added to cart succesfully';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Hey!Comic</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
   

<header>

<ul class="nav justify-content-end" style="background-color: #000000;">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="index.php">Hey!Comic</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="login.php">Admin</a>
  </li>
 <li class="nav-item dropdown mx-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Member</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="loginmember.php">Log In </a></li>
                <li><a class="dropdown-item" href="signup.php">Sign Up</a></li>
            </ul>
</li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Welcome</a>
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
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item dropdown mx-2">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Profil
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="profile.php">Setting Profile</a></li>
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
                            <input class="form-control me-2" id="search" type="search" placeholder="Search Judul" aria-label="Search">
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>



<div class="container" >
<div class="py-3">
        <h4>All Update</h4>
        <hr class="text-subline">
    </div>
    <div class="row py-1" id="tampil" >
    <?php $i = 0 ?>
           <?php foreach ($komik as $row) :?>
            <div class="col-md-3 py-3">
            <div class="card" style="width: 16rem;">
  <img src="images/<?php echo $row["gambar"]; ?>"style= "max-width: 300px; height:400px;" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><a href="#"><?php echo $row["judul"]; ?></a></h5>
    <div class="overflow-auto" style="max-height: 100px; text-align :justify "><?php echo $row["ringkas"]; ?> 
   </div>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Price : Rp. <?php echo $row["harga"]; ?></li>
    <li class="list-group-item">Stock : <?php echo $row["stok"]; ?></li>
    <div class="card-body">    
    <input type="hidden" name="idpembeli" value="<?=$_SESSION["idpembeli"] ; ?>">
    <a href="detail.php?id=<?=$row["idproduk"]; ?>">Lihat Detail</a>

  </div>
</div>


               
            </div>
        <?php endforeach; ?>
    </div>

</div>
</div>



</section>

</div>

<footer class="text-center text-black" style="background-color: #cbcbc6;">
    <div class="container p-4">

        <div class="row">
            <div class="col-md-5">
                <h5>CONTACT US</h5>
                <p>
                    Hey! Comic</p>
                <p> ALAMAT:
                    Jln. Yos Sudarso Palangka Raya
                    73111, Kalimantan Tengah
                </p>
                <p>email: heycomic@gmail.com</p>
            </div>
            <div class="col-md-7">
                <h5 class="text-uppercase">Social Media</h5>

                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="#!" class="text-black">Instagram</a>
                    </li>
                    <li>
                        <a href="#!" class="text-black">Twitter</a>
                    </li>
                    <li>
                        <a href="#!" class="text-black">Facebook</a>
                    </li>
                    <li>
                        <a href="#!" class="text-black">Whatsapp</a>
                    </li>
                </ul>
            </div>
            
        </div>
    </div>
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: #000000;;">
        © 2022 Copyright:
        <a class="text-white" href="">Hey! Comic</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->

 <!-- Optional JavaScript; choose one of the two! -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                $.ajax({
                    type: 'POST',
                    url: 'searchkomik.php',
                    data: {
                        search: $(this).val()
                    },
                    cache: false,
                    success: function(data) {
                        $('#tampil').html(data);
                    }
                });
            });
        });
    </script>

<!-- custom js file link  -->
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="js/script.js"></script>

</body>
</html>