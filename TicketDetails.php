<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <style>
.tg-innerbanner {
    position: relative;
    height: 450px;
    background-image: url('booking-hero 2.jpg'); /* Image URL */
    background-size: cover;
    background-position: right !important;
    color: #fff;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    /* Darker overlay */
    background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('img/booking-hero 2.jpg');
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

    .tg-widgetpersonprice {
        padding: 30px;
    }

    .tg-widgetpersonprice ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tg-widgetpersonprice ul li {
        padding: 10px 0;
    }

    .tg-widgetpersonprice ul li:last-child {
        border-bottom: none; /* Remove bottom border from the last item */
    }

    .container{margin:2px;}

/* CSS targeting only small screen container */
@media (max-width: 768px) {
    .panel.d-xs-block.d-md-none ul.list-unstyled li {
        display: flex;
        justify-content: space-between;
        align-items: right; 
    }

    .panel.d-xs-block.d-md-none ul.list-unstyled li strong {
        text-align:left; /* Pushes the strong text to the right */
    }
}


#feedback-form-wrapper #floating-icon > button {
  position: fixed;
  right: 0;
  top: 50%;
  transform: rotate(-90deg) translate(50%, -50%);
  transform-origin: right;
}

#feedback-form-wrapper .rating-input-wrapper input[type="radio"] {
  display: none;
}
#feedback-form-wrapper .rating-input-wrapper input[type="radio"] ~ span {
  cursor: pointer;
}
#feedback-form-wrapper .rating-input-wrapper input[type="radio"]:checked ~ span {
  background-color: #4261dc;
  color: #fff;
}
#feedback-form-wrapper .rating-labels > label{
  font-size: 14px;
    color: #777;
}

    
   
</style>

<style>
    /* Custom CSS styles */
    .container {
        margin-top: 50px;
            width: 80%;
            margin-top:50px;
            margin: 50px auto; Center align container
    }
    .panel {
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .panel ul {
            padding-left: 0; /* Remove default padding */
            margin-bottom: 0; /* Remove default margin */
        }
        .panel ul li {
            margin-bottom: 5px; /* Add spacing between list items */
        }
</style>
<body>

    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 <?php session_start(); include_once('connection.php');?>

</head>
<body>

<!-- Inner Banner -->

  <section class="tg-innerbanner">
    <h1>Congratulations !</h1>
    <p>Your Ticket is booked</p>
    <ul class="tg-breadcrumb">
        <li>Home</li>
        <li>Pages</li>
        <li class="tg-active">Flight Confirmation</li>
    </ul>
</section>

<?php

// Get the OrderID from the GET parameter
$orderID = $_GET['OrderID'];
$userId = $_SESSION['user_id'];
$flightId = $_SESSION['flight_id'];

// SQL query with WHERE condition
$sql = "SELECT 
            c.FirstName,
            c.LastName,
            c.Email,
            c.Phone,
            f.FlightID,
            f.`Flight Name`,
            f.Source,
            f.Destination,
            f.DepartureDate,
            f.DepartureTime,
            f.FlightCostPerPerson,
            o.OrderID,
            o.OrderAmount,
            o.SeatNumbers
        FROM 
            Customer c
        JOIN 
            `Order` o ON c.UserID = o.UserID
        JOIN 
            Flight f ON o.FlightID = f.FlightID
        JOIN 
            User u ON c.UserID = u.UserID
        WHERE
            o.OrderID = $orderID";

// Execute query
$result = mysqli_query($conn, $sql);
$data  = mysqli_fetch_assoc($result);


?>


<div class="container">
    <!-- Container 1 -->
    <div class="panel d-none d-sm-none d-md-block">
        <div class="row">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <h5>Flight Details</h5>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
                <ul class="list-unstyled">
                    <li>Order Number</li>
                    <li>Day of Travel</li>
                    <li>Flight Name</li>
                    <li>Flight From</li>
                    <li>Flight To</li>
                </ul>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
                <ul class="list-unstyled">
                    <li>#<?php echo $data['OrderID']; ?></li>
                    <li><?php echo  $data['DepartureDate'];?></li>
                    <li><?php echo  $data['Flight Name'];?></li>
                    <li><?php echo  $data['Source'];?></li>
                    <li><?php echo  $data['Destination'];?></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Container 1 for Extra Small Screens -->
    <div class="panel d-xs-block d-md-none">
        <h5>Flight Detail</h5>
        <ul class="list-unstyled">
            <li><strong>Order Number: </strong> #<?php echo $data['OrderID']; ?></li>
            <li><strong>Day of Travel: </strong> <?php echo  $data['DepartureDate'];?></li>
            <li><strong>Flight Name: </strong> <?php echo  $data['Flight Name'];?></li>
            <li><strong>Flight From: </strong> <?php echo  $data['Source'];?></li>
            <li><strong>Flight To: </strong><?php echo  $data['Destination'];?></li>
        </ul>
    </div>    

    <!-- Container 2 -->
    <div class="panel d-none d-sm-none d-md-block">
        <div class="row">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <h5>Billing Detail</h5>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
                <ul class="list-unstyled">
                    <li>First Name</li>
                    <li>Last Name</li>
                    <li>Email</li>
                    <li>Phone</li>
                </ul>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
                <ul class="list-unstyled">
                    <li><?php echo  $data['FirstName'];?></li>
                    <li><?php echo  $data['LastName'];?></li>
                    <li><?php echo  $data['Email'];?></li>
                    <li><?php echo  $data['Phone'];?></li>
                </ul>
            </div>
        </div>
    </div> 
    <!-- Container 2 for Extra Small Screens -->
    <div class="panel d-xs-block d-md-none">
        <h5>Billing Detail</h5>
        <ul class="list-unstyled">
            <li><strong>First Name:</strong> <?php echo  $data['FirstName'];?></li>
            <li><strong>Last Name:</strong> <?php echo  $data['LastName'];?></li>
            <li><strong>Email:</strong> <?php echo  $data['Email'];?></li>
            <li><strong>Phone:</strong><?php echo  $data['Phone'];?></li>
        </ul>
    </div>    
    <!-- Container 3 -->
    <div class="panel d-none d-sm-none d-md-block">
        <div class="row">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <h5>Payment Details</h5>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
                <ul class="list-unstyled">
                    <li>Person Base Price</li>
                    <li>Total</li>
                    <hr>
                    <li>Seat Numbers</li>
                </ul>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
                <ul class="list-unstyled">
                    <li><?php echo  $data['FlightCostPerPerson'];?>₹</li>
                    <li><?php echo  $data['OrderAmount'];?> ₹</li>
                    <hr>
                    <li><?php echo $data['SeatNumbers']; ?></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Container 3 For Extra Small Screen -->

    <div class="panel d-xs-block d-md-none">
    <h5>Payment Details</h5>
    <ul class="list-unstyled">
        <li><strong>Person Base Price: </strong> <?php echo $data['FlightCostPerPerson'];?> ₹</li>
        <hr>
        <li><strong>Total: </strong><?php echo $data['OrderAmount'];?> ₹</li>
        <hr>
        <li><strong>Seats Booked:</strong>
        <?php 
            echo $data['SeatNumbers'];
        ?>
    </li>
       
    </ul>
</div>

    
</div>

    
     <!-- Modal -->
     <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ticket Confirmation</h5>
      </div>
      <div class="modal-body">
        We will send you ticket via your email once we verify your payments.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">I understand</button>
      </div>
    </div>
  </div>
</div>

<div class="row justify-content-center">
        <div class="col-12 text-center">
        <a href="Contactus.php"><button type="button" class="btn btn-secondary">Contact Us</button></a>
        <a href="index.php"><button type="button" class="btn btn-primary">Home</button></a>

         </div>
</div>
<?php include_once('footer.php'); ?>

</body>
</html>