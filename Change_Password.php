<?php
session_start();
include_once 'connection.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $currentPassword = trim($_POST['CurrentPassword']);

        $newPassword = $_POST['NewPassword'];


        // Fetch the current password from the database
        $query = "SELECT Password FROM User WHERE UserID = $user_id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $storedPassword = $row['Password'];

            // Verify if the current password matches the stored password
            if ($currentPassword === $storedPassword) {
  
                $updateQuery = "UPDATE User SET `Password` = '$newPassword' WHERE UserID = $user_id";
                $updateResult = mysqli_query($conn, $updateQuery);

                if ($updateResult) {
                    echo 'Password updated successfully.';
                } else {
                    echo 'Error updating password.';
                }
            } else {
                echo 'Current password is incorrect.';
            }
        } else {
            echo 'User not found.';
        }
    } else {
        echo 'Invalid request.';
    }
} else {
    echo 'User session not found.';
}
?>
