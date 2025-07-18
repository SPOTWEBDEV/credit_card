<?php
include("../../../server/connection.php");


if (isset($_POST['generate'])) {
         $status = $_POST['status'];
         $price = floatval($_POST['price']);
         $country = trim($_POST['country']);
         $bank = trim($_POST['bank']);
         $input_name = trim($_POST['name']);

         if ($price <= 0) {
                  echo "<script>alert('❌ Price must be greater than 0');</script>";
                  exit;
         }

         $count = $_POST['time'];
         if ($count <= 0) {
                  echo "<script>alert('❌ Number of cards must be a positive whole number');</script>";
                  exit;
         }

         $success = 0;

         $namesArray = [
                  "John Smith",
                  "Jane Doe",
                  "Michael Johnson",
                  "Emily Davis",
                  "William Brown",
                  "Olivia Wilson",
                  "James Taylor",
                  "Sophia Martinez",
                  "Benjamin Anderson",
                  "Charlotte Thomas",
                  "Daniel Lee",
                  "Amelia Moore"
         ];

         for ($i = 0; $i < $count; $i++) {
                  $card_number = '';

                  for ($j = 0; $j < 16; $j++) {
                           $card_number .= rand(0, 9);
                  }

                  $cvv = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);

                  // Generate a random 6-digit BIN
                  $bin = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

                  // Generate expiry date: random between 1–3 years from today
                  $yearsToAdd = rand(1, 3);
                  $expiry_date = date('Y-m-d', strtotime("+$yearsToAdd years"));

                  $name = $input_name ?: $namesArray[array_rand($namesArray)];

                  $insert = mysqli_query($connection, "
        INSERT INTO cvv_cards 
        (card_number, cvv, bin, expiry_date, price, status, country, bank, name) 
        VALUES 
        ('$card_number', '$cvv', '$bin', '$expiry_date', '$price', '$status', '$country', '$bank', '$name')
    ");

                  if ($insert) {
                           $success++;
                  }
         }


         if ($success === $count) {
                  echo "<script>alert('✅ $count CVV card(s) generated successfully'); window.location.reload();</script>";
         } else {
                  echo "<script>alert('⚠️ Only $success out of $count CVV card(s) generated');</script>";
         }
}


?>


<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

         <meta charset="utf-8" />
         <title>User | <?php echo $sitename ?> - Admin & Dashboard Template</title>
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
                                                                        <h4 class="mb-sm-0">Generate CVV</h4>
                                                                        <div class="page-title-right">
                                                                                 <ol class="breadcrumb m-0">
                                                                                          <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                                                                          <li class="breadcrumb-item active">Generate Cvv</li>
                                                                                 </ol>
                                                                        </div>
                                                               </div>
                                                      </div>
                                             </div>
                                             <!-- End Page Title -->



                                             <!-- Table -->
                                             <div class="row">
                                                      <div class="col-xl-12">
                                                               <?php
                                                               

                                                               // Get the card_id from URL
                                                               $card_uuid = $_GET['card_id'] ?? '';
                                                               if (!$card_uuid) {
                                                                        die('<div class="alert alert-danger">Invalid Card ID</div>');
                                                               }

                                                               // Fetch card details
                                                               $query = mysqli_query(
                                                                        $connection,
                                                                        "SELECT * FROM cvv_cards WHERE uuid = '$card_uuid' LIMIT 1"
                                                               );

                                                               if (!$query || mysqli_num_rows($query) === 0) {
                                                                        die('<div class="alert alert-danger">Card not found.</div>');
                                                               }

                                                               $card = mysqli_fetch_assoc($query);

                                                               // Handle form submission
                                                               if (isset($_POST['save'])) {
                                                                        $card_number = $connection->real_escape_string($_POST['card_number']);
                                                                        $bin         = $connection->real_escape_string($_POST['bin']);
                                                                        $cvv         = $connection->real_escape_string($_POST['cvv']);
                                                                        $expiry_date = $connection->real_escape_string($_POST['expiry_date']);
                                                                        $card_type   = $connection->real_escape_string($_POST['card_type']);
                                                                        $price       = floatval($_POST['price']);
                                                                        $country     = $connection->real_escape_string($_POST['country']);
                                                                        $bank        = $connection->real_escape_string($_POST['bank']);
                                                                        $name        = $connection->real_escape_string($_POST['name']);
                                                                        $status      = $connection->real_escape_string($_POST['status']);

                                                                        $update = mysqli_query(
                                                                                 $connection,
                                                                                 "UPDATE cvv_cards SET 
            card_number = '$card_number',
            bin = '$bin',
            cvv = '$cvv',
            expiry_date = '$expiry_date',
            card_type = '$card_type',
            price = '$price',
            country = '$country',
            bank = '$bank',
            name = '$name',
            status = '$status'
        WHERE uuid = '$card_uuid'"
                                                                        );

                                                                        if ($update) {
                                                                                 echo '<div class="alert alert-success">Card updated successfully.</div>';
                                                                                 echo "<script>setTimeout(()=>{ window.location.href='../generate/?card_id=$card_uuid'},2000)</script>";
                                                                        } else {
                                                                                 echo '<div class="alert alert-danger">Failed to update card: ' . mysqli_error($connection) . '</div>';
                                                                        }
                                                               }
                                                               ?>

                                                               <div class="card">
                                                                        <div class="card-body">
                                                                                 <form method="POST">
                                                                                          <div class="row">
                                                                                                   <div class="col-lg-6 mb-3">
                                                                                                            <label class="form-label">Card Number</label>
                                                                                                            <input name="card_number" value="<?= htmlspecialchars($card['card_number']) ?>" type="text" class="form-control" required>
                                                                                                   </div>

                                                                                                   <div class="col-lg-6 mb-3">
                                                                                                            <label class="form-label">BIN</label>
                                                                                                            <input name="bin" value="<?= htmlspecialchars($card['bin']) ?>" type="text" class="form-control" required>
                                                                                                   </div>

                                                                                                   <div class="col-lg-6 mb-3">
                                                                                                            <label class="form-label">CVV</label>
                                                                                                            <input name="cvv" value="<?= htmlspecialchars($card['cvv']) ?>" type="text" class="form-control" required>
                                                                                                   </div>

                                                                                                   <div class="col-lg-6 mb-3">
                                                                                                            <label class="form-label">Expiry Date</label>
                                                                                                            <input name="expiry_date" value="<?= htmlspecialchars($card['expiry_date']) ?>" type="text" class="form-control" required>
                                                                                                   </div>

                                                                                                   <div class="col-lg-6 mb-3">
                                                                                                            <label class="form-label">Card Type</label>
                                                                                                            <input name="card_type" value="<?= htmlspecialchars($card['card_type']) ?>" type="text" class="form-control" required>
                                                                                                   </div>

                                                                                                   <div class="col-lg-6 mb-3">
                                                                                                            <label class="form-label">Price</label>
                                                                                                            <input name="price" value="<?= htmlspecialchars($card['price']) ?>" type="number" step="0.01" class="form-control" required>
                                                                                                   </div>

                                                                                                   <div class="col-lg-6 mb-3">
                                                                                                            <label class="form-label">Country</label>
                                                                                                            <input name="country" value="<?= htmlspecialchars($card['country']) ?>" type="text" class="form-control">
                                                                                                   </div>

                                                                                                   <div class="col-lg-6 mb-3">
                                                                                                            <label class="form-label">Bank</label>
                                                                                                            <input name="bank" value="<?= htmlspecialchars($card['bank']) ?>" type="text" class="form-control">
                                                                                                   </div>

                                                                                                   <div class="col-lg-6 mb-3">
                                                                                                            <label class="form-label">Name</label>
                                                                                                            <input name="name" value="<?= htmlspecialchars($card['name']) ?>" type="text" class="form-control">
                                                                                                   </div>

                                                                                                   <div class="col-lg-6 mb-3">
                                                                                                            <label class="form-label">Status</label>
                                                                                                            <select name="status" class="form-control">
                                                                                                                     <option value="available" <?= $card['status'] === 'available' ? 'selected' : '' ?>>Available</option>
                                                                                                                     <option value="sold" <?= $card['status'] === 'sold' ? 'selected' : '' ?>>Sold</option>
                                                                                                            </select>
                                                                                                   </div>

                                                                                                   <div class="col-lg-12">
                                                                                                            <button type="submit" name="save" class="btn btn-primary">Save Changes</button>
                                                                                                   </div>
                                                                                          </div>
                                                                                 </form>
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

         <!-- Modal -->
         <div class="modal fade" id="addpaymentModal" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content border-0">
                                    <div class="modal-header p-4 pb-0">
                                             <h5 class="modal-title" id="createMemberLabel">Generate CVV</h5>
                                             <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">


                                             <div class="modal-body p-4">
                                                      <form method="POST" class="needs-validation" novalidate>
                                                               <div class="mb-3">
                                                                        <label for="time" class="form-label">Number Generated CVV</label>
                                                                        <input type="number" value="2" name="time" class="form-control" placeholder="Number Generated CVV" required>
                                                               </div>

                                                               <div class="mb-3">
                                                                        <label for="status" class="form-label">Status</label>
                                                                        <select class="form-select" name="status" required>
                                                                                 <option value="" selected disabled>Select Status</option>
                                                                                 <option value="available">Available</option>
                                                                                 <option value="reserved">Reserved</option>
                                                                                 <option value="sold">Sold</option>
                                                                        </select>
                                                               </div>

                                                               <div class="mb-3">
                                                                        <label for="price" class="form-label">Price</label>
                                                                        <input type="number" step="0.01" min="0" name="price" class="form-control" placeholder="Enter price" required>
                                                               </div>

                                                               <div class="mb-3">
                                                                        <label for="country" class="form-label">Country</label>
                                                                        <input type="text" name="country" class="form-control" placeholder="Enter country" required>
                                                               </div>

                                                               <div class="mb-3">
                                                                        <label for="bank" class="form-label">Bank</label>
                                                                        <input type="text" name="bank" class="form-control" placeholder="Enter bank" required>
                                                               </div>

                                                               <div class="mb-3">
                                                                        <label for="name" class="form-label">Cardholder Name</label>
                                                                        <input type="text" name="name" class="form-control" placeholder="Leave blank to auto-generate">
                                                               </div>

                                                               <div class="hstack gap-2 justify-content-end">
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" name="generate" class="btn btn-success">Generate CVV Card</button>
                                                               </div>
                                                      </form>

                                             </div>

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

</html>