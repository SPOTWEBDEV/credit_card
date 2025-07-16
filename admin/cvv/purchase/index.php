<?php
include("../../../server/connection.php");


if (isset($_POST['generate'])) {
    $status = $_POST['status'];
    $price = floatval($_POST['price']);
    $country = trim($_POST['country']);
    $bank = trim($_POST['bank']);
    $input_name = trim($_POST['name']);

    if ($price <= 0) {
        echo "<script>alert('❌ Price must be greater than 0');</script>";
        exit;
    }

    $count = $_POST['time'];
    if ($count <= 0) {
        echo "<script>alert('❌ Number of cards must be a positive whole number');</script>";
        exit;
    }

    $success = 0;

    $namesArray = [
        "John Smith",
        "Jane Doe",
        "Michael Johnson",
        "Emily Davis",
        "William Brown",
        "Olivia Wilson",
        "James Taylor",
        "Sophia Martinez",
        "Benjamin Anderson",
        "Charlotte Thomas",
        "Daniel Lee",
        "Amelia Moore"
    ];

    for ($i = 0; $i < $count; $i++) {
        $card_number = '';

        for ($j = 0; $j < 16; $j++) {
            $card_number .= rand(0, 9);
        }

        $cvv = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $bin = substr($card_number, 0, 6);
        $expiry_date = date('Y-m-d', strtotime('+3 years'));

        $name = $input_name ?: $namesArray[array_rand($namesArray)];

        $insert = mysqli_query($connection, "
            INSERT INTO cvv_cards 
            (card_number, cvv, bin, expiry_date, price, status, country, bank, name) 
            VALUES 
            ('$card_number', '$cvv', '$bin', '$expiry_date', '$price', '$status', '$country', '$bank', '$name')
        ");

        if ($insert) {
            $success++;
        }
    }

    if ($success === $count) {
        echo "<script>alert('✅ $count CVV card(s) generated successfully'); window.location.reload();</script>";
    } else {
        echo "<script>alert('⚠️ Only $success out of $count CVV card(s) generated');</script>";
    }
}


?>


<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>User | <?php echo $sitename ?> - Admin & Dashboard Template</title>
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

        <?php include("../../include/nav.php") ?>


        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->

            <?php include("../../include/sidenav.php") ?>

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
                                <h4 class="mb-sm-0">Purchase CVV</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                        <li class="breadcrumb-item active">Purchase Cvv</li>
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
                                                    <th scope="col">Card Holder Name</th>
                                                    <th scope="col">CVV</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Country</th>
                                                    <th scope="col">Bank</th>
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
                            url: '<?php echo $domain ?>server/admin/api/getPurchaseCards.php',
                            method: 'GET',
                            data: {
                                page: page,
                                limit: 10, // enforce limit = 10
                                status: pageStatus, // send selected status
                                search: search
                            },
                            success: function(res) {
                                const tbody = $('#userTableBody').empty();

                                console.log(res.data);


                                if (!res.data || res.data.length === 0) {
                                    tbody.append('<tr><td colspan="5" class="text-center">No records found</td></tr>');
                                } else {
                                    res.data.forEach((card, index) => {
                                        tbody.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${card.card_number}</td>
                                <td>${card.cvv}</td>
                                <td>$${card.card_price}</td>
                                <td>${card.country}</td>
                                <td>${card.bank}</td>
                                <td>
                                    <span style="text-transform:capitalize" class="badge  
                                    ${card.purchase_status === 'pending' ? 'bg-danger-subtle text-danger' : card.purchase_status === 'approved' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning'}  
                                    p-2">${card.purchase_status}</span>
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

            <?php include("../../include/footer.php") ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="addpaymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header p-4 pb-0">
                    <h5 class="modal-title" id="createMemberLabel">Generate CVV</h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">


                    <div class="modal-body p-4">
                        <form method="POST" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="time" class="form-label">Number Generated CVV</label>
                                <input type="number" value="2" name="time" class="form-control" placeholder="Number Generated CVV" required>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="available">Available</option>
                                    <option value="reserved">Reserved</option>
                                    <option value="sold">Sold</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01" min="0" name="price" class="form-control" placeholder="Enter price" required>
                            </div>

                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" name="country" class="form-control" placeholder="Enter country" required>
                            </div>

                            <div class="mb-3">
                                <label for="bank" class="form-label">Bank</label>
                                <input type="text" name="bank" class="form-control" placeholder="Enter bank" required>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Cardholder Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Leave blank to auto-generate">
                            </div>

                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="generate" class="btn btn-success">Generate CVV Card</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div><!--end modal-->


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

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
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