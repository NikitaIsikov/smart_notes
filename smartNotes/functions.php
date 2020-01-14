<?php

function signup_validate() {
	if (count($_POST) > 3 && $_POST['email'] != '' && $_POST['login'] != '' && $_POST['pw'] !=  '' && $_POST['pw_check']) {
		$con 	= mysqli_connect('localhost', 'root', '', 'smart_notes');
		$email 	  			= $_POST['email'];
		$login	  			= $_POST['login'];
		$pw 	 			= $_POST['pw'];
		$pw_check 			= $_POST['pw_check'];
		$alert_pw = $alert_mail = 0;
		$alert_db_mail = $alert_db_login = 0;

		$query_chk_mail 	= "SELECT email FROM users WHERE email = '$email'";
		$query_chk_login 	= "SELECT login FROM users WHERE login = '$login'";

		$check_mail = mysqli_query($con, $query_chk_mail);
		$check_login = mysqli_query($con, $query_chk_login);
		$db_mail = mysqli_fetch_assoc($check_mail);
		$db_login = mysqli_fetch_assoc($check_login);

		$check_login_spc = explode(' ', $login);
		/*
		echo "<pre>";
		print_r($check_login_spc);
		echo "</pre>";*/
		if ($db_mail['email'] == $email) {
			$alert_db_mail++;
			echo "<p><span>Error! User with such email already exists</span></p>";		
		}
		if ($db_login['login'] == $login) {
			$alert_db_login++;
			echo "<p><span>Error! User with such login already exists</span></p>";		
		}
		if (count($check_login_spc) > 1) {
			$alert_db_login++;
			echo "<p><span>Error! Login must not contain spaces</span></p>";		
		}
		if (strlen($login) < 6) {
			$alert_db_login++;
			echo "<p><span>Error!Login must be at least 6 characters long</span></p>";		
		}
		if ($pw != $pw_check) {
			$alert_pw++;
			echo "<p><span>Error! Passwords don't match</span></p>";
		}
		if ($pw == $pw_check && strlen($pw) < 6) {
			$alert_pw++;
			echo "<p><span>Error! Password must be at least 6 characters long</span></p>";
		}
    	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    		$alert_mail++;
      		echo "<p><span>Error! Invalid email</span></p>";
    	}

    	$alertcounter = $alert_db_mail + $alert_db_login + $alert_pw + $alert_mail;
    	if ($alertcounter == 0) {
			$query 	= "INSERT INTO users 
			   (login, email, pw)
			   VALUES ('$login', '$email', '$pw')";
			$result = mysqli_query($con, $query);

			if ($result == false) {
				//header('Location: dbError.php');
				echo mysqli_error($connection);
			} else {
				header('Location: new_usr_greetings.php');
			}
		}
    	
	} elseif (count($_POST) > 0) {
		echo "<p><span>Error! All fields need to be filled</span></p>";
	}
}

function login_validate() {
	/*echo "<pre>";
	print_r($_POST);
	echo "</pre>";*/
	if (count($_POST) > 0 && $_POST['login_email'] != '' && $_POST['pw'] != '') {
		$con 	= mysqli_connect('localhost', 'root', '', 'smart_notes');
		$login_email		= $_POST['login_email'];
		$pw_inp	 			= $_POST['pw'];
		$key = 0;

		$query_find_result 	= "SELECT login, email, pw, id FROM users WHERE email = '$login_email' OR login = '$login_email'";
		//$query_find_login 	= "SELECT login, pw, id FROM users WHERE login = '$login_email'";

		$find_result = mysqli_query($con, $query_find_result);
		//$find_login = mysqli_query($con, $query_find_login);
		$db_result = mysqli_fetch_assoc($find_result);
		//$db_login = mysqli_fetch_assoc($find_login);
		if (!isset($_POST['remember'])) {
			$remember = 'off';
		} else {
			$remember = $_POST['remember'];
		}
		/*
		echo "<pre>";
		print_r($check_login_spc);
		echo "</pre>";*/
		if ($db_result['email'] == $login_email || $db_result['login'] == $login_email) {
			extract($db_result);
			if ($pw_inp  == $pw) {
				setcookie('id', $id, time() + 86400 * 14, "/");
				setcookie('login', $login, time() + 86400 * 14, "/");
				setcookie('email', $email, time() + 86400 * 14, "/");
				setcookie('pw', $pw, time() + 86400 * 14, "/");
				/*if ($remember == 'off') {
					setcookie('remember', 0, time() + 86400 * 14, "/");
				} elseif ($remember == 'on') {
					setcookie('remember', 1, time() + 86400 * 14, "/");
				}*/
				header('Location: homepage.php');
			} else {
				echo "<p><span>Error! Wrong password</span></p>";
			}
		} else {
			echo "<p><span>Error! There's no user with such email/login</span></p>";
		}
	} elseif (count($_POST) > 0) {
		echo "<p><span>Error! All fields need to be filled</span></p>";
	}
}

function timeTrack($chosendate) {
		if (!isset($_POST['prevweek']) && !isset($_POST['nextweek'])) {
			$startdate = strtotime("Monday");
			$chosendate = $startdate;
			$chosendate = strtotime("-1 week", $chosendate);
		} elseif (isset($_POST['prevweek']) || isset($_POST['nextweek'])) {
			$chosendate = $chosendate - 604800;
		} 
		if (isset($_POST['nextweek'])) {
			$chosendate = $chosendate + 2 * 604800;
		}
	return $chosendate;
}

function calendar($chosendate, $notes) {
	$today = strtotime('today');
	$endweek=strtotime("+6 days", $chosendate);

	while ($chosendate <= $endweek) {
		$searchfor = date("Y-m-d", $chosendate);
		$date = date("D-M-d", $chosendate);
		
		if ($chosendate == $today) {
			showDay($date, $searchfor, $notes, 2);
		} elseif (date("D", $chosendate) == 'Sat' || date("D", $chosendate) == 'Sun') {
			showDay($date, $searchfor, $notes, 1);
		} else {
			showDay($date, $searchfor, $notes);
		}
		
	  	$chosendate = strtotime("+1 day", $chosendate);
	}
	$chosendate = strtotime("-7 days", $chosendate);
	//echo $chosendate . date("l M d", $chosendate) . "<br>";
	return $chosendate;
}

function getNotes() {
	$userid = $_COOKIE['id'];
	$con = mysqli_connect('localhost', 'root', '', 'smart_notes');
	$query = "SELECT _date, name, content, id FROM notes WHERE userid = '$userid' ORDER BY _date ASC";
	$result = mysqli_query($con, $query);

	$rows = [];
	while ($row=mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	$notes = [];
	$newkey = 0;
	foreach ($rows as $key => $note) {
		if (isset($notes[$note['_date']][$newkey])) {
			$newkey++;
		} else {
			$newkey = 0;
		}
		$notes[$note['_date']][$newkey] = ['id' => $note['id'], 'name' => $note['name'], 'content' => $note['content']];
	}
	return $notes;
}

function showDay($date, $searchfor, $notes, $color = 0) {
	$dateArr = explode('-', $date);
	$weekday = $dateArr[0];
	$month 	 = $dateArr[1];
	$day 	 = $dateArr[2];

	$pallette[0] = ['#d9ddfc', '#0000bc'];
	$pallette[1]  = [0 => '#fcd9da', 1 => '#ef0003'];//ff8e92
	$pallette[2]= [0 => '#dafcd9', 1 => '#008c00'];//8eff9a
	?>
<div class="dayholder">
	<table>
		<tr <?php if (isset($notes[$searchfor])) {echo "style='border-bottom: dotted gray 2px;'";} ?>>
			<td style="vertical-align: top; background-color: <?=$pallette[$color][0]?>;">
				<h2 style="margin: 12px 3px 0px 5px; width: 75px; color: <?=$pallette[$color][1]?>;"><?=$weekday?></h2>
			</td>
			<td class="day_and_month" style="background-color: <?=$pallette[$color][0]?>; color: <?=$pallette[$color][1]?>;">
				<p><?=$day?></p>
				<p style="margin-bottom: 0px; width: 30px;"><?=$month?></p>
			</td>
			<td class="w-100">
				<p style="text-align: center; margin-bottom: 0px;">
					<i>
						<?php 
							if (isset($notes[$searchfor])) {
								if (count($notes[$searchfor]) == 1) {
									echo "1 note";
								} else {
									echo count($notes[$searchfor]) . " notes";
								}
							} else {
								echo "no notes";
							}
						?>
					</i>
				</p>
			</td>
			<td>
<?php
$modal_id = $searchfor;
$make_id = 'make' . $modal_id;
if (isset($_POST['make_new'])) {
	require 'note_action.php';
}

?>
					<input type="hidden" name="date" value="<?=$searchfor?>">
					<button type="button" class="add_button" data-toggle="modal" data-target="#Modal<?=$modal_id?>">
						<h2 style="margin: 0px;">+</h2>
					</button>
					<div class="modal fade" id="Modal<?=$modal_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">New note</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      	<form method="POST">
								      <div class="modal-body">
								      	<div class="formholder">
									        <p><input type="text" name="name" placeholder="note name" class="w-100"></p>
									        <p><textarea name="content" placeholder="content" rows="8" class="w-100"></textarea></p>
									        <input type="hidden" name="date" value="<?=$searchfor?>">
									        <input type="hidden" name="userid" value="<?=$_COOKIE['id']?>">
									    </div>
								      </div>
								      <div class="modal-footer">
								      	<input type="hidden" name="make_new" value="">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>      
								        <button type="submit" class="btn btn-primary">Create</button>
							        </form>
							      </div>
							    </div>
							  </div>
							</div>

			</td>
		</tr>
	</table>
	<table>
		<?php
		if (isset($notes[$searchfor])) {
			$idKey = 0;
			//createModals($notes[$searchfor]);
			foreach ($notes[$searchfor] as $key => $note) {
				$name 		   = $note['name'];
				$content	   = $note['content'];
				$noteid		   = $note['id'];
				$modal_id 	   = $searchfor . 'del' . $idKey;
				$modal_id_edit = $searchfor . 'edit' . $idKey;
				//echo $modal_id;
		?>
				<tr>
					<td style="vertical-align: top; width: 52px;">
							<button type="button" class="del_button" data-toggle="modal" data-target="#Modal<?=$modal_id?>" style="display: table-cell;">
								<span style="margin: 0px;">+</span>
							</button>
							<div class="modal fade" id="Modal<?=$modal_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        Are you sure to delete note "<?=$name?>"
							      </div>
							      <div class="modal-footer">
<?php
if (isset($_POST['delete'])) {
	require 'note_action.php';
}
?>
							      	<form method="POST">
								      	<input type="hidden" name="noteid" value="<?=$noteid?>">
								      	<input type="hidden" name="delete" value="">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								        <button type="submit" class="btn btn-primary">Delete note</button>
							        </form>
							      </div>
							    </div>
							  </div>
							</div>
						<!-- edit button -->
							<button type="button" class="edit_button" data-toggle="modal" data-target="#Modal<?=$modal_id_edit?>" style="display: table-cell;">
								<span style="margin: 0px;">...</span>
							</button>
							<div class="modal fade" id="Modal<?=$modal_id_edit?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
								  <form method="POST">
								      <div class="modal-body">
								      	<div class="formholder">
									        <p><input type="text" name="name" value="<?=$name?>" class="w-100"></p>
									        <p><textarea name="content" rows="8" class="w-100"><?=$content?></textarea></p>
									        <input type="hidden" name="noteid" value="<?=$noteid?>">
									      	<input type="hidden" name="edit" value="">
									    </div>
								      </div>
								      <div class="modal-footer">
									      	
									        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
									        <button type="submit" class="btn btn-primary">Save changes</button>
									  </div>
							       </form>
							       <?php
										if (isset($_POST['edit'])) {
											require 'note_action.php';
										}
								   ?>
							    </div>
							  </div>
							</div>
					</td>
					<td>								
						<h2 style="margin-top: 5px;"><?=$note['name']?></h2>
						<p>
							<?=$note['content']?>
						</p>
					</td>
				</tr>
		<?php
				$idKey++;
			}
		}
		?>
	</table>
</div>
	<?php
}

function createModal($array) {
	$idKey = 0;
	foreach ($array as $key => $note) {
 	
?>

<?php
		
	}
}
