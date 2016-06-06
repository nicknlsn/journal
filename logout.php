<?php
session_start();
session_unset();
session_destroy();
header('Location: /'); // redirect to index.php
?>
