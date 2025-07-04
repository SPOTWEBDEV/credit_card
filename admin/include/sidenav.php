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

               <li class="nav-item">
                   <a class="nav-link menu-link" href="index.html">
                       <i class="las la-house-damage"></i> <span data-key="t-dashboard">User</span>
                   </a>
               </li>


               <li class="nav-item">
                   <a class="nav-link menu-link" href="#sidebarInvoiceManagement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInvoiceManagement">
                       <i class="las la-file-invoice"></i> <span data-key="t-invoices">Deposit</span>
                   </a>
                   <div class="collapse menu-dropdown" id="sidebarInvoiceManagement">
                       <ul class="nav nav-sm flex-column">
                           <li class="nav-item">
                               <a href="invoice.html" class="nav-link" data-key="t-invoice"> Approved</a>
                           </li>

                           <li class="nav-item">
                               <a href="invoice-add.html" class="nav-link" data-key="t-add-invoice"> Pending </a>
                           </li>


                           <li class="nav-item">
                               <a href="invoice-details.html" class="nav-link" data-key="t-invoice-details"> Declined </a>
                           </li>


                       </ul>
                   </div>
               </li>

               <li class="nav-item">
                   <a class="nav-link menu-link" href="#sidebarAuthentication">
                       <i class="las la-cog"></i> <span data-key="t-authentication">Purchase</span>
                   </a>

               </li>

               <a class="nav-link menu-link" href="#sidebarInvoiceManagement">
                   <i class="las la-file-invoice"></i> <span data-key="t-invoices">Contact</span>
               </a>



<!-- 
               <div class="help-box text-center">
                   <img src="<?php echo $domain ?>assets/images/create-invoice.png" class="img-fluid" alt="">
                   <p class="mb-3 mt-2 text-muted">Upgrade To Pro For More Features</p>
                   <div class="mt-3">
                       <a href="invoice-add.html" class="btn btn-primary"> Create Invoice</a>
                   </div>
               </div> -->

           </ul>
       </div>
       <!-- Sidebar -->
   </div>