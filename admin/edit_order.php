<?php
ob_start();
include_once 'helpers/init_conn_db.php';
include_once 'header.php';

// Define variables and initialize with empty values
$OrderID = $OrderAmount = $UserID = $FlightID = $PaymentScreenshotFile = $PaymentStatus = "";
$OrderID_err = $OrderAmount_err = $UserID_err = $FlightID_err = $PaymentStatus_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate OrderID
    $input_OrderID = trim($_POST["OrderID"]);
    if (empty($input_OrderID)) {
        $OrderID_err = "Please enter the OrderID.";
    } elseif (!ctype_digit($input_OrderID)) {
        $OrderID_err = "Please enter a positive integer value.";
    } else {
        $OrderID = $input_OrderID;
    }

    // Validate OrderAmount
    $input_OrderAmount = trim($_POST["OrderAmount"]);
    if (empty($input_OrderAmount)) {
        $OrderAmount_err = "Please enter the order amount.";
    } else {
        $OrderAmount = $input_OrderAmount;
    }

    // Validate UserID
    $input_UserID = trim($_POST["UserID"]);
    if (empty($input_UserID)) {
        $UserID_err = "Please enter the UserID.";
    } else {
        $UserID = $input_UserID;
    }

    // Validate FlightID
    $input_FlightID = trim($_POST["FlightID"]);
    if (empty($input_FlightID)) {
        $FlightID_err = "Please enter the FlightID.";
    } else {
        $FlightID = $input_FlightID;
    }

    // Validate PaymentStatus
    $input_PaymentStatus = trim($_POST["PaymentStatus"]);
    if (empty($input_PaymentStatus)) {
        $PaymentStatus_err = "Please select the payment status.";
    } else {
        $PaymentStatus = $input_PaymentStatus;
    }

    // File upload
    $targetDir = "../payments/UPI";
    $fileName = basename($_FILES["PaymentScreenshotFile"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (!empty($_FILES["PaymentScreenshotFile"]["name"])) {
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to the server
            if (move_uploaded_file($_FILES["PaymentScreenshotFile"]["tmp_name"], $targetFilePath)) {
                $PaymentScreenshotFile = $fileName;
            } else {
                $PaymentScreenshotFile_err = "Sorry, there was an error uploading your file.";
            }
        } else {
            $PaymentScreenshotFile_err = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
    }

    // Check input errors before inserting into database
    if (empty($OrderID_err) && empty($OrderAmount_err) && empty($UserID_err) && empty($FlightID_err) && empty($PaymentStatus_err) && empty($PaymentScreenshotFile_err)) {
        // Prepare an update statement
        $sql = "UPDATE `Order` 
                SET OrderAmount=?, UserID=?, FlightID=?, PaymentScreenshotFile=?, PaymentStatus=? 
                WHERE OrderID=?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sissii", $param_OrderAmount, $param_UserID, $param_FlightID, $param_PaymentScreenshotFile, $param_PaymentStatus, $param_OrderID);

            // Set parameters
            $param_OrderAmount = $OrderAmount;
            $param_UserID = $UserID;
            $param_FlightID = $FlightID;
            $param_PaymentScreenshotFile = $PaymentScreenshotFile;
            $param_PaymentStatus = $PaymentStatus;
            $param_OrderID = $OrderID;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} else {
    // Check existence of OrderID parameter before processing further
    if (isset($_GET["OrderID"]) && !empty(trim($_GET["OrderID"]))) {
        // Get URL parameter
        $OrderID = trim($_GET["OrderID"]);

        // Prepare a select statement
        $sql = "SELECT * FROM `Order` WHERE OrderID = ?";
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_OrderID);

            // Set parameters
            $param_OrderID = $OrderID;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $OrderAmount = $row["OrderAmount"];
                    $UserID = $row["UserID"];
                    $FlightID = $row["FlightID"];
                    $PaymentScreenshotFile = $row["PaymentScreenshotFile"];
                    $PaymentStatus = $row["PaymentStatus"];
                } else {
                    // URL doesn't contain valid OrderID. Redirect to error page
                    alert('Doesnt Contains Valid OrderID');
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();

        // Close connection
        $conn->close();
    } else {
        // URL doesn't contain OrderID parameter. Redirect to error page
        exit();
    }
}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f7ff; /* Light blue background */
        }
        .container {
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* display: flex; */
            /* flex-direction:column; */
            
        }
    </style>
</head>
<body>

<div class="container mt-3 mb-0">
    <h2 style="text-align: center; color: #0074d9;">Edit Order</h2>
    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group <?php echo (!empty($OrderID_err)) ? 'has-error' : ''; ?>">
            <label>OrderID</label>
            <input type="text" name="OrderID" class="form-control" value="<?php echo $OrderID; ?>" readonly>
            <span class="help-block"><?php echo $OrderID_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($OrderAmount_err)) ? 'has-error' : ''; ?>">
            <label>OrderAmount</label>
            <input type="text" name="OrderAmount" class="form-control" value="<?php echo $OrderAmount; ?>">
            <span class="help-block"><?php echo $OrderAmount_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($UserID_err)) ? 'has-error' : ''; ?>">
            <label>UserID</label>
            <input type="text" name="UserID" class="form-control" value="<?php echo $UserID; ?>">
            <span class="help-block"><?php echo $UserID_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($FlightID_err)) ? 'has-error' : ''; ?>">
            <label>FlightID</label>
            <input type="text" name="FlightID" class="form-control" value="<?php echo $FlightID; ?>">
            <span class="help-block"><?php echo $FlightID_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($PaymentScreenshotFile_err)) ? 'has-error' : ''; ?>">
            <label>PaymentScreenshotFile</label>
            <input type="file" name="PaymentScreenshotFile" class="form-control" value="<?php echo $PaymentScreenshotFile; ?>">
            <span class="help-block"><!-- here --> </span> <!-- removed echo $PaymentScreenshotFile_err; -->
        </div>
        <div class="form-group <?php echo (!empty($PaymentStatus_err)) ? 'has-error' : ''; ?>">
            <label>PaymentStatus</label>
            <select name="PaymentStatus" class="form-control">
                <option value="Paid" <?php echo ($PaymentStatus == "Paid") ? "selected" : ""; ?>>Paid</option>
                <option value="Pending" <?php echo ($PaymentStatus == "Pending") ? "selected" : ""; ?>>Pending</option>
                <option value="Cancelled" <?php echo ($PaymentStatus == "Cancelled") ? "selected" : ""; ?>>Cancelled</option>
            </select>
            <span class="help-block"><?php echo $PaymentStatus_err; ?></span>
        </div>
        <input type="submit" class="btn btn-primary" value="Submit">
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>
</div>

</body>
</html>

