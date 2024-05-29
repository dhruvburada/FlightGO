<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/registrations/registration-3/assets/css/registration-3.css">

<!-- Jquery -->


<style>
      .error{
        color:red
      } 

</style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>


    <script>

$(document).ready(function() {
    $('#registrationForm').validate({
        rules: {
            firstName: {
                required: true,
                regex: /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/
            },
            lastName: {
                required: true,
                regex: /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: 'check_email.php',
                    type: 'post',
                    data: {
                        email: function() {
                            return $('#email').val();
                        }
                    }
                },
                regex: /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
            },
            password: {
                required: true,
                minlength: 8,
                regex: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/
            },
            iAgree: {
                required: true
            }
        },
        messages: {
            firstName: {
                required: "Please enter your first name",
                regex: "Please enter a valid first name"
            },
            lastName: {
                required: "Please enter your last name",
                regex: "Please enter a valid last name"
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address",
                remote: "Email already exists",
                regex: "Please enter a valid email address"
            },
            password: {
                required: "Please enter a password",
                minlength: "Your password must be at least 8 characters long",
                regex: "Password must contain at least one uppercase letter, one lowercase letter, and one number"
            },
            iAgree: {
                required: "You must agree to the terms and conditions"
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

<script>
$(document).ready(function() {
    $('#email').blur(function() {
        var email = $(this).val();
        $.ajax({
            url: 'check_mail.php',
            type: 'POST',
            data: { email: email },
            success: function(response) {
                if (response == 'exists') {
                    $('#email-error').text('Email already exists').show();
                    // Prevent form submission
                    $('#registrationForm').off('submit').submit(function(e) {
                        e.preventDefault();
                    });
                } else {
                    $('#email-error').hide();
                    // Allow form submission
                    $('#registrationForm').off('submit').submit(function() {
                        return true;
                    });
                }
            }
        });
    });
});

</script>

</head>


<body>
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
                <h2 class="h3">Registration</h2>
                <h3 class="fs-6 fw-normal text-secondary m-0">Enter your details to register</h3>
              </div>
            </div>
          </div>
          <form action="Registration.php" method="post" enctype="multipart/form" id="registrationForm">
            <div class="row gy-3 gy-md-4 overflow-hidden">
              <div class="col-12">
                <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name">
              </div>
              <div class="col-12">
                <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name">
              </div>
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
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" name="iAgree" id="iAgree">
                  <label class="form-check-label text-secondary" for="iAgree">
                    I agree to the <a href="#!" class="link-primary text-decoration-none">terms and conditions</a>
                  </label>
                </div>
              </div>
              <div class="col-12">
                <div class="d-grid">
                  <button class="btn bsb-btn-xl btn-primary" type="submit" name="submit" id="submit">Sign up</button>
                </div>
              </div>
            </div>
          </form>
          <div class="row">
            <div class="col-12">
              <hr class="mt-5 mb-4 border-secondary-subtle">
              <p class="m-0 text-secondary text-end">Already have an account? <a href="login.php" class="link-primary text-decoration-none">Sign in</a></p>
            </div>
          </div>
        
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
include_once ('connection.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


include_once('PHPMailer/Exception.php');
include_once('PHPMailer/PHPMailer.php');
include_once('PHPMailer/SMTP.php');


if (isset($_POST['submit'])) {
  $fn = $_POST['firstName'];
  $ln = $_POST["lastName"];
  $em = $_POST['email'];
  $pwd = $_POST['password'];
  $token = uniqid() . uniqid();

  $q = "INSERT INTO `User`(`Email`, `Password`,`Token`) VALUES ('$em','$pwd','$token')";
  if (mysqli_query($conn, $q)) {

    $mail = new PHPMailer(true);
      try {



          // Server settings
          $mail->SMTPDebug = SMTP::DEBUG_SERVER;  
          $mail->isSMTP(); // Set mailer to use SMTP
          $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
          $mail->SMTPAuth = true; 
          $mail->Username = 'ironbins001@gmail.com'; // SMTP username
          $mail->Password = 'ngcp wksc ygwu jkkd'; // SMTP password
          $mail->SMTPSecure = "ssl";
          $mail->Port = 465; // TCP port to connect to
          $mail->SMTPDebug = 2;
          // Recipients
          $mail->setFrom('ironbins001@gmail.com', 'Dhruv Burada'); // Sender's email address and name
          $mail->addAddress($em, $fn); // Recipient's email address and name
          
          // Attachments
          //$mail->addAttachment('/path/to/attachment/file.pdf', 'Attachment.pdf'); // Path to the attachment and optional filename

          // Content
          $mail->isHTML(true); // Set email format to HTML
          $mail->Subject = 'Account Verification';
          $mail->Body    = '
          <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff;
        }
        p {
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Account Confirmation</h1>
        <p>Congratulations,' . $fn . '! Your account has been created successfully.</p>
        <p>This email is for your account verification.</p>
        <p>Kindly click on the link below to verify your account. You will be able to login into your account only after account verification.</p>
        <a class="btn" href="http://localhost/FlightBooking/verify_account.php?em='.$em.'&token='.$token.'">Click here to verify your account</a>
    </div>
</body>
</html>
';

          // Send the email
          if ($mail->send()) {
              setcookie("success", "Registration Successfull. Activation mail is sent to your registered email account. Kindly activate your account to login.", time() + 2, "/");
?>
              <script>
                  window.location.href = "login.php";
              </script>
          <?php
          } else {

              setcookie("error", "Error in sending mail. Please try again later.", time() + 2, "/");
          ?>
              <script>
                  window.location.href = "Registration.php";
              </script>
      <?php
          }
      } catch (Exception $e) {
          echo "Email sending failed. Error: {$mail->ErrorInfo}";
      }
  } else {
      setcookie("error", "Error in registration. Please try again later.", time() + 2, "/");
      ?>
      <script>
          window.location.href = "Registration.php";
      </script>



<?php
  }
}
?>

</section>
</body>
</html>

