
<?php session_start();
include_once('connection.php');
?>
<script src="https://kit.fontawesome.com/68e8fc477f.js" crossorigin="anonymous"></script>
<style>

/* Styles for smooth hover effects */
.nav-item:hover .nav-link {
  transition: all 0.3s ease;
  background-color: #E6E6FA;
  border-radius: 20px; /* Change this to your desired hover color */
}

/* Style for active page */
.nav-item.active .nav-link {
  background-color: #007bff; /* Change this to your desired active page color */
  color: #fff; /* Change this to your desired text color for active page */
  border-radius: 15px; /* Adjust the border-radius to your preference for rounded corners */
}


</style>

<!-- Nav BAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Flight GO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active'; ?>">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) == 'Aboutus.php') echo 'active'; ?>">
          <a class="nav-link" href="Aboutus.php">About us</a>
        </li>
        <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) == 'Contactus.php') echo 'active'; ?>">
          <a class="nav-link" href="Contactus.php">Contact us</a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <?php if(isset($_SESSION['user_id'])):
          $user_id = $_SESSION['user_id']; ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="d-none d-lg-inline"><i class="fas fa-user"></i></span>

            <span class="d-inline d-lg-none">My Profile</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            
          <?php 
              $query = "SELECT * FROM Customer WHERE UserID = $user_id";
              $result = mysqli_query($conn, $query);

              if (mysqli_num_rows($result) > 0) {
            
    
                echo'<li><a class="dropdown-item" href="MyProfile.php">View My Profile</a></li>';
              }
         ?>     
            <li><a class="dropdown-item" href="ChangePassword.php">Change Password</a></li>
            <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
          </ul>
        </li>
        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="Registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin/admin_login.php">Admin Login</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<!-- Nav Bar End -->
