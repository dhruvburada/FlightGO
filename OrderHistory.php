<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script></head>
<body>

<?php include 'Header.php'; 
session_start();
if(!isset( $_SESSION['user_id'])){
  echo "<script>window.location.href= 'login.php'</script>";

} ?>

<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="MyProfile.php">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order History</li>
          </ol>
        </nav>
      </div>
    </div>
</section>

<div class="container mt-4">
    <h2>Order History</h2>
    <table class="table table-striped">
    <thead>
            <tr>
                <th scope="col">OrderID</th>
                <th scope="col">Departure Date</th>
                <th scope="col">Flight From</th>
                <th scope="col">Flight To</th>
                <th scope="col">Status</th>
                <th scope="col">View Details</th>
            </tr>
        </thead>
        <tbody>
<?php


// Check if user is logged in
if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
    include_once 'connection.php';
    $query = "SELECT o.OrderID, f.DepartureDate, f.Source, f.Destination, o.PaymentStatus FROM `Order` o 
              INNER JOIN Flight f ON o.FlightID = f.FlightID 
              WHERE o.UserID = $user_id ;";

    // Execute the query
    $result = mysqli_query($conn, $query);

        // Display table rows
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>' . $row["OrderID"] . '</td>
                    <td>' . $row['DepartureDate'] . '</td>
                    <td>' . $row['Source'] . '</td>
                    <td>' . $row['Destination'] . '</td>
                    <td>' . $row['PaymentStatus'] . '</td>
                    <td><a href="TicketDetails.php?OrderID=' . $row['OrderID'] . '">View</a></td>
                  </tr>';
        }

        // Close table body and table
        echo '
        
        </tbody>
              </table>
          </div>'; 

} else {
    // User not logged in
    echo "Please Log in";
    exit();
}
?>


</body>
</html>
