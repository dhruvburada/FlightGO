<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>


<style>
.tg-innerbanner {
    position: relative;
    height: 450px; 
    background: rgba(0,0,0,0.5) url('img/booking-hero 2.jpg');
    background-blend-mode: darken;
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: center center;
    color: #fff;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    max-width: 100%;
}


    .tg-breadcrumb {
        padding: 0;
        margin: 0;
        color: #fff;
        list-style: none;
        text-align: center;
        text-transform: capitalize;
        font-size: 14px;
        margin-top: 20px; /* Adjust spacing */
    }
    .tg-breadcrumb li {
        display: inline;
        margin-right: 5px; /* Adjust spacing between breadcrumb items */
    }
    .tg-breadcrumb li:not(.tg-active):hover {
        cursor: pointer;
        text-decoration: underline;
    }

    .tg-box {
        width: 100%;
        padding-top : 20px;
        border: 1px solid #e6e6e6; /* Add border */
        border-radius: 5px; /* Rounded corners */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
        margin-top : 25px;
        padding:15px;
    }

    .tg-widgetpersonprice {
        padding: 30px;
    }

    .tg-widgetpersonprice ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tg-widgetpersonprice ul li {
        padding: 10px 0;
    }

    .tg-widgetpersonprice ul li:last-child {
        border-bottom: none; /* Remove bottom border from the last item */
    }

    .container{margin:2px;}

    .error
    {
        color:red;
    }

    
   
</style>

<link rel="stylesheet" href="style.css">
<body>

<!-- NAV BAR START -->
<?php include 'Header.php';?>
<!-- NAV BAR END -->

<div class="col-xl-12 col-xxl-12 col-md-12 col-sm-12 col-xsm-12 col-lg-12">
<section class="tg-innerbanner">
    <h1>Billing Details</h1>
    <p>One Click To Takeoff</p>
    <ul class="tg-breadcrumb">
        <li>Home</li>
        <li>Pages</li>
        <li class="tg-active">Billing Details</li>
    </ul>
</section>
</div>


<main id="tg-main" class="tg-main tg-haslayout">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                <div id="tg-content" class="tg-content">
                    <div class="tg-billingdetail">
                        <form class="row g-3 needs-validation" id="billingForm" novalidate action="success.php" method="post" enctype="multipart/form-data">
                            <div id="error-messages" class="error-messages" style="display: none;">
                                <ul id="error-list"></ul>
                            </div>
                            <div class="col-12">
                                <div class="tg-box">
                                    <div class="tg-heading">
                                        <h3>Billing Details</h3>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="firstname" class="form-label">First name <sup>*</sup></label>
                                            <input type="name" class="form-control" id="firstname" name="firstname" placeholder="" required pattern="[A-Za-z]+">
                                            <div class="invalid-feedback">Please provide a valid first name.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastname" class="form-label">Last name <sup>*</sup></label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="" required pattern="[A-Za-z\s]+">
                                            <div class="invalid-feedback">Please provide a valid last name.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="nationality" class="form-label">Nationality <sup>*</sup></label>
                                            <input type="text" class="form-control" id="nationality" name="nationality" placeholder="" required pattern="[A-Za-z\s]+">
                                            <div class="invalid-feedback">Please provide a valid nationality.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="age" class="form-label">Age <sup>*</sup></label>
                                            <input type="number" class="form-control" id="age" name="age" placeholder="" required>
                                            <div class="invalid-feedback">Please provide a valid age.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="country" class="form-label">Country <sup>*</sup></label>
                                            <input type="text" class="form-control" id="country" name="country" placeholder="" required pattern="[A-Za-z\s]+">
                                            <div class="invalid-feedback">Please provide a valid country.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="state" class="form-label">State / County <sup>*</sup></label>
                                            <input type="text" class="form-control" id="state" name="state" placeholder="" required pattern="[A-Za-z\s]+">
                                            <div class="invalid-feedback">Please provide a valid state / county.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="city" class="form-label">Town / City <sup>*</sup></label>
                                            <input type="text" class="form-control" id="city" name="city" placeholder="" required >
                                            <div class="invalid-feedback">Please provide a valid town / city.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="postcode" class="form-label">Postcode / ZIP <sup>*</sup></label>
                                            <input type="number" class="form-control" id="postcode" name="postcode" placeholder="" required>
                                            <div class="invalid-feedback">Please provide a valid postcode / ZIP.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email Address <sup>*</sup></label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                                            <div class="invalid-feedback">Please provide a valid email address.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label">Phone Number <sup>*</sup></label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="" required >
                                            <div class="invalid-feedback">Please provide a valid phone number.</div>
                                            </div>
                                    </div>  
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <!-- Additional Travelers Details -->
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                <div id="tg-content" class="tg-content">
                    <div class="tg-billingdetail">
                            <div id="error-messages" class="error-messages" style="display: none;">
                                <ul id="error-list"></ul>
                            </div>
                            <div class="col-12">
                                <div class="tg-box">
                                    <div class="tg-heading">
                                        <h3>Additional Travelers</h3>
                                    </div>

                                
                                        <?php
                                        // Define the number of travelers (change this as per your requirement)
                                        $numTravelers = 2;
                                        // Generate form fields for each traveler
                                        for ($i = 1; $i <= $numTravelers; $i++) {
                                            echo '
                                                <div class="traveler-row">
                                                    <h6 style="padding-top:10px;">Traveler ' . $i . '</h6>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="firstname' . $i . '" class="form-label">First name <sup>*</sup></label>
                                                                <input type="name" class="form-control" id="firstname' . $i . '" name="firstname' . $i . '" placeholder="" required pattern="[A-Za-z]+">
                                                                <div class="invalid-feedback">Please provide a valid first name.</div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="lastname' . $i . '" class="form-label">Last Name<sup>*</sup></label>
                                                                <input type="text" name="lastname' . $i . '" class="form-control" id="lastname' . $i . '" placeholder="" required>
                                                                <div class="invalid-feedback">Please provide a valid Last name.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="age' . $i . '" class="form-label">Age<sup>*</sup></label>
                                                                <input type="number" name="age' . $i . '" class="form-control" id="age' . $i . '" placeholder="" required>
                                                                <div class="invalid-feedback">Please provide a valid Age.</div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="nationality' . $i . '" class="form-label">Nationality<sup>*</sup></label>
                                                                <input type="text" name="nationality' . $i . '" class="form-control" id="nationality' . $i . '" placeholder="" required>
                                                                <div class="invalid-feedback">Please provide a valid Nationality.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';     
                                        }
                                        
                                        
                                        ?>
                                </div>
                            </div>         
                        </div>  
                 </div>            
            </div>                                    
                            <!-- Your order -->
                            
                            
    <div class="col">
    <div class="tg-box tg-yourorder">
        <div class="tg-heading">
            <h3>Your Order</h3>
        </div>
        <div class="tg-widgetpersonprice">
            <div class="tg-widgetcontent">
                <ul class="list-unstyled">
                    <li class="d-flex justify-content-between align-items-center">
                        <span>Person Base Price (5 x 3,000₹)</span>
                        <em>15,000₹</em>
                    </li>
                    <hr style="border:solid 1px black; ">
                    <li class="d-flex justify-content-between align-items-center">
                        <span>Sub Total</span>
                        <em>15,000₹</em>
                    </li>
                    <li class="d-flex justify-content-between align-items-center">
                        <span>Tax Rate</span>
                        <em>10₹</em>
                    </li>
                    <li class="d-flex justify-content-between align-items-center">
                        <span>Rewards Point</span>
                        <em>-10₹</em>
                    </li>
                    <hr style="border:solid 1px black;">
                    <li class="d-flex justify-content-between align-items-center">
                        <span>Total Price</span>
                        <em>15,000₹</em>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


                            <!-- Payment area -->
<div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                <div class="tg-box">
                    <div id="tg-accordion" class="accordion" role="tablist" aria-multiselectable="true">
                        <div class="card">
                            <div class="card-header" role="tab" id="bank-transfer-header">
                                <h4 class="card-title mb-0">
                                    <input type="radio" id="bank-transfer" name="paymenttype">
                                    <label class="form-check-label" for="bank-transfer">Direct Bank Transfer</label>
                                </h4>
                            </div>
                            <div id="bank-transfer-content" class="collapse" role="tabpanel" aria-labelledby="bank-transfer-header">
                                <div class="card-body">
                                    <p>Recipient: Dhruv Burada
                                        Account Number: 8488997323
                                        Bank Name: Kotak Mahindra
                                        Please transfer the specified amount to the above account and provide us with a screenshot of the bank transfer by clicking here.</p>
                                    <input type="file" id="fileInput" class="form-control-file" accept=".pdf, .jpeg, .jpg, .png, .gif">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="upi-header">
                                <h4 class="card-title mb-0">
                                    <input type="radio" id="UPI" name="paymenttype">
                                    <label class="form-check-label" for="UPI">UPI Payment</label>
                                </h4>
                            </div>
                            <div id="upi-content" class="collapse" role="tabpanel" aria-labelledby="upi-header">
                                <div class="card-body">
                                    <p>To make a payment through UPI, transfer the amount to our UPI ID: 8488997323@upi. Once the payment is completed, kindly provide us with a screenshot of the transaction for verification purposes by clicking the button below:</p>
                                    <input type="file" id="paymentScreenshot" class="form-control-file" name="paymentScreenshot" accept=".jpg, .jpeg, .png">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>     
                
                                <!-- Discount Coupons -->
                
            <div class="row">
                <div id="tg-content" class="tg-content">
                    <div class="tg-billingdetail">
                            <div id="error-messages" class="error-messages" style="display: none;">
                                <ul id="error-list"></ul>
                            </div>
                            <div class="col-12">
                                <div class="tg-box">
                                    <div class="tg-heading">
                                        <h3>Discount Coupons</h3>
                                    </div>
                                    <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="couponCode" class="form-label">Enter Coupon Code:</label>
                                    <input type="text" class="form-control" id="couponCode" name="couponCode" placeholder="Enter your coupon code" required>
                                    <div class="invalid-feedback">Please enter a valid coupon code.</div>
                                </div>
                                <div class="col-md-4 align-self-end">
                                    <button type="submit" class="btn btn-primary">Apply Coupon</button>
                                </div>
                            </div>

                                </div>
                            </div>
                    </div>
                </div>
            </div>


        </fieldset>
        <button id="placeOrderButton" class="btn btn-primary" type="submit" style="float:right;">Place Order</button>
</div>
</script>

                                    </form>
                                
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get the radio buttons
        var bankTransferRadio = document.getElementById("bank-transfer");
        var upiRadio = document.getElementById("UPI");

        // Get the descriptions
        var bankTransferContent = document.getElementById("bank-transfer-content");
        var upiContent = document.getElementById("upi-content");

        // Hide both descriptions initially
        bankTransferContent.classList.add("collapse");
        upiContent.classList.add("collapse");

        // Add event listeners to radio buttons
        bankTransferRadio.addEventListener("change", function () {
            bankTransferContent.classList.remove("collapse");
            upiContent.classList.add("collapse");
        });

        upiRadio.addEventListener("change", function () {
            bankTransferContent.classList.add("collapse");
            upiContent.classList.remove("collapse");
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-yFNBgjb/JwvXgrRr00EgrKZpX2VwI1n5CJtiXfTc7OJIIoRKd0zQgPJC2z+gg3GY" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-09Gg7Xx3gLyIETvTg/+QlvkL29s7bxh0fWzhsWbFa4nxwY7gHVYZJ3d2rmnu/BO5" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        // Add custom method to check if the input contains only letters and spaces
        $.validator.addMethod("lettersAndSpaces", function(value, element) {
            return this.optional(element) || /^[A-Za-z\s]+$/i.test(value);
        }, "Please enter only letters and spaces.");

        // Add custom method to validate email format
        $.validator.addMethod("emailFormat", function(value, element) {
            return this.optional(element) || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        }, "Please enter a valid email address.");

        // Add custom method to validate phone number format
        $.validator.addMethod("phoneFormat", function(value, element) {
            return this.optional(element) || /^[0-9]{10}$/.test(value);
        }, "Please enter a valid phone number.");

        // Initialize validation for the main form (billingForm)
        $("#billingForm").validate({
            rules: {
                firstname: {
                    required: true,
                    lettersAndSpaces: true
                },
                lastname: {
                    required: true,
                    lettersAndSpaces: true
                },
                nationality: {
                    required: true,
                    lettersAndSpaces: true
                },
                age: {
                    required: true,
                    number: true,
                    min: 0
                },
                email: {
                    required: true,
                    emailFormat: true
                },
                phone: {
                    required: true,
                    phoneFormat: true
                },
                // Additional traveler's details
                <?php 
                    for($i = 1; $i <= $numTravelers; $i++) {
                        echo "
                            'firstname$i': {
                                required: true,
                                lettersAndSpaces: true
                            },
                            'lastname$i': {
                                required: true,
                                lettersAndSpaces: true
                            },
                            'nationality$i': {
                                required: true,
                                lettersAndSpaces: true
                            },
                            'age$i': {
                                required: true,
                                number: true,
                                min: 0
                            },";
                    }
                ?>
            },
            messages: {
                firstname: {
                    required: "Please enter your first name."
                },
                lastname: {
                    required: "Please enter your last name."
                },
                nationality: {
                    required: "Please enter your nationality."
                },
                age: {
                    required: "Please enter your age.",
                    number: "Please enter a valid age.",
                    min: "Please enter a valid age."
                },
                email: {
                    required: "Please enter your email address."
                },
                phone: {
                    required: "Please enter your phone number."
                },
                // Additional traveler's details
                <?php 
                    for($i = 1; $i <= $numTravelers; $i++) {
                        echo "
                            'firstname$i': {
                                required: 'Please enter traveler $i first name.'
                            },
                            'lastname$i': {
                                required: 'Please enter traveler $i last name.'
                            },
                            'nationality$i': {
                                required: 'Please enter traveler $i nationality.'
                            },
                            'age$i': {
                                required: 'Please enter traveler $i age.',
                                number: 'Please enter a valid age for traveler $i.',
                                min: 'Please enter a valid age for traveler $i.'
                            },";
                    }
                ?>
            },

            errorPlacement: function(error, element) {
        // Place errors after the element's parent (if it exists) with class 'error-placement'
        error.insertAfter(element);
        }
        });

        // Submit handler for the main form
        $('#placeOrderButton').click(function() {
            // Check if the main form (billingForm) is valid
            if ($("#billingForm").valid()) {
                // Submit the form if valid
                $('#billingForm').submit();
            }
        });

        $(document).on('focusout', 'input[id^=firstname], input[id^=lastname], input[id^=nationality], input[id^=age]', function() {
        // Re-validate the form when focus is out from dynamically added fields
        $("#billingForm").valid();
    });
});
    // });

    
</script>

    
</body>
</html>
