<?php
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";*/

if (isset($_POST['delete'])) {
	$id = $_POST['noteid'];
	$con = mysqli_connect('localhost', 'root', '', 'smart_notes');
	$request = "DELETE FROM notes WHERE id = '$id'";
	$result = mysqli_query($con, $request);
}

if (isset($_POST['make_new'])) {
	$userid = $_POST['userid'];
	$date = $_POST['date'];
	$name = $_POST['name'];
	$content = $_POST['content'];
	$name = trim($name);
	$content = trim($content);

	$con = mysqli_connect('localhost', 'root', '', 'smart_notes');
	$request = "INSERT INTO notes
				(userid, _date, name, content)
				VALUES ('$userid', '$date', '$name', '$content')";

	$result = mysqli_query($con, $request);
	//echo $result;
}
?>
<script type="text/javascript">
window.location.href = 'homepage.php';
</script>
