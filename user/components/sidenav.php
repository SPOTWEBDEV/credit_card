 <div class="app-menu navbar-menu">
     <!-- LOGO -->
     <div class="navbar-brand-box">
         <!-- Dark Logo-->
         <a href="index.html" class="logo logo-dark">
             <span class="logo-sm">
                 <img src="<?php echo $domain ?>assets/images/logo-sm.png" alt="" height="22">
             </span>
             <span class="logo-lg">
                 <img src="<?php echo $domain ?>assets/images/logo-dark.png" alt="" height="21">
             </span>
         </a>
         <!-- Light Logo-->
         <a href="index.html" class="logo logo-light">
             <span class="logo-sm">
                 <img src="<?php echo $domain ?>assets/images/logo-sm.png" alt="" height="22">
             </span>
             <span class="logo-lg">
                 <img src="<?php echo $domain ?>assets/images/logo-light.png" alt="" height="21">
             </span>
         </a>
         <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
             <i class="ri-record-circle-line"></i>
         </button>
     </div>

     <div id="scrollbar">
         <div class="container-fluid">

             <div id="two-column-menu">
             </div>
             <ul class="navbar-nav" id="navbar-nav">
                 <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                 <li class="nav-item">
                     <a class="nav-link menu-link" href="index.html">
                         <i class="las la-house-damage"></i> <span data-key="t-dashboard">Dashboard</span>
                     </a>
                 </li>

                 <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Pages</span></li>

                 <li class="nav-item">
                     <a class="nav-link menu-link" href="#sidebarInvoiceManagement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInvoiceManagement">
                         <i class="las la-file-invoice"></i> <span data-key="t-invoices">Invoices Management</span>
                     </a>
                     <div class="collapse menu-dropdown" id="sidebarInvoiceManagement">
                         <ul class="nav nav-sm flex-column">
                             <li class="nav-item">
                                 <a href="invoice.html" class="nav-link" data-key="t-invoice"> Invoice </a>
                             </li>

                             <li class="nav-item">
                                 <a href="invoice-add.html" class="nav-link" data-key="t-add-invoice"> Add Invoice </a>
                             </li>


                             <li class="nav-item">
                                 <a href="invoice-details.html" class="nav-link" data-key="t-invoice-details"> Invoice Details </a>
                             </li>



                             <li class="nav-item">
                                 <a class="nav-link menu-link" href="#sidebarReport" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarReport"
                                     data-key="t-report">Report
                                 </a>
                                 <div class="collapse menu-dropdown" id="sidebarReport">
                                     <ul class="nav nav-sm flex-column">
                                         <li class="nav-item">
                                             <a href="payment-summary.html" class="nav-link" data-key="t-payment-summary"> Payment Summary </a>
                                         </li>
                                         <li class="nav-item">
                                             <a href="sale-report.html" class="nav-link" data-key="t-sale-report"> Sale Report </a>
                                         </li>
                                         <li class="nav-item">
                                             <a href="expenses-report.html" class="nav-link" data-key="t-expenses-report"> Expenses Report </a>
                                         </li>
                                     </ul>
                                 </div>
                             </li>

                             <li class="nav-item">
                                 <a href="user.html" class="nav-link" data-key="t-users">Users</a>
                             </li>



                         </ul>
                     </div>
                 </li>

                 <li class="nav-item">
                     <a class="nav-link menu-link" href="#sidebarAuthentication" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuthentication">
                         <i class="las la-cog"></i> <span data-key="t-authentication">Authentication</span>
                     </a>
                     <div class="collapse menu-dropdown" id="sidebarAuthentication">
                         <ul class="nav nav-sm flex-column">
                             <li class="nav-item">
                                 <a href="auth-signin.html" class="nav-link" data-key="t-signin">Sign In</a>
                             </li>

                         </ul>
                     </div>
                 </li>





                 <li class="nav-item">
                     <a class="nav-link menu-link" href="#sidebarTables" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTables">
                         <i class="las la-table"></i> <span data-key="t-tables">Tables</span>
                     </a>
                     <div class="collapse menu-dropdown" id="sidebarTables">
                         <ul class="nav nav-sm flex-column">
                             <li class="nav-item">
                                 <a href="tables-basic.html" class="nav-link" data-key="t-basic-tables">Basic Tables</a>
                             </li>
                             <li class="nav-item">
                                 <a href="tables-gridjs.html" class="nav-link" data-key="t-grid-js">Grid Js</a>
                             </li>
                             <li class="nav-item">
                                 <a href="tables-listjs.html" class="nav-link" data-key="t-list-js">List Js</a>
                             </li>
                             <li class="nav-item">
                                 <a href="tables-datatables.html" class="nav-link" data-key="t-datatables">Datatables </a>
                             </li>
                         </ul>
                     </div>
                 </li>



                 <li class="nav-item">
                     <a class="nav-link menu-link" href="#sidebarIcons" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarIcons">
                         <i class="las la-gift"></i> <span data-key="t-icons">Icons</span>
                     </a>
                     <div class="collapse menu-dropdown" id="sidebarIcons">
                         <ul class="nav nav-sm flex-column">
                             <li class="nav-item">
                                 <a href="icons-remix.html" class="nav-link" data-key="t-remix">Remix</a>
                             </li>
                             <li class="nav-item">
                                 <a href="icons-boxicons.html" class="nav-link" data-key="t-boxicons">Boxicons</a>
                             </li>
                             <li class="nav-item">
                                 <a href="icons-materialdesign.html" class="nav-link" data-key="t-material-design">Material Design</a>
                             </li>
                             <li class="nav-item">
                                 <a href="icons-bootstrap.html" class="nav-link" data-key="t-bootstrap">Bootstrap</a>
                             </li>
                             <li class="nav-item">
                                 <a href="icons-lineawesome.html" class="nav-link" data-key="t-line-awesome">Line Awesome</a>
                             </li>
                         </ul>
                     </div>
                 </li>



                 <div class="help-box text-center">
                     <img src="<?php echo $domain ?>assets/images/create-invoice.png" class="img-fluid" alt="">
                     <p class="mb-3 mt-2 text-muted">Upgrade To Pro For More Features</p>
                     <div class="mt-3">
                         <a href="invoice-add.html" class="btn btn-primary"> Create Invoice</a>
                     </div>
                 </div>

             </ul>
         </div>
         <!-- Sidebar -->
     </div>

     <div class="sidebar-background"></div>
 </div>