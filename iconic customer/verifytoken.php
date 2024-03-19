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
                                        <h3 class="mt-1 mb-5 pb-1">Verify Login</h3>
                                    </div>

                                        <p>Please Verify to your account</p>

                                        <?php
                                        require_once "./Connection.php";


                                        if (isset($_GET['token']) && isset($_GET['id'])) {
                                            $userId = $_GET['id'];
                                            $verification_token = $_GET['token'];

                                            $isVerified = "SELECT user_id FROM user WHERE user_id = " . $userId . " AND code != NULL";
                                            $rs = $conn->query($isVerified);
                                            if ($rs->num_rows > 0) {
                                                // User already verified
                                                echo "<div class='alert alert-success'>You are already verified.</div>";
                                            } else {
                                                // Not verified
                                                $insCode = "UPDATE user SET code = ? WHERE user_id = ?";
                                                $stmt = $conn->prepare($insCode);
                                                $stmt->bind_param("si", $verification_token, $userId);
                                                if ($stmt->execute()) {
                                                    echo "<div class='alert alert-success'>You are verified.</div>";
                                                    echo "<a href='./login.php'><button type='button' class='btn btn-primary btn-block fa-lg gradient-custom-2 mb-3'>Go to Login</button></a>";
                                                } else {
                                                    echo "<div class='alert alert-danger'>Error in executing query.</div>";
                                                }
                                            }

                                            // Check the token in the database and update the user's status if it's valid
                                            // $updateQuery = "UPDATE user SET is_active = 1 WHERE code = ?";
                                            // $updateStmt = $conn->prepare($updateQuery);
                                            // $updateStmt->bind_param("s", $verification_token);

                                            // if ($updateStmt->execute()) {
                                            //     $msg = "<div class='alert alert-info'>Email verified successfully.</div>";
                                            // } else {
                                            //     $msg = "<div class='alert alert-danger'>Verification failed. Please try again or contact support.</div>";
                                            // }
                                        } else {
                                            $msg = "<div class='alert alert-danger'>Invalid verification link.</div>";
                                        }
