<?php

session_start();
include_once('connection.php');

$discountAmount = $_POST['discountAmount'] ?? 0;
$numTravelers = $_POST['numTravelers'] ?? 0;
$flightId = $_SESSION['flight_id'];
$query = "SELECT FlightCostPerPerson FROM Flight WHERE FlightID = $flightId";

$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);
$flightAmount = $row['FlightCostPerPerson'];
$subtotal = $flightAmount * ($numTravelers + 1); // Example subtotal calculation
$tax = 50; // Example static tax value
$total = $subtotal + $tax - $discountAmount; // Example total calculation

$_SESSION['total']=$total;

// Generate HTML markup for the order summary
$html = '
<div class="summary-details">
    <div class="summary-item">
        <span class="item-label">Flight Amount (per person):</span>
        <span class="item-value">' . $flightAmount . '</span>
    </div>
    <div class="summary-item">
        <span class="item-label">Number of Travelers:</span>
        <span class="item-value">1+' . $numTravelers . '</span>
    </div>
    <div class="summary-item">
        <span class="item-label">Subtotal:</span>
        <span class="item-value">' . $subtotal . '</span>
    </div>
    <div class="summary-item">
        <span class="item-label">Tax:</span>
        <span class="item-value">' . $tax . '</span>
    </div>
    <div class="summary-item">
        <span class="item-label">Discount Amount:</span>
        <span class="item-value">' . $discountAmount . '</span>
    </div>
    <div class="summary-item total">
        <span class="item-label">Total:</span>
        <span class="item-value">' . $total . '</span>
        <script>sessionStorage.setItem("total", "' . $total . '");</script>
    </div>

</div>';

// Output the generated HTML markup
echo $html;
?>
