<!-- top nav bar -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Home</a>
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
        $journalCount = 3;
        if ($journalCount == 1) { // if logged in user only has one journal
          // display a single button for adding a new journal
          echo '<li><a href="#">New Journal</a></li>';
        } else { // if logged in user has more than one journal
          // display a drop down with all the journals, and a button at the bottom for adding a new journal
          $journals = array("My First Journal", "School Journal", "Scripture Study Journal"); // for demo
          echo '<li class="dropdown">';
          echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#">My Journals<span class="caret"></span></a>';
          echo '<ul class="dropdown-menu">';
          foreach ($journals as $journal) {
            echo '<li><a href="#">' . $journal . '</a></li>';
          }
          echo '<li class="divider"></li>';
          echo '<li><a href="#">New Journal</a></li>';
          echo '</ul>';
          echo '</li>';
        }
        ?>
        <!-- <li><a href="entries.php">My Journals</a></li> -->
        <li><a href="about.php">About</a></li>
      </ul>
      <!-- here we will need to put php to display different buttons based on sessions -->
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>

    </div>
  </div>
</nav>
