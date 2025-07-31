<?php
include("../../server/connection.php");
include("../../server/client/auth/index.php");

?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Settings | <?php echo $sitename ?> - Black Market CC Access</title>
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
                                <h4 class="mb-sm-0">Profile</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Account</a></li>
                                        <li class="breadcrumb-item active">Setting</li>
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


                                    <form method="POST">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="username">Username</label>
                                                <input id="username" name="username" value="<?php echo htmlspecialchars($userDetail['username']) ?>" type="text" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="email">Email</label>
                                                <input id="email" name="email" value="<?php echo htmlspecialchars($userDetail['email']) ?>" type="email" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="phone">Phone number</label>
                                                <input id="phone" name="phone" value="<?php echo htmlspecialchars($userDetail['phone']) ?>" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <button type="submit" name="save" class="btn btn-primary">Save Change</button>
                                        </div>


                                    </form>
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

    <!-- dropzone js -->
    <script src="<?php echo $domain ?>assets/libs/dropzone/dropzone-min.js"></script>

    <script src="<?php echo $domain ?>assets/js/pages/ecommerce-product-create.init.js"></script>

    <!-- App js -->
    <script src="<?php echo $domain ?>assets/js/app.js"></script>
</body>


</html>