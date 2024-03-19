<?php
require_once("./Connection.php");
require_once("./Session.php");

$msg = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" />
    <title>Iconic - Register</title>
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
    </style>

    <style>
        /* The message box is shown when the user clicks on the password field */
        #message {
            display: none;
            background: #f1f1f1;
            color: #000;
            position: relative;
            padding-left: 20px;
            margin-top: 10px;
        }

        #message p {
            padding: 10px 35px;
            margin: 0;
            /* font-size: 18px; */
        }

        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
            color: green;
        }

        .valid:before {
            position: relative;
            left: -35px;
            content: "✔";
        }

        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid {
            color: red;
        }

        .invalid:before {
            position: relative;
            left: -35px;
            content: "✖";
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
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white text-center px-3 py-4 p-md-5 mx-md-5">
                                    <img src="logo.png" alt="logo" width="300" height="300"><br>
                                    <h3 class="mb-4">ICONIC EVENT MANAGEMENT</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body p-md-4 mx-md-4">

                                    <div class="text-center">
                                        <h3 class="mt-1 mb-4 pb-1">Register</h3>
                                    </div>

                                    <form class="needs-validation" action="./testreg.php" method="post" novalidate>
                                        <p>Please register to your account</p>
                                        <?php echo $msg; ?>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input type="text" id="txtFirstname" name="txtFirstname" class="form-control" placeholder="First Name" required />
                                                    <label class="form-label" for="txtFirstname">First Name</label>
                                                    <div class="invalid-feedback">Please enter a First Name!</div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input type="text" id="txtLastname" name="txtLastname" class="form-control" placeholder="Last Name" required />
                                                    <label class="form-label" for="txtLastname">Last Name</label>
                                                    <div class="invalid-feedback">Please enter a Last Name!</div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <div class="form-outline ">
                                                    <input type="email" id="txtEmail" name="txtEmail" class="form-control" placeholder="Email Address" required />
                                                    <label class="form-label" for="txtEmail">Email</label>
                                                    <div class="invalid-feedback">Please enter a valid Email address!</div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <div class="form-outline input-group">
                                                    <span id="code" class="input-group-text">C.C.</span>
                                                    <input type="tel" id="txtPhone" name="txtPhone" class="form-control" placeholder="Phone Number" required />
                                                    <label class="form-label" for="txtPhone">Phone Number</label>
                                                    <div class="invalid-feedback">Please enter a Phone Number!</div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <div class="form-outline ">
                                                    <textarea class="form-control" id="txtAddress" placeholder="Address" name="txtAddress" required></textarea>
                                                    <label class="form-label" for="txtAddress">Address</label>
                                                    <div class="invalid-feedback">Please enter a Address!</div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <select class="form-control" id="selCountry" name="selCountry" required>
                                                    <option value="" selected disabled>Select Country</option>
                                                    <?php
                                                    $fetchCountries = "SELECT country_id, country_name FROM country_master
														ORDER BY country_name";
                                                    $rs = $conn->query($fetchCountries);
                                                    if ($rs->num_rows > 0) {
                                                        while ($row = $rs->fetch_array()) {
                                                            echo sprintf(
                                                                "<option value='%s'>%s</option>",
                                                                $row[0],
                                                                $row[1]
                                                            );
                                                        }
                                                    } else {
                                                        echo "<option selected value=''>No Data</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">Please select a Country!</div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <select class="form-control" id="selCity" name="selCity" required>
                                                    <option value="" selected disabled>Select City</option>
                                                </select>
                                                <div class="invalid-feedback">Please select a City!</div>
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <div class="form-outline">
                                                    <input type="password" id="txtPass" name="txtPass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
                                                    <label class="form-label" for="txtPass">Password</label>
                                                    <i class="far fa-eye-slash pw-hide-icon pw_hide" id="pwToggle"></i>
                                                    <div class="invalid-feedback">Please enter your password!</div>
                                                </div>

                                                <div id="message">
                                                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                                    <p id="capital" class="invalid">A <b>capital</b> letter</p>
                                                    <p id="number" class="invalid">A <b>number</b></p>
                                                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <div class="form-outline">
                                                    <input type="password" id="txtConfirm" name="txtConfirm" class="form-control" required />
                                                    <label class="form-label" for="txtConfirm">Confirm Password</label>
                                                    <i class="far fa-eye-slash pw-hide-icon pw_hide" id="confirmPwToggle"></i>
                                                    <div class="invalid-feedback">Please enter your Confirm password!</div>
                                                </div>
                                            </div>

                                            <div class="text-center pt-1 mb-2 pb-1">
                                                <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Register</button>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-center pb-4">
                                                <p class="mb-0 me-2">Already your have an account?</p>
                                                <a href="login.php"><button type="button" class="btn btn-outline-danger">Login</button></a>
                                            </div>
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
        window.onload = function() {
            // variables
            selCountry = document.getElementById("selCountry");
            selCity = document.getElementById("selCity");
            countryCode = document.getElementById("code");

            // listeners
            selCountry.addEventListener("change", function() {
                const xhr = new XMLHttpRequest();
                const data = "data=" + selCountry.value;
                xhr.open("POST", "./async/cities-for-country.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function() {
                    selCity.innerHTML = this.responseText;
                }
                xhr.onerror = function() {
                    alert("Server-side Error");
                }
                xhr.send(data);

                // ------------------------------------------

                const xhr2 = new XMLHttpRequest();
                const data2 = "data=" + selCountry.value;
                xhr2.open("POST", "./async/code-for-country.php", true);
                xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr2.onload = function() {
                    countryCode.innerHTML = this.responseText;
                }
                xhr2.onerror = function() {
                    alert("Server-side Error");
                }
                xhr2.send(data2);
            });
        }
    </script>

    <script>
        var myInput = document.getElementById("txtPass");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if (myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            // Validate length
            if (myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }

        // JavaScript to toggle password visibility
        const passwordInput = document.getElementById('txtPass');
        const confirmPasswordInput = document.getElementById('txtConfirm');
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