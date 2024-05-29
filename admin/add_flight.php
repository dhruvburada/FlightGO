<?php
session_start();

if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    echo '<script>window.location.href = "admin_login.php";</script>';
    exit; 
}
?>

<?php
ob_start();
include_once 'helpers/init_conn_db.php';
include_once 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are set
    if (isset($_POST['flightName'], $_POST['source'], $_POST['destination'], $_POST['departureDate'], $_POST['departureTime'], $_POST['costPerPerson'])) {
        $flightName = $_POST['flightName'];
        $source = $_POST['source'];
        $destination = $_POST['destination'];
        $departureDate = $_POST['departureDate'];
        $departureTime = $_POST['departureTime'];
        $costPerPerson = $_POST['costPerPerson'];

        // Check if the source and destSination are different
        if ($source == $destination) {
            echo '<div class="container mt-3">';
                    echo '<div class="alert alert-danger" role="alert">Source and destination cannot be the same </div>';
                    echo '</div>';
            header("location:add_flight.php");
        } else {
            // Check if the selected flight name (airline) exists in the airlines table
            $stmt = $conn->prepare("SELECT airline FROM airlines WHERE airline = ?");
            $stmt->bind_param("s", $flightName);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Insert data into the 'flight' table
                $stmt = $conn->prepare("INSERT INTO Flight (FlightName, Source, Destination, DepartureDate, DepartureTime, FlightCostPerPerson)
                                        VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $flightName, $source, $destination, $departureDate, $departureTime, $costPerPerson);

                if ($stmt->execute()) {
                    // echo '<div class="container mt-3">';
                    // echo '<div class="alert alert-success" role="alert">Flight added successfully!</div>';
                    // echo '</div>';
                    header('Location: flights.php');
                    exit();
                } else {
                    echo '<div class="container mt-3">';
                    echo '<div class="alert alert-danger" role="alert">Error adding flight: ' . $conn->error . '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="container mt-3">';
                echo '<div class="alert alert-danger" role="alert">The selected airline does not exist!</div>';
                echo '</div>';
            }
        }
    } else {
        echo '<div class="container mt-3">';
        echo '<div class="alert alert-danger" role="alert">All fields are required!</div>';
        echo '</div>';
    }
}
ob_end_flush();
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
    <div class="container mt-0">
        <div class="form-container">
            <h2 style="text-align: center; color: #0074d9;">Add Flight</h2>
            <form action="add_flight.php" method="post">
                <label for="flightName">Flight Name:</label>
                <?php
                    $sql = 'SELECT * FROM airlines';
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    echo '<select class="flightName col-md-3 mt-4" name="flightName" style="border: 0px; border-bottom: 
                        2px solid #5c5c5c; background-color: whitesmoke !important; font-size: 16px;">
                        <option selected>Select Airline</option>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="'. $row['Airline']  .'">'. 
                        $row['airline'] .'</option>';
                    }
                    ?>
                </select>
                <br>
                <label for="source">Source:</label>
                <select class="mt-3" id="source" name="source" required style="border: 0px; border-bottom: 
                    2px solid #5c5c5c; background-color: whitesmoke !important; font-size: 16px;">
                    <option value="">Select Source</option>
                    <?php
                    $sql = 'SELECT * FROM cities';
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['City']}'>{$row['City']}</option>";
                    }
                    ?>
                </select>
                <br>
                <label for="destination">Destination:</label>
                <select class="mt-3" id="destination" name="destination" required style="border: 0px; border-bottom: 
                    2px solid #5c5c5c; background-color: whitesmoke !important; font-size: 16px;">
                    <option value="">Select Destination</option>
                    <?php
                    $sql = 'SELECT * FROM cities';
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['City']}'>{$row['City']}</option>";
                    }
                    ?>
                </select>
                <br>
                <label class="mt-3" for="departureDate">Departure Date:</label>
                <input  type="date" id="departureDate" name="departureDate" required style="border: 0px; border-bottom: 
                    2px solid #5c5c5c; background-color: whitesmoke !important; font-size: 16px;">
                <label class="mt-3" for="departureTime">Departure Time:</label>
                <input type="time" id="departureTime" name="departureTime" required style="border: 0px; border-bottom: 
                    2px solid #5c5c5c; background-color: whitesmoke !important; font-size: 16px;">
                <label class="mt-3" for="costPerPerson">Flight Cost Per Person:</label>
                <input type="number" id="costPerPerson" name="costPerPerson" required style="border: 0px; border-bottom: 
                    2px solid #5c5c5c; background-color: whitesmoke !important; font-size: 16px;">
                <input class="mt-3" class="mt-3" type="submit" value="Add Flight" style="border: 0px; border-bottom: 
                    2px solid #5c5c5c; background-color: #0074d9; color: white; font-size: 16px; cursor: pointer;">
            </form>
        </div>
    </div>

<?php
include_once 'footer.php';
?>

</body>
</html>
