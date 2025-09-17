<?php 
  require("db-config/security.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<?php
  require('headers/head.php'); //Change the content of this depends on your UI Template. This sample is a Bootstrap5

?>

</head>

<body class="g-sidenav-show  bg-gray-100">

    <!-- SIDE BAR -->
<?php
   // require __DIR__ . '/bars/sidebar.php'; //Side bar ito
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


      <div class="row"><!-- WHOLE ROW PARA SA MGA CARDS -->

      <?php 
            $get_all_brps = "SELECT * FROM brp";
            $all_brps = secure_query_no_params($pdo, $get_all_brps);
                                if($all_brps){ 
                                  while($brps = $all_brps->fetch()){ 
      ?>
            <!-- Card Template 12-->
                    <div class="col-lg-3 col-md-3 mt-1 mb-1">
                        <div class="card">
                            <div class="card-body"> <!-- INSIDE BLANK CARD -->
                                <script type="text/javascript">
                                    // Map appearance
                                    var width="100%";         // width in pixels or percentage
                                    var height="100";         // height in pixels
                                    var latitude="0.00";      // center latitude (decimal degrees)
                                    var longitude="0.00";     // center longitude (decimal degrees)
                                    var zoom="10";             // initial zoom (between 3 and 18)
                                    var names=false;          // always show ship names (defaults to false)

                                    // Single ship tracking
                                    var mmsi="<?=$brps['mmsi']?>";     // display latest position (by MMSI)
                                    var imo="<?=$brps['imo']?>";        // display latest position (by IMO, overrides MMSI)
                                    var show_track=true;     // display track line (last 24 hours)

                                    // Fleet tracking
                                    var fleet="e48ab3d80a0e2a9bf28930f2dd08800c"; // your personal Fleet key (displayed in your User Profile)
                                    var fleet_name="Patrol Vessel"; // display particular fleet from your fleet list
                                    var fleet_timespan="1440"; // maximum age in minutes of the displayed ship positions
                                </script>
                                <script type="text/javascript" src="assets/js/aismap.js"></script>
                            
                        
                            </div> <!-- INSIDE BLANK CARD -->
                        </div>
                    </div>
            <!-- Card Template -->
             <?php 
                            }
                        }
             ?>

           

      </div><!-- WHOLE ROW PARA SA MGA CARDS -->

      
      
      
      

      <!-- FOOTER AREA -->
    <?php 
        //require __DIR__ . '/footer/footer.php';
    ?>
  <!-- FOOTER AREA -->

      <!-- Dito start ng BODY iwan palagi yang Contrainer-fuid-->
    </div>
  </main>

  <!-- DARK / LIGHT MODE -->
    <?php 
        //require __DIR__ . '/footer/modes.php';
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
  <script>

$(window).on("load", function() {
    // Handler for .ready() called.
    setTimeout(function() {
    // Code to execute after 5 seconds
        $('#embed-header').hide();
    }, 5000);
    
    // alert($('.brand').attr('href', 'https://www.google.com'));
    //     $(".brand").each(function() {
    //         var href = $(this).attr("href")
    //         $(this).attr("href", href.substr(0, href.length - 2) + newLanguage);
    //         alert(href);
    //     });
});
</script>
</body>

</html>