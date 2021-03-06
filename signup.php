<?php
session_start();
require("myFunctions.php"); // get database connected
// require 'password.php';
$db = loadDatabase();

// TODO:
// VALIDATE INPUT

// check for existing email address here
$email = htmlspecialchars($_POST['email']);
$query = "SELECT emailAddress FROM user WHERE emailAddress=:email";
$stmtCheckEmail = $db->prepare($query);
$stmtCheckEmail->bindValue(':email', $email, PDO::PARAM_STR);
$stmtCheckEmail->execute();
$results = $stmtCheckEmail->fetchAll(PDO::FETCH_ASSOC);

// insert info into database
if (!$results) {
	$firstName = htmlspecialchars($_POST['firstName']);
	$lastName = htmlspecialchars($_POST['lastName']);
	$passwordHash = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
	$username = substr($email, 0, strpos($email, '@'));
	$accountCreateDate = date("Y-m-d");

	$query = "INSERT INTO user(firstName, lastName, emailAddress, password, username, accountCreateDate) VALUES (:firstName, :lastName, :email, :password, :username, :accountCreateDate)";
	$stmt = $db->prepare($query);
	$stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
	$stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
	$stmt->bindValue(':email', $email, PDO::PARAM_STR);
	$stmt->bindValue(':password', $passwordHash, PDO::PARAM_STR);
	$stmt->bindValue(':username', $username, PDO::PARAM_STR);
	$stmt->bindValue(':accountCreateDate', $accountCreateDate, PDO::PARAM_STR);
	$stmt->execute();

	// log user in and redirect to the new journal page
	$_SESSION['failedLogin'] = false;
	$_SESSION['username'] = $username;
	$_SESSION['loggedIn'] = true;
	$_SESSION['userId'] = $db->lastInsertId();
	$_SESSION['numJournals'] = 0;

	header("Location: newJournal.php");
	// echo $passwordHash;
	exit();
} else {
	$_SESSION['failedSignup'] = true;
	header("Location: /");
	exit();
}
?>;
