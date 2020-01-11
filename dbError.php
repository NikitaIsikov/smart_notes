<?php

$con 	= mysqli_connect('localhost', 'root', '', 'smart_notes');
$query_chk	= "SELECT email FROM users WHERE id = 1";
echo mysqli_error($con);