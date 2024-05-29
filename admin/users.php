<?php
session_start();
include_once 'helpers/init_conn_db.php';
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
    <title>View Users</title>
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
    <h2 style="text-align: center; color: #0074d9;">Registered Users</h2>
    <div class="table-responsive">
        <table class="table table-primary table-striped-columns mt-2">
            <thead>
            <tr>
                <th scope="col">Email</th>
                <th scope="col">Active Status</th>
                <th scope="col">UserID</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM User";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["Email"] . '</td>';
                    echo '<td>' . ($row["IsActive"] ? 'Active' : 'Inactive') . '</td>';
                    echo '<td>' . $row["UserID"] . '</td>';
                    echo '<td><a href="edit_user.php?UserID=' . $row["UserID"] . '" class="btn btn-primary">Edit</a></td>';
                    echo '<td><a href="delete_user.php?UserID=' . $row["UserID"] . '" class="btn btn-danger">Delete</a></td>';
                    echo '</tr>';
                }
            } else {
                echo "<tr><td colspan='5'>No users available</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
