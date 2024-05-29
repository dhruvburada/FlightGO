<?php
include_once 'helpers/init_conn_db.php';
include_once 'header.php';

// Initialize variables
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM Customer WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $UserID = $row['UserID'];
        $FirstName = $row['FirstName'];
        $LastName = $row['LastName'];
        $Nationality = $row['Nationality'];
        $Age = $row['Age'];
        $Country = $row['Country'];
        $State = $row['State'];
        $City = $row['City'];
        $PostalCode = $row['PostalCode'];
        $Email = $row['Email'];
        $Phone = $row['Phone'];
        $ProfilePic = $row['PROFILE_PIC'];
    } else {
        echo "Customer not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f7ff; /* Light blue background */
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #ffffff; /* White background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }
        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #0074d9; /* Blue button */
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="form-container">
        <h2 style="text-align: center; color: #0074d9;">Edit Customer</h2>
        <form action="update_customer.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
            <div class="form-group row">
                <label for="FirstName" class="col-sm-3 col-form-label">First Name:</label>
                <div class="col-sm-9">
                    <input type="text" id="FirstName" name="FirstName" value="<?php echo $FirstName; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="LastName" class="col-sm-3 col-form-label">Last Name:</label>
                <div class="col-sm-9">
                    <input type="text" id="LastName" name="LastName" value="<?php echo $LastName; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="Nationality" class="col-sm-3 col-form-label">Nationality:</label>
                <div class="col-sm-9">
                    <input type="text" id="Nationality" name="Nationality" value="<?php echo $Nationality; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="Age" class="col-sm-3 col-form-label">Age:</label>
                <div class="col-sm-9">
                    <input type="number" id="Age" name="Age" value="<?php echo $Age; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="Country" class="col-sm-3 col-form-label">Country:</label>
                <div class="col-sm-9">
                    <input type="text" id="Country" name="Country" value="<?php echo $Country; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="State" class="col-sm-3 col-form-label">State:</label>
                <div class="col-sm-9">
                    <input type="text" id="State" name="State" value="<?php echo $State; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="City" class="col-sm-3 col-form-label">City:</label>
                <div class="col-sm-9">
                    <input type="text" id="City" name="City" value="<?php echo $City; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="PostalCode" class="col-sm-3 col-form-label">Postal Code:</label>
                <div class="col-sm-9">
                    <input type="text" id="PostalCode" name="PostalCode" value="<?php echo $PostalCode; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="Email" class="col-sm-3 col-form-label">Email:</label>
                <div class="col-sm-9">
                    <input type="email" id="Email" name="Email" value="<?php echo $Email; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="Phone" class="col-sm-3 col-form-label">Phone:</label>
                <div class="col-sm-9">
                    <input type="text" id="Phone" name="Phone" value="<?php echo $Phone; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="ProfilePic" class="col-sm-3 col-form-label">Profile Picture:</label>
                <div class="col-sm-9">
                    <input type="file" id="ProfilePic" name="PROFILE_PIC" accept="image/*" value="<?php echo $ProfilePic; ?>"required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="submit" value="Update" style="width: 100%;">
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
