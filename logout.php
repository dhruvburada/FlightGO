<?php
session_start();

// Clear PHP session data
unset($_SESSION['user_id']);
session_destroy();
?>

<script>
    // Clear sessionStorage
    sessionStorage.clear();
    
    // Redirect to login page
    window.location.href = "login.php";
</script>
