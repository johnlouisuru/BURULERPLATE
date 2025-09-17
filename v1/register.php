<?php 
require("db-config/security.php");
// Check if the user is logged in
if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    // User is not logged in, redirect to login page
    header('Location: signin');
    exit();
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
                  <p class="text-sm mb-0 text-uppercase text-info">All Arrival </p>
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
              <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span>Data from [January - <?=$currentMonth?>]</p>
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
                    $percentage = ($total_current / $total_arrival) * 100;
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

        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-uppercase text-dark">Departure Vessel</p>
                  <?php 
                    $count_departure = 'SELECT * FROM vessel_logs WHERE tdod IS NOT NULL';
                    $total_departure = get_total_count($pdo, $count_departure);
                    $percentage = ($total_departure / $total_arrival) * 100;
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
              <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span>Updated Just Now</p>
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
                    $percentage = ($total_stranded / $total_arrival) * 100;
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
              <p class="mb-0 text-sm">Updated Just Now</p>
              <!-- <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder"><?=round($percentage, 0)?>% </span> of <?=$total_arrival?></p> -->
            </div>
          </div>
        </div>
        
      </div><!-- WHOLE ROW PARA SA MGA CARDS -->
          <hr />
      
          
     

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
   
    

    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        
        datasets: [{
          label: "Views",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#43A047",
          data: [
          <?php 
             $days_label = '';
             $days = [
                0 => "Mon",
                1 => "Tue",
                2 => "Wed",
                3 => "Thu",
                4 => "Fri",
                5 => "Sat",
                6 => "Sun"
            ];
              for($week = 0; $week<=6; $week++){
                  if(date('w') == $week){
                      $days_label .= '"TODAY",';
                  }
                  else {
                      $days_label .= '"'.$days[$week].'",';
                  }
              
                $query_arriving = "SELECT * FROM vessel_logs 
                                  WHERE tdoa BETWEEN DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)
                                  AND DATE_ADD(CURDATE(), INTERVAL (6 - WEEKDAY(CURDATE())) DAY) 
                                  AND MONTH(tdoa) = MONTH(CURDATE())
                                  AND YEAR(tdoa)  = YEAR(CURDATE())
                                  AND WEEKDAY(tdoa) = $week
                ";
                  //$query_arriving = "SELECT * FROM vessel_logs WHERE WEEK(tdoa, $week) = WEEK(NOW()) AND MONTH(tdoa) = MONTH(NOW()) AND YEAR(tdoa) = YEAR(NOW())";
                      $query_returned = secure_query_no_params($pdo, $query_arriving);
                      $total_fetched_arriving = $query_returned->rowCount();
                        echo $total_fetched_arriving.',';
                      
              }
            ?>
          ],
          barThickness: 'flex'
        }, ],
        labels: [<?=$days_label?>]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: '#e5e5e5'
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 10,
              font: {
                size: 14,
                lineHeight: 2
              },
              color: "#737373"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#737373',
              padding: 10,
              font: {
                size: 14,
                lineHeight: 2
              },
            }
          },
        },
      },
    });




    var ctx2 = document.getElementById("chart-line").getContext("2d");

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Vessel",
          tension: 0,
          borderWidth: 2,
          pointRadius: 3,
          pointBackgroundColor: "green",
          pointBorderColor: "transparent",
          borderColor: "blue",
          backgroundColor: "transparent",
          fill: true,
          data: [
            <?php 
          $year = 2025;
            for ($i = 1; $i <= 12; $i++) { 
              
              $query_arriving = "SELECT * FROM vessel_logs WHERE YEAR(tdoa)=$year AND MONTH(tdoa)=$i";
              $query_returned = secure_query_no_params($pdo, $query_arriving);
              $total_fetched_arriving = $query_returned->rowCount();
              echo $total_fetched_arriving.',';
            }
          ?>
          ],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          },
          tooltip: {
            callbacks: {
              title: function(context) {
                const fullMonths = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                return fullMonths[context[0].dataIndex];
              }
            }
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [4, 4],
              color: '#e5e5e5'
            },
            ticks: {
              display: true,
              color: '#737373',
              padding: 10,
              font: {
                size: 12,
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#737373',
              padding: 10,
              font: {
                size: 12,
                lineHeight: 2
              },
            }
          },
        },
      },
    });

   
  </script>
  
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