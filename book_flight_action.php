<?php

session_start();
include_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_SESSION['user_id'];
    $flightid = $_SESSION['flight_id'];
    $total = $_SESSION['total'];

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
    $discount_coupon = $_POST["discount_coupon"];

    $paymentMethod = $_POST["paymentMethod"]; // Assuming you have a payment method field in your form

    // Handle image uploads
    $upiScreenshot = $_FILES["upiScreenshot"]; // Assuming the name of your file input is "upiScreenshot"
    $bankScreenshot = $_FILES["bankScreenshot"]; // Assuming the name of your file input is "bankScreenshot"

    $sql_check_customer = "SELECT * FROM Customer WHERE UserID = $userid";
    $result_check_customer = mysqli_query($conn, $sql_check_customer);

    if (mysqli_num_rows($result_check_customer) > 0) {
        // Customer exists, update their information
        $sql_update_customer = "UPDATE Customer SET Firstname = '$firstname', Lastname = '$lastname', Nationality = '$nationality', Age = $age, Country = '$country', `State` = '$state', City = '$city', PostalCode = '$postalCode',Email = '$email', phone = '$phone' WHERE UserID = $userid";
        
        if (mysqli_query($conn, $sql_update_customer)) {
            echo "Customer information updated successfully";
        } else {
            echo "Error updating customer information: " . mysqli_error($conn);
        }
    } else {
        // Customer does not exist, insert their information
        $sql_insert_customer = "INSERT INTO Customer (Firstname, Lastname, Nationality, Age, Country, `State`, City, PostalCode, Email, Phone) VALUES ('$firstname', '$lastname', '$nationality', $age, '$country', '$state', '$city', '$postalCode', '$email', '$phone')";
        
        if (mysqli_query($conn, $sql_insert_customer)) {
            echo "New record created successfully";
        } else {
            echo "Error inserting record: " . mysqli_error($conn);
        }
    }


    if ($_FILES['bankScreenshot']['error'] == UPLOAD_ERR_OK) {
        // Bank screenshot was uploaded
        $tmp_name = $_FILES["bankScreenshot"]["tmp_name"];
        $filename = $_FILES["bankScreenshot"]["name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $newFilename = uniqid('payment_') . '.' . $ext;
        $destination = "img/payments/BankTransfer/" . $newFilename;
    } elseif ($_FILES['upiScreenshot']['error'] == UPLOAD_ERR_OK) {
        // UPI screenshot was uploaded
        $tmp_name = $_FILES["upiScreenshot"]["tmp_name"];
        $filename = $_FILES["upiScreenshot"]["name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $newFilename = uniqid('payment_') . '.' . $ext;
        $destination = "img/payments/UPI/" . $newFilename;
    } else {
        // Neither file was uploaded or an error occurred
        echo "No file uploaded or an error occurred.";
        // Handle the error or exit
    }
    
    // Move the uploaded file to the destination folder
    if (move_uploaded_file($tmp_name, $destination)) {
        // File moved successfully, proceed with storing order information
        $sql_insert_order = "INSERT INTO `Order` (OrderAmount, UserID, FlightID, PaymentScreenshotFile, PaymentStatus) VALUES ($total, $userid, $flightid, '$newFilename', 'Pending')";
    
        if (mysqli_query($conn, $sql_insert_order)) {
            echo "Order information stored successfully<br>";
            header("Location: OrderHistory.php");
        } else {
            echo "Error inserting order information: " . mysqli_error($conn);
        }
    } else {
        // Error moving file
        echo "Error uploading file.";
    }
}    

$num_travelers = $num_travelers+1;
$sql_update_seat = "UPDATE Flight SET Seats = Seats - $num_travelers WHERE FlightID = $flightid";

// Execute the query
if (mysqli_query($conn, $sql_update_seat)) {
    echo "Seat count updated successfully.";
} else {
    echo "Error updating seat count: " . mysqli_error($conn);
}


unset($_SESSION['flight_id']);
unset($_SESSION['total']);
unset($_SESSION['DiscountAmount']);
    
mysqli_close($conn);
?>