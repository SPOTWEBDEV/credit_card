<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">


                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-md-block me-2">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search..." autocomplete="off" id="search-options" value="">
                        <span class="las la-search search-widget-icon"></span>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                        <div data-simplebar style="max-height: 320px;">
                            <!-- item-->
                            <div class="dropdown-header">
                                <h6 class="text-overflow text-muted mb-0 text-uppercase">Recent Searches</h6>
                            </div>

                            <div class="dropdown-item bg-transparent text-wrap">
                                <a href="index.html" class="btn btn-soft-secondary btn-sm btn-rounded">how to setup <i class="mdi mdi-magnify ms-1"></i></a>
                                <a href="index.html" class="btn btn-soft-secondary btn-sm btn-rounded">buttons <i class="mdi mdi-magnify ms-1"></i></a>
                            </div>
                            <!-- item-->
                            <div class="dropdown-header mt-2">
                                <h6 class="text-overflow text-muted mb-1 text-uppercase">Pages</h6>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
                                <span>Analytics Dashboard</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"></i>
                                <span>Help Center</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                <span>My account settings</span>
                            </a>

                            <!-- item-->
                            <div class="dropdown-header mt-2">
                                <h6 class="text-overflow text-muted mb-2 text-uppercase">Members</h6>
                            </div>

                            <div class="notification-list">
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src="<?php echo $domain ?>assets/images/users/avatar-2.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-1">
                                            <h6 class="m-0">Angela Bernier</h6>
                                            <span class="fs-11 mb-0 text-muted">Manager</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src="<?php echo $domain ?>assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-1">
                                            <h6 class="m-0">David Grasso</h6>
                                            <span class="fs-11 mb-0 text-muted">Web Designer</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src="<?php echo $domain ?>assets/images/users/avatar-5.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-1">
                                            <h6 class="m-0">Mike Bunch</h6>
                                            <span class="fs-11 mb-0 text-muted">React Developer</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="text-center pt-3 pb-1">
                            <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All Results <i class="ri-arrow-right-line ms-1"></i></a>
                        </div>
                    </div>
                </form>

            </div>

            <div class="d-flex align-items-center">



                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-primary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>



                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-primary rounded-circle" data-toggle="fullscreen">
                        <i class='las la-expand fs-24'></i>
                    </button>
                </div>

                <!-- <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-primary rounded-circle light-dark-mode">
                                <i class='las la-moon fs-24'></i>
                            </button>
                        </div> -->



                <div class="dropdown header-item">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="<?php echo $domain ?>assets/images/avatar.svg" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <!-- <span class="d-none d-xl-inline-block fw-medium user-name-text fs-16"><?php echo $userDetail['username'] ?>. <i class="las la-angle-down fs-12 ms-1"></i></span>
                                    </span> -->
                            </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="<?php echo $domain ?>user/dashboard/index.php">
                            <i class="bx bx-home fs-15 align-middle me-1"></i>
                            <span key="t-profile">Dashboard</span>
                        </a>

                        <a class="dropdown-item" href="<?php echo $domain ?>user/my-card/index.php">
                            <i class="bx bx-credit-card fs-15 align-middle me-1"></i>
                            <span key="t-my-wallet">My Card</span>
                        </a>

                        <a class="dropdown-item" href="<?php echo $domain ?>user/Purchase/index.php">
                            <i class="bx bx-cart fs-15 align-middle me-1"></i>
                            <span key="t-lock-screen">Purchase</span>
                        </a>



                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#"><i class="bx bx-power-off fs-15 align-middle me-1 text-danger"></i> <span key="t-logout">Logout </span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>





<?php
// Function to get the full current URL
function getCurrentUrl()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $domain = $_SERVER['HTTP_HOST'];
    $requestUri = $_SERVER['REQUEST_URI'];

    // Remove query parameters
    $requestUri = strtok($requestUri, '?');

    return $protocol . $domain . $requestUri;
}


// List of URLs where you don't want the modal to show
$excludedUrls = [
    'http://localhost/credit_card/user/deposit/',
    'http://localhost/credit_card/user/deposit/index.php',
    'http://localhost/credit_card/user/deposit/#',
    'http://localhost/credit_card/user/deposit',
    'http://localhost/credit_card/user/deposit/proof',
    'http://localhost/credit_card/user/deposit/proof/',
    'http://localhost/credit_card/user/deposit/proof/#',
    'https://grubsp.com/user/deposit/',
    'https://grubsp.com/user/deposit/index.php',
    'https://grubsp.com/user/deposit/#',
    'https://grubsp.com/user/deposit',
    'https://grubman.com/user/deposit/proof',
    'https://grubman.com/user/deposit/proof/',
    'https://grubman.com/user/deposit/proof/#',
    
];

// Get the current full URL
$currentUrl = getCurrentUrl();

// Check if current URL is not in excluded list
if (!in_array($currentUrl, $excludedUrls)) {
    $checkDeposit = mysqli_query($connection, "SELECT * FROM deposits WHERE user='$id' AND status='approved'");
    $modelDeposit = mysqli_num_rows($checkDeposit);

    if ($modelDeposit <= 0) {
?>
        <!-- Modal Trigger Script -->
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('depositModal'), {
                    backdrop: 'static',
                    keyboard: false
                });
                myModal.show();
                document.body.classList.add('modal-open');
                document.body.style.backdropFilter = 'blur(5px)';
            });
        </script>
<?php
    }
}
?>



<style>
    .modal-backdrop.show {
        backdrop-filter: blur(5px);
    }
</style>




<!-- Deposit Required Modal -->
<div class="modal fade show" id="depositModal" tabindex="-1" aria-labelledby="depositModalLabel" aria-modal="true" role="dialog" style="display: none; backdrop-filter: blur(5px);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="depositModalLabel">Deposit Required</h5>
            </div>
            <div class="modal-body text-center">
                <i class="bi bi-exclamation-triangle-fill display-4 text-danger"></i>
                <p class="mt-3 fs-5">You must have money in your balance before viewing this page.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="<?php echo $domain ?>user/deposit/" class="btn btn-primary">Make a Deposit</a>
            </div>
        </div>
    </div>
</div>