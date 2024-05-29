<?php
include_once('helpers/init_conn_db.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set parameters
    $UserID = $_POST['UserID'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Nationality = $_POST['Nationality'];
    $Age = $_POST['Age'];
    $Country = $_POST['Country'];
    $State = $_POST['State'];
    $City = $_POST['City'];
    $PostalCode = $_POST['PostalCode'];
    $Email = $_POST['Email'];
    $Phone = $_POST['Phone'];
    
    // Handle profile picture upload
    if (isset($_FILES["PROFILE_PIC"]) && $_FILES["PROFILE_PIC"]["error"] === UPLOAD_ERR_OK) {
        // Generate a random string for the filename
        $randomString = uniqid();

        // Extract file extension
        $fileExtension = pathinfo($_FILES["PROFILE_PIC"]["name"], PATHINFO_EXTENSION);

        // Construct the new filename
        $ProfilePic = "profile_pic_" . $randomString . "." . $fileExtension;

        // Target directory
        $targetDir = "../img/profile_pic/";
        $targetFile = $targetDir . $ProfilePic;

        // Check file size
        if ($_FILES["PROFILE_PIC"]["size"] > 400000) {
            echo "Sorry, your file is too large.";
            exit;
        }

        // Allow certain file formats
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit;
        }

        // Check if file already exists and remove it
        if (file_exists($targetFile)) {
            unlink($targetFile); // Remove the existing file
        }

        // Move the uploaded file to the target directory
        if (!move_uploaded_file($_FILES["PROFILE_PIC"]["tmp_name"], $targetFile)) {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    }

    // Prepare and bind the data for database update
    $stmt = $conn->prepare("UPDATE Customer SET FirstName=?, LastName=?, Nationality=?, Age=?, Country=?, State=?, City=?, PostalCode=?, Email=?, Phone=?, PROFILE_PIC=? WHERE UserID=?");
    $stmt->bind_param("sssissssssss", $FirstName, $LastName, $Nationality, $Age, $Country, $State, $City, $PostalCode, $Email, $Phone, $ProfilePic, $UserID);

    // Execute the update statement
    if ($stmt->execute()) {
        echo "Record updated successfully.";
        header('location:customers.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
