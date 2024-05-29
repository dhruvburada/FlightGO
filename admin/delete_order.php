<?php
ob_start();
include_once 'helpers/init_conn_db.php';
include_once 'header.php';

// Check existence of OrderID parameter before processing further
if (isset($_GET["OrderID"]) && !empty(trim($_GET["OrderID"]))) {
    // Get URL parameter
    $OrderID = trim($_GET["OrderID"]);

    // Prepare a delete statement
    $sql = "DELETE FROM `Order` WHERE OrderID = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_OrderID);

        // Set parameters
        $param_OrderID = $OrderID;

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records deleted successfully. Redirect to landing page
            header("location: index.php");
            exit();
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
    echo "Oops! Something went wrong. Please try again later.";
    header("location: orders.php");
    exit();
}
ob_end_flush();
?>
