<?php
include_once 'helpers/init_conn_db.php';

// Process delete operation after confirmation
if (isset($_POST["UserID"]) && !empty($_POST["UserID"])) {
    // Prepare a delete statement
    $sql = "DELETE FROM User WHERE UserID = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_UserID);

        // Set parameters
        $param_UserID = $_POST["UserID"];

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records deleted successfully. Redirect to landing page
            header("location: users.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} else {
    // Check existence of UserID parameter
    if (empty(trim($_GET["UserID"]))) {
        alert('User ID not there');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f7ff; /* Light blue background */
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .confirmation-container {
            background-color: #ffffff; /* White background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }

        input[type="submit"] {
            background-color: #dc3545; /* Red button */
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #c82333; /* Darker red on hover */
        }

        input[type="button"] {
            background-color: #0074d9; /* Blue button */
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="button"]:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="confirmation-container">
        <h2 style="text-align: center; color: #dc3545;">Confirm Deletion</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group row">
                <p style="text-align: center; font-size: 18px;">Are you sure you want to delete this user?</p>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="hidden" name="UserID" value="<?php echo trim($_GET["UserID"]); ?>"/>
                    <input type="submit" value="Yes" style="width: 100%;">
                </div>
                <div class="col-sm-6">
                    <input type="button" value="No" style="width: 100%;" onclick="history.go(-1);">
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
