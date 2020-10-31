<?php 
include 'config/config.php';
if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$msg="";
	$class="";
		if($name==="" || $password===""){
			$msg ="username and password fields are required";
			$class = "danger";
		}
		elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
			$msg="email is invalid";
			$class = "danger";
		}
		else{
			$query = mysqli_query($connection,"SELECT email FROM subscribers WHERE email='$email'");
			if(mysqli_num_rows($query)>0){
				$msg="Email is taken";
				$class = "danger";
			}else{
			$password = password_hash($password, PASSWORD_DEFAULT);
			$sql = mysqli_query($connection, "INSERT INTO subscribers VALUES('','$name','$email','$password');");
			if($sql){
				?>
            <script>
                window.location.assign("slogin.php");
            </script>
            <?php
		}

			}
		}

	echo "<div class='alert alert-$class'>$msg</div>";
}

?>