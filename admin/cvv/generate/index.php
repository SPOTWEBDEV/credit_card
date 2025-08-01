<?php
include("../../../server/connection.php");





$banksByCountry = [
    "United States" => ["Bank of America", "Chase", "Wells Fargo", "Citibank", "US Bank"],
    "United Kingdom" => ["Barclays", "HSBC", "Lloyds Bank", "NatWest", "Standard Chartered"],
    "China" => ["ICBC", "China Construction Bank", "Bank of China", "Agricultural Bank of China", "Bank of Communications"],
    "Dubai" => ["Emirates NBD", "Dubai Islamic Bank", "Mashreq Bank", "RAKBANK", "Commercial Bank of Dubai"]
];

function normalizeCountry($input)
{
    $input = strtolower(trim($input));
    if ($input === 'uk') return 'United Kingdom';
    if ($input === 'usa') return 'United States';
    if ($input === 'uae' || $input === 'dubai') return 'Dubai';
    return ucwords($input);
}

function findCountryByBank($bank, $banksByCountry)
{
    foreach ($banksByCountry as $country => $banks) {
        if (in_array($bank, $banks)) return $country;
    }
    return null;
}

function generateCVVCards($count, $status, $price, $givenCountry = '', $givenBank = '', $inputName = '')
{
    global $banksByCountry, $connection;

    $generated = [];
    $used = [];

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

    $givenCountry = $givenCountry ? normalizeCountry($givenCountry) : '';
    $givenBank = $givenBank ? ucwords(trim($givenBank)) : '';

    for ($i = 0; $i < $count; $i++) {
        $country = $givenCountry;
        $bank = $givenBank;

        // If bank is provided but country is not, infer country
        if (!$country && $bank) {
            $country = findCountryByBank($bank, $banksByCountry);
        }

        // If country is provided but bank is not, pick random bank from that country
        if ($country && !$bank) {
            $banks = $banksByCountry[$country] ?? [];
            if (!$banks) continue;
            $bank = $banks[array_rand($banks)];
        }

        // If neither provided, pick a random combination not already used
        if (!$country && !$bank) {
            $availableCountries = array_keys($banksByCountry);
            do {
                $country = $availableCountries[array_rand($availableCountries)];
            } while (in_array($country, array_column($generated, 'country'))); // Avoid repetition

            $banks = $banksByCountry[$country];
            $bank = $banks[array_rand($banks)];
        }

        // Avoid duplicate country+bank pair
        $key = $country . '|' . $bank;
        if (isset($used[$key])) {
            $i--;
            continue;
        }
        $used[$key] = true;

        // Price logic
        if (!$price) {
            if (in_array($country, ['United States', 'United Kingdom'])) {
                $cardPrice = rand(40, 60);
            } else {
                $cardPrice = rand(15, 40);
            }
        } else {
            $cardPrice = $price;
        }

        // Name
        $name = $inputName ?: $namesArray[array_rand($namesArray)];

        // Generate card details
        $card_number = '';
        for ($j = 0; $j < 16; $j++) {
            $card_number .= rand(0, 9);
        }

        $cvv = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $bin = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $yearsToAdd = rand(1, 3);
        $expiry_date = date('Y-m-d', strtotime("+$yearsToAdd years"));

        // Insert into database
        $insert = mysqli_query($connection, "
            INSERT INTO cvv_cards 
            (card_number, cvv, bin, expiry_date, price, status, country, bank, name) 
            VALUES 
            ('$card_number', '$cvv', '$bin', '$expiry_date', '$cardPrice', '$status', '$country', '$bank', '$name')
        ");

        if ($insert) {
            $generated[] = ['country' => $country, 'bank' => $bank];
        }
    }

    return $generated;
}




if (isset($_POST['generate'])) {
    // Get form values and sanitize
    $count = isset($_POST['time']) ? intval($_POST['time']) : 1;
    $status = trim($_POST['status']);
    $price = isset($_POST['price']) && $_POST['price'] !== '' ? floatval($_POST['price']) : null;
    $country = isset($_POST['country']) ? strtolower(trim($_POST['country'])) : '';
    $bank = isset($_POST['bank']) ? strtolower(trim($_POST['bank'])) : '';
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';

    // Include the logic code you already have for:
    // - Generating the cards
    // - Inferring country or bank
    // - Ensuring variation in results


    generateCVVCards($count, $status, $price, $country, $bank, $name);


    echo "<script>alert('✅ $count CVV card(s) generated successfully!');</script>";
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
                                <h4 class="mb-sm-0">Generate CVV</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                        <li class="breadcrumb-item active">Generate Cvv</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Page Title -->

                    <!-- Filters -->
                    <div class="row pb-4 gy-3">
                        <div class="col-sm-4">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addpaymentModal">
                                <i class="las la-plus me-1"></i> Generate Cvv
                            </button>
                        </div>
                        <div class="col-sm-auto ms-auto">
                            <div class="d-flex gap-3">
                                <input type="text" class="form-control" id="searchBox" placeholder="Search for Result">
                                <select id="pageStatus" class="form-select w-auto">
                                    <option value="available" selected>Available</option>
                                    <option value="sold">Sold</option>
                                    <option value="reserved">Reserved</option>
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
                                                    <th scope="col">Card Holder Name</th>
                                                    <th scope="col">Card Holder Number</th>
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
                            url: '../../../server/admin/api/getCards.php',
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
                                    res.data.forEach((card, index) => {
                                        tbody.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${card.name}</td>
                                <td>${card.card_number}</td>
                                <td>${card.cvv}</td>
                                <td>$${card.price}</td>
                                <td>${card.country}</td>
                                <td>${card.bank}</td>
                                <td>
                                    <span style="text-transform:capitalize" class="badge  
                                    ${card.status === 'sold' ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success'}  
                                    p-2">${card.status}</span>
                                </td>
                                <td>
                                  <a href="../view/?card_id=${card.uuid}"><button class="btn btn-success btn-sm">View More</button></a>
                                </td>
                                <td>
                                  <a href="../edit/?card_id=${card.uuid}"><button class="btn btn-danger btn-sm">Edit</button></a>
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
                                <input type="number" step="0.01" min="0" name="price" class="form-control" placeholder="Leave blank to auto-generate">
                            </div>

                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" name="country" class="form-control" placeholder="Leave blank to auto-generate">
                            </div>

                            <div class="mb-3">
                                <label for="bank" class="form-label">Bank</label>
                                <input type="text" name="bank" class="form-control" placeholder="Leave blank to auto-generate">
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