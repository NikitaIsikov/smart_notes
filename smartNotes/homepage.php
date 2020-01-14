<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<?php require 'functions.php';?>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> 

	<link rel="stylesheet" type="text/css" href="style/homepage.css">
	<link rel="stylesheet" type="text/css" href="style/header.css">
</head>
<?php require 'header.php' ?>
<body>

	<block class="container">
		<block class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<?php
				if (count($_COOKIE) > 0) {
					$notes = getNotes();
					$refresh_switch = 0;
					
					echo "<pre>";
					print_r($_POST);
					echo "</pre>";
					
					date_default_timezone_set("Europe/Kiev");

					$con   = mysqli_connect('localhost', 'root', '', 'smart_notes');
					$login = $_COOKIE['login'];
					$email = $_COOKIE['email'];

					if (!isset($_POST['chosendate'])) {
						$chosendate = 0;
						$chosendate = timeTrack($chosendate);
					} else {
						$chosendate = $_POST['chosendate'];
						$chosendate = timeTrack($chosendate);
					}
					
					?>

					<form method="post">
						<p style="margin: 20px 0px 20px 0px;">
							<div class="btn-group" role="group" aria-label="Basic example">
								<button class="btn blue_reg_button" type="submit" name="prevweek">prev</button>
								<button class="btn blue_reg_button" type="submit" name="curweek">current</button>
								<button class="btn blue_reg_button" type="submit" name="nextweek">next</button>
							</div>
						</p>
						<input type="hidden" name="chosendate" value="<?=$chosendate?>">
					</form>
					<?php 
						if (isset($_POST['prevweek'])) {
							//$chosendate = $chosendate + 604800;
						} elseif (isset($_POST['nextweek'])) {
							//$chosendate = $chosendate - 604800;
						} elseif (isset($_POST['curweek'])) {
							//$chosendate = $chosendate - 604800;
						}
						calendar($chosendate, $notes);
					?>
						
					<form method="post">
						<p style="margin: 20px 0px 20px 0px;">
							<div class="btn-group" role="group" aria-label="Basic example">
								<button class="btn blue_reg_button" type="submit" name="prevweek">prev</button>
								<button class="btn blue_reg_button" type="refresh">current</button>
								<button class="btn blue_reg_button" type="submit" name="nextweek">next</button>
							</div>
						</p>
						<input type="hidden" name="chosendate" value="<?=$chosendate?>">
					</form>
				<?php 
				} else {
				?>
					<h1>Hi, Welcome to SmartNotes!</h1>
					<p>Log in or Sign up to continue</p>
				<?php
				}
				?>















				

				
				

				<!--div class="accordion" id="accordionExample">
				  <div class="card">
				    <div class="card-header" id="headingOne">
				      <h2 class="mb-0">
				        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				          Collapsible Group Item #1
				        </button>
				      </h2>
				    </div>

				    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				      <div class="card-body">
				        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
				      </div>
				    </div>
				  </div>
				  <div class="card">
				    <div class="card-header" id="headingTwo">
				      <h2 class="mb-0">
				        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				          Collapsible Group Item #2
				        </button>
				      </h2>
				    </div>
				    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
				      <div class="card-body">
				        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
				      </div>
				    </div>
				  </div>
				  <div class="card">
				    <div class="card-header" id="headingThree">
				      <h2 class="mb-0">
				        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				          Collapsible Group Item #3
				        </button>
				      </h2>
				    </div>
				    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
				      <div class="card-body">
				        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
				      </div>
				    </div>
				  </div>
				</div-->
			</div>
			
			<div class="col-md-3"></div>
		</block>
	</block>
</body>
</html>


<?php

?>