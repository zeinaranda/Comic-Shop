<?php
include "config.php";

if(isset($_POST['username'])){
   $username = mysqli_real_escape_string($conn,$_POST['username']);

   $query = "select count(*) as cntUser from pembeli where username='".$username."'";

   $result = mysqli_query($conn,$query);
   $response = "<span style='color: green;'>Username Available.</span>";
   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);

      $count = $row['cntUser'];
        echo "<script>$('#submit').prop('disabled',false);</script>";
      if($count > 0){
          $response = "<span style='color: red;'>Username Not Available.</span>";
          echo "<script>$('#submit').prop('disabled',true);</script>";
      }
   
   }

   echo $response;
   die;
}



    