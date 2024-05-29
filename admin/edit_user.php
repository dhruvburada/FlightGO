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
        $Email = trim($_POST["Email"]);
    }

    // Validate IsActive
    if (empty(trim($_POST['IsActive']))) {
        $IsActive_err = "Please specify active status.";
    } elseif (($_POST['IsActive'] != '0') && ($_POST['IsActive'] != '1')) {
        $IsActive_err = "Please enter a valid active status (0 or 1).";
    } else {
        $IsActive = trim($_POST['IsActive']);
    }

    // Validate password
    if (!empty(trim($_POST["Password"])) && !empty(trim($_POST["VerifyPassword"]))) {
        if (strlen(trim($_POST["Password"])) < 6) {
            $Password_err = "Password must have at least 6 characters.";
        } elseif ($_POST["Password"] != $_POST["VerifyPassword"]) {
            $VerifyPassword_err = "Password did not match.";
        } else {
            $Password = trim($_POST["Password"]);
        }
    }

    // Check input errors before updating in database
    if (empty($Email_err) && empty($IsActive_err) && empty($Password_err) && empty($VerifyPassword_err)) {
        // Prepare an update statement
        if (!empty($Password)) {
            $sql = "UPDATE User SET Email = ?, Password = ?, IsActive = ? WHERE UserID = ?";
            if ($stmt = $conn->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("ssii", $param_Email, $param_Password, $param_IsActive, $param_UserID);

                // Set parameters
                $param_Email = $Email;
                $param_Password = password_hash($Password, PASSWORD_DEFAULT);
                $param_IsActive = $IsActive;
                $param_UserID = $_GET["UserID"];

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Redirect to users page
                    header("location: users.php");
                    exit();
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                $stmt->close();
            }
        } else {
            $sql = "UPDATE user SET Email = ?, IsActive = ? WHERE UserID = ?";
            if ($stmt = $conn->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("sii", $param_Email, $param_IsActive, $param_UserID);

                // Set parameters
                $param_Email = $Email;
                $param_IsActive = $IsActive;
                $param_UserID = $_GET["UserID"];

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Redirect to users page
                    header("location: users.php");
                    exit();
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                $stmt->close();
            }
        }
    }

    // Close connection
    $conn->close();
} else {
    // Prepare a select statement
    $sql = "SELECT Email, IsActive FROM user WHERE UserID = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_UserID);

        // Set parameters
        $param_UserID = $_GET["UserID"];

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // Fetch result row as an associative array
                $row = $result->fetch_assoc();

                // Retrieve individual field value
                $Email = $row["Email"];
                $IsActive = $row["IsActive"];
            } else {
                // URL doesn't contain valid UserID. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    $stmt->close();
}
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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
        <h2 style="text-align: center; color: #0074d9;">Edit User</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?UserID=' . $_GET['UserID']; ?>" method="post">
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
                    <input type="password" id="Password" name="Password" value="<?php echo $Password; ?>">
                    <span class="error"><?php echo $Password_err; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="VerifyPassword" class="col-sm-3 col-form-label">Verify Password:</label>
                <div class="col-sm-9">
                    <input type="password" id="VerifyPassword" name="VerifyPassword" value="<?php echo $VerifyPassword; ?>">
                    <span class="error"><?php echo $VerifyPassword_err; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="IsActive" class="col-sm-3 col-form-label">Active Status:</label>
                <div class="col-sm-9">
                    <select id="IsActive" name="IsActive" required>
                        <option value="" disabled>Select active status</option>
                        <option value="1" <?php if ($IsActive == "1") echo 'selected="selected"'; ?>>Active</option>
                        <option value="0" <?php if ($IsActive == "0") echo 'selected="selected"'; ?>>Inactive</option>
                    </select>
                    <span class="error"><?php echo $IsActive_err; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="submit" value="Update User" style="width: 100%;">
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
