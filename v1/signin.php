<?php 
require("db-config/security.php");
require 'db-config/csrf.php';
$token = generate_csrf_token(); // defaults to 'csrf' key and 180 seconds
$_SESSION['csrf_token'] = $token;
if(@$_SESSION['is_admin'] == 1) {
    // User is not logged in, redirect to login page
    header('Location: dashboard');
    exit();
}
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?=$_ENV['PAGE_ICON']?>">
  <title>
    MSSC-FVMS ADMIN PORTAL
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>

<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-6 mx-auto">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
              <ul class="navbar-nav d-lg-flex d-none">
                <li class="nav-item">
                  <img src="<?=$_ENV['PAGE_ICON']?>" class="" width="50" height="50" alt="main_logo">
                </li>
              </ul>
        <div class="container-fluid pe-0">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="#">
              Welcome to <?=$_ENV['PAGE_HEADER']?>
            </a>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('assets/img/cover.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Login Authorized ADMIN Account</h4>
                  <div class="row mt-3">
                    <div class="col-2 text-center ms-auto">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-facebook text-white text-lg"></i>
                      </a>
                    </div>
                    <div class="col-2 text-center px-1">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-github text-white text-lg"></i>
                      </a>
                    </div>
                    <div class="col-2 text-center me-auto">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-google text-white text-lg"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action='log-in-auth'>
                                        <input type="hidden" name="csrf_token" value='<?=$token?>'>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Enter Authorized Email</label>
                    <input type="email" name='email' class="form-control" value='<?=(@$_SESSION['temp-email-holder']) ? $_SESSION['temp-email-holder'] : '' ?>'>
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name='password' class="form-control">
                  </div>
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                    <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                  </div>
                  <?php 
                        if(@$_SESSION['error']){ ?>
                    <div class="input-group input-group-outline mb-3">
                        <span class='text text-danger text-bg-dark w-100 text-center'>Error: <b><?=@$_SESSION['error']?></b></span>
                    </div>
                       <?php 
                        }
                  ?>
                  <div class="text-center">
                    <button type="submit" name='submit' class="btn bg-gradient-info w-100 my-4 mb-2">Sign in</button>
                  </div>
                  <div class="text-center">
                    <a href='../api/' class="btn bg-gradient-primary w-100 my-4 mb-2">Login as Employee Account</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
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
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>
<?php 
$_SESSION['error'] = ''; 
$_SESSION['temp-email-holder'] = '';
?>
</html>