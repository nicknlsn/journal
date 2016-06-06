<?php

?>

<!DOCTYPE html>
<html lang="en">

<?php
include 'modules/headBlock.html';

echo '<body>';

// top nav bar
include 'modules/navBarTop.php';
?>

<div class="container">
  <h3>About This Site</h3>
  <!-- <p>In this example, the navigation bar is hidden on small screens and replaced by a button in the top right corner (try to re-size this window). -->
  <p>This site was created as a project for CS313 at BYU-I. It is a simple journal keeping application that allows users to sign up for a free account, create journals, and write in them.</p>
  <p>The purpose is to demonstrate a good understanding of client-side/server-side communication with PHP, and also demonstrate a good understanding of database design, retrieval, and modification.</p>
</div>

<!-- Static bottom navbar -->
<?php // not sure if i need a bottom bar
// include 'modules/navBarBottom.html';
?>

</body>
</html>
