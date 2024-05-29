<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Flights</title>

    <?php session_start();
    $_SESSION['flight_id'] = $_GET['flight_id'];
    include_once('connection.php');?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="BSstyle.css">

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>


<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
$(function(){
    $("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        transitionEffectSpeed: 500,
        onStepChanging: function (event, currentIndex, newIndex) { 
            if (newIndex === 1) {
                $('.steps ul').addClass('step-2');
            } else {
                $('.steps ul').removeClass('step-2');
            }
            if (newIndex === 2) {
                $('.steps ul').addClass('step-3');
            } else {
                $('.steps ul').removeClass('step-3');
            }
            if (newIndex === 3) {
                $('.steps ul').addClass('step-4');
                $('.actions ul').addClass('step-last');
            } else {
                $('.steps ul').removeClass('step-4');
                $('.actions ul').removeClass('step-last');
            }
            return true; 
        },
        labels: {
            finish: "Order again",
            next: "Next",
            previous: "Previous"
        }
    });

    var storedStepIndex = sessionStorage.getItem("currentStep");
    if (storedStepIndex !== null) {
        // Set the wizard to the stored step index
        $("#wizard").steps("setStep", parseInt(storedStepIndex));
    }
    
    // Custom Steps Jquery Steps
    $('.wizard > .steps li a').click(function(){
        $(this).parent().addClass('checked');
        $(this).parent().prevAll().addClass('checked');
        $(this).parent().nextAll().removeClass('checked');
    });
    
    // Custom Button Jquery Steps
    $('.forward').click(function(){
        $("#wizard").steps('next');
    });
    
    $('.backward').click(function(){
        $("#wizard").steps('previous');
    });
    
    // Checkbox
    $('.checkbox-circle label').click(function(){
        $('.checkbox-circle label').removeClass('active');
        $(this).addClass('active');
    });
});
</script>




<style>
    #applyDiscountBtn {
    padding: 10px 10px; /* Adjust padding if needed */
}

.valid-message {
    color: green;
}

.invalid-message {
    color: red;
}


.order-summary {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.summary-details {
    margin-top: 20px;
}

.summary-item {
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
}

.item-label {
    font-weight: bold;
}

.total {
    border-top: 2px solid #ccc;
    margin-top: 10px;
}

/* CSS for payment section */
.payment-options {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.payment-details {
    display: none;
    margin-bottom: 20px;
}

.payment-details h3 {
    margin-bottom: 10px;
}

.payment-details p {
    margin-bottom: 5px;
}

/* Style file input */
input[type="file"] {
    margin-top: 10px;
}

/* Button styles */
.form-footer button {
    margin-right: 10px;
}


</style>




</head>
<body>
    
</body>
</html>

<?php

if (!isset($_SESSION['user_id'])) {
    $_SESSION['flight_id'] = $_GET['flight_id'];
    echo '<script>window.location.href="login.php"</script>';
    
    exit(); 
}
else
{
?>


<h1 class="text-center fs-4">Billing Form</h1>
    <form id="signUpForm" action="book_flight_action.php" method="post" enctype="multipart/form-data">
        <!-- start step indicators -->
        <div class="form-header d-flex mb-4">
            <span class="stepIndicator">Account Setup</span>
            <span class="stepIndicator">Additional Information</span>
            <span class="stepIndicator">Order Summary</span>
            <span class="stepIndicator">Payment</span>
        </div>
        <!-- end step indicators -->
    
        <!-- step one -->
        <div class="step">
            <p class="text-center mb-4">Personal Details</p>

            <div class="col-md-12">
                <label for="firstname" class="form-label" oninput="this.className = ''" name="firstname">First Name <sup>*</sup></label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter your first name" required pattern="[A-Za-z]+" onchange="showErrorMessage(this)">
                <div class="invalid-feedback error-message">Please provide a valid first name.</div>
            </div>


            <div class="col-md-12">
                <label for="lastname" class="form-label" oninput="this.className = ''" name="lastname">Last Name <sup>*</sup></label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your last name" required pattern="[A-Za-z]+" onchange="showErrorMessage(this)">
                    <div class="invalid-feedback">Please provide a valid last name.</div>
            </div>

            <div class="col-md-12">
                <label for="nationality" class="form-label" oninput="this.className = ''" name="nationality">Nationality <sup>*</sup></label>
                    <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Enter your nationality" required pattern="[A-Za-z]+" onchange="showErrorMessage(this)">
                    <div class="invalid-feedback">Please provide your nationality.</div>
            </div>

            <div class="col-md-12">
                <label for="age" class="form-label" oninput="this.className = ''" name="age">Age <sup>*</sup></label>
                    <input type="number" class="form-control" id="age" name="age" placeholder="Enter your age" required onchange="showErrorMessage(this)" min="10">
                    <div class="invalid-feedback">Please provide your age.</div>
            </div>

            <div class="col-md-12">
                <label for="country" class="form-label" oninput="this.className = ''">Country <sup>*</sup></label>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Enter your country" required pattern="[A-Za-z]+" onchange="showErrorMessage(this)">
                    <div class="invalid-feedback">Please provide your country.</div>
            </div>

            <div class="col-md-12">
                <label for="state" class="form-label" oninput="this.className = ''">State <sup>*</sup></label>
                    <input type="text" class="form-control" id="state" name="state" placeholder="Enter your state" required pattern="[A-Za-z]+" onchange="showErrorMessage(this)">
                    <div class="invalid-feedback">Please provide your state.</div>
            </div>

            <div class="col-md-12">
                <label for="city" class="form-label" oninput="this.className = ''" name="city">City <sup>*</sup></label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" required pattern="[A-Za-z]+" onchange="showErrorMessage(this)">
                    <div class="invalid-feedback">Please provide your city.</div>
            </div>

            <div class="col-md-12">
                <label for="postalCode" class="form-label" oninput="this.className = ''">Postal Code <sup>*</sup></label>
                    <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="Enter your postal code" required pattern="[0-9]{6}" onchange="showErrorMessage(this)"> 
                    <div class="invalid-feedback">Please provide your postal code.</div>
            </div>

            <div class="col-md-12">
                <label for="email" class="form-label" oninput="this.className = ''" name="email">Email <sup>*</sup></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required onchange="showErrorMessage(this)" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                    <div class="invalid-feedback">Please provide a valid email address.</div>
            </div>

            <div class="col-md-12">
                <label for="phone" class="form-label" oninput="this.className = ''" name="phone">Phone <sup>*</sup></label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required pattern="[0-9]{10}" onchange="showErrorMessage(this)">
                    <div class="invalid-feedback">Please provide a valid phone number.</div>
            </div>
        </div>
    
   

        <!-- step two -->
        <div class="step">
                    <p class="text-center mb-4">Enter number of travelers and apply discount coupon</p>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <input type="number" class="form-control" placeholder="Number of Travelers Travelling with you" name="num_travelers" id="num_travelers" min="0" onfocusout="storeNumTravelers()">
                    <div class="invalid-feedback" id="numerror">Travelers can be from  0 to 4 people.</div>
                </div>
            </div>    
            <div class="row">
                <div class="col-md-10 mb-3">
                    <div class="input-group discount-coupon-wrapper">
                        <input type="text" class="form-control" placeholder="Discount Coupon" oninput="this.className = ''" name="discount_coupon" id="discountCoupon">
                    </div>
                </div>    
                <div class="col-md-2">
                    <div class="input-group">
                        <button class="btn btn-outline-secondary btn-lg" type="button" id="applyDiscountBtn" onclick="applyDiscount()">Apply</button>
                    </div>
                </div>
            </div>
            <div id="couponMessage"></div>
        </div>   




        <script>
    function updateOrderSummary(discountAmount, numTravelers) {
    // AJAX request to the PHP script
    $.ajax({
        url: 'OrderSummary.php', // Change the URL to your PHP script
        method: 'POST',
        dataType: 'html',
        data: {
            discountAmount: discountAmount,
            numTravelers: numTravelers
        },
        success: function(response) {
            // Update the order summary section with the response from PHP script
            $('.order-summary').html(response);
        },
        error: function(xhr, status, error) {
            // Handle error if AJAX request fails
            console.error(error);
            alert('An error occurred while updating the order summary.');
        }
    });
}



</script>

        <!-- step three -->
        <div class="step">
            <div class="order-summary">
            
            </div>
        </div>


        </div>

            <!-- Step 4: Payment -->
            <div class="step">
                <h2 class="section-title">Payment</h2>
                
                <!-- Payment Options -->
                <div class="payment-options">
                    <div class="option">
                        <input type="radio" id="upiPayment" name="paymentMethod" value="upi" checked>
                        <label for="upiPayment">UPI Payment</label>
                    </div>
                    <div class="option">
                        <input type="radio" id="bankTransfer" name="paymentMethod" value="bank">
                        <label for="bankTransfer">Direct Bank Transfer</label>
                    </div>

                    <div class="option">
                    <input type="radio" id="razorPay" name="paymentMethod" value="razorpay" id="razorPay">
                    <label for="razorPay">Razor Pay</label>
                </div>
                </div>
                

                <!-- UPI Payment Details -->
                <div id="upiDetails" class="payment-details">
                    <h3>UPI Payment Details</h3>
                    <p>Please transfer the amount to the following UPI ID and upload the payment screenshot.</p>
                    <p>UPI ID: dhruvburada@upi.com</p>
                    <input type="file" class="form-control" id="upiScreenshot" name="upiScreenshot" accept="image/*" capture="camera" required>
                    <div class="invalid-feedback">Please select an image.</div>
                </div>
                
                <!-- Bank Transfer Details -->
                <div id="bankDetails" class="payment-details">
                    <h3>Direct Bank Transfer Details</h3>
                    <p>Please transfer the amount to the following bank account and upload the payment screenshot.</p>
                    <p>Bank Account: XXXX XXXX XXXX XXXX</p>
                    <input type="file" class="form-control" id="bankScreenshot" name="bankScreenshot" accept="image/*" capture="camera" required>
                    <div class="invalid-feedback">Please select an image.</div>
                </div>

             </div>


        </div>

        <input type="hidden" name="flightID" value="<?php echo $_SESSION['flight_id']; ?>">
        <input type="hidden" name="total" value="<?php echo $_SESSION['total']; ?>">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

        <div id="orderGenerated" style="display: none;">
                <h2>Order Generated!</h2>
                <img src="img/ordercomplete.gif" alt="Beautiful GIF">
                <p>Your order has been successfully generated. Click <a href="OrderHistory.php">here</a> to view your order details.</p>
            </div>
        <!-- start previous / next buttons -->
        <div class="form-footer d-flex">
            <button type="button" class="indi" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" class="indi" id="nextBtn" onclick="nextPrev(1)">Next</button>
        </div>
        <!-- end previous / next buttons -->
    </form>

    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab
        
        function showTab(n) {
          // This function will display the specified tab of the form...
          var x = document.getElementsByClassName("step");
          x[n].style.display = "block";
          //... and fix the Previous/Next buttons:
          if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
          } else {
            document.getElementById("prevBtn").style.display = "inline";
          }
         
          if (n == (x.length-1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
            document.getElementById("nextBtn").setAttribute("type", "submit");
            
            
          } else {
            document.getElementById("nextBtn").innerHTML = "Next";
          }
          fixStepIndicator(n)
        }


        
        function nextPrev(n) {

                // This function will figure out which tab to display
                var x = document.getElementsByClassName("step");
                
                if (n == 1 && !validateForm()) return false;
                if (currentTab == 3 && !validateScreenshot()) return false;
                
                if (currentTab ==1 && !numTravelersStored) return true;


                if (currentTab === 1 && n === 1) {
                // Get the discount amount and number of travelers
                var discountAmount = parseInt(sessionStorage.getItem("DiscountAmount"));

                if (isNaN(discountAmount)) {
                    discountAmount = 0;
                }
                

                var numTravelers = parseInt(JSON.parse(sessionStorage.getItem("formData")).num_travelers);
                if (isNaN(numTravelers)) {
                    NumTravelers = 0;
                }
                
                console.log(discountAmount);
                console.log(numTravelers);

                updateOrderSummary(discountAmount, numTravelers);
            }
                // Hide the current tab:
                x[currentTab].style.display = "none";
                // Increase or decrease the current tab by 1:
                currentTab = currentTab + n;
                // if you have reached the end of the form...
                if (currentTab >= x.length) {
                    document.getElementById("orderGenerated").style.display = "block";
                    document.getElementById("nextBtn").setAttribute("type", "submit");
                    document.getElementById('signUpForm').submit();

                    return false;
                }
                // Otherwise, display the correct tab:
                showTab(currentTab);
}

        
        function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("step");
    y = x[currentTab].getElementsByTagName("input");
    
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        var field = y[i];
        var pattern = new RegExp(field.pattern); // Get the pattern from the input field
        
        // If a field is empty or does not match the pattern...
        if (!pattern.test(field.value)) {
            // add an "invalid" class to the field:
            field.classList.add("invalid");
            // and set the current valid status to false
            valid = false;
            // Show error message
            showErrorMessage(field);
        } else {
            // If the field is valid, remove any existing "invalid" class:
            field.classList.remove("invalid");
        }
    }
    
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("stepIndicator")[currentTab].classList.add("finish");
    }
    
    return valid; // return the valid status
}

function validateScreenshot() {
    var upiScreenshotInput = document.getElementById("upiScreenshot");
    var bankScreenshotInput = document.getElementById("bankScreenshot");
    var currentTab = document.getElementsByClassName("step")[currentTab];
    
    // Check if UPI screenshot is required and uploaded
    if (upiPayment.checked && !upiScreenshotInput.value) {
        alert("Please upload the UPI payment screenshot.");
        return false;
    }
    
    // Check if bank transfer screenshot is required and uploaded
    if (bankTransfer.checked && !bankScreenshotInput.value) {
        alert("Please upload the bank transfer payment screenshot.");
        return false;
    }
    
    return true;
}



var numTravelersStored = false; // Global variable to track if numTravelers was successfully stored

function storeNumTravelers() {
    var numTravelersInput = document.getElementById("num_travelers");
    var numTravelers = numTravelersInput.value;
    var numTravelersInt = parseInt(numTravelers);

    // Check if number of travelers is entered
    if (numTravelers.trim() !== "") {
        // Send AJAX request to check available seats and store number of travelers
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "store_num_travelers.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Handle response from server
                    console.log(xhr.responseText);
                    document.getElementById("numerror").innerHTML = xhr.responseText;
                    document.getElementById("numerror").className = "invalid-message";
                    if (xhr.responseText !== null) {
                        numTravelersStored = true; // Set global variable to true indicating success
                    } else {
                        numTravelersStored = false; // Set global variable to false indicating failure
                    }

                } else {
                    console.log("Error: Unable to store number of travelers.");
                    numTravelersStored = false; // Set global variable to false indicating failure
                }
            }
        };
        xhr.send("numTravelers=" + numTravelers); // Send numTravelers in the request
    } else {
        document.getElementById("numerror").innerHTML = "Number of travelers is required.";
        document.getElementById("numerror").className = "invalid-message";
        console.log("Number of travelers is required.");
        numTravelersStored = false; // Set global variable to false indicating failure
    }
}

function showErrorMessage(input) {
    var errorMessage = input.parentNode.querySelector('.invalid-feedback');
    if (!input.checkValidity()) {
        errorMessage.style.display = 'block';
    } else {
        errorMessage.style.display = 'none';
    }
    
    storeNumTravelers();
}


        function fixStepIndicator(n) {
          // This function removes the "active" class of all steps...
          var i, x = document.getElementsByClassName("stepIndicator");
          for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
          }
          //... and adds the "active" class on the current step:
          x[n].className += " active";
        }


        function applyDiscount() {
    // Get the coupon code entered by the user
    var couponCode = document.getElementById("discountCoupon").value;

    // Make an AJAX request to the server to validate the coupon code
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "validate_coupon.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.valid) {
                // Coupon code is valid, display success message in green
                document.getElementById("couponMessage").innerHTML = "Coupon code applied. You got a discount of $" + response.discountAmount;
                document.getElementById("couponMessage").className = "valid-message";
                sessionStorage.setItem("DiscountAmount", response.discountAmount);
                console.log(sessionStorage.getItem('DiscountAmount'));
            } else {
                // Coupon code is invalid, display error message in red
                console.log(response.message)
                document.getElementById("couponMessage").innerHTML = response.message;
                document.getElementById("couponMessage").className = "invalid-message";
            }
        }
    };
    xhr.send(JSON.stringify({ couponCode: couponCode }));
}

document.addEventListener("DOMContentLoaded", function() {
    const upiPayment = document.getElementById("upiPayment");
    const bankTransfer = document.getElementById("bankTransfer");
    const razorPay = document.getElementById("razorPay"); // New Razor Pay option
    const upiDetails = document.getElementById("upiDetails");
    const bankDetails = document.getElementById("bankDetails");
    const upiScreenshotInput = document.getElementById("upiScreenshot");
    const bankScreenshotInput = document.getElementById("bankScreenshot");
    const form = document.getElementById("signUpForm");

    // Check UPI radio button and show UPI section by default
    upiPayment.checked = true;
    upiDetails.style.display = "block";
    bankDetails.style.display = "none";

    // Show UPI payment details when selected
    upiPayment.addEventListener("change", function() {
        if (upiPayment.checked) {
            upiDetails.style.display = "block";
            bankDetails.style.display = "none";
            razorPay.checked = false; // Uncheck Razor Pay option
            upiScreenshotInput.required = true;
            bankScreenshotInput.removeAttribute("required");
        }
    });

    // Show bank transfer details when selected
    bankTransfer.addEventListener("change", function() {
        if (bankTransfer.checked) {
            bankDetails.style.display = "block";
            upiDetails.style.display = "none";
            razorPay.checked = false; // Uncheck Razor Pay option
            bankScreenshotInput.required = true;
            upiScreenshotInput.removeAttribute("required");
        }
    });

    // Enable form submission when Razor Pay is selected
    razorPay.addEventListener("change", function() {
        if (razorPay.checked) {
            upiDetails.style.display = "none";
            bankDetails.style.display = "none";
            upiScreenshotInput.removeAttribute("required");
            bankScreenshotInput.removeAttribute("required");
        }
    });

    // Prevent form submission if required input is not filled
    form.addEventListener("submit", function(event) {
        if ((upiPayment.checked && !upiScreenshotInput.value) || (bankTransfer.checked && !bankScreenshotInput.value)) {
            event.preventDefault();
            alert("Please upload the required screenshot.");
        }
    });
});


</script>

<!-- Razor Pay Gateaway -->

<script>
$(document).ready(function() {
    // Attach event listener to the Razor Pay payment button using jQuery
    $('#razorPay').change(function() {
        console.log("Razor Pay button clicked");
        let billing_name = $('#firstname').val();
        let billing_mobile = $('#phone').val();
        let billing_email = $('#email').val();
        let payAmount = parseInt(sessionStorage.getItem('total')); 
        var paymentOption='';
        var paymentOption= "netbanking";


        var request_url = "submitPayment.php";
        var formData = {
            billing_name: billing_name,
            billing_mobile: billing_mobile,
            billing_email: billing_email,
            
            payAmount:payAmount,
            action: 'payOrder'
        };

        console.log("Sending AJAX request to: " + request_url);
        console.log("Form Data:", formData);

        $.ajax({
            type: 'POST',
            url: request_url,
            data: formData,
            dataType: 'json',
            encode: true,
        }).done(function(data) {
            console.log("Response received from server:", data);

            if (data.res == 'success') {
                console.log("Payment order successfully created");
                var orderID = data.order_number;
                var orderNumber = data.order_number;
                var options = {
                    "key": data.razorpay_key, // Enter the Key ID generated from the Dashboard
                    "amount": data.userData.amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "INR",
                    "name": "FlightGO", //your business name
                    "description": data.userData.description,
                    "image": "http://localhost/FlightBooking/img/FlightGO.jpeg",
                    "order_id": data.userData.rpay_order_id, //This is a sample Order ID. Pass 
                    "handler": function(response) {

                            //Submit this Form to different Location
                            var form = document.getElementById('signUpForm');

                            // Set the new action URL
                            var newAction = 'razor-pay-success.php'; // Replace 'different_location.php' with your desired URL

                            // Change the form's action attribute
                            form.action = newAction;

                            // Submit the form
                            form.submit();


                    },
                    "modal": {
                        "ondismiss": function() {
                            window.location.replace("payment-failed.php?oid=" + orderID);
                        }
                    },
                    "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                        "name": data.userData.name, //your customer's name
                        "email": data.userData.email,
                        "contact": data.userData.mobile //Provide the customer's phone number for better conversion rates 
                    },
                    "notes": {
                        "address": "FlightGO"
                    },
                    "config": {
                        "display": {
                            "blocks": {
                                "banks": {
                                    "name": 'Pay using ' + paymentOption,
                                    "instruments": [

                                        {
                                            "method": paymentOption
                                        },
                                    ],
                                },
                            },
                            "sequence": ['block.banks'],
                            "preferences": {
                                "show_default_blocks": true,
                            },
                        },
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.on('payment.failed', function(response) {

                    window.location.replace("payment-failed.php?oid=" + orderID + "&reason=" + response.error.description + "&paymentid=" + response.error.metadata.payment_id);

                });
                rzp1.open();
            } else {
                console.log("Error: " + data.info);
            }

        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log("AJAX request failed:", textStatus, errorThrown);
        });
    });
});




    </script>

<!-- Store Form Data -->


<script>
function storeFormData() {
    var formData = {};
    // Get all input elements in the form
    var inputFields = document.querySelectorAll("input");
    // Loop through each input field
    inputFields.forEach(function(input) {
        // Store the value of the input field in the formData object
        formData[input.id] = input.value;
    });
    // Convert the formData object to a JSON string and store it in session storage
    sessionStorage.setItem("formData", JSON.stringify(formData));
}

// Call the storeFormData function whenever there's a change in the form fields
document.querySelectorAll("input, select").forEach(function(input) {
    input.addEventListener("change", storeFormData);
});

// Function to retrieve form data from session storage and populate form fields
function populateFormFields() {
    // Retrieve form data from session storage
    var formData = sessionStorage.getItem("formData");
    
    if (formData) {
        // Parse the JSON string to convert it back to an object
        formData = JSON.parse(formData);
        
        // Loop through each property in the formData object
        for (var key in formData) {
            if (formData.hasOwnProperty(key)) {
                // Get the value of the property and populate the corresponding form field
                var value = formData[key];
                document.getElementById(key).value = value;
            }
        }
    }
}


// Call the populateFormFields function when the page loads
window.addEventListener("load", populateFormFields);

</script>




<?php
}

?>