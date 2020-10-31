<?php
include '../config/config.php';
$user = $_SESSION['admin_user'];

if(isset($_POST['text'])){
	$pwd = md5($_POST['text']);
	$query = mysqli_query($connection,"SELECT password FROM users WHERE username='$user'");
	$data = mysqli_fetch_array($query);
	$pwdfromdb=$data['password'];
	if($pwdfromdb == $pwd){
		echo "<span class='text-success'>password matched</span>";
	}else{
		echo "<span class='text-danger'>password does not matched</span>";
	}
}
