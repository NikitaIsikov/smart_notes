<!DOCTYPE html>
<html>
<head>
	<title>Sign up: error</title>
	<link rel="stylesheet" type="text/css" href="style/signup_form.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<block style="width: 100%; display: block;" class="container">
		<div class="row">
			<block class="col-md"></block>
			
			<form class="col-md" method="POST">
				<h2>Oops!</h2>
				<p><img src="images/cross.png" style="height: 100px"></p>
				<p>Oops! We have a problem with database.</p>
				<p>Try again later</p>
				<?php
					$con 	= mysqli_connect('localhost', 'root', '', 'smart_notes');
					$query_chk	= "SELECT email FROM users WHERE id = 1";
				?>
				<p><?=mysqli_error($con)?></p>
				<p><a href="log_in.php"><button type="button" class="blue_reg_button">Log in</button></a></p>
				<p><a href="homepage.php"><button type="button" class="blue_inv_button">Go to homepage</button></a></p>
			</form>

			<block class="col-md"></block>
		</div>
	</block>
</body>
</html>