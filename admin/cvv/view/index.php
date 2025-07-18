<?php
include("../../../server/connection.php");
include("../../../server/client/auth/index.php");

$card_uuid = $_GET['card_id'] ?? '';


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
                                                                        <h4 class="mb-sm-0">View My Card Details</h4>
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


                                                                                           if(isset($_GET['del'])){

                                                                                                   $del = $_GET['del'];

                                                                                                   // Delete the card
                                                                                                   $delete = mysqli_query($connection, "DELETE FROM cvv_cards WHERE uuid = '$del'");
                                                                                                   echo mysqli_error($connection);
                                                                                                   if ($delete) {
                                                                                                            echo '<div class="alert alert-success">Card deleted successfully.</div>';
                                                                                                            echo "<script>setTimeout(()=>{ window.location.href='../generate/'},2000)</script>";
                                                                                                   } else {
                                                                                                            echo '<div class="alert alert-danger">Failed to delete card: ' . mysqli_error($connection) . '</div>';
                                                                                                   }

                                                                                           }
                                                                                        






                                                                                          
                                                                                          $check = mysqli_query($connection, "SELECT * FROM cvv_cards WHERE uuid = '$card_uuid' LIMIT 1");
                                                                                          if (!$check || mysqli_num_rows($check) === 0) {
                                                                                                   die('<div class="alert alert-danger">Card not found.</div>');
                                                                                          }else{
                                                                                                    if (!$card_uuid) {
                                                                                                   echo '<div class="alert alert-danger">Invalid Card ID</div>';
                                                                                          } else {

                                                                                                   // Fetch the purchase joined with card details
                                                                                                   $query = mysqli_query(
                                                                                                            $connection,
                                                                                                            "SELECT c.created_at , c.uuid, c.card_number, c.bin, c.cvv, c.expiry_date, c.card_type, c.price, c.card_image, c.bank_logo 
                                                                                          FROM cvv_cards  as c
                                                                                          WHERE uuid = '$card_uuid'
                                                                                          LIMIT 1"
                                                                                                   );

                                                                                                   if (!$query || mysqli_num_rows($query) === 0) {
                                                                                                            echo '<div class="alert alert-danger">Purchase not found or you are not authorized to view it.</div>';
                                                                                                   } else {

                                                                                                            $fetchCardDetails = mysqli_fetch_assoc($query);

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
                                                                                                                                       <th scope="col"><?php echo htmlspecialchars($fetchCardDetails['card_number']); ?></th>
                                                                                                                              </tr>
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">BIN</th>
                                                                                                                                       <th scope="col"><?php echo htmlspecialchars($fetchCardDetails['bin']); ?></th>
                                                                                                                              </tr>
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">CVV</th>
                                                                                                                                       <th scope="col"><?php echo htmlspecialchars($fetchCardDetails['cvv']); ?></th>
                                                                                                                              </tr>
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">Expiry Date</th>
                                                                                                                                       <th scope="col"><?php echo htmlspecialchars($fetchCardDetails['expiry_date']); ?></th>
                                                                                                                              </tr>
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">Card Type</th>
                                                                                                                                       <th scope="col"><?php echo htmlspecialchars($fetchCardDetails['card_type']); ?></th>
                                                                                                                              </tr>
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">Price</th>
                                                                                                                                       <th scope="col">$<?php echo htmlspecialchars($fetchCardDetails['price']); ?></th>
                                                                                                                              </tr>
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">Card Creation Date</th>
                                                                                                                                       <th scope="col"><?php echo htmlspecialchars($fetchCardDetails['created_at']); ?></th>
                                                                                                                              </tr>

                                                                                                                              <tr>
                                                                                                                                       <th scope="col">Card Image</th>
                                                                                                                                       <th scope="col">
                                                                                                                                                <?php if (!empty($fetchCardDetails['card_image'])): ?>
                                                                                                                                                         <img src="../../../uploads/cards/<?php echo htmlspecialchars($fetchCardDetails['card_image']); ?>" alt="Card Image" width="150">
                                                                                                                                                <?php else: ?>
                                                                                                                                                         No image
                                                                                                                                                <?php endif; ?>
                                                                                                                                       </th>
                                                                                                                              </tr>
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">Bank Logo</th>
                                                                                                                                       <th scope="col">
                                                                                                                                                <?php if (!empty($fetchCardDetails['bank_logo'])): ?>
                                                                                                                                                         <img src="../../../uploads/banks/<?php echo htmlspecialchars($fetchCardDetails['bank_logo']); ?>" alt="Bank Logo" width="150">
                                                                                                                                                <?php else: ?>
                                                                                                                                                         No logo
                                                                                                                                                <?php endif; ?>
                                                                                                                                                View Card Details
                                                                                                                                       </th>
                                                                                                                              </tr>
                                                                                                                              <tr>
                                                                                                                                       <th scope="col">Action</th>
                                                                                                                                       <th scope="col">
                                                                                                                                                <a href="../edit/?card_id=<?php echo $fetchCardDetails['uuid'] ?>">
                                                                                                                                                         <button type="button" class="btn btn-secondary btn-sm">Edit Card</button>
                                                                                                                                                </a>
                                                                                                                                                <a href="?del=<?php echo $fetchCardDetails['uuid'] ?>">
                                                                                                                                                         <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                                                                                                                                </a>
                                                                                                                                       </th>
                                                                                                                              </tr>
                                                                                                                     </tbody>
                                                                                                            </table>

                                                                                          <?php }
                                                                                          }

                                                                                          ?>
                                                                                 <?php } ?>
                                                                                          


                                                                                 </div>
                                                                        </div>

                                                               </div>
                                                      </div>
                                             </div>

                                    </div>
                           </div>





                           <!-- End Page-content -->

                           <?php include("../../include/footer.php") ?>
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