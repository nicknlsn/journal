<?php
session_start();
require("myFunctions.php"); // get database connected
$db = loadDatabase();

echo '<!DOCTYPE html>';
echo '<html lang="en">';

include 'modules/headBlock.html';

echo '<body>';

if (isset($_SESSION['loggedIn'])) { // user is logged in
	// get journals with a function!!!
    $journalInfo = getJournals($db); // we need to do this every time for the navbar menu

    if ($journalInfo == "newUser") { // if they haven't created the first journal yet
    	header("Location: newJournal.php");
    	exit();
    } else {
    	$_SESSION['journals'] = $journalInfo;       // all the journals for this user
    }

	// get the nav bar going
    include 'modules/navBarTop.php';

    // load which journal?
	if (isset($_GET['journal'])) { // check for a request for a specific journal
		$_SESSION['journalName'] = $_GET['journal'];
		$_SESSION['journalId'] = $_GET['journalId'];
		$entries = getEntries($db, $_SESSION['journalId']);
	} else if (isset($_SESSION['getJournal'])) { // if redirected from the newJournal page, journal name and id will already be set
		$entries = getEntries($db, $_SESSION['journalId']);
	} else { // display the last edited journal and entries
	    $lastJournal = getLastJournalId($db, $_SESSION['userId']);
	    $_SESSION['journalId'] = $lastJournal['id'];
	    $_SESSION['journalName'] = $lastJournal['name'];
		$entries = getEntries($db, $_SESSION['journalId']);
	}

	// this is what will be changed to add an image of a journal and a fancier entry browsing / display method
	echo '<div class="container">';
	echo '<h1>Journal: ' . $_SESSION['journalName'] . '</h1>';
    echo '<h3>Add new entry:</h3>';
    echo '<form action="newEntry.php" method="POST"><textarea name="entryText"></textarea>';
    echo '<input type="submit" value="Add Entry"></form>';
    foreach ($entries as $entry) {
    	echo '<h3>Entry from: ' . $entry['createDate'] . '</h3>';
    	echo '<h4>' . $entry['text'] . '</h4>';
    	echo '</br>';
    }
    echo '</div>';

} else { // user needs to login or sign up
	include 'modules/navBarTop.php';
	// display login box or sign up box
	include 'modules/loginOrSignup.php';
}

// Static bottom navbar
// include 'modules/navBarBottom.html'; // not sure if i need a bottom bar...

// if they refresh the home page without being logged in, we don't want to show the email already taken message again
if (!isset($_SESSION['loggedIn'])) {
	session_unset();
	session_destroy();
}


echo '</body>';
echo '</html>';
?>
