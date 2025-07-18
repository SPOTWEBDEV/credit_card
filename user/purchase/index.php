<?php
include("../../server/connection.php");
include("../../server/client/auth/index.php");

?>


<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<!-- Mirrored from themesbrand.com/<?php echo $sitename ?>/layouts/transaction-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Jun 2025 13:09:38 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Transaction List | <?php echo $sitename ?> - Admin & Dashboard Template</title>
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

        <?php include("../components/navbar.php") ?>


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
                                <h4 class="mb-sm-0">Purchase CVV</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">Client</a></li>
                                        <li class="breadcrumb-item active">Purchase CVV</li>
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
                                } else {
                                    mysqli_query($connection, "UPDATE users SET bal='{$user['bal']}' WHERE id='$id'");
                                    echo '<div class="alert alert-danger">Failed to purchase card: ' . mysqli_error($connection) . '</div>';
                                }


                                echo "<script>setTimeout(()=>{ window.reload()},3000)</script>";
                            }


                            ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-hover table-nowrap align-middle mb-0">
                                            <thead>
                                                <tr class="text-muted text-uppercase">
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Card Holder Name</th>
                                                    <th scope="col">Card Holder Number</th>
                                                    <th scope="col">CVV</th>
                                                    <th scope="col">Bins</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Country</th>
                                                    <th scope="col">Bank</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
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

                        $.ajax({
                            url: '<?php echo $domain ?>server/client/api/purchaseCard.php',
                            method: 'GET',
                            data: {
                                page: page,
                                limit: 10, // enforce limit = 10
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
                                <td>${card.name}</td>
                                <td>${card.card_number}</td>
                                <td>${card.cvv}</td>
                                <td>${card.bin}</td>
                                <td>$${card.price}</td>
                                <td>${card.country}</td>
                                <td>${card.bank}</td>
                                <td>
                                    <span style="text-transform:capitalize" class="badge  
                                    ${card.status === 'sold' ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success'}  
                                    p-2">${card.status}</span>
                                </td>
                                <td>
                                    ${
                                        card.status === 'available'
                                        ? `
                                            <form method="POST" onsubmit="return confirm('Are you sure you want to buy this card?')">
                                                <input type="hidden" name="cvv_card_id" value="${card.uuid}">
                                                <button type="submit" name="buy" class="btn btn-warning btn-sm">Buy</button>
                                                 <a href="./view/?card_id=${card.uuid}"><button type="button" class="btn btn-success btn-sm">View More</button></a>
                                            </form>
                                            
                                        `
                                        : '<span  class="btn btn-warning btn-sm">Already Bought</span>'
                                    }
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



                });
            </script>


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


<!-- Mirrored from themesbrand.com/<?php echo $sitename ?>/layouts/transaction-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Jun 2025 13:09:38 GMT -->

</html>