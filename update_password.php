<?php

session_start();

include_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if passwords match
    if ($_POST['password'] != $_POST['confirm_password']) {
        $_SESSION['error'] = "Passwords do not match";
        header("Location: new_password.php");
        exit();
    }

    // Get email from session
    $email = $_SESSION['forget_em'];

    // Store the new password
    $password = $_POST['password'];

    // Update password in the database
    $sql = "UPDATE User SET Password = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $password, $email);
    if ($stmt->execute()) {
        // Delete the OTP entry
        $deleteSql = "DELETE FROM token WHERE Email = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("s", $email);
        $deleteStmt->execute();

        $_SESSION['success'] = "Password updated successfully";
        header("Location: login.php"); // Redirect to login page
        exit();
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again later.";
        header("Location: new_password.php");
        exit();
    }
}
?>
