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
  
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    $alamat = $_POST['alamat'];
    $kodepos = $_POST['kodepos'];
    $negara = $_POST['negara'];
    $gender = $_POST['gender'];
    $ttl = $_POST['ttl'];
 
    $update = mysqli_query($conn, "UPDATE `pembeli` SET nama='$nama', email='$email', nohp='$nohp', alamat='$alamat', kodepos='$kodepos', negara='$negara', gender='$gender', ttl='$ttl' WHERE idpembeli = '".$_SESSION["idpembeli"]."'");
    if ($update) {
       echo "
       <script>
       alert('Data berhasil di update');
       document.location.href = 'profile.php';
       </script> ";
   }  else {
       echo "
       <script>
       alert('Data berhasil di update.');
       document.location.href = 'profile.php';
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
   <title>Hey!Comic - My Profile</title>

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


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Setting Profile</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>

  <body class="bg-light">

    <div class="container">
      <div class="py-5 text-center">
        <h2>SETTING PROFILE</h2>
      </div>
      <form action="" method="post">
      <?php
        $profile = query("SELECT * FROM pembeli where idpembeli='".$_SESSION["idpembeli"]."'") [0];
        ?>
             <div class="mb-3">
              <label for="nama">Nama <span class="text-muted"></span></label>
              <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $profile["nama"]; ?>">
             </div>

             <div class="mb-3">
              <label for="email">Email <span class="text-muted"></span></label>
              <input type="text" class="form-control" name="email" id="email" value="<?php echo $profile["email"]; ?>">
             </div>

             <div class="mb-3">
              <label for="nohp">No Hp <span class="text-muted"></span></label>
              <input type="text" class="form-control" name="nohp" id="nohp" value="<?php echo $profile["nohp"]; ?>">
             </div>

             <div class="mb-3">
              <label for="alamat">Alamat <span class="text-muted"></span></label>
              <input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $profile["alamat"]; ?>">
             </div>

             <div class="mb-3">
              <label for="kodepos">Kode Pos <span class="text-muted"></span></label>
              <input type="text" class="form-control" name="kodepos" id="kodepos" value="<?php echo $profile["kodepos"]; ?>">
             </div>

             <div class="mb-3">
              <label for="negara">Negara <span class="text-muted"></span></label>
              <input type="text" class="form-control" name="negara" id="negara" value="<?php echo $profile["negara"]; ?>">
             </div>

             <div class="mb-3">
              <label for="gender">Jenis Kelamin <span class="text-muted"></span></label>
              <input type="text" class="form-control" name="gender" id="gender" value="<?php echo $profile["gender"]; ?>">
             </div>

             <div class="mb-3">
              <label for="ttl">Tanggal Lahir <span class="text-muted"></span></label>
              <input type="text" class="form-control" name="ttl" id="ttl" value="<?php echo $profile["ttl"]; ?>">
             </div>
       
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" value="submit" name="submit" type="submit">Update</button>
          </form>
        </div>
      </div>

<br>
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
</html>
