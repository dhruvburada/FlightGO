
<?php session_start(); 


 // Start the session
include_once('helpers/init_conn_db.php'); 

if(isset($_POST["submit"])) {

  $username = $_POST["username"];
  $password = $_POST["password"];


  $sql = "SELECT * FROM `Admin` WHERE Username = '$username'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    // Check if the query returned any rows
    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_assoc($result);
        $_SESSION["admin_id"] = $result['AdminID'];

        echo '<script>';
        echo 'console.log("Admin ID: ' . $_SESSION['admin_id'] . '");';
        echo 'window.location.href="index.php"';
        echo '</script>';

        // header("Location: index.php");
        exit;
    } else {
        setcookie("error_message", "Invalid username or password. Please try again.", time() + 5, "/");
    }
} else {
    setcookie("error_message", "Error executing query. Please try again.", time() + 5, "/");
}
// header("Location: login.php");
exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/registrations/registration-3/assets/css/registration-3.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

    <style>
        .error {
            color: red;
        }
    </style>
<script>
$(document).ready(function() {
    $('#LoginForm').validate({
        rules: {
            username: {
                required: true,
                regex: /^[a-zA-Z0-9_]+$/
            },
            password: {
                required: true,
                minlength: 8,
                regex: /^[a-zA-Z0-9!@#$%^&*()_+]+$/
            }
        },
        messages: {
            username: {
                required: "Please enter your username",
                regex: "Username must contain only letters, numbers, and underscores"
            },
            password: {
                required: "Please enter a password",
                minlength: "Your password must be at least 8 characters long",
                regex: "Password must contain only letters, numbers, and symbols"
            }
        }
    });
});
</script>



</head>
    <!-- Your login form HTML goes here -->



    <body>

    

<section class="p-3 p-md-4 p-xl-5">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
        <div class="d-flex flex-column justify-content-between h-100 p-3 p-md-4 p-xl-5">
          <h3 class="m-0">Welcome!</h3>
          <img class="img-fluid rounded mx-auto my-4" loading="lazy" src="../img/FlightGO.jpeg" width="245" height="80" alt="BootstrapBrain Logo">
          <p class="mb-0"></p>
        </div>
      </div>
      <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
        <div class="p-3 p-md-4 p-xl-5">
          <div class="row">
            <div class="col-12">
              <div class="mb-5">
                <h2 class="h3">Login</h2>
                <h3 class="fs-6 fw-normal text-secondary m-0">Enter Login Details to continue</h3>
              </div>
            </div>
          </div>
          <form action="admin_login.php" method="post" enctype="multipart/form" id="LoginForm">
            <div class="row gy-3 gy-md-4 overflow-hidden">

              <div class="col-12">
                <label for="email" class="form-label">User Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username">
                <div id="email-error" class="error"></div>
              </div>
              <div class="col-12">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="password" id="password" value="">
              </div>
              <div class="col-12">
                <div class="d-grid">
                  <button class="btn bsb-btn-xl btn-primary" type="submit" name="submit" id="submit">Sign in</button>
                </div>
              </div>
            </div>
          </form>
        
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </body>
</html>
