<?php
ob_start();
include_once 'helpers/init_conn_db.php';
include_once 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if FlightID and other fields are set
    if (isset($_POST['FlightID'], $_POST['flightName'], $_POST['source'], $_POST['destination'], $_POST['departureDate'], $_POST['departureTime'], $_POST['costPerPerson'])) {
        $FlightID = $_POST['FlightID'];
        $flightName = $_POST['flightName'];
        $source = $_POST['source'];
        $destination = $_POST['destination'];
        $departureDate = $_POST['departureDate'];
        $departureTime = $_POST['departureTime'];
        $costPerPerson = $_POST['costPerPerson'];

        // Update flight details in the database
        $sql = "UPDATE Flight SET `Flight Name`=?, Source=?, Destination=?, DepartureDate=?, DepartureTime=?, FlightCostPerPerson=? WHERE FlightID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $flightName, $source, $destination, $departureDate, $departureTime, $costPerPerson, $FlightID);

        if ($stmt->execute()) {
            header("Location: flights.php");
            exit();
        } else {
            echo '<div class="container mt-3">';
            echo '<div class="alert alert-danger" role="alert">Error updating flight details: ' . $conn->error . '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="container mt-3">';
        echo '<div class="alert alert-danger" role="alert">All fields are required!</div>';
        echo '</div>';
    }
}

include_once 'footer.php';
ob_end_flush(); // End output buffering and flush buffer contents
?>
