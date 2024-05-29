<?php

session_start();
echo error_reporting(E_ALL);
echo ini_set('display_errors', 1);
include_once('connection.php');

$userid = $_POST['user_id'];
$flightid = $_POST['flightID'];
$total = $_POST['total'];

if (isset($_SESSION['user_id'])) {
    $userid = $_SESSION['user_id'];
} else {
    $userid = $_POST['user_id'];
}

if (isset($_SESSION['flight_id'])) {
    $flightid = $_SESSION['flight_id'];
} else {
    $flightid = $_POST['flightID'];
}

if (isset($_SESSION['total'])) {
    $total = $_SESSION['total'];
} else {
    $total = $_POST['total'];
}


$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$nationality = $_POST["nationality"];
$age = $_POST["age"];
$country = $_POST["country"];
$state = $_POST["state"];
$city = $_POST["city"];
$postalCode = $_POST["postalCode"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$num_travelers = $_POST["num_travelers"];
$num_travelers = $num_travelers+1;

// Check if the customer exists in the database
$sql_check_customer = "SELECT * FROM Customer WHERE UserID = $userid";
$result_check_customer = mysqli_query($conn, $sql_check_customer);

if (mysqli_num_rows($result_check_customer) > 0) {


    // Customer exists, update their information
    $sql_update_customer = "UPDATE Customer SET FirstName = '$firstname', LastName = '$lastname', Nationality = '$nationality', Age = $age, Country = '$country', `State` = '$state', City = '$city', PostalCode = '$postalCode', Email = '$email', Phone = '$phone' WHERE UserID = $userid";

    if (mysqli_query($conn, $sql_update_customer)) {

        echo "Customer information updated successfully<br>";
    } else {
        echo "Error updating customer information: " . mysqli_error($conn) . "<br>";
    }
} else {
    $sql_insert_customer = "INSERT INTO Customer (UserID, FirstName, LastName, Nationality, Age, Country, `State`, City, PostalCode, Email, Phone) VALUES ($userid, '$firstname', '$lastname', '$nationality', $age, '$country', '$state', '$city', '$postalCode', '$email', '$phone')";
    
    if (mysqli_query($conn, $sql_insert_customer)) {
        echo "New record created successfully<br>";
    } else {
        echo "Error inserting record: " . mysqli_error($conn) . "<br>";
    }
}




// Insert order information
function generateSeatNumbers($num_travelers, $flightId, $conn) {
    // Retrieve already assigned seats for the given flight
    $assignedSeats = array();
    $sql_assigned_seats = "SELECT SeatNumbers FROM `Order` WHERE FlightID = $flightId";
    $result_assigned_seats = mysqli_query($conn, $sql_assigned_seats);
    if ($result_assigned_seats) {
        while ($row = mysqli_fetch_assoc($result_assigned_seats)) {
            $assignedSeats = array_merge($assignedSeats, explode(',', $row['SeatNumbers']));
        }
    }

    // Define your seat allocation logic here
    // For example, if you have a fixed number of seats per row and multiple rows
    // You can generate seat numbers like "A1, A2, A3, ..., B1, B2, B3, ...", etc.

    // Example: 3 travelers per row, 5 rows
    $rows = 10;
    $seatsPerRow = 5;
    
    $seatNumbers = array();

    // Generate seat numbers for each row
    for ($i = 1; $i <= $rows; $i++) {
        for ($j = 1; $j <= $seatsPerRow; $j++) {
            $seatNumber = chr(64 + $i) . $j; // Convert ASCII value to character
            if (!in_array($seatNumber, $assignedSeats)) {
                $seatNumbers[] = $seatNumber;
            }
        }
    }

    // If you need to generate seat numbers based on the number of travelers,
    // adjust the logic accordingly, considering seat availability and preference

    // For simplicity, let's assume all travelers are seated sequentially
    $assignedSeatNumbers = array_slice($seatNumbers, 0, $num_travelers);

    // Convert array to comma-separated string
    $seatNumbersString = implode(',', $assignedSeatNumbers);

    return $seatNumbersString;
}

// Generate seat numbers based on the number of travelers
$seatNumbers = generateSeatNumbers($num_travelers,$flightid,$conn);

// Insert order information along with seat numbers
$sql_insert_order = "INSERT INTO `Order` (OrderAmount, UserID, FlightID, PaymentScreenshotFile, PaymentStatus, SeatNumbers) VALUES ($total, $userid, $flightid, 'RazorPay', 'Paid', '$seatNumbers')";

// Execute the SQL insert operation
if (mysqli_query($conn, $sql_insert_order)) {
    echo "Order information stored successfully<br>";
    header("Location: OrderHistory.php"); // Redirect to OrderHistory page
} else {
    // If there's an error, display an error message along with debug information
    echo "Error inserting order information: " . mysqli_error($conn) . "<br>";
    echo "Debugging information: <br>";
    echo "SQL query: " . $sql_insert_order . "<br>";
}

// Check if the user already has a record in the RewardPoint table
$sql_check_rewardpoint = "SELECT * FROM RewardPoint WHERE UserID = $userid";
$result_check_rewardpoint = mysqli_query($conn, $sql_check_rewardpoint);

if (mysqli_num_rows($result_check_rewardpoint) > 0) {
    // User already has a record, update the existing record
    $sql_update_rewardpoint = "UPDATE RewardPoint SET PointsEarned = PointsEarned + 50, PointsBalance = PointsBalance + 50 WHERE UserID = $userid";

    if (mysqli_query($conn, $sql_update_rewardpoint)) {
        echo "Reward points updated successfully<br>";
    } else {
        echo "Error updating reward points: " . mysqli_error($conn) . "<br>";
    }
} else {
    // User does not have a record, insert a new record
    $sql_insert_rewardpoint = "INSERT INTO RewardPoint (UserID, PointsEarned, PointsRedeemed, PointsBalance) VALUES ($userid, 50, 0, 50)";

    if (mysqli_query($conn, $sql_insert_rewardpoint)) {
        echo "New reward points record created successfully<br>";
    } else {
        echo "Error inserting reward points record: " . mysqli_error($conn) . "<br>";
    }
}


$sql_update_seat = "UPDATE Flight SET Seats = Seats - $num_travelers WHERE FlightID = $flightid";

// Execute the query
if (mysqli_query($conn, $sql_update_seat)) {
    echo "Seat count updated successfully.";
} else {
    echo "Error updating seat count: " . mysqli_error($conn);
}



// Clear session variables
unset($_SESSION['flight_id']);
unset($_SESSION['total']);
unset($_SESSION['DiscountAmount']);

mysqli_close($conn);
?>

<script>
    sessionStorage.clear();
</script>