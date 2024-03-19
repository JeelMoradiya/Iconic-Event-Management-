<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" />
    <title>Login - iconic</title>
    <style>
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }

        .password-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2em;
            color: #333;
        }

        .password-icon {
            left: 15px;
        }

        .pw-hide-icon {
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 15px;
            font-size: 1.2em;
            color: #333;
        }
    </style>
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6 d-flex  align-items-center gradient-custom-2">
                                <div class="text-white text-center  px-3 py-4 p-md-5 mx-md-5">
                                    <img src="logo.png" alt="logo" width="300" height="300"><br>
                                    <h3 class="mb-4">ICONIC EVENT MANAGEMENT</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <h3 class="mt-1 mb-5 pb-1">New Password</h3>
                                    </div>

                                    <form class="needs-validation" method="post" novalidate>
                                        <p>Please change to your account password</p>

                                        <div class="col-md-12 mb-4">
                                            <div class="form-outline">
                                                <input type="password" id="txtNPass" name="txtNPass" class="form-control" required />
                                                <label class="form-label" for="txtNPass">New Password</label>
                                                <i class="far fa-eye-slash pw-hide-icon pw_hide" id="pwToggle"></i>
                                                <div class="invalid-feedback">Please enter your New password!</div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-4">
                                            <div class="form-outline">
                                                <input type="password" id="txtCPass" name="txtCPass" class="form-control" required />
                                                <label class="form-label" for="txtCPass">Confirm Password</label>
                                                <i class="far fa-eye-slash pw-hide-icon pw_hide" id="confirmPwToggle"></i>
                                                <div class="invalid-feedback">Please enter your Confirm password!</div>
                                            </div>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Forgot</button>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Already your have an account password?</p>
                                            <a href="./login.php"><button type="button" class="btn btn-outline-danger">Login</button></a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
    <script>
        // JavaScript to toggle password visibility
        const passwordInput = document.getElementById('txtNPass');
        const confirmPasswordInput = document.getElementById('txtCPass');
        const pwHideIcon = document.getElementById('pwToggle');
        const confirmPwHideIcon = document.getElementById('confirmPwToggle');

        pwHideIcon.addEventListener('click', togglePasswordVisibility.bind(null, passwordInput, pwHideIcon));
        confirmPwHideIcon.addEventListener('click', togglePasswordVisibility.bind(null, confirmPasswordInput, confirmPwHideIcon));

        function togglePasswordVisibility(inputField, icon) {
            if (inputField.type === 'password') {
                inputField.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                inputField.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }

        // JavaScript validation for the form
        const form = document.querySelector('.needs-validation');

        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    </script>
</body>

</html>