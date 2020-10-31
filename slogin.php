<?php require 'pages/header.php' ?>
<div class="row mt-3">
	<div class="col-md-6 mx-auto">
		<h4>Login</h4>
		<p>Fill in all details</p>
		<p class="text-center" id="msg"></p>
		<form action="" method="POST" autocomplete="off">
			<label>Email</label>
			<div class="form-group">
				<input type="email" name="email" id="email" value="" class="form-control form-control-lg">
			</div>
			<label>Password</label>
			<div class="form-group">
				<input type="password" name="password" id="password" value="" class="form-control form-control-lg">
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input type="submit" name="login" id="submit" value="Login" class="btn btn-success btn-block">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<a href="sregister.php" class="btn btn-block bg-light">Need an Account? Register</a>
					</div>
				</div>
			</div>
			
		</form>
	</div>
</div>

<!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- jquery knob -->
  <script src="assets/jquery-knob/js/jquery.knob.js"></script>
  <!--custome script for all page-->
  <script src="js/scripts.js"></script>

  <script>
  	$(document).ready(function(){
  		$('form').submit(function(event){
  			let email=document.getElementById('email').value;
  			let password=document.getElementById('password').value;
  			let submit=document.getElementById('submit').value;

  			$("#msg").load('slogin-val.php',{
  				email:email,
  				password:password,
  				submit:submit

  			});
  			event.preventDefault();
  		});
  	});
  </script>