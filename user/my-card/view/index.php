<?php
include("../../../server/connection.php");
include("../../../server/client/auth/index.php");


?>


<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

         <meta charset="utf-8" />
         <title>Payments | <?php echo $sitename ?> - Admin & Dashboard Template</title>
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

                  <?php include("../../components/navbar.php") ?>


                  <!-- ========== App Menu ========== -->
                  <div class="app-menu navbar-menu">
                           <!-- LOGO -->


                           <?php include("../../components/sidenav.php") ?>

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
                                                                        <h4 class="mb-sm-0">View  My Card Details</h4>
                                                                        <div class="page-title-right">
                                                                                 <ol class="breadcrumb m-0">
                                                                                          <li class="breadcrumb-item"><a href="#">Client</a></li>
                                                                                          <li class="breadcrumb-item active">View My Card Details</li>
                                                                                 </ol>
                                                                        </div>
                                                               </div>
                                                      </div>
                                             </div>
                                             <!-- End Page Title -->



                                             <!-- Table -->
                                             <div class="row">
                                                      <div class="col-xl-12">
                                                               <div class="card">
                                                                        <div class="card-body">
                                                                                 <div class="table-responsive table-card p-2">
                                                                                          <?php






                                                                                          $card_uuid = $_GET['card_id'] ?? '';
                                                                                          if (!$card_uuid) {
                                                                                                   echo '<div class="alert alert-danger">Invalid Card ID</div>';
                                                                                          } else {

                                                                                                   // Fetch the purchase joined with card details
                                                                                                   $query = mysqli_query(
                                                                                                            $connection,
                                                                                                            "SELECT p.*, c.card_number, c.bin, c.cvv, c.expiry_date, c.card_type, c.price, c.card_image, c.bank_logo 
                                                                                          FROM cvv_purchases p
                                                                                          JOIN cvv_cards c ON c.id = p.cvv_card_id
                                                                                          WHERE p.uuid = '$card_uuid' AND p.user_id = '$id'
                                                                                          LIMIT 1"
                                                                                                   );

                                                                                                   if (!$query || mysqli_num_rows($query) === 0) {
                                                                                                            echo '<div class="alert alert-danger">Purchase not found or you are not authorized to view it.</div>';
                                                                                                   } else {

                                                                                                            $purchase = mysqli_fetch_assoc($query);

                                                                                          ?>

                                                                                                            <table class="table table-hover table-nowrap align-middle mb-0">
                                                                                                                     <tbody>
                                                                                                                              <style>
                                                                                                                                       .table th {
                                                                                                                                                font-weight: 300;
                                                                                                                                       }
                                                                                                                              </style>

                                                                                                                              <tr>
                                                                                                                                       <th scope="col">Card Number</th>
                                                                                                                                       <th scope="col"><?php echo htmlspecialchars($purchase['card_number']); ?></th>
                                                                                                                              </tr>
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">BIN</th>
                                                                                                                                       <th scope="col"><?php echo htmlspecialchars($purchase['bin']); ?></th>
                                                                                                                              </tr>
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">CVV</th>
                                                                                                                                       <th scope="col"><?php echo htmlspecialchars($purchase['cvv']); ?></th>
                                                                                                                              </tr>
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">Expiry Date</th>
                                                                                                                                       <th scope="col"><?php echo htmlspecialchars($purchase['expiry_date']); ?></th>
                                                                                                                              </tr>
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">Card Type</th>
                                                                                                                                       <th scope="col"><?php echo htmlspecialchars($purchase['card_type']); ?></th>
                                                                                                                              </tr>
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">Price</th>
                                                                                                                                       <th scope="col">$<?php echo htmlspecialchars($purchase['amount']); ?></th>
                                                                                                                              </tr>
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">Purchase Date</th>
                                                                                                                                       <th scope="col"><?php echo htmlspecialchars($purchase['purchase_date']); ?></th>
                                                                                                                              </tr>
                                                                                                                              
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">Card Image</th>
                                                                                                                                       <th scope="col">
                                                                                                                                                <?php if (!empty($purchase['card_image'])): ?>
                                                                                                                                                         <img src="../../../uploads/cards/<?php echo htmlspecialchars($purchase['card_image']); ?>" alt="Card Image" width="150">
                                                                                                                                                <?php else: ?>
                                                                                                                                                         No image
                                                                                                                                                <?php endif; ?>
                                                                                                                                       </th>
                                                                                                                              </tr>
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">Bank Logo</th>
                                                                                                                                       <th scope="col">
                                                                                                                                                <?php if (!empty($purchase['bank_logo'])): ?>
                                                                                                                                                         <img src="../../../uploads/banks/<?php echo htmlspecialchars($purchase['bank_logo']); ?>" alt="Bank Logo" width="150">
                                                                                                                                                <?php else: ?>
                                                                                                                                                         No logo
                                                                                                                                                <?php endif; ?>
                                                                                                                                                View Card Details
                                                                                                                                       </th>
                                                                                                                              </tr>
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">Back</th>
                                                                                                                                       <th scope="col">
                                                                                                                                                <a href="../index.php">
                                                                                                                                                         <button type="button" class="btn btn-secondary btn-sm">Back to Purchases</button>
                                                                                                                                                </a>
                                                                                                                                       </th>
                                                                                                                              </tr>
                                                                                                                     </tbody>
                                                                                                            </table>

                                                                                          <?php }
                                                                                          }

                                                                                          ?>


                                                                                 </div>
                                                                        </div>

                                                               </div>
                                                      </div>
                                             </div>

                                    </div>
                           </div>





                           <!-- End Page-content -->

                           <?php include("../../components/footer.php") ?>
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

</html>