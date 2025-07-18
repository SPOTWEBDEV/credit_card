  <div class="navbar-brand-box">
      <!-- Dark Logo-->
      <!-- <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?php echo $domain ?>assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo $domain ?>assets/images/logo-dark.png" alt="" height="21">
                    </span>
                </a> -->
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
                  <a class="nav-link menu-link" href="<?php echo $domain ?>admin/">
                      <i class="las la-house-damage"></i> <span data-key="t-dashboard">Dashboard</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link menu-link" href="<?php echo $domain ?>admin/user/index.php">
                      <i class="las la-house-damage"></i> <span data-key="t-dashboard">User</span>
                  </a>
              </li>


              <li class="nav-item">
                  <a class="nav-link menu-link" href="<?php echo $domain ?>admin/deposit-history" aria-controls="sidebarInvoiceManagement">
                      <i class="las la-file-invoice"></i> <span data-key="t-invoices">Deposit</span>
                  </a>

              </li>

              
              <li class="nav-item">
                  <a class="nav-link menu-link" href="#sidebarInvoiceManagement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInvoiceManagement">
                      <i class="las la-file-invoice"></i> <span data-key="t-invoices">CVV</span>
                  </a>
                  <div class="collapse menu-dropdown" id="sidebarInvoiceManagement">
                      <ul class="nav nav-sm flex-column">
                          <li class="nav-item">
                              <a href="<?php echo $domain ?>admin/cvv/generate/" class="nav-link" data-key="t-invoice"> Generate CVV</a>
                          </li>

                          <li class="nav-item">
                              <a href="<?php echo $domain ?>admin/cvv/generate/" class="nav-link" data-key="t-add-invoice"> CVV List </a>
                          </li>

                      </ul>
                  </div>
              </li>

              <a class="nav-link menu-link" href="<?php echo $domain ?>admin/contact/index.php">
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