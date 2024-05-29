<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Rewards</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<?php
session_start();
include_once('connection.php');

$query = "SELECT PointsBalance, PointsRedeemed 
          FROM RewardPoint
          WHERE UserID = {$_SESSION['user_id']}";

$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $pointsBalance = $row['PointsBalance'];
    $pointsRedeemed = $row['PointsRedeemed'];

    // Step 5: Fetch Coupon Codes based on Points Balance
    $couponQuery = "SELECT CouponCode, DiscountAmount, PointsRequired 
                    FROM DiscountCoupon 
                    WHERE PointsRequired <= $pointsBalance 
                    ORDER BY PointsRequired DESC";
    $couponResult = mysqli_query($conn, $couponQuery);

    if ($couponResult && mysqli_num_rows($couponResult) > 0) {
        // Update user's PointBalance and PointsRedeemed
        $couponRow = mysqli_fetch_assoc($couponResult);
        $requiredPoints = $couponRow['PointsRequired'];
        $newPointsBalance = $pointsBalance - $requiredPoints;
        $newPointsRedeemed = $pointsRedeemed + $requiredPoints;
        $updateQuery = "UPDATE RewardPoint 
                        SET PointsBalance = $newPointsBalance, PointsRedeemed = $newPointsRedeemed 
                        WHERE UserID = {$_SESSION['user_id']}";
        mysqli_query($conn, $updateQuery);

        // Display the modal and coupon information
        ?>
        <div class="modal" id="couponModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Rewards</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        // Fetch coupon codes from database
                        $couponQuery = "SELECT CouponCode, DiscountAmount, PointsRequired 
                                        FROM DiscountCoupon 
                                        WHERE PointsRequired <= $pointsBalance 
                                        ORDER BY PointsRequired DESC";
                        $couponResult = mysqli_query($conn, $couponQuery);

                        if ($couponResult && mysqli_num_rows($couponResult) > 0) {
                            // Display coupon codes
                            echo "<ul>";
                            while ($couponRow = mysqli_fetch_assoc($couponResult)) {
                                echo "<h3>Congratulations !!</h3>";
                                echo "You have won Voucher of worth " . $couponRow['DiscountAmount'];
                                echo '<img src="img/voucher.gif" style="max-width: 75%; height: auto;">';
                                echo "<li>Coupon Code: " . $couponRow['CouponCode'] . "</li>";
                                echo "Please Store it for later use.";
                                break;
                            }
                            echo "</ul>";
                        } else {
                            // No available coupon codes
                            echo "<p>No available coupon codes. You don't have enough points to earn any coupon.</p>";
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="window.location.href='MyProfile.php'">Back</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Trigger modal display on page load
            document.addEventListener("DOMContentLoaded", function() {
                var myModal = new bootstrap.Modal(document.getElementById('couponModal'));
                myModal.show();
            });
        </script>
        <?php
    }
} else {
    echo "Error fetching reward points: " . mysqli_error($conn);
}
?>



<script>
    // Trigger modal display on page load
    document.addEventListener("DOMContentLoaded", function() {
        var myModal = new bootstrap.Modal(document.getElementById('couponModal'));
        myModal.show();
    });
</script>


<script>
    var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})
</script>