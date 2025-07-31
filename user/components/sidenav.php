<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo $domain ?>user/dashboard/">
                        <i class="las la-tachometer-alt"></i> <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarInvoiceManagement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInvoiceManagement">
                        <i class="las la-money-check-alt"></i> <span data-key="t-invoices">Deposit</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarInvoiceManagement">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo $domain ?>user/deposit/" class="nav-link" data-key="t-invoice">
                                    <i class="las la-hand-holding-usd me-1"></i> Request
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $domain ?>user/deposit/history/" class="nav-link" data-key="t-add-invoice">
                                    <i class="las la-history me-1"></i> History
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo $domain ?>user/purchase/">
                        <i class="las la-shopping-cart"></i> <span data-key="t-tables">Purchase</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo $domain ?>user/my-card/">
                        <i class="las la-id-card"></i> <span data-key="t-icons">My Card</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo $domain ?>user/setting/">
                        <i class="las la-cog"></i> <span data-key="t-authentication">Setting</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>