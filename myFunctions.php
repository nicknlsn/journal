<?php
function loadDatabase() {

  $dbHost = "";
  $dbPort = "";
  $dbUser = "";
  $dbPassword = "";

  $dbName = "Journal";

  $openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');

  if ($openShiftVar === null || $openShiftVar == "") {
    // Not in the openshift environment
    //echo "Using local credentials: ";
    require("localDBCredentials.php");
  } else {
    // In the openshift environment
    //echo "Using openshift credentials: ";
    $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
    $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
    $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
    $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
  }

  //echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br >\n";
  $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  // this line makes PDO give us an exception when there are problems
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  return $db;
}

function getJournals($db) {
  // this query returns the journals for this user, with the first row being the one with the latest entry
  // $query = "SELECT DISTINCT journal.id, journal.name FROM journal LEFT JOIN entry ON entry.journalId=journal.id WHERE journal.userId=:userId ORDER BY entry.createDate DESC"; // maybe don't need this here
  $query = "SELECT DISTINCT name, id from journal WHERE userId=:userId";
  $stmtJournalInfo = $db->prepare($query);
  $stmtJournalInfo->bindValue(':userId', $_SESSION['userId'], PDO::PARAM_INT);
  $stmtJournalInfo->execute();
  $journals = $stmtJournalInfo->fetchAll(PDO::FETCH_ASSOC); // fetch all to get all rows, each row representing a journal

  if ($journals) {
    // return array(
    //     // 'journalId'=>$journals[0]['id'],     // id of last used journal
    //     // 'journalName'=>$journals[0]['name'], // name of lase used journal
    //     'journals'=>$journals,               // all of this users journal ids and names, used for the navbar drop down menu
    //     'numJournals'=>count($journals)      // the number of journals this user has, used for the navbar drop down menu
    //     );
    $_SESSION['numJournals'] = count($journals);
    return $journals;
  } else {
    $_SESSION['newUser'] = true;
    $_SESSION['numJournals'] = 0;
    return "newUser";
  }
}

  // get all the entries for a particular journal
function getEntries($db, $journalId) {
  $stmt = $db->prepare("SELECT createDate, text FROM entry WHERE journalId=:journalId;");
  $stmt->bindValue(':journalId', $journalId, PDO::PARAM_INT);
  $stmt->execute();
  $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $entriesReversed = array_reverse($entries);
  return $entriesReversed;
}

function getLastJournalId($db, $userId) {
  $query = "SELECT journal.id, journal.name FROM journal LEFT JOIN entry ON entry.journalId=journal.id WHERE userId=:userId ORDER BY entry.createDate DESC LIMIT 1";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
  $stmt->execute();
  $results = $stmt->fetch(PDO::FETCH_ASSOC);
  $returnInfo = array('id'=>$results['id'], 'name'=>$results['name']);
  return $returnInfo;
}

?>
