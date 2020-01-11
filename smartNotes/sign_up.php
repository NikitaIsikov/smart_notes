<!DOCTYPE html>
<html>
<head>
	<title>Sign up</title>
	<link rel="stylesheet" type="text/css" href="style/signup_form.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<?php require 'functions.php'; ?>

<block style="width: 100%; display: block;" class="container">
	<div class="row">
		<block class="col-md"></block>

		<form class="col-md" method="POST">
			<h2>Sign up</h2>
			<p><input type="text" name="email" placeholder="*email"></p>
			<p><input type="text" name="login" placeholder="*login (6 characters min)"></p>
			<p><input type="password" name="pw" placeholder="*password (6 characters min)"></p>
			<p><input type="password" name="pw_check" placeholder="*repeat password"></p>
			<?php signup_validate(); ?>
			<span>*</span> - required fields<br>
			<p><button type="submit" class="blue_reg_button">Sign up!</button></p>
		</form>

		<block class="col-md"></block>
	</div>
</block>

</body>
</html>