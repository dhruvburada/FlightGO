<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Flight</title>

    <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

<?php include_once('connection.php');?>


    <style>
        body {
            overflow-x: hidden;
        }

        .tg-innerbanner {
            position: relative;
            height: 450px;
            background: rgba(0,0,0,0.5) url('img/booking-hero 2.jpg');
            background-blend-mode: darken;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-position: center center;
            color: #fff;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            max-width: 100%;
        }

        .tg-breadcrumb {
            padding: 0;
            margin: 0;
            color: #fff;
            list-style: none;
            text-align: center;
            text-transform: capitalize;
            font-size: 14px;
            margin-top: 20px; /* Adjust spacing */
        }

        .tg-breadcrumb li {
            display: inline;
            margin-right: 5px; /* Adjust spacing between breadcrumb items */
        }

        .tg-breadcrumb li:not(.tg-active):hover {
            cursor: pointer;
            text-decoration: underline;
        }

        .tg-box {
            width: 100%;
            padding-top : 20px;
            border: 1px solid #e6e6e6; /* Add border */
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
            margin-top : 25px;
            padding:15px;
        }
    </style>

</head>
<body>

<?php include_once('Header.php'); ?>
<?php 

$from = $_GET['from'];
$to = $_GET['to'];
$date = $_GET['date'];

?>

<div class="col-xl-12 col-xxl-12 col-md-12 col-sm-12 col-xsm-12 col-lg-12">
<section class="tg-innerbanner">
    <h1>Search Flights</h1>
    <p><?php echo $from . " to ".$to; ?></p>
    <ul class="tg-breadcrumb">
        <li>Home</li>
        <li class="tg-active">Flights</li>
    </ul>
</section>
</div>

<?php
$query = "SELECT * FROM Flight WHERE Source = '$from' AND Destination = '$to' AND DepartureDate = '$date' AND Seats>0";
$result = mysqli_query($conn, $query);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th>Flight ID</th>
                            <th>Source</th>
                            <th>Flight Name</th>
                            <th>Destination</th>
                            <th>Departure Date</th>
                            <th>Departure Time</th>
                            <th>Price per Ticket</th>
                            <th>Available Seats</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['FlightID']}</td>";
                            echo "<td>{$row['Source']}</td>";
                            echo "<td>{$row['Flight Name']}</td>";
                            echo "<td>{$row['Destination']}</td>";
                            echo "<td>{$row['DepartureDate']}</td>";
                            echo "<td>{$row['DepartureTime']}</td>";
                            echo "<td>{$row['FlightCostPerPerson']}</td>";
                            echo "<td>{$row['Seats']}</td>";
                            echo "<td><a href='book_flight.php?flight_id={$row['FlightID']}' class='btn btn-primary'>Book Now</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php } ?>
            <div class="text-center">
                <?php if (mysqli_num_rows($result) == 0) { ?>
                    <p class="mt-5">No flights found.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>



<?php include_once('footer.php'); ?>

</body>
</html>




<?php include_once('footer.php'); ?>

    
</body>
</html>