<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    

<?php
include_once("connection.php");

$em = $_REQUEST['em'];
$token = $_REQUEST['token'];

$q = "select * from User where Email='$em' and Token='$token'";
$result = mysqli_query($conn, $q);
$count = mysqli_num_rows($result);

if ($count == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
        $status = $row["isActive"];
        if ($status == "Active") {
            $_SESSION['success'] = "Account is already activated";
        } else {
            $updt = "update User set isActive=1 where email='$em' and token='$token'";
            if (mysqli_query($conn, $updt)) {
                setcookie('success', "Account activated successfully", time() + 2, "/");
            } else {
                setcookie('error', "Error in activating Account. Please try again later.", time() + 2, "/");
            }
        }
        
          echo '<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
        <h1 class="mb-4" style="color:blue">Your Account has Activated Successfully !</h1>
        <p class="mb-4">Please Login to continue.</p>
        <a href="login.php" class="btn btn-primary">Go to Login Page</a>
    </div>
</div>';
?>
    <?php
    }
} else {
    setcookie('error', "Either Email is not registered or token is incorrect.", time() + 2, "/");
    ?>
    <script>
        window.location.href = "register.php";
    </script>
<?php
}
?>
