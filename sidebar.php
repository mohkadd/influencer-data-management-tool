<!-- Sidebar -->
    <ul class="sidebar navbar-nav">
     <?php 
      if($_SESSION['admintype'] !== 4){
        ?>
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <?php 
      }
    ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-play"></i>
          <span>YouTube</span>
        </a>
        <?php
        if($_SESSION['admintype'] == 1){
        ?>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="youtube-dashboard.php">YouTube Dashboard</a>
          <a class="dropdown-item" href="view-youtube-data.php">View YouTube Data</a>
          <a class="dropdown-item" href="insert-youtube-data.php">Insert YouTube Data</a>
          <a class="dropdown-item" href="import-youtube-data.php">Import YouTube Data</a>
          <a class="dropdown-item" href="bulk-delete-youtube.php">Delete Youtube Data</a>          
        </div>
        <?php    
        }
        if($_SESSION['admintype'] == 2){
        ?>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="youtube-dashboard.php">YouTube Dashboard</a>
          <a class="dropdown-item" href="view-youtube-data.php">View YouTube Listing</a>
          <a class="dropdown-item" href="insert-youtube-data.php">Insert YouTube Data</a>
          <a class="dropdown-item" href="import-youtube-data.php">Import YouTube Data</a>
        </div>
        <?php     
        }
        if($_SESSION['admintype'] == 3){
        ?>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="youtube-dashboard.php">YouTube Dashboard</a>
          <a class="dropdown-item" href="view-youtube-data.php">View YouTube Listing</a>
        </div>
        <?php     
        }
        if($_SESSION['admintype'] == 4){
        ?>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="insert-youtube-data.php">Insert YouTube Data</a>
          <a class="dropdown-item" href="import-youtube-data.php">Import YouTube Data</a>
        </div>
        <?php     
        }
        ?>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-camera"></i>
          <span>Instagram</span>
        </a>
        <?php
        if($_SESSION['admintype'] == 1){
        ?>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="instagram-dashboard.php">Instagram Dashboard</a>
          <a class="dropdown-item" href="view-instagram-data.php">View Instagram Data</a>
          <a class="dropdown-item" href="insert-instagram-data.php">Insert Instagram Data</a>
          <a class="dropdown-item" href="import-instagram-data.php">Import Instagram Data</a>
          <a class="dropdown-item" href="bulk-delete-instagram.php">Delete Instagram Data</a>          
        </div>
        <?php    
        }
        if($_SESSION['admintype'] == 2){
        ?>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="instagram-dashboard.php">Instagram Dashboard</a>
          <a class="dropdown-item" href="view-instagram-data.php">View Instagram Listing</a>
          <a class="dropdown-item" href="insert-instagram-data.php">Insert Instagram Data</a>
          <a class="dropdown-item" href="import-instagram-data.php">Import Instagram Data</a>
        </div>
        <?php     
        }
        if($_SESSION['admintype'] == 3){
        ?>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="instagram-dashboard.php">Instagram Dashboard</a>
          <a class="dropdown-item" href="view-instagram-data.php">View Instagram Listing</a>
        </div>
        <?php     
        }
        if($_SESSION['admintype'] == 4){
        ?>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="insert-instagram-data.php">Insert Instagram Data</a>
          <a class="dropdown-item" href="import-instagram-data.php">Import Instagram Data</a>
        </div>
        <?php     
        }
        ?>
      </li>
      <?php
      if( $_SESSION['admintype'] == 1 ){
      ?>
      <li class="nav-item active">
        <a class="nav-link" href="view-user.php">
          <i class="fas fa-fw fa-user-circle"></i>
          <span>Users</span>
        </a>
      </li>
      <?php      
      }
      ?>
      <?php
      if( $_SESSION['admintype'] == 1 || $_SESSION['admintype'] == 2 ){
      ?>
      <li class="nav-item active">
        <a class="nav-link" href="view-city.php">
          <i class="fas fa-fw fa-city"></i>
          <span>City</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="view-state.php">
          <i class="fas fa-fw fa-map-marker"></i>
          <span>State</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="loghistory.php">
          <i class="fas fa-fw fa-history"></i>
          <span>Log History</span>
        </a>
      </li>
      <?php      
      }
      ?>
<!--
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-award"></i>
          <span>Instagram</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="inventory-dashboard.php">Instagram Dashboard</a>
          <a class="dropdown-item" href="view-all-inventory.php">View Instagram Listing</a>
          <a class="dropdown-item" href="insert-inventory.php">Insert Instagram Entry</a>
        </div>
      </li>
-->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Login Screens:</h6>
          <a class="dropdown-item" href="index.php">Login</a>
          <a class="dropdown-item" href="register.html">Register</a>
          <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Other Pages:</h6>
          <a class="dropdown-item" href="404.html">404 Page</a>
          <a class="dropdown-item" href="blank.html">Blank Page</a>
        </div>
      </li> -->
    </ul>