<?php
include("../../../server/connection.php");
include("../../../server/client/auth/index.php");





?>


<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Payments | <?php echo $sitename ?> - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo $domain ?>assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="<?php echo $domain ?>assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo $domain ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo $domain ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo $domain ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include("../../components/navbar.php") ?>


        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->


            <?php include("../../components/sidenav.php") ?>

            <div class="sidebar-background"></div>
        </div>
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
                                <h4 class="mb-sm-0">View Card Details</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">Client</a></li>
                                        <li class="breadcrumb-item active">View Card Details</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Page Title -->



                    <!-- Table -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">

                                <?php

                                if (isset($_POST['buy'])) {
                                    $cvv_card_uuid = $_POST['cvv_card_id'];

                                    // get card
                                    $cardRes = mysqli_query(
                                        $connection,
                                        "SELECT id, price FROM cvv_cards WHERE uuid='$cvv_card_uuid' AND status='available' LIMIT 1"
                                    );
                                    if (!$cardRes || mysqli_num_rows($cardRes) == 0) {
                                        die('<div class="alert alert-danger">Card not available.</div>');
                                    }
                                    $card = mysqli_fetch_assoc($cardRes);
                                    $amount = $card['price'];
                                    $card_id = $card['id'];

                                    // get user
                                    $userRes = mysqli_query($connection, "SELECT bal FROM users WHERE id='$id' LIMIT 1");
                                    if (!$userRes || mysqli_num_rows($userRes) == 0) {
                                        die('<div class="alert alert-danger">User not found.</div>');
                                    }
                                    $user = mysqli_fetch_assoc($userRes);

                                    if ($user['bal'] < $amount) {
                                        die('<div class="alert alert-danger">Insufficient balance to purchase this card.</div>');
                                    }

                                    // deduct balance
                                    $newBal = $user['bal'] - $amount;
                                    $updateBal = mysqli_query($connection, "UPDATE users SET bal='$newBal' WHERE id='$id'");
                                    if (!$updateBal) {
                                        die('<div class="alert alert-danger">Failed to update balance: ' . mysqli_error($connection) . '</div>');
                                    }

                                    // insert purchase
                                    $insert = mysqli_query($connection, "
        INSERT INTO cvv_purchases (user_id, cvv_card_id, amount, status)
        VALUES ('$id', '$card_id', '$amount', 'approved')
    ");

                                    if ($insert) {
                                        mysqli_query($connection, "UPDATE cvv_cards SET status='sold' WHERE id='$card_id'");
                                        echo '<div class="alert alert-success">Card purchased successfully.</div>';
                                        echo "<script>setTimeout(()=>{ window.location.href='../index.php' },2000)</script>";
                                    } else {
                                        mysqli_query($connection, "UPDATE users SET bal='{$user['bal']}' WHERE id='$id'");
                                        echo '<div class="alert alert-danger">Failed to purchase card: ' . mysqli_error($connection) . '</div>';
                                    }


                                    echo "<script>setTimeout(()=>{ window.reload()},3000)</script>";
                                }


                                ?>

                                <div class="card-body">
                                    <div class="table-responsive table-card p-2">
                                        <?php



                                        $card_uuid = $_GET['card_id'] ?? '';
                                        if (!$card_uuid) {
                                            echo '<div class="alert alert-danger">Invalid Card ID</div>';
                                        } else {

                                            // Fetch the card only
                                            $query = mysqli_query(
                                                $connection,
                                                "SELECT * FROM cvv_cards WHERE uuid = '$card_uuid' LIMIT 1"
                                            );

                                            if (!$query || mysqli_num_rows($query) === 0) {
                                                echo '<div class="alert alert-danger">Card not found.</div>';
                                            } else {

                                                $card = mysqli_fetch_assoc($query);

                                        ?>

                                                <table class="table table-hover table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <style>
                                                            .table th {
                                                                font-weight: 300;
                                                            }
                                                        </style>

                                                        <tr>
                                                            <th scope="col">Name</th>
                                                            <th scope="col"><?php echo htmlspecialchars($card['name']); ?></th>
                                                        </tr>

                                                        <tr>
                                                            <th scope="col">Card Number</th>
                                                            <th scope="col"><?php echo htmlspecialchars(maskCardNumber($card['card_number']));
                                                                            ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">BIN</th>
                                                            <th scope="col"><?php echo htmlspecialchars($card['bin']); ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">CVV</th>
                                                            <th scope="col">***</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Expiry Date</th>
                                                            <th scope="col"><?php echo htmlspecialchars($card['expiry_date']); ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Card Type</th>
                                                            <th scope="col"><?php echo htmlspecialchars($card['card_type']); ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Country</th>
                                                            <th scope="col" style="text-transform:capitalize"><?php echo htmlspecialchars($card['country']); ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Bank</th>
                                                            <th scope="col" style="text-transform:capitalize"><?php echo htmlspecialchars($card['bank']); ?></th>
                                                        </tr>

                                                        <tr>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">$<?php echo htmlspecialchars($card['price']); ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">
                                                                <?php
                                                                $status = htmlspecialchars($card['status']);
                                                                $statusClass = match ($status) {
                                                                    'available' => 'text-success',
                                                                    'sold' => 'text-danger',
                                                                    default => 'text-muted',
                                                                };
                                                                ?>
                                                                <span class="<?php echo $statusClass; ?>"><?php echo ucfirst($status); ?></span>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Created At</th>
                                                            <th scope="col"><?php echo htmlspecialchars($card['created_at']); ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Updated At</th>
                                                            <th scope="col"><?php echo htmlspecialchars($card['updated_at']); ?></th>
                                                        </tr>

                                                        <tr>
                                                            <th scope="col">Card Image</th>
                                                            <th scope="col">
                                                                <?php if (!empty($card['card_image'])): ?>
                                                                    <img src="../../../uploads/cards/<?php echo htmlspecialchars($card['card_image']); ?>" alt="Card Image" width="150">
                                                                <?php else: ?>
                                                                    No image
                                                                <?php endif; ?>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Bank Logo</th>
                                                            <th scope="col">
                                                                <?php if (!empty($card['bank_logo'])): ?>
                                                                    <img src="../../../uploads/banks/<?php echo htmlspecialchars($card['bank_logo']); ?>" alt="Bank Logo" width="150">
                                                                <?php else: ?>
                                                                    No logo
                                                                <?php endif; ?>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Action</th>
                                                            <th scope="col">
                                                                <form method="POST" onsubmit="return confirm('Are you sure you want to buy this card?')">
                                                                    <input type="hidden" name="cvv_card_id" value="<?php echo $card_uuid ?>">
                                                                    <button type="submit" name="buy" class="btn btn-warning btn-sm">Buy</button>

                                                                </form>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Back</th>
                                                            <th scope="col">
                                                                <a href="../index.php">
                                                                    <button type="button" class="btn btn-secondary btn-sm">Back to Cards</button>
                                                                </a>
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                        <?php }
                                        } ?>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>





            <!-- End Page-content -->

            <?php include("../../components/footer.php") ?>
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