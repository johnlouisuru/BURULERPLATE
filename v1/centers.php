<?php 
require("db-config/security.php");
// Check if the user is logged in
if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    // User is not logged in, redirect to login page
    header('Location: signin');
    exit();
}
$sql = "SELECT * FROM pscc";
$decrypt_pid = secure_query_no_params($pdo, $sql);
    if($decrypt_pid){
        while($getting_center_details = $decrypt_pid->fetch()){
            if(md5($getting_center_details['id']) === $_GET['pid']){
                $cid = $getting_center_details['id'];
                $cname = $getting_center_details['pscc_name'];
            }
            
        }
    }
    if(!isset($cid)){
        header('Location: dashboard');
    }

?>
<!DOCTYPE html>
<html lang="en">

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
    <!-- Dito start ng BODY iwan palagi yang Contrainer-fuid-->
      <!-- <a class="weatherwidget-io" href="https://forecast7.com/en/12d88121d77/philippines/" data-label_1="PH" data-label_2="MSSC Weather" data-theme="original" >PHILIPPINES MSSC Weather</a>
        <script>
        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
        </script> -->

      <div class="row"><!-- WHOLE ROW PARA SA MGA CARDS -->
        <hr />
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <?php 
                    $currentMonth = date("F"); // current month name (e.g., August)
                  ?>
                  <p class="text-sm mb-0 text-uppercase text-info">All Arrival [<?=date('Y')?>]</p>
                  <?php 
                  
                    $count_arrival = 'SELECT * FROM vessel_logs';
                    $total_arrival = get_total_count($pdo, $count_arrival);
                  ?>
                  <h4 class="mb-0"><?=$total_arrival?></h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-light shadow-dark shadow text-center border-radius-lg">
                  <!-- <i class="material-symbols-rounded opacity-10">weekend</i> -->
                   <img src="<?=$_ENV['PAGE_ICON']?>" class="" width="50" height="50" alt="main_logo">
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
              <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span>Data from [01 August - Today]</p>
            </div>
          </div>
        </div>
        
            <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-uppercase text-dark">Departure Vessel</p>
                  <?php 
                    $count_departure = 'SELECT * FROM vessel_logs WHERE tdod IS NOT NULL';
                    $total_departure = get_total_count($pdo, $count_departure);
                    if($total_departure>=1){
                        $percentage = ($total_departure / $total_arrival) * 100;
                    } else {
                        $percentage = 0;
                    }
                  ?>
                  <h4 class="mb-0"><?=$total_departure?></h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-light shadow-dark shadow text-center border-radius-lg">
                  <img src="assets/img/underway.png" class="" width="50" height="50" alt="main_logo">
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"><?=round($percentage, 0)?>% </span>of <?=$total_arrival?></p>
              <!--<p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span>Updated Just Now</p>-->
            </div>
          </div>
        </div>
        
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-warning text-uppercase">Current Vessel</p>
                  <?php 
                    $count_current = 'SELECT * FROM vessel_logs WHERE tdod IS NULL';
                    $total_current = get_total_count($pdo, $count_current);
                    if($total_current>=1){
                        $percentage = ($total_current / $total_arrival) * 100;
                    } else {
                        $percentage = 0;
                    }
                    
                  ?>
                  <h4 class="mb-0"><?=$total_current?></h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-light shadow-dark shadow text-center border-radius-lg">
                  <!-- <i class="material-symbols-rounded opacity-10">weekend</i> -->
                   <img src="assets/img/vessel.png" class="" width="50" height="50" alt="main_logo">
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
              <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"><?=round($percentage, 0)?>% </span>of <?=$total_arrival?></p>
            </div>
          </div>
        </div>

        

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-uppercase text-success">Inspected Vessel</p>
                  <?php 
                    $count_all_vessel = 'SELECT * FROM vessel_logs WHERE remarks LIKE "%Inspected%"';
                    $total_stranded = get_total_count($pdo, $count_all_vessel);
                    if($total_stranded>=1){
                        $percentage = ($total_stranded / $total_arrival) * 100;
                    } else {
                        $percentage = 0;
                    }
                  ?>
                  <h4 class="mb-0"><?=$total_stranded?></h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-light shadow-dark shadow text-center border-radius-lg">
                  <!-- <span class="material-symbols-rounded opacity-10" width="150" height="150" alt="main_logo">library_add_check</span> -->
                   <img src="https://png.pngtree.com/png-vector/20250401/ourmid/pngtree-illustration-of-paper-with-check-mark-png-image_15917517.png" class="" width="50" height="50" alt="main_logo">
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span>Data from [01 August - Today]</p>
              <!--<p class="mb-0 text-sm">This Month [<?=date('F')?>]</p>-->
              <!-- <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder"><?=round($percentage, 0)?>% </span> of <?=$total_arrival?></p> -->
            </div>
          </div>
        </div>
        
      </div><!-- WHOLE ROW PARA SA MGA CARDS -->
          <hr />

          <div class="card mb-12 col-12">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-2 pb-1">
                        <h6 class="text-white text-uppercase ps-3">PSC CENTER - <?=$cname?></h6>
                    </div>
                    </div>
                <div class="card-body">

                  <div class="pt-1 pb-1">
                    <p class="text-center small">List of all Divisions Under this Center</p>
                  </div>

                  <div class="table-responsive">
              <table class="table datatable table-striped text-sm">
                <thead>
                  <tr>
                    <th>Division</th>
                    <th>Total Arrival</th>
                    <th>Total Departure</th>
                    <th>Total Current</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 

                  //echo $db;
                  $temp_total_arrival = 0;
                  $temp_total_departure = 0;
                  $sql = "select * from pscd WHERE pscc_id = $cid AND is_active='1'";
                    $get_all_div = secure_query_no_params($pdo, $sql);
                            if($get_all_div){ 
                              while($all_div = $get_all_div->fetch()){ 
                                $total_arrival = 0;
                                $total_departed = 0;
                            ?>
                      <tr>
                      <td><a href="details.php?cid=<?=md5($all_div['pscc_id'])?>&did=<?=md5($all_div['id'])?>"><?=$all_div['pscd_name']?></a></td>
                      <?php 
                          $sql = "select COUNT(id) AS total_arrived from vessel_logs WHERE cid=$cid AND did=$all_div[id]";
                          $arrival = secure_query_no_params($pdo, $sql);
                          if($arrival){
                            $result4 = $arrival->fetch(); 
                            $total_arrival = $result4['total_arrived'];
                          }
                          else {
                            $total_arrival = 0;
                          } 
                          
                      ?>
                      <td><?=$total_arrival?></td>
                      <?php 
                          $sql = "select COUNT(id) AS total_departed from vessel_logs WHERE cid=$cid AND did=$all_div[id] AND tdod IS NOT NULL";
                          $departed = secure_query_no_params($pdo, $sql);
                          if($departed){
                            $result5 = $departed->fetch(); 
                            $total_departed = $result5['total_departed'];
                          }
                          else {
                            $total_departed = 0;
                          } 
                          
                      ?>
                        <td><?=$total_departed?></td>
                      <?php 
                          $sql = "select COUNT(id) AS total_arrived from vessel_logs WHERE cid=$cid AND did=$all_div[id] AND tdod IS NULL";
                          $arrival = secure_query_no_params($pdo, $sql);
                          if($arrival){
                            $result4 = $arrival->fetch(); 
                            $total_current = $result4['total_arrived'];
                          }
                          else {
                            $total_current = 0;
                          } 
                          
                      ?>
                        <td><?=$total_current?></td>
                        
                        <td></td>
                      </tr>
                  <?php
                  $temp_total_arrival += $total_arrival;
                  $temp_total_departure += $total_departed;
                  $temp_total_current += $total_current;
                        }
                      }
                      else { ?>
                        <tr>
                            <td colspan="5"><center><b>No Entries Found</b></center></td>
                        </tr>
                      <?php  
                      }
                  ?>
                  <tr class='bg-gradient-dark'> 
                    <td colspan='5'></td>
                  </tr>
                  <tr class='table table-info'>
                    <td><i>OVERALL</i></td>
                    <td><?=$temp_total_arrival?></td>
                    <td><?=$temp_total_departure?></td>
                    <td><?=$temp_total_current?></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
              </div>

                </div>
              </div>
      
          
     

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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.2.0"></script>

  <script src="assets/js/main.js"></script>
</body>

</html>