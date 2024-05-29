<?php
session_start();
if (isset($_SESSION['user_id'])) {
    include_once 'connection.php'; // Include database connection

    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profilePic'])) {
        $file = $_FILES['profilePic'];
        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileTmpName = $file['tmp_name'];

        $userdetails = "SELECT Profile_Pic FROM Customer WHERE UserID = $user_id";
        $deleteResult = mysqli_fetch_assoc(mysqli_query($conn, $userdetails));
        $old_dp = $deleteResult['Profile_Pic'];

        

        if ($fileType === 'image/jpeg' || $fileType === 'image/png') {
            $uniqueId = 'profile_pic_' . uniqid(); // Generate a unique ID
            $newFileName = $uniqueId . '.' . pathinfo($fileName, PATHINFO_EXTENSION); 
            $destination = 'img/profile_pic/' . $newFileName; 

            if (move_uploaded_file($fileTmpName, $destination)) {
                // Update the database with the filename or unique ID of the uploaded picture
                $updateQuery = "UPDATE Customer SET Profile_Pic = '$newFileName' WHERE UserID = $user_id";
                $result = mysqli_query($conn, $updateQuery);

                if ($result) {
                    if ($old_dp && file_exists('img/profile_pic/' . $old_dp)) {
                        unlink('img/profile_pic/' . $old_dp);
                        echo 'Old profile picture deleted successfully.';
                    } else {
                        echo 'Old profile picture not found.';
                    }

                } else {
                    echo 'Error updating database.';
                }
            } else {
                echo 'Error moving file to destination.';
            }
        } else {
            echo 'Please select a valid image file (JPEG or PNG).';
        }
    } else {
        echo 'Invalid request.';
    }
} else {
    echo 'User session not found.';
}
?>
