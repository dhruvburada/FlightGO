<?php
include_once 'connection.php'; // Include the connection.php file to establish a database connection

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// require('PHPMailer\PHPMailer.php');
// require('PHPMailer\SMTP.php');
// require('PHPMailer\Exception.php');

include_once ('connection.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


include_once('PHPMailer/Exception.php');
include_once('PHPMailer/PHPMailer.php');
include_once('PHPMailer/SMTP.php');


$error_msg = ""; // Initialize error message variable

if (isset($_POST['btn'])) {
    $email = $_POST['em'];
    
    // Check if the email exists in the database
    $query = "SELECT * FROM User WHERE Email='$email'";
    $result = mysqli_query($conn, $query);
    echo "hi";
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        // Generate OTP and token
        $token = bin2hex(random_bytes(32));
        $otp = mt_rand(100000, 999999);
        
        // Insert token and OTP into the database
        $insert_token_query = "INSERT INTO token (Email, Token, OTP) VALUES ('$email', '$token', $otp)";
        if (mysqli_query($conn, $insert_token_query)) {
            $mail = new PHPMailer();
            try {
                // Email 
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;  
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'SMTP EMAIL'; // Your SMTP Email
                $mail->Password = 'SMTP PASSWORD'; // Your SMTP password
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->SMTPDebug = 2;
                
                // Set sender and recipient
                $mail->setFrom('Sender Email', 'Sender Name'); 
                $mail->addAddress($email);
                
                // Email content
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset';
                $mail->Body = 'Your OTP to reset your account password is ' . $otp;
                
                // Send email
                if ($mail->send()) {
                    // Redirect to forget_password_otp.php
                    header("Location: forget_password_otp.php?email=" . urlencode($email));
                    exit();
                } else {
                    $error_msg = "Error in sending OTP. Please try again later.";
                }
            } catch (Exception $e) {
                echo "Email sending failed. Error: {$mail->ErrorInfo}";
            }
        } else {
            $error_msg = "Error in generating OTP. Please try again later.";
        }
    } else {
        $error_msg = "Email not found in our records. Please register first.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>

    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/registrations/registration-3/assets/css/registration-3.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

    <style>
        .error {
            color:red;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#form1').validate({
                rules: {
                    em: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    em: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    }
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function(form) {
                    form.submit(); // Submit the form if validation passes
                }
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
                                    <h2 class="h3">Forget Password</h2>
                                    <h3 class="fs-6 fw-normal text-secondary m-0">Enter email to change password</h3>
                                    <?php if (!empty($error_msg)) : ?>
                                        <div class="alert alert-danger"><?php echo $error_msg; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <form action="" method="post" id="form1">
                            <div class="row gy-3 gy-md-4 overflow-hidden">
                                <div class="form-group">
                                    <label for="em">Email:</label>
                                    <input type="email" class="form-control" id="em" placeholder="Enter email" name="em">
                                </div>
                                <button type="submit" class="btn btn-primary" style="color:white;font-weight:bold;" name="btn">Send OTP</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>


bsb-btn-xl
