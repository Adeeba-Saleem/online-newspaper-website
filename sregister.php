<?php include 'pages/header.php'; ?>
<div class="row mt-3">
	<div class="col-md-6 mx-auto">
		<h4>Register to become a Subscriber</h4>
		<p>Fill in all details</p>
		<p class="text-center" id="msg"></p>
		<form action="sregister-val.php" method="POST" autocomplete="off">
			<label>Username</label>
			<div class="form-group">
				<input type="text" name="name" id="name"  class="form-control form-control-lg">
			</div>
			<label>Email</label>
			<div class="form-group">
				<input type="email" name="email" id="email"  class="form-control form-control-lg">
			</div>
			<label>Password</label>
			<div class="form-group">
				<input type="password" name="password" id="password"  class="form-control form-control-lg">
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input type="submit" name="submit" id="submit" value="Register" class="btn btn-success btn-block">
					</div>
					
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<a href="slogin.php" class="btn btn-block bg-light">Have an Account? Login</a>
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
  			let name=document.getElementById('name').value;
  			let email=document.getElementById('email').value;
  			let password=document.getElementById('password').value;
  			let submit=document.getElementById('submit').value;

  			$("#msg").load('sregister-val.php',{
  				name:name,
  				email:email,
  				password:password,
  				submit:submit

  			});
  			event.preventDefault();
  		});
  	});
  </script>