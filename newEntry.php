<?php
session_start();
require("myFunctions.php"); // get database connected
$db = loadDatabase();

// insert into database
$text = $_POST['entryText'];

$query = "INSERT INTO entry(journalId, createDate, text) VALUES (:journalId, :createDate, :text)";
$stmt = $db->prepare($query);
$stmt->bindValue(':journalId', $_SESSION['journalId'], PDO::PARAM_INT);
$stmt->bindValue(':createDate', date("Y-m-d H-i-s"), PDO::PARAM_STR);
$stmt->bindValue(':text', $text, PDO::PARAM_STR);
$stmt->execute();

header("Location: /");
?>
