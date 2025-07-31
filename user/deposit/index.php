<?php
include("../../server/connection.php");
include("../../server/client/auth/index.php");

?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Deposit | <?php echo $sitename ?> - Black Market CC Access</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Access premium stolen credit cards, dumps, and fullz. Updated daily." name="description" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo $domain ?>assets/images/favicon.ico">

    <!-- Plugins css -->
    <link href="<?php echo $domain ?>assets/libs/dropzone/dropzone.css" rel="stylesheet" type="text/css" />

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

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0"> Transaction Request</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Account</a></li>
                                        <li class="breadcrumb-item active">New Transaction</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">

                                    <?php




                                    if (isset($_POST['submit'])) {

                                        $amount = $_POST['amount'];
                                        $crypto_type = $_POST['crypto_type'];
                                        $crypto_address = $_POST['crypto_address'];
                                        $payment_method = $crypto_type; // since it’s crypto

                                        $depost_id = uniqid("DEP-");

                                        $redirect = $domain . 'user/deposit/proof/?deposit_id=' . $depost_id;

                                        $stmt = $connection->prepare("INSERT INTO deposits (deposts_id, user, amount, status, payment_method, payment_address) VALUES (?, ?, ?, 'pending', ?, ?)");
                                        $stmt->bind_param("sidss", $depost_id, $id, $amount, $payment_method, $crypto_address);

                                        if ($stmt->execute()) {
                                            echo "<div class='alert alert-success'>Deposit submitted successfully!</div>";
                                            echo "<script>setTimeout(()=>{ window.location.href='$redirect' },3000)</script>";
                                        } else {
                                            echo "<div class='alert alert-danger'>Error: " . $connection->error . "</div>";
                                        }
                                    }
                                    ?>




                                    <form method="POST" action="">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="price">Amount</label>
                                                <input id="price" name="amount" placeholder="Enter Amount" type="number" class="form-control">
                                            </div>
                                        </div>

                                        <div id="crypto-section" style="display:none;">
                                            <div class="mb-3">
                                                <label for="crypto_type" class="form-label">Crypto Type</label>
                                                <select class="form-select" name="crypto_type" id="crypto_type">
                                                    <option selected disabled>Select Crypto</option>
                                                    <?php foreach ($crypto_options as $type => $address): ?>
                                                        <option value="<?= htmlspecialchars($type) ?>"><?= htmlspecialchars($type) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="crypto_address" class="form-label">Crypto Address</label>
                                                <input type="text" class="form-control" id="crypto_address" name="crypto_address" readonly>
                                            </div>
                                        </div>

                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </form>

                                    <script>
                                        document.getElementById('price').addEventListener('input', function() {
                                            const val = parseFloat(this.value);
                                            if (!isNaN(val) && val > 0) {
                                                document.getElementById('crypto-section').style.display = 'block';
                                            } else {
                                                document.getElementById('crypto-section').style.display = 'none';
                                            }
                                        });

                                        // Change address when crypto type changes
                                        document.getElementById('crypto_type').addEventListener('change', function() {
                                            const addresses = <?php echo json_encode($crypto_options); ?>;
                                            const selected = this.value;
                                            document.getElementById('crypto_address').value = addresses[selected] || '';
                                        });
                                    </script>


                                    <ul class="list-unstyled mb-0" id="dropzone-preview">
                                        <li class="mt-2" id="dropzone-preview-list">
                                            <!-- This is used as the file preview template -->
                                            <div class="border rounded">
                                                <div class="d-flex p-2">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-sm bg-light rounded">
                                                            <img data-dz-thumbnail class="img-fluid rounded d-block" src="<?php echo $domain ?>assets/images/new-document.png" alt="Dropzone-Image" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="pt-1">
                                                            <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                            <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                            <strong class="error text-danger" data-dz-errormessage></strong>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </li>
                                    </ul>


                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <?php include("../components/footer.php") ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->





    <!-- JAVASCRIPT -->
    <script src="<?php echo $domain ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $domain ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo $domain ?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo $domain ?>assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?php echo $domain ?>assets/js/plugins.js"></script>

    <!-- dropzone js -->
    <script src="<?php echo $domain ?>assets/libs/dropzone/dropzone-min.js"></script>

    <script src="<?php echo $domain ?>assets/js/pages/ecommerce-product-create.init.js"></script>

    <!-- App js -->
    <script src="<?php echo $domain ?>assets/js/app.js"></script>
</body>


<!-- Mirrored from themesbrand.com/<?php echo $sitename ?>/layouts/transaction-new.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Jun 2025 13:09:38 GMT -->

</html>