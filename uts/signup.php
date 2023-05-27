<?php 
session_start();
@include 'config.php';

if(isset($_POST['submit']))
 {
 $username = $_POST['username'];
 $password = $_POST['password'];
 $email = $_POST['email'];
 $nama = $_POST['nama'];
 $nohp = $_POST['nohp'];
 $alamat = $_POST['alamat'];
 $kodepos = $_POST['kodepos'];
 $negara = $_POST['negara'];
 $gender = $_POST['gender'];
 $ttl = $_POST['ttl'];

 insertmember($username,$password, $email, $nama, $nohp, $alamat , $kodepos, $negara, $gender, $ttl);
 if (mysqli_affected_rows($conn)>0) {
    $_SESSION["sign up"] = true;
    echo "
    <script>
    alert('Registrasi Berhasil');
    document.location.href = 'loginmember.php';
    </script> ";
}  else { 
	echo "
    <script>
    alert('Registrasi Gagal. Username telah digunakan. Mohon buat username baru.');
    document.location.href = 'signup.php';
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
    <link rel="stylesheet" href="css/style2.css" type="text/css">
</head>
<body>

<div class="login-wrap">
	<div class="login-html">
		
	
		<div class="login-form">
		<div class="tab">Sign Up</div>
            <form  action="" method="post">
				<div class="group">
					
					<label for="username" name="username" class="label">Username</label>
					<input id="txt_username" name="username" type="text" class="input" >
					<div id="uname_response" ></div>
				</div>
				<div class="group">
					<label for="password" name="password" class="label">Password</label>
					<input id="password" name="password" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="email" name="email" class="label">Email</label>
					<input id="email" name="email" type="text" class="input" data-type="text">
				</div>
				<div class="group">
					<label for="nama" name="nama" class="label">Name</label>
					<input id="nama" name="nama" type="text" class="input">
				</div>
                <div class="group">
					<label for="nohp" name="nohp" class="label">No Hp</label>
					<input id="nohp" name="nohp" type="text" class="input">
				</div>
                <div class="group">
					<label for="alamat" name="alamat" class="label">Alamat</label>
					<input id="alamat" name="alamat" type="text" class="input">
				</div>
                <div class="group">
					<label for="kodepos" name="kodepos" class="label">Kode Pos</label>
					<input id="kodepos" name="kodepos" type="text" class="input">
				</div>
                <div class="group">
					<label for="negara" name="negara" class="label">Negara</label>
					<input id="negara" name="negara" type="text" class="input">
				</div>
                <div class="group">
					<label for="ttl" name="ttl" class="label">Tanggal Lahir</label>
					<input id="ttl" name="ttl" type="date" class="input">
				</div>
                <div class="group">
                <label for="gender" class="label">Gender</label>
                <input type="radio" name="gender" id="gender" value="Laki-Laki" > Laki-Laki
                <input type="radio" name="gender" id="gender" value="Perempuan"> Perempuan
                </div>
				<div class="group">
					<input type="submit" id="submit" name = "submit" class="button" value="Sign Up">
				</div>
				<div class="hr"></div>
				
			</div>
			
				<div class="hr"></div>
				
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

$("#txt_username").keyup(function(){

   var username = $(this).val().trim();

   if(username != ''){

	  $.ajax({
		 url: 'check_availability.php',
		 type: 'post',
		 data: {username: username},
		 success: function(response){

			 $('#uname_response').html(response);

		  }
	  });
   }else{
	  $("#uname_response").html("");
   }

 });

});
</script>
</form>
</body>