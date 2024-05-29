<?php
include_once 'helpers/init_conn_db.php';
include_once 'header.php';



// Define variables and initialize with empty values
$OrderID = $OrderAmount = $UserID = $FlightID = $PaymentScreenshotFile = $PaymentStatus = "";
$OrderID_err = $OrderAmount_err = $UserID_err = $FlightID_err = $PaymentScreenshotFile_err = $PaymentStatus_err = "";

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
// File upload
$targetDir = "../img/payments/UPI";
$fileName = basename($_FILES["OrderFile"]["name"]);

// Generate unique ID for the filename
$uniqueId = uniqid();

// Extract file extension
$fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

// Construct the new filename
$newFileName = "payment_" . $uniqueId . "." . $fileExtension;

$targetFilePath = $targetDir . $newFileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (!empty($_FILES["OrderFile"]["name"])) {
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to the server
        if (move_uploaded_file($_FILES["OrderFile"]["tmp_name"], $targetFilePath)) {
            // File uploaded successfully
            $OrderFile = $newFileName;
        } else {
            // Error uploading file
            $OrderFile_err = "Sorry, there was an error uploading your file.";
        }
    } else {
        // Invalid file type
        $OrderFile_err = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
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
                header("location: orders.php");
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
}
?>

