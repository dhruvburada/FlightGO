<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    
</head>
<body>

<!-- Navigation Bar START -->

<?php session_start(); include_once('Header.php');?>

<!-- Fetch Data From Database -->


<?php include_once 'connection.php'; ?>

<?php

// Check if the user is logged in (i.e., if the user ID is stored in the session)
if(isset($_SESSION['user_id'])) {
    include_once 'connection.php';
    $user_id = $_SESSION['user_id'];

    // Query to fetch user data based on user ID
    $query = "SELECT * FROM Customer WHERE UserID = $user_id";
    $query2 = "SELECT * FROM `RewardPoint` WHERE UserID = $user_id";


    $result = mysqli_query($conn, $query);
    $result2 = mysqli_query($conn , $query2);

    // Check if the query was successful
    if($result && $result2) {
        // Fetch the user data
        $user_data = mysqli_fetch_assoc($result);
        $rewards_data = mysqli_fetch_assoc($result2);
    } else {

        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
  } else {
    include "AccessDenied.php";
}
?>

<!-- Navigation Bar END -->

<section style="background-color: #eee;">
  <div class="container py-5">
    <!-- Breadcrumb Navigation -->
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="MyProfile.php">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
          </ol>
        </nav>
      </div>
    </div>

    <!-- Profile Section -->
    <div class="row">
      <!-- Profile Card -->
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <!-- Profile Picture -->
            <img src="img/profile_pic/<?php echo $user_data['PROFILE_PIC'] ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
            <!-- User Name -->
            <h5 class="my-3"><?php echo $user_data['FirstName'] . " ".$user_data['LastName'] ?></h5>
            <!-- Buttons for Profile Actions -->
            <div class="d-flex justify-content-center mb-2">
            <button type="button" class="btn btn-primary" onclick="document.getElementById('profilePicInput').click();">Change Profile Pic</button>
            <input type="file" id="profilePicInput" style="display: none;" accept="image/*" onchange="uploadProfilePic(this)">
            <button type="button" class="btn btn-outline-primary ms-1" onclick="location.href='ChangePassword.php';">Change Password</button>
            </div>
          </div>
        </div>

        <!-- Side Menu with Links -->
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush">
              <!-- List of Links -->
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fas fa-home fa-lg text-warning"></i>
                <p class="mb-0"><a href="index.php" style="text-decoration:none;">Home</a></p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fas fa-lock fa-lg" style="color: #55acee;"></i>
                <p class="mb-0"><a href="ChangePassword.php" style="text-decoration:none;">Change Password</a></p>
              </li>
              <li class= "list-group-item d-flex justify-content-between align-items-center p-3">
                <i class= "fas fa-history fa-lg" style= "color: #55acee;"></i>
                <p class= "mb-0"><a href= "OrderHistory.php" style= "text-decoration:none;">Order History</a></p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
    <i class="fas fa-history fa-lg" style="color: #55acee;"></i>
    
    <!-- Add the Redeem Rewards button here -->
    <form action="CheckRewards.php" method="post">
        <button type="submit" class="btn btn-primary">Redeem Rewards</button>
    </form>
</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- User Information Section -->
      <div class= "col-lg-8">
        <!-- User Details Card -->
        <div class= "card mb-4">
          <div class= "card-body">
            <!-- User Details Rows -->
            <!-- First Name Row -->
            <div class= "row">
              <div class= "col-sm-4">
                <p class= "mb-0">First Name </p>
              </div>
              <div class= "col-sm-4">
                <p class= "text-muted mb-0"><?php echo $user_data['FirstName'] ?> </p>
              </div>
              <div class="col-sm-4">
              <a href="#" data-bs-toggle="modal" data-bs-target="#editModal">
              <i class="fas fa-edit text-primary align-items-right edit-icon" data-field="FirstName"></i>
              </a>
              </div>
              
            </div>

            <!-- Last Name Row -->
            <hr>
            <div class= "row">
              <div class= "col-sm-4">
                <p class= "mb-0">Last Name</p>
              </div>
              <div class= "col-sm-4">
                <p class= "text-muted mb-0"><?php echo $user_data['LastName'] ?></p>
              </div>
              <div class="col-sm-4">
              <a href="#" data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fas fa-edit text-primary align-items-right edit-icon"></i>
                </a>
              </div>
            </div>

            <!-- Email Row -->
            <hr>
            <div class= "row">
              <div class= "col-sm-4">
                <p class= "mb-0">Email</p>
              </div>
              <div class= "col-sm-4">
                <p class= "text-muted mb-0"><?php echo $user_data['Email'] ?></p>
              </div>
              <div class="col-sm-4">
              <a href="#" data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fas fa-edit text-primary align-items-right edit-icon"></i>
                </a>
              </div>
            </div>

            <!-- Phone Row -->
            <hr>
            <div class= "row">
              <div class= "col-sm-4">
                <p class= "mb-0">Phone</p>
              </div>
              <div class= "col-sm-4">
                <p class= "text-muted mb-0"><?php echo $user_data['Phone'] ?></p>
              </div>
              <div class="col-sm-4">
              <a href="#" data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fas fa-edit text-primary align-items-right edit-icon"></i>
                </a>
              </div>
            </div>

            <!-- Nationality Row -->
            <hr>
            <div class= "row">
              <div class= "col-sm-4">
                <p class= "mb-0">Nationality</p>
              </div>
              <div class= "col-sm-4">
                <p class= "text-muted mb-0"><?php echo $user_data['Nationality'] ?></p>
              </div>
              <div class="col-sm-4">
              <a href="#" data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fas fa-edit text-primary align-items-right edit-icon"></i>
                </a>
              </div>
            </div>

            <!-- Age Row -->
            <hr>
            <div class= "row">
              <div class= "col-sm-4">
                <p class= "mb-0">Age</p>
              </div>
              <div class= "col-sm-4">
                <p class= "text-muted mb-0"><?php echo $user_data['Age'] ?></p>
              </div>
              <div class="col-sm-4">
              <a href="#" data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fas fa-edit text-primary align-items-right edit-icon"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

                <!-- Points Card and Progress Bars -->
                <div class="row">
          <div class="col-md-4">
            <div class="card mb-4 mb-md-0">
            <div class="card-body">
                <p class="mb-2">Points<span class="text-primary font-italic me-1"> Earned </span></p>
                <p class="mb-1" style="font-size: .77rem;"><?php echo $rewards_data['PointsEarned'] ?> Points</p>
                <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo ($rewards_data['PointsEarned'] / ($rewards_data['PointsEarned'] + $rewards_data['PointsRedeemed'] + $rewards_data['PointsBalance'])) * 100 ?>%" aria-valuenow="<?php echo $rewards_data['PointsEarned'] ?>" aria-valuemin="0" aria-valuemax="<?php echo $rewards_data['PointsEarned'] + $rewards_data['PointsRedeemed'] + $rewards_data['PointsBalance'] ?>"></div>
                </div>

                <p class="mb-2 mt-2">Points <span class="text-primary font-italic me-1 ">Redeemed</span></p>
                <p class="mb-1" style="font-size: .77rem;"><?php echo $rewards_data['PointsRedeemed'] ?> Points</p>
                <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo ($rewards_data['PointsRedeemed'] / ($rewards_data['PointsEarned'] + $rewards_data['PointsRedeemed'] + $rewards_data['PointsBalance'])) * 100 ?>%" aria-valuenow="<?php echo $rewards_data['PointsRedeemed'] ?>" aria-valuemin="0" aria-valuemax="<?php echo $rewards_data['PointsEarned'] + $rewards_data['PointsRedeemed'] + $rewards_data['PointsBalance'] ?>"></div>
                </div>
                
                <p class="mb-2 mt-2">Points <span class="text-primary font-italic me-1 ">Balance</span></p>
                <p class="mb-1" style="font-size: .77rem;"><?php echo $rewards_data['PointsBalance'] ?> Points</p>
                <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo ($rewards_data['PointsBalance'] / ($rewards_data['PointsEarned'] + $rewards_data['PointsRedeemed'] + $rewards_data['PointsBalance'])) * 100 ?>%" aria-valuenow="<?php echo $rewards_data['PointsBalance'] ?>" aria-valuemin="0" aria-valuemax="<?php echo $rewards_data['PointsEarned'] + $rewards_data['PointsRedeemed'] + $rewards_data['PointsBalance'] ?>"></div>
                </div>
     
              </div>
            </div>
          </div>

          <!-- Address Information Card -->
          <div class="col-md-8">
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-4">
                    <p class="mb-0">Country</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="text-muted mb-0"><?php echo $user_data['Country'] ?></p>
                  </div>
                  <div class="col-sm-4">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#editModal">
                  <i class="fas fa-edit text-primary align-items-right edit-icon"></i>
                  </a>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-4">
                    <p class="mb-0">State</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="text-muted mb-0"><?php echo $user_data['State'] ?></p>
                  </div>
                  <div class="col-sm-4">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fas fa-edit text-primary align-items-right edit-icon"></i>
                </a>
              </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-4">
                    <p class="mb-0">PostalCode</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="text-muted mb-0"><?php echo $user_data['PostalCode'] ?></p>
                  </div>
                  <div class="col-sm-4">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fas fa-edit text-primary align-items-right edit-icon"></i>
                </a>
              </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Field</h5>
                </button>
            </div>
            <form id="editForm" method="post">
                <div class="modal-body">
                    <input type="text" class="form-control" id="newValue" name="new_value">
                    <input type="hidden" id="fieldName" name="field_name">
                    <div id="error-msg" class="text-danger"></div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="SaveChanges">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
var fieldName;

$('.edit-icon').click(function() {
    fieldName = $(this).closest('.row').find('.col-sm-4:first-child').text().trim();
    $('#fieldName').val(fieldName);
    $('#editModalLabel').text('Edit ' + fieldName);
    $('#editModal').modal('show');

    
});

$('#SaveChanges').click(function() {
  var newVal = $('#newValue').val();
  fieldName = fieldName.replace(/\s/g, '');
  var regex = {
        'FirstName': /^[A-Za-z]+$/,
        'LastName': /^[A-Za-z]+$/,
        'Nationality': /^[A-Za-z]+$/,
        'State': /^[A-Za-z]+$/,
        'Age': /^\d+$/,
        'Phone': /^\d+$/,
        'PostalCode': /^[A-Za-z]+$/,
        'Email': /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    };
    
    // Check if the fieldName exists in the regex object
    if (!regex.hasOwnProperty(fieldName)) {
        console.error('fieldName is not set', fieldName); // Log an error if fieldName is invalid
        return;
    }
    
    // Perform validation based on the regular expression corresponding to the fieldName
    if (!regex[fieldName].test(newVal)) {
        $('#error-msg').text('Invalid ' + fieldName); // Update error message
        return;
    }
    
    $('#editForm').submit(); // Submit the form

});

//call the validation function when enter key is pressed 
$('#newValue').keypress(function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        $('#SaveChanges').click();
    }
});


//To hide the error when modal is closed
$('#editModal').on('hidden.bs.modal', function () {
    $('#error-msg').text('');
});

//File upload

function uploadProfilePic() {
    var fileInput = document.getElementById('profilePicInput');
    var file = fileInput.files[0]; // Get the uploaded file
    var formData = new FormData(); // Create FormData object to send file data

    formData.append('profilePic', file); // Append the file to FormData object

    // Create XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure XMLHttpRequest
    xhr.open('POST', 'upload_profile_pic.php'); // Specify the URL of the server-side script
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // Set custom header for AJAX request

    // Define function to handle AJAX response
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Check if the response is successful
            console.log(xhr.responseText); // Log the server response
            // You can handle further actions based on the response from the server
        } else {
            console.error('Upload failed. Error code: ' + xhr.status); // Log error if upload fails
        }
    };

    // Send the FormData object containing the file to the server
    xhr.send(formData);
}


$('#editForm').submit(function(e) {
    e.preventDefault(); // Prevent default form submission
    // Serialize form data
    var formData = $(this).serialize();
    $.ajax({
        url: 'update_profile.php',
        method: 'POST',
        data: formData,
        success: function(response) {
            console.log(response);
            location.reload();
            $('#editModal').modal('hide');
        },
        error: function(xhr, status, error) {
            console.log("Error occurred");
            console.error(xhr.responseText);
        }
    });
});


//Upload File

function uploadProfilePic() {
    var fileInput = document.getElementById('profilePicInput');
    var file = fileInput.files[0]; // Get the uploaded file
    var formData = new FormData(); // Create FormData object to send file data

    formData.append('profilePic', file); // Append the file to FormData object

    // Create XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure XMLHttpRequest
    xhr.open('POST', 'upload.php'); // Specify the URL of the server-side script
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // Set custom header for AJAX request

    // Define function to handle AJAX response
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Check if the response is successful
            console.log(xhr.responseText); // Log the server response
            location.reload();

        } else {
            console.error('Upload failed. Error code: ' + xhr.status); // Log error if upload fails
        }
    };

    // Send the FormData object containing the file to the server
    xhr.send(formData);
}


</script>
</body>
</html>