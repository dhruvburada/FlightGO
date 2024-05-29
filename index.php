
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlightGO</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>

    /* Change color of carousel control indicators */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: blue !important; /* Change to your desired color */
        border-radius: 50%; /* Make the indicators rounded */
        padding:5px;
    }
    </style>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

<?php include_once('connection.php');?>



</head>
<body>
    <?php include_once('Header.php'); ?>

<?php
$source_query = "SELECT DISTINCT Source FROM Flight";
$source_result = mysqli_query($conn, $source_query);
?>

<div style="background-image: url('img/booking-hero 2.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Find Your Flight</h3>
                        <form action="search_results.php" method="get" id="flightForm">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="from">From:</label>
                                        <select class="form-control" id="from" name="from" required>
                                            <?php while ($row = mysqli_fetch_assoc($source_result)) { ?>
                                                <option value="<?php echo $row['Source']; ?>"><?php echo $row['Source']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="to">To:</label>
                                        <select class="form-control" id="to" name="to" required>
                                            <!-- Options will be dynamically populated based on user selection -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" >
                                        <label for="date">Date:</label>
                                        <input type="date" class="form-control" id="date" name="date" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div> ‎ </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary" class="search">Search Flights</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container" style="position: relative; margin: 100px auto; background-color: #fff; border-radius: 10px; padding: 0%; padding-right: 10px;">
    <div class="row">
        <div class="col-md-6" id="image" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; background: url('https://img.freepik.com/free-vector/urban-city-background-video-conferencing_23-2148641633.jpg?size=626&ext=jpg&ga=GA1.2.777073396.1599399655');">
            <img src="https://www.freepnglogos.com/uploads/plane-png/png-jet-plane-transparent-jet-plane-images-pluspng-34.png" alt="" id="plane" style="position: absolute; width: 400px; left: 40%; top: -5%;">
        </div>
        <div class="col-md-6">
            <div id="info" class="pt-md-4" style="text-align: center;">
                <div id="mobile-plane" style="display: none;">
                    <img src="https://www.freepnglogos.com/uploads/plane-png/png-jet-plane-transparent-jet-plane-images-pluspng-34.png" alt="" style="position: absolute; width: 400px; top: 10%; left: 10%;">
                </div>
                <div class="h4">Get</div>
                <div class="offer font-weight-bold" style="font-size: 5rem;"><i>FLAT 50 OFF</i></div>
                <div class="h4">on</div>
                <div class="h4">Your Next Flight with us</div>
                <div class="h4 pt-5">FLY 50</div>
                <div class="coupon"><i>coupon valid for 2 Month</i></div>
                <div class="btn rounded mt-3" style="padding: 10px 50px; font-size: 25px; font-weight: 600; background: #333; color: #fff; margin-bottom: 5%;">REDEEM NOW</div>
            </div>
        </div>
    </div>
</div>

<h3 class=" row justify-content-center align-items-center">Most Visited Locations</h3>

<?php
// Assume connection is established

// SQL query to fetch data from Slider table
$sql = "SELECT * FROM slider";
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Counter to keep track of number of cards
    $card_count = 0;

    // Output start of carousel
    echo '<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">';

    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        // If it's the first card, set it as active
        $active_class = ($card_count == 0) ? "active" : "";

        // Output start of carousel item
        if ($card_count % 3 == 0) {
            echo '<div class="carousel-item ' . $active_class . '">
                    <div class="container">
                        <div class="row">';
        }

        // Output HTML structure for each card dynamically
        echo '<div class="col">
                <div class="card">
                    <img src="' . $row["image_url"] . '" class="card-img-top" alt="' . $row["name"] . '">
                    <div class="card-body">
                        <h5 class="card-title">' . $row["name"] . '</h5>
                        <p class="card-text">' . $row["brief"] . '</p>
                        <a href="explore.php?destination=' . $row["name"] . '" class="btn btn-primary">More <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>';

        // If it's the last card in the row, close the row and carousel item
        if (($card_count + 1) % 3 == 0 || $card_count == mysqli_num_rows($result) - 1) {
            echo '</div></div></div>';
        }

        // Increment card count
        $card_count++;
    }

    // Output slider indicators
    echo '</div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators " data-bs-slide="next">
            <span class="carousel-control-next-icon " aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>';
} else {
    echo "0 results";
}

// Close database connection (assuming it was opened elsewhere)
mysqli_close($conn);
?>






<!-- Script to find destinations where souce = user entered value -->

<script>
document.addEventListener("DOMContentLoaded", function() {
  // Get references to the source and destination dropdowns
  var fromDropdown = document.getElementById("from");
  var toDropdown = document.getElementById("to");

  // Event listener for when the source dropdown selection changes
  fromDropdown.addEventListener("change", function() {
    var selectedSource = fromDropdown.value;
    // AJAX call to fetch destinations corresponding to the selected source
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Clear previous options
          toDropdown.innerHTML = "";
          // Parse JSON response
          var destinations = JSON.parse(xhr.responseText);
          // Populate destination dropdown with fetched destinations
          destinations.forEach(function(destination) {
            var option = document.createElement("option");
            option.value = destination;
            option.textContent = destination;
            toDropdown.appendChild(option);
          });
        } else {
          console.error("Error fetching destinations: " + xhr.status);
        }
      }
    };
    xhr.open("GET", "getDestination.php?from=" + selectedSource, true);

    xhr.send();
  });
});
</script>

<?php include_once('footer.php'); ?>



</body>
</html>



</body>
</html>
