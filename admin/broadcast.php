<?php
include_once('helpers/init_conn_db.php');
include_once('header.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

include_once('PHPMailer/Exception.php');
include_once('PHPMailer/PHPMailer.php');
include_once('PHPMailer/SMTP.php');

if (isset($_POST['submit'])  && isset($_POST['message'])) {

        $sql = "SELECT Email FROM Customer";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
            
                $to_email=$row['Email'];

                $mail = new PHPMailer(true);

               

                // Send email using PHPMailer
                // $mail = new PHPMailer(true);
                try {
                    
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'SMTP Email/Username'; // Your SMTP email
                    $mail->Password = 'SMTP Password'; // Your SMTP password
                    $mail->SMTPSecure = "ssl";
                    $mail->Port = 465;
                    $mail->SMTPDebug = 0;

                    $mail->isHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body = $body;

                    $mail->setFrom('Sender Email', 'Sender Name '); // Sender's email and name
                    $mail->addAddress($to_email); // Recipient email
                    $mail->Subject = 'Notification';
                    $mail->Body = $_POST['message']; // Body of the email

                    if ($mail->send()) {
                        
                        setcookie("success", "BroadCast Successfull", time() + 2, "/");
                        foreach ($_COOKIE as $key => $value) {
                            setcookie($key, "", time() - 3600, "/");
                        }
                        echo'<script>window.location.href="index.php";</script>'
                    } else {
                        setcookie("error", "Error in sending mail. Please try again later.", time() + 2, "/");
                        echo'<script>window.location.href="index.php";</script>'
                    }
                } catch (Exception $e) {
                    echo "Email sending failed. Error: {$mail->ErrorInfo}";
                    echo'<script>window.location.href="index.php";</script>'
                }
            }
        }
    } else {
        setcookie("error", "Error in registration. Please try again later.", time() + 2, "/");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Broadcast Message</title>
    <style>
        .body {
            font-family: Arial, sans-serif;
            background-color: #f0f7ff; /* Light blue background */
        }
        .broadcast {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100vh;
        }
        .form-container {
            background-color: #ffffff; /* White background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 400px;
        }
        .form-group textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
        }
        .form-group input[type="submit"] {
            background-color: #0074d9; /* Blue button */
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body class="body">
<div class="container broadcast">
    <div class="form-container">
        <h2 style="text-align: center; color: #0074d9;">Broadcast Message</h2>
        <form action="broadcast.php" method="post">
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" cols="20" required></textarea>
                <span class="error"></span>
            </div>
            <div class="form-group">
                <input type="submit" value="Send" name="submit">
            </div>
        </form>
    </div>
</div>
</body>
</html>
