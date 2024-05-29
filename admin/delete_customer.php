<?php
include_once 'helpers/init_conn_db.php';
include_once 'header.php';

// Delete customer
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM Customer WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header('Location: customers.php');
    exit();
} else {
    echo "Invalid request.";
    exit();
}
?>
