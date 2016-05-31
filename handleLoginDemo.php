<?php
session_start();

// obviously, this will need to be replaced by a query to the database to authenticate a user
if ($_POST['submit'] == "Login as Norman Levy") {
	$_SESSION["username"] = "normanLevy";
	$_SESSION["loggedIn"] = true;
	$_SESSION["userId"] = 1;
} else if ($_POST['submit'] == "Login as Darth Vader") {
	$_SESSION["username"] = "darthvader";
	$_SESSION["loggedIn"] = true;
	$_SESSION["userId"] = 2;
}
$_SESSION['loggedIn'] = true;
header('Location: index.php'); // redirect to index.php
?>
