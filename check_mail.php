<?php
include_once("connection.php");

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $q = "SELECT * FROM User WHERE Email='$email'";
    $result = mysqli_query($conn, $q);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo 'exists';
    } else {
        echo 'not_exists';
    }
}
?>
