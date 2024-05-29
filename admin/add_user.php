<?php
ob_start();
include_once 'helpers/init_conn_db.php';
include_once 'header.php';

// Define variables and initialize with empty values
$Email = $Password = $VerifyPassword = $IsActive = "";
$Email_err = $Password_err = $VerifyPassword_err = $IsActive_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Email
    if (empty(trim($_POST["Email"]))) {
        $Email_err = "Please enter an email.";
    } else {
        // Prepare a select statement
        $sql = "SELECT UserID FROM user WHERE Email = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_Email);

            // Set parameters
            $param_Email = trim($_POST["Email"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // store result
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $Email_err = "This email is already taken.";
                } else {
                    $Email = trim($_POST["Email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Validate Password
    if (empty(trim($_POST['Password']))) {
        $Password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST['Password'])) < 6) {
        $Password_err = "Password must have at least 6 characters.";
    } else {
        $Password = trim($_POST['Password']);
    }

    // Validate Verify Password
    if (empty(trim($_POST["VerifyPassword"]))) {
        $VerifyPassword_err = "Please verify password.";
    } else {
        $VerifyPassword = trim($_POST["VerifyPassword"]);
        if (empty($Password_err) && ($Password != $VerifyPassword)) {
            $VerifyPassword_err = "Passwords did not match.";
        }
    }

    // Validate IsActive
    if (empty(trim($_POST['IsActive']))) {
        $IsActive_err = "Please specify active status.";
    } elseif (($_POST['IsActive'] != '0') && ($_POST['IsActive'] != '1')) {
        $IsActive_err = "Please enter a valid active status (0 or 1).";
    } else {
        $IsActive = trim($_POST['IsActive']);
    }

    // Check input errors before inserting in database
    if (empty($Email_err) && empty($Password_err) && empty($VerifyPassword_err) && empty($IsActive_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO User (Email, Password, IsActive) VALUES (?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssi", $param_Email, $param_Password, $param_IsActive);

            // Set parameters
            $param_Email = $Email;
            $param_Password = password_hash($Password, PASSWORD_DEFAULT); // Creates a password hash
            $param_IsActive = $IsActive;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to add user page
                header("location: users.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
ob_end_flush(); // End output buffering and flush buffer contents
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
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

        .form-container {
            background-color: #ffffff; /* White background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #0074d9; /* Blue button */
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="form-container">
            <h2 style="text-align: center; color: #0074d9;">Add User</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group row">
                    <label for="Email" class="col-sm-3 col-form-label">Email:</label>
                    <div class="col-sm-9">
                        <input type="text" id="Email" name="Email" value="<?php echo $Email; ?>" required>
                        <span class="error"><?php echo $Email_err; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Password" class="col-sm-3 col-form-label">Password:</label>
                    <div class="col-sm-9">
                        <input type="password" id="Password" name="Password" value="<?php echo $Password; ?>" required>
                        <span class="error"><?php echo $Password_err; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="VerifyPassword" class="col-sm-3 col-form-label">Verify Password:</label>
                    <div class="col-sm-9">
                        <input type="password" id="VerifyPassword" name="VerifyPassword" value="<?php echo $VerifyPassword; ?>" required>
                        <span class="error"><?php echo $VerifyPassword_err; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="IsActive" class="col-sm-3 col-form-label">Active Status:</label>
                    <div class="col-sm-9">
                        <select id="IsActive" name="IsActive" required>
                            <option value="" disabled selected>Select active status</option>
                            <option value="1" <?php if ($IsActive == "1") echo 'selected="selected"'; ?>>Active</option>
                            <option value="0" <?php if ($IsActive == "0") echo 'selected="selected"'; ?>>Inactive</option>
                        </select>
                        <span class="error"><?php echo $IsActive_err; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="submit" value="Add User" style="width: 100%;">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
