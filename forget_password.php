<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>

    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/registrations/registration-3/assets/css/registration-3.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

    <style>
        .error {
            color:red;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#form1').validate({
                rules: {
                    em: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    em: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    }
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function(form) {
                    form.submit(); // Submit the form if validation passes
                }
            });
        });
    </script>
</head>
<body>
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
                    <div class="d-flex flex-column justify-content-between h-100 p-3 p-md-4 p-xl-5">
                        <h3 class="m-0">Welcome!</h3>
                        <img class="img-fluid rounded mx-auto my-4" loading="lazy" src="img/FlightGO.jpeg" width="245" height="80" alt="BootstrapBrain Logo">
                        <p class="mb-0"></p>
                    </div>
                </div>
                <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
                    <div class="p-3 p-md-4 p-xl-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5">
                                    <h2 class="h3">Forget Password</h2>
                                    <h3 class="fs-6 fw-normal text-secondary m-0">Enter email to change password</h3>
                                </div>
                            </div>
                        </div>
                        <form action="forget_password_action.php" method="post" id="form1">
                            <div class="row gy-3 gy-md-4 overflow-hidden">
                                <div class="form-group">
                                    <label for="em">Email:</label>
                                    <input type="email" class="form-control" id="em" placeholder="Enter email" name="em">
                                </div>
                                <button type="submit" class="btn bsb-btn-xl btn-primary" style="color:white" name="btn">Send OTP</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
