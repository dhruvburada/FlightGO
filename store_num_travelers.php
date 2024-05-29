<?php
session_start();

// Include your database connection file if needed
include_once('connection.php');

// Function to fetch available seats from the Flight table
function getAvailableSeats() {
    global $conn; // Access the global $conn variable

    // Initialize available seats to 0
    $availableSeats = 0;

    // Check if $_SESSION['flight_id'] is set
    if (isset($_SESSION['flight_id'])) {
        $query = "SELECT Seats FROM Flight WHERE FlightID=" . $_SESSION['flight_id'];
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $availableSeats = intval($row['Seats']);
            } else {
                echo "Error: No rows found for the given FlightID.";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: FlightID not set in session.";
    }

    return $availableSeats;
}

// Get number of travelers from the AJAX request
$numTravelers = isset($_POST['numTravelers']) ? intval($_POST['numTravelers']) : 0;
$numTravelers = $numTravelers+1;

// Get available seats
$availableSeats = getAvailableSeats();

// Check if number of travelers exceeds available seats
if ($numTravelers <= $availableSeats) {
    // Store number of travelers in session variable
    $_SESSION['num_travelers'] = $numTravelers;
} else {
    // Return error response
    echo "Error: Number of travelers exceeds available seats.";
}
?>
