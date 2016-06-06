<?php
// session_start(); // don't need this here because this code is called from another PHP file that already does this

?>

<!-- top nav bar -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Journal</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <!-- <li class="active"><a href="#">Home</a></li> -->
        <!-- TODO change this to only show a drop down when there are more than one journal. make it dynamic. -->
        <!-- if there is only one journal, make it just a button that says "New Journal" -->
        <!-- <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">My Journals<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Journal 1</a></li>
            <li><a href="#">Journal 2</a></li>
            <li><a href="#">Journal 3</a></li>
          </ul>
        </li> -->
        <?php
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
          if ($_SESSION['numJournals'] < 2) { // if logged in user only has one journal
            // display a single button for adding a new journal
            echo '<li><a href="newJournal.php">Create New Journal</a></li>';
          } else { // if logged in user has more than one journal
            // display a drop down with all the journals, and a button at the bottom for adding a new journal
            echo '<li class="dropdown">';
            echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#">My Journals<span class="caret"></span></a>';
            echo '<ul class="dropdown-menu">';
            foreach ($_SESSION['journals'] as $journal) {
              echo '<li><a href="index.php?journal='.$journal['name'].'&journalId='.$journal['id'].'">'.$journal['name'].'</a></li>';
            }
            echo '<li class="divider"></li>';
            echo '<li><a href="newJournal.php">Create New Journal</a></li>';
            echo '</ul>';
            echo '</li>';
          }
        }
        ?>
        <!-- <li><a href="entries.php">My Journals</a></li> -->
      </ul>
      <!-- here we will need to put php to display different buttons based on sessions -->
      <ul class="nav navbar-nav navbar-right">
        <li><a href="about.php">About</a></li>
        <?php
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) { // show a logout button in navbar, and open journal on top of background
          echo '<li><a href="#">' . $_SESSION['username'] . '</a></li>';
          echo '<li><a href="logout.php">Logout</a></li>';
        }
        // else { // show a login button and a sign up button. NO! show a closed journal with login window on top
        //   echo '<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
        //   include 'modules/loginDropdown.php';
        // }
        ?>
      </ul>

      <!-- <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul> -->

    </div>
  </div>
</nav>
