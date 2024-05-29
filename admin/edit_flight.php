<?php
include_once 'helpers/init_conn_db.php';
include_once 'header.php';

// Check if the FlightID is set
if (isset($_GET['FlightID'])) {
    $FlightID = $_GET['FlightID'];
    // Fetch flight details from the database
    $sql = "SELECT * FROM Flight WHERE FlightID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $FlightID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Flight</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f7ff; /* Light blue background */
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #ffffff; /* White background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 400px;
        }
        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #0074d9; /* Blue button */
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2 style="text-align: center; color: #0074d9;">Edit Flight</h2>
        <form action="update_flight.php" method="post">
            <input type="hidden" name="FlightID" value="<?php echo $row['FlightID']; ?>">
            <label for="flightName">Flight Name:</label>
            <input type="text" id="flightName" name="flightName" value="<?php echo $row['FlightName']; ?>" required>
            <label for="source">Source:</label>
            <input type="text" id="source" name="source" value="<?php echo $row['Source']; ?>" required>
            <label for="destination">Destination:</label>
            <input type="text" id="destination" name="destination" value="<?php echo $row['Destination']; ?>" required>
            <label for="departureDate">Departure Date:</label>
            <input type="date" id="departureDate" name="departureDate" value="<?php echo $row['DepartureDate']; ?>" required>
            <label for="departureTime">Departure Time:</label>
            <input type="time" id="departureTime" name="departureTime" value="<?php echo $row['DepartureTime']; ?>" required>
            <label for="costPerPerson">Flight Cost Per Person:</label>
            <input type="number" id="costPerPerson" name="costPerPerson" value="<?php echo $row['FlightCostPerPerson']; ?>" required>
            <input type="submit" value="Update Flight">
        </form>
    </div>
</div>

</body>
</html>

<?php
include_once 'footer.php';
?>
