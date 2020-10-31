<?php 
include 'config/config.php';
if(isset($_POST['submit'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$msg="";
	$class="";
		if($email==="" || $password===""){
			$msg ="email and password fields are required";
			$class = "danger";
		}
	
		else{
		$sql = mysqli_query($connection, "SELECT * FROM subscribers WHERE email='$email'");
		if(mysqli_num_rows($sql) > 0){
			$row = mysqli_fetch_array($sql);

			$db_email = $row['email'];
			$db_password = $row['password'];
			$db_id = $row['id'];
			$db_name = $row['name'];

			if(password_verify($password, $db_password)){
				$_SESSION['subscriber'] = $db_name;
					?>
            <script>
                window.location.assign("index.php");
            </script>
            <?php
			}
			else{
			$msg ="password";
			$class = "danger";
			}
		}else{
			$msg ="Invalid Email Address or not registerd be a subscriber";
			$class = "danger";
		}
		}

	echo "<div class='alert alert-$class'>$msg</div>";
}

?>