<?php

session_start();

include_once('connection.php');
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// require('PHPMailer\PHPMailer.php');
// require('PHPMailer\SMTP.php');
// require('PHPMailer\Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


include_once('PHPMailer/Exception.php');
include_once('PHPMailer/PHPMailer.php');
include_once('PHPMailer/SMTP.php');


if (isset($_POST['btn'])) {
    // Get the OTP entered by the user
    $enteredOTP = $_POST['otp'];

    // Query to fetch the email and token based on the entered OTP
    $query = "SELECT Email, Token FROM token WHERE OTP = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $enteredOTP); // Assuming OTP is an integer
    $stmt->execute();
    $stmt->store_result();

    // If a record with the entered OTP exists
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($email, $token);
        $stmt->fetch();

        // Set retrieved email and token in session
        $_SESSION['forget_em'] = $email;
        $_SESSION['forget_token'] = $token;

        // Redirect to new password page
        header("Location: new_password.php");
        exit();
    } else {
        // No record found with the entered OTP
        $_SESSION['error'] = "Invalid OTP. Please try again.";
        header("Location: forget_password_otp.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password OTP</title>

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.1);
        }
        .card-title {
            font-size: 1.5rem;
        }
        .form-control {
            margin-bottom: 1rem;
        }
        .btn-block {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h3 class="card-title text-center mb-4">Forget Password OTP</h3>
                <?php if(isset($_GET['error_msg'])) { ?>
                    <p class="text-center text-danger"><?php echo $_GET['error_msg']; ?></p>
                <?php } ?>
                <form action="forget_password_otp_action.php" method="post">
                    <input type="text" class="form-control" name="otp" placeholder="Enter OTP" required>
                    <button type="submit" class="btn btn-primary bsb-btn-xl btn-block" name="btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
