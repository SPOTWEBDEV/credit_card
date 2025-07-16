<?php
include("../../../server/connection.php");
include("../../../server/client/auth/index.php");

?>


<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>User | Invoika - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
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

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include("../../components/navbar.php") ?>


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
                                <h4 class="mb-sm-0">Deposit History</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">User</a></li>
                                        <li class="breadcrumb-item active">Deposit History</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Page Title -->

                    <!-- Filters -->
                    <div class="row pb-4 gy-3">

                        <div class="col-sm-auto ms-auto">
                            <div class="d-flex gap-3">
                                <input type="text" class="form-control" id="searchBox" placeholder="Search for Result">
                                <select id="pageStatus" class="form-select w-auto">
                                    <option value="all" selected>All</option>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="declined">Declined</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-hover table-nowrap align-middle mb-0">
                                            <thead>
                                                <tr class="text-muted text-uppercase">
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Deposit Amount</th>
                                                    <th scope="col">Deposit Payment Method</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="userTableBody">
                                                <!-- Data from AJAX -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <nav class="mt-3">
                                        <ul class="pagination justify-content-end mb-0" id="pagination">
                                            <!-- Pagination buttons -->
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(function() {
                    let currentPage = 1;

                    function loadUsers(page = 1) {
                        const search = $('#searchBox').val();
                        const pageStatus = $('#pageStatus').val();

                        $.ajax({
                            url: '../../../server/client/api/getDeposit.php',
                            method: 'GET',
                            data: {
                                page: page,
                                limit: 10, // enforce limit = 10
                                status: pageStatus, // send selected status
                                search: search
                            },
                            success: function(res) {


                                const tbody = $('#userTableBody').empty();

                                if (!res.data || res.data.length === 0) {
                                    tbody.append('<tr><td colspan="5" class="text-center">No records found</td></tr>');
                                } else {
                                    res.data.forEach((deposit, index) => {
                                        tbody.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>$${deposit.amount}</td>
                                <td>${deposit.payment_method}</td>
                                <td>${deposit.date}</td>
                                <td>
                                    <span style="text-transform:capitalize" class="badge  
                                    ${deposit.status === 'sold' ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success'}  
                                    p-2">${deposit.status}</span>
                                </td>
                            </tr>
                        `);
                                    });
                                }

                                // Build pagination
                                const pagination = $('#pagination').empty();
                                const totalPages = Math.ceil(res.total / res.limit);

                                pagination.append(`<li class="page-item ${res.page === 1 ? 'disabled' : ''}">
                    <a class="page-link pageBtn" href="#" data-page="${res.page - 1}">Previous</a>
                </li>`);

                                for (let i = 1; i <= totalPages; i++) {
                                    pagination.append(`<li class="page-item ${i === res.page ? 'active' : ''}">
                        <a class="page-link pageBtn" href="#" data-page="${i}">${i}</a>
                    </li>`);
                                }

                                pagination.append(`<li class="page-item ${res.page === totalPages ? 'disabled' : ''}">
                    <a class="page-link pageBtn" href="#" data-page="${res.page + 1}">Next</a>
                </li>`);
                            },
                            error: function(error) {
                                $('#userTableBody').html(`<tr><td colspan="5" class="text-center text-danger">Error loading data => ${error.responseText || error.message}</td></tr>`);
                            }
                        });
                    }

                    // Initial load
                    loadUsers();

                    // Pagination click
                    $(document).on('click', '.pageBtn', function(e) {
                        e.preventDefault();
                        const targetPage = $(this).data('page');
                        if (targetPage > 0) {
                            currentPage = targetPage;
                            loadUsers(currentPage);
                        }
                    });

                    // Search
                    $('#searchBox').on('input', function() {
                        currentPage = 1;
                        loadUsers(currentPage);
                    });

                    // Status filter
                    $('#pageStatus').on('change', function() {
                        currentPage = 1;
                        loadUsers(currentPage);
                    });
                });
            </script>


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

    


    <!-- JAVASCRIPT -->
    <script src="<?php echo $domain ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $domain ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo $domain ?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo $domain ?>assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?php echo $domain ?>assets/js/plugins.js"></script>

    <!-- Sweet Alerts js -->
    <script src="<?php echo $domain ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- App js -->
    <script src="<?php echo $domain ?>assets/js/app.js"></script>
</body>

</html>