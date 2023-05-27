<?php 
session_start();
unset($_SESSION["loginn"]);

header("Location: index.php");
exit;

?>