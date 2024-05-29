<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#passwordForm").validate({
                rules: {
                    CurrentPassword: {
                        required: true,
                        minlength: 8
                    },
                    NewPassword: {
                        required: true,
                        minlength: 8
                    },
                    ConfirmPassword: {
                        required: true,
                        minlength: 8,
                        equalTo: "#NewPassword"
                    }
                },
                messages: {
                    CurrentPassword: {
                        required: "Please enter your current password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    NewPassword: {
                        required: "Please enter your new password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    ConfirmPassword: {
                        required: "Please confirm your new password",
                        minlength: "Your password must be at least 8 characters long",
                        equalTo: "Your passwords do not match"
                    }
                },
                submitHandler: function(form) {
                    // Submit the form via AJAX
                    $.ajax({
                        type: "POST",
                        url: "Change_Password.php", 
                        data: $(form).serialize(),
                        success: function(response) {
                          $("#messageBox").html(response).css({
                            "margin-top": "3px",
                            "text-align": "center", 
                            "padding": "8px", 
                            "border-radius": "8px", 
                            "background-color": "#ffffff", 
                           });


                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText); // Log any errors
                        }
                    });
                }
            });
        });
    </script>

<style>
    .error {
        color: red;
    }

    .form-container {
        border: 1px solid #ced4da;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        background-color: white;
    }

    body {
        background-color: #eee;
    }
</style>
</head>
<body>

<?php session_start(); include_once('Header.php');
if(!isset( $_SESSION['user_id'])){
  echo "<script>window.location.href= 'login.php'</script>";

} ?>


<div class="container mt-5">
  <!-- Message display area -->
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="mt-3 text-center p-2 rounded">
        <span id="messageBox"></span>
      </div>
    </div>
  </div>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="form-container">
        <form id="passwordForm" method="POST">
          <div class="form-group mb-3">
            <label for="CurrentPassword">Current Password</label>
            <input type="password" class="form-control" id="CurrentPassword" name="CurrentPassword" placeholder="Password">
          </div>
          <div class="form-group mb-3">
            <label for="NewPassword">New Password</label>
            <input type="password" class="form-control" id="NewPassword" name="NewPassword" placeholder="Password">
          </div>
          <div class="form-group mb-3">
            <label for="ConfirmPassword">Confirm Password</label>
            <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" placeholder="Password">
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>
