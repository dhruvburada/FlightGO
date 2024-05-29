<?php
session_start(); // Start the session

include_once('connection.php');

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
