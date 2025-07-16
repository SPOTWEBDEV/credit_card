<?php
include("../../server/connection.php");

?>


<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Contact Message List | <?php echo $sitename ?></title>
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

            <?php include("../include/sidenav.php") ?>

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
                                <h4 class="mb-sm-0">All Contact Message</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                        <li class="breadcrumb-item active">All Contact Message</li>
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
                                <select id="pageSize" class="form-select w-auto">
                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="20">20</option>
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
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Subject</th>
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
                        const limit = $('#pageSize').val();

                        $.ajax({
                            url: '../../server/admin/api/getContact.php',
                            method: 'GET',
                            data: {
                                page: page,
                                limit: limit,
                                search: search
                            },
                            success: function(res) {
                                const tbody = $('#userTableBody').empty();

                                if (res.data.length === 0) {
                                    tbody.append('<tr><td colspan="5" class="text-center">No records found</td></tr>');
                                } else {
                                    res.data.forEach(user => {
                                        tbody.append(`
                            <tr>
                                <td>${user.id}</td>
                                <td>${user.username}</td>
                                <td>${user.email}</td>
                                <td>${user.created_at}</td>
                                <td>${user.subject}</td>
                                <td>
                            <span style="text-transform:capitalize" class="badge  ${user.status == 'unread' ? 'bg-danger-subtle text-danger' : user.status == 'read' ? 'bg-primary-subtle text-primary' : 'bg-success-subtle text-success' }   p-2">${user.status}</span>
                                
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
                                console.log(error);

                                $('#userTableBody').html(`<tr><td colspan="5" class="text-center text-danger">Error loading data => ${error.responseText
                || error.message}</td></tr>`);
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

                    // Page size
                    $('#pageSize').on('change', function() {
                        currentPage = 1;
                        loadUsers(currentPage);
                    });
                });
            </script>

            <!-- End Page-content -->

            <?php include("../include/footer.php") ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="addpaymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header p-4 pb-0">
                    <h5 class="modal-title" id="createMemberLabel">Add User</h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form autocomplete="off" id="memberlist-form" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" id="memberid-input" class="form-control" value="">
                                <div class="text-center mb-4">
                                    <div class="position-relative d-inline-block">
                                        <div class="position-absolute bottom-0 end-0">
                                            <label for="member-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Member Image">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                        <i class="ri-image-fill"></i>
                                                    </div>
                                                </div>
                                            </label>
                                            <input class="form-control d-none" value="" id="member-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                        </div>
                                        <div class="avatar-lg">
                                            <div class="avatar-title bg-light rounded-circle">
                                                <img src="<?php echo $domain ?>assets/images/users/user-dummy-img.jpg" id="member-img" class="avatar-md rounded-circle h-auto" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 mt-4">
                                    <label for="teammembersName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="teammembersName" placeholder="Enter name" required>
                                    <div class="invalid-feedback">Please Enter a member name.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="teammembersEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="teammembersEmail" placeholder="Enter email" required>
                                    <div class="invalid-feedback">Please Enter a member Email.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="teammembersnumber" class="form-label">Phone</label>
                                    <input type="number" class="form-control" id="teammembersnumber" placeholder="Enter number" required>
                                    <div class="invalid-feedback">Please Enter a member number.</div>
                                </div>

                                <div class="mb-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="2">Disabled</option>
                                    </select>
                                </div>

                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="addNewMember">Add User</button>
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

    <!-- Sweet Alerts js -->
    <script src="<?php echo $domain ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- App js -->
    <script src="<?php echo $domain ?>assets/js/app.js"></script>
</body>


<!-- Mirrored from themesbrand.com/<?php echo $sitename ?>/layouts/user.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Jun 2025 13:07:23 GMT -->

</html>