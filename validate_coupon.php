<?php

session_start();

include_once('connection.php');

$data = json_decode(file_get_contents('php://input'), true);
$couponCode = $data['couponCode'];

// if(isset($_SESSION['DiscountAmount'])) {
//     // If a coupon has already been applied, return an error message
//     echo json_encode(array("valid" => false, "message" => "You can only use one coupon at a time"));
//     exit; // Exit the script to prevent further execution
// }


// Query the database to check if the coupon code exists and retrieve its details
$query = "SELECT * FROM DiscountCoupon WHERE CouponCode = '$couponCode'";
$result = mysqli_query($conn, $query);

// Check if the coupon code exists
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    // Check if the coupon code is expired
    if ($row['ExpiryDate'] < date('Y-m-d')) {
        echo json_encode(array("valid" => false, "message" => "Coupon code expired"));
    } elseif ($row['UsageLimit'] == 0) {
        // Check if the usage limit for the coupon code is exceeded
        echo json_encode(array("valid" => false, "message" => "Coupon code limit exceeded"));
    } else {
        
            $_SESSION['DiscountAmount'] = $row['DiscountAmount'];
            $sqlUpdate = "UPDATE DiscountCoupon SET UsageLimit = UsageLimit - 1 WHERE CouponCode = '$couponCode'";
            $conn->query($sqlUpdate);

        // Coupon code is valid, return the discount amount
            echo json_encode(array("valid" => true, "discountAmount" => $row['DiscountAmount']));
    }

} else {
    // Coupon code does not exist
    echo json_encode(array("valid" => false, "message" => " Invalid coupon code"));

    //Store Discount Amount in JS's session
    
}

// Close the database connection
mysqli_close($conn);
?>
