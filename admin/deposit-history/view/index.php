<?php
include("../../../server/connection.php");


                           if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['deposit_id'])) {
                                    $depositId = mysqli_real_escape_string($connection, $_POST['deposit_id']);
                                    $action = $_POST['action'];

                                    if ($action === 'approve') {
                                             // Get deposit info (amount + user)
                                             $depositRes = mysqli_query($connection, "SELECT amount, user FROM deposits WHERE deposts_id='$depositId' LIMIT 1");
                                             if ($depositRes && mysqli_num_rows($depositRes) > 0) {
                                                      $deposit = mysqli_fetch_assoc($depositRes);
                                                      $amount = floatval($deposit['amount']);
                                                      $userId = intval($deposit['user']);

                                                      // Approve deposit
                                                      $updateDeposit = mysqli_query($connection, "UPDATE deposits SET status='approved' WHERE deposts_id='$depositId'");

                                                      if ($updateDeposit) {
                                                               // Update user balance
                                                               $updateUser = mysqli_query($connection, "UPDATE users SET bal = bal + $amount WHERE id='$userId'");

                                                               if ($updateUser) {
                                                                        echo "<script>alert('Deposit approved and user balance updated'); window.location.href='./index.php';</script>";
                                                               } else {
                                                                        echo '<div class="alert alert-danger">Deposit approved, but failed to update user balance: ' . mysqli_error($connection) . '</div>';
                                                               }
                                                      } else {
                                                               echo '<div class="alert alert-danger">Failed to approve deposit: ' . mysqli_error($connection) . '</div>';
                                                      }
                                             } else {
                                                      echo '<div class="alert alert-danger">Deposit not found</div>';
                                             }
                                    }

                                    if ($action === 'decline') {
                                             $update = mysqli_query($connection, "UPDATE deposits SET status='declined' WHERE deposts_id='$depositId'");
                                             if ($update) {
                                                      echo "<script>alert('Deposit declined'); window.location.reload();</script>";
                                             } else {
                                                      echo '<div class="alert alert-danger">Failed to decline deposit: ' . mysqli_error($connection) . '</div>';
                                             }
                                    }
                           }



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
                                                                        <h4 class="mb-sm-0">Deposit History</h4>
                                                                        <div class="page-title-right">
                                                                                 <ol class="breadcrumb m-0">
                                                                                          <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                                                                          <li class="breadcrumb-item active">Deposit History</li>
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


                                                                                          $deposit_id = $_GET['deposit_id'];



                                                                                          if (!$deposit_id) {
                                                                                                   die('<div class=" alert alert-danger">Invalid deposit ID</div>');
                                                                                          }

                                                                                          // fetch the deposit
                                                                                          $query = mysqli_query($connection, "SELECT deposits.*, users.username , users.email FROM deposits,users WHERE deposits.deposts_id = '$deposit_id' AND deposits.user=users.id");
                                                                                          echo mysqli_error($connection);
                                                                                          $deposit = mysqli_fetch_assoc($query);


                                                                                          if (mysqli_num_rows($query) < 0) {
                                                                                                   die('<div class="alert alert-danger">Deposit not found</div>');
                                                                                          }
                                                                                          ?>

                                                                                          <table class="table table-hover table-nowrap align-middle mb-0">
                                                                                                   <tbody id="userTableBody">
                                                                                                            <style>
                                                                                                                     .table th {
                                                                                                                              font-weight: 300;
                                                                                                                     }
                                                                                                            </style>

                                                                                                            <tr>
                                                                                                                     <th scope="col">User Name</th>
                                                                                                                     <th scope="col"><?php echo htmlspecialchars($deposit['username']); ?></th>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                     <th scope="col">User Email</th>
                                                                                                                     <th scope="col"><?php echo htmlspecialchars($deposit['email']); ?></th>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                     <th scope="col">Amount</th>
                                                                                                                     <th scope="col">$<?php echo htmlspecialchars($deposit['amount']); ?></th>
                                                                                                            </tr>


                                                                                                            <tr>
                                                                                                                     <th scope="col">Payment Method</th>
                                                                                                                     <th scope="col"><?php echo htmlspecialchars($deposit['payment_method']); ?></th>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                     <th scope="col">Payment Address</th>
                                                                                                                     <th scope="col"><?php echo htmlspecialchars($deposit['payment_address'] ?? ''); ?></th>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                     <th scope="col">Image</th>
                                                                                                                     <th scope="col">
                                                                                                                              <?php if (!empty($deposit['image'])): ?>
                                                                                                                                       <img src="../../../uploads/deposit/<?php echo htmlspecialchars($deposit['image']); ?>" alt="Deposit Proof" width="150">
                                                                                                                              <?php else: ?>
                                                                                                                                       No image
                                                                                                                              <?php endif; ?>
                                                                                                                     </th>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                     <th scope="col">Date</th>
                                                                                                                     <th scope="col"><?php echo htmlspecialchars($deposit['date']); ?></th>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                     <th scope="col">Status</th>
                                                                                                                     <th scope="col">
                                                                                                                              <?php
                                                                                                                              $status = htmlspecialchars($deposit['status']);
                                                                                                                              $statusClass = '';

                                                                                                                              if ($status === 'approved') {
                                                                                                                                       $statusClass = 'text-success';
                                                                                                                              } elseif ($status === 'pending') {
                                                                                                                                       $statusClass = 'text-danger';
                                                                                                                              } elseif ($status === 'declined') {
                                                                                                                                       $statusClass = 'text-warning';
                                                                                                                              } else {
                                                                                                                                       $statusClass = 'text-muted';
                                                                                                                              }
                                                                                                                              ?>

                                                                                                                              <span class="<?php echo $statusClass; ?>"><?php echo ucfirst($status); ?></span>
                                                                                                                     </th>
                                                                                                            </tr>
                                                                                                            <?php if ($status === 'pending'): ?>
                                                                                                                     <tr>
                                                                                                                              <th scope="col">Action</th>
                                                                                                                              <th scope="col">
                                                                                                                                       <form method="POST" style="display:inline;" onsubmit="return confirm('Approve this deposit?')">

                                                                                                                                                <input type="hidden" name="action" value="approve">
                                                                                                                                                <input type="hidden" name="deposit_id" value="<?php echo htmlspecialchars($deposit_id); ?>">
                                                                                                                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                                                                                                       </form>

                                                                                                                                       <form method="POST" style="display:inline; margin-left:5px;" onsubmit="return confirm('Decline this deposit?')">
                                                                                                                                                <input type="hidden" name="action" value="decline">
                                                                                                                                                <input type="hidden" name="deposit_id" value="<?php echo htmlspecialchars($deposit_id); ?>">
                                                                                                                                                <button type="submit" class="btn btn-danger btn-sm">Decline</button>
                                                                                                                                       </form>
                                                                                                                              </th>
                                                                                                                     </tr>
                                                                                                            <?php endif; ?>
                                                                                                            <tr>
                                                                                                                     <th scope="col">Back</th>
                                                                                                                     <th scope="col"> <a href="../index.php"><button type="submit" class="btn btn-secondary btn-sm">Deposit History</button></a></th>
                                                                                                            </tr>

                                                                                                   </tbody>
                                                                                          </table>

                                                                                 </div>

                                                                        </div>
                                                               </div>
                                                      </div>
                                             </div>

                                    </div>
                           </div>

                           <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



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