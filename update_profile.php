<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the field name and new value from the form
    $fieldName = $_POST['field_name'];
    $newValue = $_POST['new_value'];

    // Check if the user is logged in
    if(isset($_SESSION['user_id'])) {
        include_once 'connection.php'; // Include database connection

        // Get the user ID from the session
        $user_id = $_SESSION['user_id'];

        // Prepare the SQL query based on the field name
        switch ($fieldName) {
            case 'First Name':
                $query = "UPDATE Customer SET FirstName = '$newValue' WHERE UserID = $user_id";
                break;
            case 'Last Name':
                $query = "UPDATE Customer SET LastName = '$newValue' WHERE UserID = $user_id";
                break;
            case 'Email':
                $query = "UPDATE Customer SET Email = '$newValue' WHERE UserID = $user_id";
                break;
            case 'Phone':
                $query = "UPDATE Customer SET Phone = '$newValue' WHERE UserID = $user_id";
                break;
            case 'Nationality':
                $query = "UPDATE Customer SET Nationality = '$newValue' WHERE UserID = $user_id";
                break;
            case 'Age':
                $query = "UPDATE Customer SET Age = '$newValue' WHERE UserID = $user_id";
                break;
            case 'Country':
                $query = "UPDATE Customer SET Country = '$newValue' WHERE UserID = $user_id";
                break;
            case 'State':
                $query = "UPDATE Customer SET `State` = '$newValue' WHERE UserID = $user_id";
                break;
            case 'PostalCode':
                $query = "UPDATE Customer SET PostalCode = '$newValue' WHERE UserID = $user_id";
                break;    
            default:
                // Handle unsupported field name
                echo "Error: Unsupported field name";
                exit();
        }

        // Execute the query
        if(mysqli_query($conn, $query)) {
            // Update successful
            echo "Data updated successfully";
            header("Location: MyProfile.php");
            exit();
        } else {
            // Error occurred during update
            echo "Error updating data: " . mysqli_error($conn);
        }

        // Close database connection
        mysqli_close($conn);
    } else {
        // User is not logged in
        include "AccessDenied.php";
    }
} else {
    echo "Form data not received";
}
?>
