<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Location</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            padding-top: 50px;
        }
        .location-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,.1);
        }
        .location-card img {
            border-radius: 10px;
            margin-bottom: 20px;
            max-width: 100%;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        h2 {
            color: #007bff;
        }
    </style>
</head>
<body>

<?php
// Check if destination name is set in the URL
if(isset($_GET['destination'])) {
    // Connect to the database
    include_once('connection.php');
    
    // Sanitize input to prevent SQL injection
    $destination = mysqli_real_escape_string($conn, $_GET['destination']);
    
    // SQL query to fetch information about the selected location
    $sql = "SELECT * FROM slider WHERE name = '$destination'";
    $result = mysqli_query($conn, $sql);

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="location-card">
                        <img src="<?php echo $row['image_url']; ?>" class="img-fluid" alt="<?php echo $row['name']; ?>">
                        <h2><?php echo $row['name']; ?></h2>
                        <p><?php echo $row['description']; ?></p>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        echo "<div class='container'><div class='alert alert-danger' role='alert'>Location not found!</div></div>";
    }
    
    // Close database connection
    mysqli_close($conn);
} else {
    echo "<div class='container'><div class='alert alert-danger' role='alert'>No location selected!</div></div>";
}
?>

</body>
</html>
