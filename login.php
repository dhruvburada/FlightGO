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
        .error
        {
            color:red;
        }
    </style>
    <script>
$(document).ready(function() {
    $('#LoginForm').validate({
        rules: {
            email: {
                required: true,
                email: true,
                regex: /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
            },
            password: {
                required: true,
                minlength: 8,
                regex: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/
            }
        },
        messages: {
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address",
                regex: "Please enter a valid email address"
            },
            password: {
                required: "Please enter a password",
                minlength: "Your password must be at least 8 characters long",
                regex: "Password must contain at least one uppercase letter, one lowercase letter, and one number"
            }
        },
        errorPlacement: function(error, element) {
            if (element.is(":checkbox")) {
                error.appendTo(element.parents('.form-check'));
            } else {
                error.appendTo(element.parent());
            }
        },
        submitHandler: function(form) {
            form.submit(); // Submit the form if validation passes and email does not exist
        }
    });
});


</script>

<?php include_once 'connection.php'; ?>

    <body>

    <?php

session_start(); // Start the session

if(isset($_POST["submit"])) {

  $email = $_POST["email"];
  $password = $_POST["password"];

  $q = "SELECT * FROM  `User` WHERE Email = '$email';";
  $result = mysqli_query($conn, $q);

  if($result) {
      // Check if the query returned any rows
      if(mysqli_num_rows($result) > 0){
          $result = mysqli_fetch_assoc($result);
          
          if($email == $result["Email"] && $password == $result["Password"]) {
              if($result["IsActive"]!=0) {
                  

                $_SESSION["user_id"] = $result['UserID'];

                echo '<script>';
                echo 'console.log("User ID: ' . $_SESSION['user_id'] . '");';
                echo '</script>';
                  
                
                
                // Check if flight_id session variable is set
                if (isset($_SESSION['flight_id'])) {
                    // If set, redirect to book_flight.php
                    header("Location: book_flight.php?flight_id=".$_SESSION['flight_id']);
                    exit();
                } else {
                    // If not set, redirect to index.php
                    header("Location: index.php");
                    exit();
                }
                
                
              } else {
                setcookie("error_message", "Please Activate your Account.", time() + 5, "/"); 
              }
          } else {
              setcookie("error_message", "Invalid email or password. Please try again.", time() + 5, "/");
          }
      } else {
          setcookie("error_message", "User with this email does not exist. Please try again.", time() + 5, "/");
      }
  } else {
      setcookie("error_message", "Error executing query. Please try again.", time() + 5, "/");
  }
  header("Location: login.php");
  exit;
}


if(isset($_COOKIE["error_message"])) {
  echo "<p class='alert alert-danger p-3 m-4 text-center' role='alert'>" . $_COOKIE["error_message"] . "</p>";
  setcookie("error_message", "", time() - 3600, "/");
}


?>
<section class="p-3 p-md-4 p-xl-5">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
        <div class="d-flex flex-column justify-content-between h-100 p-3 p-md-4 p-xl-5">
          <h3 class="m-0">Welcome!</h3>
          <img class="img-fluid rounded mx-auto my-4" loading="lazy" src="img/FlightGO.jpeg" width="245" height="80" alt="BootstrapBrain Logo">
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
          <form action="login.php" method="post" enctype="multipart/form" id="LoginForm">
            <div class="row gy-3 gy-md-4 overflow-hidden">

              <div class="col-12">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
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
          <div class="row mt-3">
            <div class="col-12">
              <div class="d-grid">
                <a href="forget_password.php" class="btn btn-outline-primary bsb-btn-xl">Forget Password?</a>
              </div>
            </div>
          </div>
                  <div class="row">
            <div class="col-12">
              <hr class="mt-5 mb-4 border-secondary-subtle">
              <p class="m-0 text-secondary text-end">Dont have an account? <a href="Registration.php" class="link-primary text-decoration-none">Sign up</a></p>
            </div>
          </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>




</body>
</html>



        
