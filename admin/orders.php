<?php

session_start();
include_once('helpers/init_conn_db.php'); 
include_once 'header.php';



if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    echo '<script>window.location.href = "admin_login.php";</script>';
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
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
    <h2 style="text-align: center; color: #0074d9;">Orders</h2>
    <div class="table-responsive">
        <table class="table table-primary table-striped-columns mt-2">
            <thead>
            <tr>
                <th scope="col">OrderID</th>
                <th scope="col">OrderAmount</th>
                <th scope="col">UserID</th>
                <th scope="col">FlightID</th>
                <th scope="col">PaymentScreenshotFile</th>
                <th scope="col">PaymentStatus</th>
                <th scope="col">Email</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // $sql = "SELECT `Order`.`OrderID`, `Order`.`OrderAmount`, `Order`.`UserID`, `Order`.`FlightID`, `Order`.`PaymentScreenshotFile`, `Order`.`PaymentStatus`, `user`.`Email` 
            //         FROM `Order` 
            //         LEFT JOIN `user` ON `Order`.`UserID` = `user`.`UserID`";

            $sql = "SELECT 
            o.OrderID, 
            o.OrderAmount, 
            o.UserID, 
            o.FlightID, 
            o.PaymentScreenshotFile, 
            o.PaymentStatus, 
            u.Email
        FROM 
            `Order` AS o
        LEFT JOIN 
            `User` AS u ON o.UserID = u.UserID;";        
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["OrderID"] . '</td>';
                    echo '<td>' . $row["OrderAmount"] . '</td>';
                    echo '<td>' . $row["UserID"] . '</td>';
                    echo '<td>' . $row["FlightID"] . '</td>';
                    echo '<td><img src="../img/payments/UPI/' . $row["PaymentScreenshotFile"] . '" alt="Payment Screenshot" style="max-width: 100px;"></td>';
                    echo '<td>' . $row["PaymentStatus"] . '</td>';
                    echo '<td>' . $row["Email"] . '</td>';
                    echo '<td><a href="edit_order.php?OrderID=' . $row["OrderID"] . '" class="btn btn-primary">Edit</a></td>';
                    echo '<td><a href="delete_order.php?OrderID=' . $row["OrderID"] . '" class="btn btn-danger">Delete</a></td>';
                    echo '</tr>';
                }
            } else {
                echo "<tr><td colspan='9'>No orders available</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

<?php include_once "footer.php"?>