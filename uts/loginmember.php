<?php
session_start();
@include 'config.php';

if(isset($_POST["loginn"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    
        
    $check = mysqli_query($conn, "SELECT * FROM pembeli WHERE username = '$username' and password = '$password'");
    if(mysqli_num_rows($check)=== 1) {
        $_SESSION["loginn"] = true;
        $_SESSION["username"] = $username;
        echo "
        <script>
        alert('Login Berhasil');
        document.location.href = 'member.php';
        </script> ";
    }  else {
        echo "
        <script>
        alert('Username/Password Salah');
        document.location.href = 'loginmember.php';
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
    <title>Halaman Login!</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>Hey!<span>Comic</span></div>
		</div>
		<br>
        <form class="login" action="" method="post">
        <h1>LOGIN MEMBER</h1>
             <input type="text" name="username" placeholder="username">
             
             <input type="password" name="password" placeholder="password">

             <input type="submit" name="loginn" value="Login">
        <h3>Belum punya akun? <a href="signup.php" style="color: white;" >Register Sekarang</h3>
               

</form>

</body>
</html>