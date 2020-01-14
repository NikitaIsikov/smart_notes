<!DOCTYPE html>
<html>
<head>
	<title>Log in</title>
	<link rel="stylesheet" type="text/css" href="style/signup_form.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<?php require 'functions.php'; 
	 // require 'header_bar.php';
?>

<block style="width: 100%; display: block;" class="container">
	<div class="row">
		<block class="col-md"></block>

		<form class="col-md" method="POST">
			<h2>Log in</h2>
			<p><input type="text" name="login_email" placeholder="login or email"></p>
			<p><input type="password" name="pw" placeholder="password"></p>
			<!--p><input type="checkbox" name="remember" style="width: auto;"> Remember me</p-->
			<?php login_validate(); ?>
			<p><button type="submit" class="blue_reg_button">Log in!</button></p>
		</form>

		<block class="col-md"></block>
	</div>
</block>

</body>
</html>