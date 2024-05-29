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
    <title>View Customers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f7ff; /* Light blue background */
        }
        .container {
            display: flex;
            flex-direction:column;
            /* justify-content: center; */
            align-items: center;
            height: 100vh;
            
        }
        .table-striped-columns tbody tr:nth-of-type(odd) {
            background-color: rgba(0,0,0,.05);
        }
        .table-striped-columns tbody tr:nth-of-type(even) {
            background-color: rgba(0,0,0,.1);
        }
        .table-striped-columns tbody tr:hover {
            background-color: rgba(0,0,0,.075);
        }
        td a {
            color:black;
        }
    </style>
</head>
<body>

<div class="container mt-3 pt-10">
    <h2 style="text-align: center; color: #0074d9;">Customers</h2>
    <div class="table-responsive">
        <table class="table table-primary table-striped-columns mt-2">
            <thead>
                <tr>
                    <th scope="col">UserID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Nationality</th>
                    <th scope="col">Age</th>
                    <th scope="col">Country</th>
                    <th scope="col">State</th>
                    <th scope="col">City</th>
                    <th scope="col">Postal Code</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Profile Picture</th>
                    <th scope="col">Edit</th>
                    <!-- <th scope="col">Delete</th>       Removed "delete" because of foreign key violation --> 
                </tr> 
            </thead>
            <tbody>
                <?php
                $sql = 'SELECT * FROM Customer';
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['UserID'] . '</td>';
                    echo '<td>' . $row['FirstName'] . '</td>';
                    echo '<td>' . $row['LastName'] . '</td>';
                    echo '<td>' . $row['Nationality'] . '</td>';
                    echo '<td>' . $row['Age'] . '</td>';
                    echo '<td>' . $row['Country'] . '</td>';
                    echo '<td>' . $row['State'] . '</td>';
                    echo '<td>' . $row['City'] . '</td>';
                    echo '<td>' . $row['PostalCode'] . '</td>';
                    echo '<td>' . $row['Email'] . '</td>';
                    echo '<td>' . $row['Phone'] . '</td>';
                    echo '<td><img src="../img/profile_pic/' . $row['PROFILE_PIC'] . '" style="max-width:100px;height:auto;"></td>';
                    echo '<td><button type="button" class="btn btn-primary"><a href="edit_customer.php?id=' . $row['UserID'] . '">Edit</a></button></td>';
                    // echo '<td><button type="button" class="btn btn-danger"><a href="delete_customer.php?id=' . $row['UserID'] . '"> Delete</a></button></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include_once 'footer.php';
?>

</body>
</html>
