<?php
// Include your database connection file
include_once('connection.php');

// Store the selected source
$selectedSource = $_GET['from'];

// Query to fetch distinct destinations based on the selected source
$destination_query = "SELECT DISTINCT Destination FROM Flight WHERE Source = '$selectedSource'";


$destination_result = mysqli_query($conn, $destination_query);

// Check if there are any results
if(mysqli_num_rows($destination_result) > 0) {
    // Initialize an array to store the destinations
    $destinations = [];
    
    // Fetch destinations and add them to the array
    while ($row = mysqli_fetch_assoc($destination_result)) {
        $destinations[] = $row['Destination'];
    }
    
    // Send destinations as JSON response
    header('Content-Type: application/json');
    echo json_encode($destinations);
    exit;
} else {
    // If no destinations found, return an empty array as JSON response
    header('Content-Type: application/json');
    echo json_encode([]);
    exit;
}
?>

