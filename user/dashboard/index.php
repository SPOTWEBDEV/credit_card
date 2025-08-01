<?php
include("../../server/connection.php");
include("../../server/client/auth/index.php");

// Get balance of the logged-in user
$getBalanceQuery = mysqli_query($connection, "SELECT bal FROM users WHERE id='$id'");
$userData = mysqli_fetch_assoc($getBalanceQuery);
$balance = $userData['bal'];

// Get total deposit 
$getDepositTotalQuery = mysqli_query($connection, "SELECT * FROM deposits WHERE user='$id' AND status='approved'");
$totalDeposit = mysqli_num_rows($getDepositTotalQuery);

// Get pending deposits
$getPendingQuery = mysqli_query($connection, "SELECT *  FROM deposits WHERE user='$id' AND status='pending'");
$pendingDeposit = mysqli_num_rows($getPendingQuery);


// Get purchase credit card spending
$getCardPurchaseQuery = mysqli_query($connection, "SELECT COUNT(id) as total, SUM(amount) as card_purchase FROM cvv_purchases WHERE user_id='$id'");
$cardData = mysqli_fetch_assoc($getCardPurchaseQuery);

$totalcardPurchase = $cardData['total'] ?? 0;
$cardPurchase = $cardData['card_purchase'] ?? 0;




// echo 



?>



<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Client Dashboard | <?php echo $sitename ?> - Black Market CC Access</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Access premium stolen credit cards, dumps, and fullz. Updated daily." name="description" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo $domain ?>assets/images/favicon.ico">

    <!-- Sweet Alert css-->
    <link href="<?php echo $domain ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="<?php echo $domain ?>assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo $domain ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo $domain ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo $domain ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include("../components/navbar.php") ?>

        <!-- removeNotificationModal -->
        <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Are you sure ?</h4>
                                <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- ========== App Menu ========== -->

        <?php include("../components/sidenav.php") ?>

        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Dashboard Overview</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">Client</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Page Title -->



                    <div class="container py-5">
                        <div class="row g-4">
                            <!-- Balance -->
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="text-muted">Account Balance</h6>
                                                <h4 class="text-success fw-bold">$<?php echo number_format($balance, 2); ?></h4>
                                            </div>
                                            <i class="bi bi-wallet2 fs-1 text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Deposit -->
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="text-muted">Total Deposit</h6>
                                                <h4 class="text-primary fw-bold"><?php echo $totalDeposit ?></h4>
                                            </div>
                                            <i class="bi bi-bank fs-1 text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Deposit -->
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="text-muted">Pending Deposit</h6>
                                                <h4 class="text-warning fw-bold"><?php echo $pendingDeposit; ?></h4>
                                            </div>
                                            <i class="bi bi-hourglass-split fs-1 text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Purchases -->

                            <div class="col-md-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="text-muted">Total Card Purchases</h6>
                                                <h4 class="text-danger fw-bold"><?php echo $totalcardPurchase ?></h4>
                                            </div>
                                            <i class="bi bi-credit-card-2-front fs-1 text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="text-muted">Card Purchases</h6>
                                                <h4 class="text-danger fw-bold">$<?php echo number_format($cardPurchase, 2); ?></h4>
                                            </div>
                                            <i class="bi bi-credit-card-2-front fs-1 text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



            <?php include("../components/footer.php") ?>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>



    <!-- Theme Settings -->


    <!-- JAVASCRIPT -->
    <script src="<?php echo $domain ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $domain ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo $domain ?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo $domain ?>assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?php echo $domain ?>assets/js/plugins.js"></script>

    <!-- App js -->
    <script src="<?php echo $domain ?>assets/js/app.js"></script>
</body>



</html>