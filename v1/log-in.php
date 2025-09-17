<!DOCTYPE html>
<html lang="en">

<head>
<?php 
// $2y$10$pGp0yQAKW9FmP2wkdbfOkuQVwtEUn.NfxaJXBl.wWmgURpYY.DYsm
// $2y$10$qdg0CRfmItDp0EdmBy5QrOvC3UT.xwsoelTI4hNgmPtXLz.NnBQES


//echo password_hash('LjWawU', PASSWORD_DEFAULT);
//require('check_sess.php');

require("db-config/security.php");
require 'db-config/csrf.php';
$token = generate_csrf_token(); // defaults to 'csrf' key and 180 seconds
$_SESSION['csrf_token'] = $token;
if (isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header('Location: dashboard');
    exit();
}
    require('headers/head.php');
  ?>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <dqiv class="row">
                <div class=" col-2 start-left" style="margin-top:5%; background-image: url('assets/img/mssc.png'); background-repeat: no-repeat; background-size: contain;">
                    <!-- <img class="img-fluid img-responsive" src="assets/img/mssc.jpg"> -->
                </div>

                <div class="col-8">
                    <center> <span><br><br>
                        <H1 class="text text-primary uppercase" style="font-size:100px">FVMS</H1>
                        <h1 class="text text-primary uppercase"><a href="#">Ⓕoreign Ⓥessel Ⓜonitoring Ⓢystem</a><br><br></h1></span>
                    </center>
                </div>

                <div class=" col-2 start-left" style="margin-top:5%; background-image: url('assets/img/psc.png'); background-repeat: no-repeat; background-size: contain;">
                   <!-- <img class="img-fluid img-responsive" src="assets/img/psc.jpg">  -->
                </div>
        </dqiv>
            <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
					
                        <!-- Nested Row within Card Body -->
                        <div class="row">
						<div class="col-lg-6 d-flex justify-content-center">
						<img src='assets/img/phmap.png' style="max-height:500px; max-width:350px;" class='col-lg-6 d-lg-block'>
                        </div> 
                        <!--<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>-->
                            <div class="col-lg-6">
							
                                <div class="p-5">

                                    <div class="text-center">
										<h1 class="h3 mb-0 text-center text-gray-800">ENTER VALID CREDENTIALS</h1>
										<hr />
										
                                    </div>
                                    <form class="user" method="POST" action='log-in-auth.php'>
                                        <input type="hidden" name="csrf_token" value='<?=$token?>'>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" name='email' value='<?=(@$_SESSION['email-temp-holder']) ? $_SESSION['email-temp-holder'] : '' ?>' aria-describedby="emailHelp"
                                                placeholder="Enter Authorized Email">
                                        </div><br>
                                        <div class="form-group">
                                            <input type="password" name='password' class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Enter Password">
                                        </div><br>
                                        <input type='submit' name='submit' class="btn btn-primary btn-user btn-block col-md-12" value='LOGIN'>
                                            
                                        <!-- <hr>
                                        <a href="#l" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="#" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
										-->
                                    </form>
                                    <hr>
                                    <?php 

                                        if(@$_SESSION['error']){
                                            echo '<p class="text text-bg-danger text-center">'.$_SESSION['error'].'</p>';
                                        }
                                    ?>
                                    <div class="text-center">
                                        <a href="api/log_in"><i class="bi bi-person-bounding-box"> &nbsp Login Using Division/Center Account</i></a>
                                    </div>
                                    <div class="text-center">
                                        <a  href="#"><i class="bi bi-fingerprint"></i> Forgot Password</a>
                                    </div> 
                                    <!-- <div class="text-center">
                                        <a href="../attendance/Lecture/takeAttendance.php"><i class="bi bi-person-bounding-box"> &nbsp Login Using Face Recognition</i></a>
                                    </div>
                                    <div class="text-center">
                                        <a href="../qr/"><i class="bi bi-qr-code"> &nbsp Login Using QR Code</i></a>
                                    </div>
                                    <div class="text-center">
                                        <a  href="#"><i class="bi bi-person-plus"></i> Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <?php
   // require('links/footer-js.php');
   $_SESSION['error'] = '';
   $_SESSION['temp-email-holder'] = '';
  ?>
</body>

</html>