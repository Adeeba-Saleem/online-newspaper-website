<?php 
include '../../config/config.php';

function clean($data){
	global $connection;
	$data = htmlspecialchars($data);
	$data = stripslashes($data);
	$data = trim($data);
	$data = mysqli_real_escape_string($connection, $data);
	return $data;
}

function addUsers(){
	global $connection;
	$user = $_SESSION['admin_user'];
	$sql = mysqli_query($connection, "SELECT role FROM users WHERE username='$user'");
 	$row = mysqli_fetch_array($sql);
 	$role = $row['role'];

	if(isset($_POST['register']) && $role ==='Admin' ){
		//Do this
		$fname = clean($_POST['fname']);
		$lname = clean($_POST['lname']);
		$email = clean($_POST['email']);
		$username = $fname . ' ' .$lname;
		$pwd = $_POST['pwd'];
		$role = $_POST['role']; 

		$res_e = mysqli_query($connection,"SELECT * FROM users WHERE email='$email'");
		$res_u = mysqli_query($connection,"SELECT * FROM users WHERE username='$username'");

		if(empty($fname) && empty($lname)){
			header("Location: ../addusers.php?message=fields_are_required");
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			header("Location: ../addusers.php?message=email_is_invalid");
		} elseif(empty($email)){
			header("Location: ../addusers.php?message=fields_are_required");
		} elseif(mysqli_num_rows($res_e) > 0){
			header("Location: ../addusers.php?message=email_already_taken");
		}
		elseif(mysqli_num_rows($res_u) > 0){
			header("Location: ../addusers.php?message=username_already_taken");
		}
		elseif(empty($pwd)){
			header("Location: ../addusers.php?message=fields_are_required");
		} elseif (strlen($pwd) < 6) {
			header("Location: ../addusers.php?message=password_is_short");
		} else{
			$hashPwd = md5($pwd);
			$ProfilePic = '../assets/images/profile_pics/default/head_1.png';
			$username = $fname . ' ' .$lname;
			$query = mysqli_query($connection, "INSERT INTO users VALUES('','$username','$fname','$lname','$email','$hashPwd','$ProfilePic','$role','0')");
			if($query){
				header("Location: ../user.php");
			} else{
				die("Failed " . mysqli_error($connection));
			}
		}
	}else{
		header("Location: ../index.php");
	}
}
addUsers();


function approvecomment(){
	global $connection;
	if(isset($_GET['a_com_id'])){
		echo $id = $_GET['a_com_id'];
		$sql = mysqli_query($connection, "UPDATE comments SET status='approved' WHERE id=$id");
		if($sql){
			header("Location: ../comments.php");
		}else{
			die(mysqli_error($connection));
		}
	}
}


approvecomment();

function unapprovecomment(){
	global $connection;
	if(isset($_GET['u_com_id'])){
		$id = $_GET['u_com_id'];
		$sql = mysqli_query($connection, "UPDATE comments SET status='unapproved' WHERE id=$id");
		if($sql){
			header("Location: ../comments.php");
		}else{
			die(mysqli_error($connection));
		}
	}
}


unapprovecomment();


function approvepost(){
	global $connection;
	$user = $_SESSION['admin_user'];
	$sql = mysqli_query($connection, "SELECT role FROM users WHERE username='$user'");
 	$row = mysqli_fetch_array($sql);
 	$role = $row['role'];
	if(isset($_GET['a_post_id']) && $role ==='Admin'){
		echo $id = $_GET['a_post_id'];
		$sql = mysqli_query($connection, "UPDATE news SET status='approved' WHERE id=$id");
		if($sql){
			header("Location: ../post.php");
		}else{
			die(mysqli_error($connection));
		}
	}
}


approvepost();

function unapprovepost(){
	global $connection;
	$user = $_SESSION['admin_user'];
	$sql = mysqli_query($connection, "SELECT role FROM users WHERE username='$user'");
 	$row = mysqli_fetch_array($sql);
 	$role = $row['role'];
	if(isset($_GET['u_post_id']) && $role ==='Admin'){
		$id = $_GET['u_post_id'];
		$sql = mysqli_query($connection, "UPDATE news SET status='unapproved' WHERE id=$id");
		if($sql){
			header("Location: ../post.php");
		}else{
			die(mysqli_error($connection));
		}
	}
}


unapprovepost();