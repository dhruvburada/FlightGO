<?php
include_once 'helpers/init_conn_db.php';
include_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Flight</title>
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
            <h2 style="text-align: center; color: #0074d9;">Add Flight</h2>
            <form action="add_flight.php" method="post">
                <label for="flightName">Flight Name:</label>
                <input type="text" id="flightName" name="flightName" required>
                <label for="source">Source:</label>
                <input type="text" id="source" name="source" required>
                <label for="destination">Destination:</label>
                <input type="text" id="destination" name="destination" required>
                <label for="departureDate">Departure Date:</label>
                <input type="date" id="departureDate" name="departureDate" required>
                <label for="departureTime">Departure Time:</label>
                <input type="time" id="departureTime" name="departureTime" required>
                <label for="costPerPerson">Flight Cost Per Person:</label>
                <input type="number" id="costPerPerson" name="costPerPerson" required>
                <input type="submit" value="Add Flight">
            </form>
        </div>
    </div>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are set
    if (isset($_POST['flightName'], $_POST['source'], $_POST['destination'], $_POST['departureDate'], $_POST['departureTime'], $_POST['costPerPerson'])) {
        $flightName = $_POST['flightName'];
        $source = $_POST['source'];
        $destination = $_POST['destination'];
        $departureDate = $_POST['departureDate'];
        $departureTime = $_POST['departureTime'];
        $costPerPerson = $_POST['costPerPerson'];

        // Insert data into the 'flight' table
        $sql = "INSERT INTO flight (`FlightName`, `Source`, `Destination`, `DepartureDate`, `DepartureTime`, `FlightCostPerPerson`)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $flightName, $source, $destination, $departureDate, $departureTime, $costPerPerson);

        if ($stmt->execute()) {
            echo '<div class="container mt-3">';
            echo '<div class="alert alert-success" role="alert">Flight added successfully!</div>';
            echo '</div>';
        } else {
            echo '<div class="container mt-3">';
            echo '<div class="alert alert-danger" role="alert">Error adding flight: ' . $conn->error . '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="container mt-3">';
        echo '<div class="alert alert-danger" role="alert">All fields are required!</div>';
        echo '</div>';
    }
}

include_once 'footer.php';
?>

</body>
</html>
