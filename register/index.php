<?php

include('../server/connection.php');





if (isset($_POST['register'])) {

    // grabing the user inputs
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    // checking if the input is empty
    if (!empty($email) && !empty($username) && !empty($password)) {

        $hashing  = password_hash($password, PASSWORD_DEFAULT);



        $statement  = "INSERT INTO `users`(username,email,password) VALUES ('$username','$email','$hashing')";
        $query = mysqli_query($connection, $statement);
        if ($query) {
            echo "<script>
           alert('Register Successful')
           window.location.href = '../login/'

           </script>";
        } else {
            echo "<script>alert('Something Went Wrong')</script>";
        }
    } else {
        echo "<script>alert('Input is empty')</script>";
    }
}


?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Sign Up | <?php echo $sitename ?> - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo $domain ?>/../assetsimages/favicon.ico">

    <!-- Layout config Js -->
    <script src="<?php echo $domain ?>/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo $domain ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo $domain ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo $domain ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- Add this in the <head> or before </body> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body class="auth-bg 100-vh">
    <div class="bg-overlay bg-light"></div>

    <div class="account-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="auth-full-page-content d-flex min-vh-100 py-sm-5 py-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 py-0 py-xl-4">

                                <div class="card my-auto overflow-hidden">
                                    <div class="row g-0">
                                        <div class="col-lg-6">
                                            <div class="p-lg-5 p-4">
                                                <div class="text-center">
                                                    <h5 class="mb-0">Create New Account</h5>

                                                </div>

                                                <div class="mt-4">
                                                    <form method="POST" class="auth-input">
                                                        <div class="mb-3">
                                                            <label for="email " class="form-label">Email</label>
                                                            <input name="email" type="text" class="form-control" id="email" placeholder="Enter email">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Username</label>
                                                            <input name="username" type="text" class="form-control" id="username" placeholder="Enter username">
                                                        </div>

                                                        <div class="mb-2">
                                                            <label for="userpassword" class="form-label">Password</label>
                                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                                <input name="password" type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input">
                                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="las la-eye align-middle fs-18"></i></button>
                                                            </div>
                                                        </div>



                                                        <div class="mt-2">
                                                            <button name="register" class="btn btn-primary w-100" type="submit">Sign Up</button>
                                                        </div>



                                                        <div class="mt-4 text-center">
                                                            <p class="mb-0">Don't have an account ? <a href="<?php echo $domain ?>login/index.php" class="fw-medium text-primary text-decoration-underline"> Signin </a> </p>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="d-flex h-100 bg-auth align-items-end">
                                                <div class="p-lg-5 p-4">
                                                    <div style="background:url(../assets/images/cards/16.jpg) center/cover" class="bg-overlay bg-primary"></div>
                                                    <div class="p-0 p-sm-4 px-xl-0 py-5">
                                                        <div id="reviewcarouselIndicators" class="carousel slide auth-carousel" data-bs-ride="carousel">
                                                            <div class="carousel-indicators carousel-indicators-rounded">
                                                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                            </div>

                                                            <!-- end carouselIndicators -->
                                                            <div class="carousel-inner mx-auto">
                                                                <div class="carousel-item active">
                                                                    <div class="testi-contain text-center">
                                                                        <h5 class="fs-20 text-white mb-0">“I feel confident using my credit card here—every purchase is simple and secure!”
                                                                        </h5>
                                                                        <p class="fs-15 text-white-50 mt-2 mb-0">"Since I started using this website, I’ve been able to make purchases easily and manage my credit card seamlessly. The platform is secure, fast, and user-friendly—it simplifies transactions and keeps my financial details safe. Highly recommend!"</p>
                                                                    </div>
                                                                </div>

                                                                <div class="carousel-item">
                                                                    <div class="testi-contain text-center">
                                                                        <h5 class="fs-20 text-white mb-0">“Highlighting Rewards/Cashback”</h5>
                                                                        <p class="fs-15 text-white-50 mt-2 mb-0">
                                                                            "Ever since I started using this website with my credit card, I’ve earned amazing rewards on every purchase! The process is smooth, and I love how quickly my cashback adds up. It’s become my go-to for safe, rewarding transactions."
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="carousel-item">
                                                                    <div class="testi-contain text-center">
                                                                        <h5 class="fs-20 text-white mb-0">“Security & Convenience Focus”</h5>
                                                                        <p class="fs-15 text-white-50 mt-2 mb-0">
                                                                            "Using this website with my credit card has been a game-changer. The fraud protection gives me peace of mind, and the one-click checkout saves so much time. I’ve never had a single issue—just fast, secure purchases!"
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end carousel-inner -->
                                                        </div>
                                                        <!-- end review carousel -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>


    <!-- JAVASCRIPT -->
    <script src="<?php echo $domain ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $domain ?>/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo $domain ?>/assets/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo $domain ?>/assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?php echo $domain ?>/assets/js/plugins.js"></script>
</body>

</html>