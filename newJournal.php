<?php
session_start();
require("myFunctions.php"); // get database connected
$db = loadDatabase();

if (isset($_POST['journalName'])) { // add journal to database
	// insert
	$query = "INSERT INTO journal(userId, name, createDate) VALUES (:userId, :name, :createDate)";
	$stmt = $db->prepare($query);
	$stmt->bindValue(':userId', $_SESSION['userId'], PDO::PARAM_INT);
	$stmt->bindValue(':name', $_POST['journalName'], PDO::PARAM_STR);
	$stmt->bindValue(':createDate', date("Y-m-d"), PDO::PARAM_STR);
	$stmt->execute();

	$id = $db->lastInsertId();
	$_SESSION['getJournal'] = true;
	$_SESSION['journalId'] = $id;
	$_SESSION['journalName'] = $_POST['journalName'];

	// redirect to index.php with new journal
	header("Location: /");
	exit();
} else { // get journal name from user
	echo '<!DOCTYPE html>';
	echo '<html lang="en">';
	include 'modules/headBlock.html';
	echo '<body>';
	include 'modules/navBarTop.php';

	// put stuff here
	echo '<div class="container">';
	echo '<h1>Create a new journal</h1>';
	?>
	<form action="newJournal.php" method="POST">
		<input type="text" name="journalName" placeholder="JournalName"></input>
		<input type="submit" value="Create"></input>
	</form>
	<?php
	echo '</div>';

	echo '</body>';
	echo '</html>';
}
?>

