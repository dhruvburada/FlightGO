<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Failed Payment</title>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #f0f0f0;
    }

    .container {
    max-width: 400px; /* Set the maximum width of the container */
    margin: 0 auto; /* Center the container horizontally */
    text-align: center;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}



    .error-message {
        margin-top: 20px;
        font-weight: bold;
        color: red;
    }

    .error-list {
        list-style-type: none;
        padding: 0;
    }

    .error-list li {
        margin-bottom: 10px;
    }

    .home-button {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #3498db;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }

    .image {
    max-width: 100%; /* Make the image responsive */
    height: auto; /* Maintain aspect ratio */
}
</style>
</head>
<body>
<div class="container">
<img src="img/payment_failed.gif" alt="Failed Payment GIF" class="image">
    <?php if(isset($_GET) && !empty($_GET)) { ?>
        <h2>Your Payment Has been failed</h2>
        <ul class="error-list">
            <?php foreach($_GET as $key => $value) { ?>
                <li><strong><?php echo $key; ?>:</strong> <?php echo $value; ?></li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <p class="error-message">Failed to retrieve error parameters.</p>
    <?php } ?>

    <a href="index.php" class="home-button">Back to Home</a>
</div>
</body>
</html>


<?php

unset($_SESSION['flight_id']);
unset($_SESSION['total']);
unset($_SESSION['DiscountAmount']);

?>

<script>
    sessionStorage.clear();
</script>

