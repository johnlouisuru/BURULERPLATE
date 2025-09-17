<!DOCTYPE html>
<html lang="en">
<?php 
require("db-config/security.php");
// Check if the user is logged in
if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    // User is not logged in, redirect to login page
    header('Location: signin');
    exit();
}
$sql = "SELECT * FROM pscd";
$decrypt_pid = secure_query_no_params($pdo, $sql);
    if($decrypt_pid){
        while($getting_center_details = $decrypt_pid->fetch()){
            if(md5($getting_center_details['pscc_id']) == $_GET['cid'] && md5($getting_center_details['id']) == $_GET['did']){
                $cid = $getting_center_details['pscc_id'];
                $did = $getting_center_details['id'];
                $cname = $getting_center_details['pscd_name'];
            }
            
        }
    }
    if(!isset($cid)){
        header('Location: dashboard');
    }

?>

<head>

<!-- For the Datatables -->
 <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <!-- Vendor CSS Files -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
   
    <link href=" https://cdn.datatables.net/2.3.3/css/dataTables.bootstrap4.css" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
<!-- End of Datatables -->

<!-- Bootstrap5 Sources -->
<!-- Vendor JS Files -->
  <script src="assets-b5/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets-b5/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets-b5/vendor/chart.js/chart.umd.js"></script>
  <script src="assets-b5/vendor/echarts/echarts.min.js"></script>
  <script src="assets-b5/vendor/quill/quill.min.js"></script>
  <script src="assets-b5/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets-b5/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets-b5/vendor/php-email-form/validate.js"></script>

<?php
require __DIR__ . '/headers/head.php'; //Included dito outside links and local styles
?>

</head>

<body class="g-sidenav-show bg-gray-100">

    <!-- SIDE BAR -->
<?php
    require __DIR__ . '/bars/sidebar.php'; //Side bar ito
?>
    <!-- SIDE BAR -->
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- NAVBAR -->
    <?php
        require __DIR__ . '/bars/topbar.php'; //Topbar yung kasama Profile Icon
    ?>
    <!-- END NAVBAR -->
     
    <div class="container-fluid py-2">
         <div class="row"><!-- WHOLE ROW PARA SA MGA CARDS -->
    
              <!-- Toast with Placements -->

              <!-- Start of PSCC NAMES  -->
            <div class="card mb-12 col-12">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                      <?php 
                        $sql = "select * from pscc WHERE id=$cid";
                        $div_details = secure_query_no_params($pdo, $sql);
                          if($div_details){
                            $civname = $div_details->fetch(); 
                            $centerss = $civname['pscc_name'];
                          }
                          else {
                              $centerss = '';
                          }
                      ?>
                    <h5 class="card-title text-center pb-0 fs-4"><?=$centerss?></h5>
                    <p class="text-center small"><?=$cname?></b></p>
                  </div>

                  <div class="table-responsive">
              <table class="table datatable table-striped">
                <thead>
                  <tr>
                    <th>Name & Type of Vessel</th>
                    <th>Flag State</th>
                    <th>Company</th>
                    <th>ATA</th>
                    <th>Location</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql = "select * from vessel_logs WHERE cid=$cid AND did=$did";
                    $all_arrived = secure_query_no_params($pdo, $sql);
                            if($all_arrived){ 
                              while($arrived = $all_arrived->fetch()){ 
                        
                         $tov = "SELECT tov
                                      FROM vessel 
                                      WHERE id=".$arrived['tov']."";
                              $fetch_tov = get_type_of_vessel($pdo, $tov);
                                if($fetch_tov){
                                  foreach($fetch_tov as $row){
                                    $tov_name_display = $row['tov'];
                                  }
                                }
                      ?>
                      <tr>
                      <td><?=$arrived['name']?> / <?=$tov_name_display?></td>
                      <td><?=$arrived['flag_state']?></td>
                      <td><?=$arrived['company']?></td>
                      <td> <?=date("d M Y H:i", strtotime($arrived['tdoa']))?>H</td>
                      <td><?=$arrived['location']?></td>
                      <td><?=$arrived['status']?> <br> <?=$arrived['remarks']?> <br> <?=$arrived['inspection_status']?></td>
                      </tr>
                  <?php
                        }
                      }
                      else { ?>
                        <tr>
                            <td colspan="6"><center><b>No Entries Found</b></center></td>
                        </tr>
                      <?php  
                      }
                  ?>
                </tbody>
              </table>
              </div>
                <div class="row">
                    
                </div>
                      
                </div>
              </div>
            <!-- End of PSCC NAMES  -->
                
            
            </div><!--END  WHOLE ROW PARA SA MGA CARDS -->
          
      <!-- FOOTER AREA -->
    <?php 
        require __DIR__ . '/footer/footer.php';
    ?>
  <!-- FOOTER AREA -->

      <!-- Dito start ng BODY iwan palagi yang Contrainer-fuid-->
    </div>
  </main>

  <!-- DARK / LIGHT MODE -->
    <?php 
        require __DIR__ . '/footer/modes.php';
    ?>
  <!-- DARK / LIGHT MODE -->
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.2.0"></script>

  <script src="assets/js/main.js"></script>
</body>

</html>