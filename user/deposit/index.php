<?php
include("../../server/connection.php");

?>


<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Payments | Invoika - Admin & Dashboard Template</title>
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

        <?php include('../components/navbar.php') ?>
    

        
        <!-- ========== App Menu ========== -->
       <?php include('../components/sidenav.php')  ?>
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
                                <h4 class="mb-sm-0">Payments</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Payments</a></li>
                                        <li class="breadcrumb-item active">Payments</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row pb-4 gy-3">
                        <div class="col-sm-4">
                            <button class="btn btn-primary addPayment-modal" data-bs-toggle="modal" data-bs-target="#addpaymentModal"><i class="las la-plus me-1"></i> Add Payment</button>
                        </div>

                        <div class="col-sm-auto ms-auto">
                            <div class="d-flex gap-3">
                                <div class="search-box">
                                    <input type="text" class="form-control" id="searchMemberList" placeholder="Search for Result">
                                    <i class="las la-search search-icon"></i>
                                </div>
                                <div class="">
                                    <button type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-soft-info btn-icon fs-14"><i class="las la-ellipsis-v fs-18"></i></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                        <li><a class="dropdown-item" href="#">All</a></li>
                                        <li><a class="dropdown-item" href="#">Last Week</a></li>
                                        <li><a class="dropdown-item" href="#">Last Month</a></li>
                                        <li><a class="dropdown-item" href="#">Last Year</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#nav-border-top-all" role="tab" aria-selected="true">
                                                All
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#nav-border-top-paid" role="tab" aria-selected="false">
                                                Paid
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#nav-border-top-pending" role="tab" aria-selected="false">
                                                Pending
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content text-muted pt-2">
                                        <div class="tab-pane active" id="nav-border-top-all" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive table-card">
                                                        <table class="table table-hover table-nowrap align-middle mb-0">
                                                            <thead class="table-light">
                                                                <tr class="text-muted text-uppercase">
                                                                    <th scope="col">Member</th>
                                                                    <th scope="col">Date</th>
                                                                    <th scope="col">Payment Details</th>
                                                                    <th scope="col" style="width: 16%;">Payment Type</th>
                                                                    <th scope="col" style="width: 12%;">Amount</th>
                                                                    <th scope="col" style="width: 12%;">Status</th>
                                                                    <th scope="col" style="width: 12%;">Action</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Donald Risher</a>
                                                                    </td>
                                                                    <td>20 Sep, 2022</td>
                                                                    <td>Maintenance</td>
                                                                    <td>Google Pay</td>
                                                                    <td>$1200.00</td>
                                                                    <td><span class="badge bg-success-subtle text-success p-2">Paid</span></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="las la-ellipsis-h align-middle fs-18"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                                                        View</button>
                                                                                </li>
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                                                        Edit</button>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                                                        Download</a>
                                                                                </li>
                                                                                <li class="dropdown-divider"></li>
                                                                                <li>
                                                                                    <a class="dropdown-item remove-item-btn" href="#">
                                                                                        <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                                                        Delete
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Brody Holman</a>
                                                                    </td>
                                                                    <td>12 Arl, 2022</td>
                                                                    <td>Flight Booking</td>
                                                                    <td>Credit Card</td>
                                                                    <td>$3600.00</td>
                                                                    <td><span class="badge bg-danger-subtle text-danger p-2">Failed</span></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="las la-ellipsis-h align-middle fs-18"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                                                        View</button>
                                                                                </li>
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                                                        Edit</button>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                                                        Download</a>
                                                                                </li>
                                                                                <li class="dropdown-divider"></li>
                                                                                <li>
                                                                                    <a class="dropdown-item remove-item-btn" href="#">
                                                                                        <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                                                        Delete
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Jolie Hood</a>
                                                                    </td>
                                                                    <td>28 Mar, 2022</td>
                                                                    <td>Office Rent</td>
                                                                    <td>Cash</td>
                                                                    <td>$800.00</td>
                                                                    <td><span class="badge bg-warning-subtle text-warning p-2">Pending</span></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="las la-ellipsis-h align-middle fs-18"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                                                        View</button>
                                                                                </li>
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                                                        Edit</button>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                                                        Download</a>
                                                                                </li>
                                                                                <li class="dropdown-divider"></li>
                                                                                <li>
                                                                                    <a class="dropdown-item remove-item-btn" href="#">
                                                                                        <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                                                        Delete
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Buckminster Wong</a>
                                                                    </td>
                                                                    <td>23 Aug, 2022</td>
                                                                    <td>Salary Payment</td>
                                                                    <td>Google Pay</td>
                                                                    <td>$1600.00</td>
                                                                    <td><span class="badge bg-success-subtle text-success p-2">Paid</span></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="las la-ellipsis-h align-middle fs-18"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                                                        View</button>
                                                                                </li>
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                                                        Edit</button>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                                                        Download</a>
                                                                                </li>
                                                                                <li class="dropdown-divider"></li>
                                                                                <li>
                                                                                    <a class="dropdown-item remove-item-btn" href="#">
                                                                                        <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                                                        Delete
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Howard Lyons</a>
                                                                    </td>
                                                                    <td>18 Sep, 2022</td>
                                                                    <td>Maintenance</td>
                                                                    <td>Bank Transfer</td>
                                                                    <td>$3200.00</td>
                                                                    <td><span class="badge bg-danger-subtle text-danger p-2">Failed</span></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="las la-ellipsis-h align-middle fs-18"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                                                        View</button>
                                                                                </li>
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                                                        Edit</button>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                                                        Download</a>
                                                                                </li>
                                                                                <li class="dropdown-divider"></li>
                                                                                <li>
                                                                                    <a class="dropdown-item remove-item-btn" href="#">
                                                                                        <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                                                        Delete
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Howard Oneal</a>
                                                                    </td>
                                                                    <td>12 Feb, 2022</td>
                                                                    <td>Online Product</td>
                                                                    <td>Credit Card</td>
                                                                    <td>$900.00</td>
                                                                    <td><span class="badge bg-success-subtle text-success p-2">Paid</span></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="las la-ellipsis-h align-middle fs-18"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                                                        View</button>
                                                                                </li>
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                                                        Edit</button>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                                                        Download</a>
                                                                                </li>
                                                                                <li class="dropdown-divider"></li>
                                                                                <li>
                                                                                    <a class="dropdown-item remove-item-btn" href="#">
                                                                                        <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                                                        Delete
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Jena Hall</a>
                                                                    </td>
                                                                    <td>30 Nov, 2022</td>
                                                                    <td>Train Booking</td>
                                                                    <td>Cash</td>
                                                                    <td>$200.00</td>
                                                                    <td><span class="badge bg-success-subtle text-success p-2">Paid</span></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="las la-ellipsis-h align-middle fs-18"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                                                        View</button>
                                                                                </li>
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                                                        Edit</button>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                                                        Download</a>
                                                                                </li>
                                                                                <li class="dropdown-divider"></li>
                                                                                <li>
                                                                                    <a class="dropdown-item remove-item-btn" href="#">
                                                                                        <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                                                        Delete
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Paki Edwards</a>
                                                                    </td>
                                                                    <td>23 Sep, 2022</td>
                                                                    <td>Maintenance</td>
                                                                    <td>Google Pay</td>
                                                                    <td>$1200.00</td>
                                                                    <td><span class="badge bg-warning-subtle text-warning p-2">Pending</span></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="las la-ellipsis-h align-middle fs-18"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                                                        View</button>
                                                                                </li>
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                                                        Edit</button>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                                                        Download</a>
                                                                                </li>
                                                                                <li class="dropdown-divider"></li>
                                                                                <li>
                                                                                    <a class="dropdown-item remove-item-btn" href="#">
                                                                                        <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                                                        Delete
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <a href="#javascript: void(0);" class="text-body align-middle fw-medium">James Diaz</a>
                                                                    </td>
                                                                    <td>16 Aug, 2022</td>
                                                                    <td>Bus Booking</td>
                                                                    <td>Google Pay</td>
                                                                    <td>$1800.00</td>
                                                                    <td><span class="badge bg-danger-subtle text-danger p-2">Failed</span></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="las la-ellipsis-h align-middle fs-18"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                                                        View</button>
                                                                                </li>
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                                                        Edit</button>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                                                        Download</a>
                                                                                </li>
                                                                                <li class="dropdown-divider"></li>
                                                                                <li>
                                                                                    <a class="dropdown-item remove-item-btn" href="#">
                                                                                        <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                                                        Delete
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>


                                                            </tbody><!-- end tbody -->
                                                        </table><!-- end table -->
                                                    </div><!-- end table responsive -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="nav-border-top-paid" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive table-card">
                                                        <table class="table table-hover table-nowrap align-middle mb-0">
                                                            <thead class="table-light">
                                                                <tr class="text-muted text-uppercase">
                                                                    <th scope="col">Member</th>
                                                                    <th scope="col">Date</th>
                                                                    <th scope="col">Payment Details</th>
                                                                    <th scope="col" style="width: 16%;">Payment Type</th>
                                                                    <th scope="col" style="width: 12%;">Amount</th>
                                                                    <th scope="col" style="width: 12%;">Status</th>
                                                                    <th scope="col" style="width: 12%;">Action</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Donald Risher</a>
                                                                    </td>
                                                                    <td>20 Sep, 2022</td>
                                                                    <td>Maintenance</td>
                                                                    <td>Google Pay</td>
                                                                    <td>$1200.00</td>
                                                                    <td><span class="badge bg-success-subtle text-success p-2">Paid</span></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="las la-ellipsis-h align-middle fs-18"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                                                        View</button>
                                                                                </li>
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                                                        Edit</button>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                                                        Download</a>
                                                                                </li>
                                                                                <li class="dropdown-divider"></li>
                                                                                <li>
                                                                                    <a class="dropdown-item remove-item-btn" href="#">
                                                                                        <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                                                        Delete
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Buckminster Wong</a>
                                                                    </td>
                                                                    <td>23 Aug, 2022</td>
                                                                    <td>Salary Payment</td>
                                                                    <td>Google Pay</td>
                                                                    <td>$1600.00</td>
                                                                    <td><span class="badge bg-success-subtle text-success p-2">Paid</span></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="las la-ellipsis-h align-middle fs-18"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                                                        View</button>
                                                                                </li>
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                                                        Edit</button>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                                                        Download</a>
                                                                                </li>
                                                                                <li class="dropdown-divider"></li>
                                                                                <li>
                                                                                    <a class="dropdown-item remove-item-btn" href="#">
                                                                                        <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                                                        Delete
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Howard Oneal</a>
                                                                    </td>
                                                                    <td>12 Feb, 2022</td>
                                                                    <td>Online Product</td>
                                                                    <td>Credit Card</td>
                                                                    <td>$900.00</td>
                                                                    <td><span class="badge bg-success-subtle text-success p-2">Paid</span></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="las la-ellipsis-h align-middle fs-18"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                                                        View</button>
                                                                                </li>
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                                                        Edit</button>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                                                        Download</a>
                                                                                </li>
                                                                                <li class="dropdown-divider"></li>
                                                                                <li>
                                                                                    <a class="dropdown-item remove-item-btn" href="#">
                                                                                        <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                                                        Delete
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Jena Hall</a>
                                                                    </td>
                                                                    <td>30 Nov, 2022</td>
                                                                    <td>Train Booking</td>
                                                                    <td>Cash</td>
                                                                    <td>$200.00</td>
                                                                    <td><span class="badge bg-success-subtle text-success p-2">Paid</span></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="las la-ellipsis-h align-middle fs-18"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                                                        View</button>
                                                                                </li>
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                                                        Edit</button>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                                                        Download</a>
                                                                                </li>
                                                                                <li class="dropdown-divider"></li>
                                                                                <li>
                                                                                    <a class="dropdown-item remove-item-btn" href="#">
                                                                                        <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                                                        Delete
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody><!-- end tbody -->
                                                        </table><!-- end table -->
                                                    </div><!-- end table responsive -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="nav-border-top-pending" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive table-card">
                                                        <table class="table table-hover table-nowrap align-middle mb-0">
                                                            <thead class="table-light">
                                                                <tr class="text-muted text-uppercase">
                                                                    <th scope="col">Member</th>
                                                                    <th scope="col">Date</th>
                                                                    <th scope="col">Payment Details</th>
                                                                    <th scope="col" style="width: 16%;">Payment Type</th>
                                                                    <th scope="col" style="width: 12%;">Amount</th>
                                                                    <th scope="col" style="width: 12%;">Status</th>
                                                                    <th scope="col" style="width: 12%;">Action</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Jolie Hood</a>
                                                                    </td>
                                                                    <td>28 Mar, 2022</td>
                                                                    <td>Office Rent</td>
                                                                    <td>Cash</td>
                                                                    <td>$800.00</td>
                                                                    <td><span class="badge bg-warning-subtle text-warning p-2">Pending</span></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="las la-ellipsis-h align-middle fs-18"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                                                        View</button>
                                                                                </li>
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                                                        Edit</button>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                                                        Download</a>
                                                                                </li>
                                                                                <li class="dropdown-divider"></li>
                                                                                <li>
                                                                                    <a class="dropdown-item remove-item-btn" href="#">
                                                                                        <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                                                        Delete
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Paki Edwards</a>
                                                                    </td>
                                                                    <td>23 Sep, 2022</td>
                                                                    <td>Maintenance</td>
                                                                    <td>Google Pay</td>
                                                                    <td>$1200.00</td>
                                                                    <td><span class="badge bg-warning-subtle text-warning p-2">Pending</span></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="las la-ellipsis-h align-middle fs-18"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-eye fs-18 align-middle me-2 text-muted"></i>
                                                                                        View</button>
                                                                                </li>
                                                                                <li>
                                                                                    <button class="dropdown-item" href="javascript:void(0);"><i class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                                                        Edit</button>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="las la-file-download fs-18 align-middle me-2 text-muted"></i>
                                                                                        Download</a>
                                                                                </li>
                                                                                <li class="dropdown-divider"></li>
                                                                                <li>
                                                                                    <a class="dropdown-item remove-item-btn" href="#">
                                                                                        <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                                                        Delete
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody><!-- end tbody -->
                                                        </table><!-- end table -->
                                                    </div><!-- end table responsive -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center mb-2 gy-3">
                                        <div class="col-md-5">
                                            <p class="mb-0 text-muted">Showing <b>1</b> to <b>5</b> of <b>10</b> results</p>
                                        </div>
                                        <div class="col-sm-auto ms-auto">
                                            <nav aria-label="...">
                                                <ul class="pagination mb-0">
                                                    <li class="page-item disabled">
                                                        <span class="page-link">Previous</span>
                                                    </li>
                                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item" aria-current="page">
                                                        <span class="page-link">2</span>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">Next</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>


                                </div><!-- end card-body -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include('../components/footer.php') ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="addpaymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header p-4 pb-0">
                    <h5 class="modal-title" id="createMemberLabel">Add Payment</h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="Name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="Name" placeholder="Enter Name">
                                </div>

                                <div class="mb-3">
                                    <label for="paymentdetails" class="form-label">Payment Details</label>
                                    <textarea class="form-control" placeholder="Enter Payment Description" id="paymentdetails"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" id="amount" placeholder="Enter Amount">
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-4">
                                            <label for="paymenttype" class="form-label">Payment Type</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Select Payment Type</option>
                                                <option value="1">Google Pay</option>
                                                <option value="2">Credit Card</option>
                                                <option value="3">Cash</option>
                                                <option value="4">Bank Transfer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-4">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Select Status</option>
                                                <option value="1">Paid</option>
                                                <option value="2">Pending</option>
                                                <option value="3">Failed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="addNewMember">Add Payment</button>
                                </div>
                            </div>
                        </div>
                    </form>
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

    <!-- App js -->
    <script src="<?php echo $domain ?>assets/js/app.js"></script>
</body>
</html>