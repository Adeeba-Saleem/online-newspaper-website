<?php 

session_start();

if (isset($_GET['logout'])) {
	unset($_SESSION['admin_user']);
	header("Location: ../nw-admin.php");
}




 ?>