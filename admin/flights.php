<?php
session_start();

if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    echo '<script>window.location.href = "admin_login.php";</script>';
    exit; 
}
?>

<?php
include_once 'helpers/init_conn_db.php';
include_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Flights</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f7ff; /* Light blue background */
        }
        .container {
            display: flex;
            flex-direction:column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>

<div class="container mt-3 mb-0">
    
        <h2 style="text-align: center; color: #0074d9;">Upcoming Flights</h2>
        <div class="table-responsive">
        <table class="table table-primary table-striped-columns mt-2">
            <thead>
            <tr>
                <th scope="col">Flight ID</th>
                <th scope="col">Flight Name</th>
                <th scope="col">Source</th>
                <th scope="col">Destination</th>
                <th scope="col">Departure Date</th>
                <th scope="col">Departure Time</th>
                <th scope="col">Cost / Person</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $currentDateTime = date('Y-m-d H:i:s');
            $departureDate = date('Y-m-d');
            $departureTime = date('H:i:s');

            $sql = "SELECT * FROM Flight WHERE DepartureDate >= ? OR (DepartureDate = ? AND DepartureTime > ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $departureDate, $departureDate, $departureTime);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["FlightID"] . '</td>';
                    echo '<td>' . $row["Flight Name"] . '</td>';
                    echo '<td>' . $row["Source"] . '</td>';
                    echo '<td>' . $row["Destination"] . '</td>';
                    echo '<td>' . $row["DepartureDate"] . '</td>';
                    echo '<td>' . $row["DepartureTime"] . '</td>';
                    echo '<td>₹' . $row["FlightCostPerPerson"] . '</td>';
                    echo '<td><a href="edit_flight.php?FlightID=' . $row["FlightID"] . '" class="btn btn-primary">Edit</a></td>';
                    echo '<td><a href="delete_flight.php?FlightID=' . $row["FlightID"] . '" class="btn btn-danger">Delete</a></td>';
                    echo '</tr>';
                }
            } else {
                echo "<tr><td colspan='9'>No upcoming flights available</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<div class="container mt-0 ">
    <div class="table-responsive ">
        <h2 style="text-align: center; color: #0074d9;">Flights History</h2>
        <table class="table table-primary table-striped-columns">
            <thead>
            <tr>
                <th scope="col">Flight ID</th>
                <th scope="col">Flight Name</th>
                <th scope="col">Source</th>
                <th scope="col">Destination</th>
                <th scope="col">Departure Date</th>
                <th scope="col">Departure Time</th>
                <th scope="col">Cost / Person</th>
                <!-- <th scope="col">Edit</th> -->
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $departureDate = date('Y-m-d');
            $departureTime = date('H:i:s');

            $sql = "SELECT * FROM Flight WHERE DepartureDate < ? OR (DepartureDate = ? AND DepartureTime <= ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $departureDate, $departureDate, $departureTime);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["FlightID"] . '</td>';
                    echo '<td>' . $row["Flight Name"] . '</td>';
                    echo '<td>' . $row["Source"] . '</td>';
                    echo '<td>' . $row["Destination"] . '</td>';
                    echo '<td>' . $row["DepartureDate"] . '</td>';
                    echo '<td>' . $row["DepartureTime"] . '</td>';
                    echo '<td>₹' .$row["FlightCostPerPerson"] . '</td>';
                    // echo '<td><a href="edit_flight.php?FlightID=' . $row["FlightID"] . '" class="btn btn-primary">Edit</a></td>';
                    echo '<td><a href="delete_flight.php?FlightID=' . $row["FlightID"] . '" class="btn btn-danger">Delete</a></td>';
                    echo '</tr>';
                }
            } else {
                echo "<tr><td colspan='8'>No history flights available</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once 'footer.php'; ?>

</body>
</html>
