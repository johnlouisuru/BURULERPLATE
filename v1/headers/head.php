  <?php 
  // This helps the sidebar to show who is active panel
    $who_is_active = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}";
    $path_parts = pathinfo($who_is_active);

    $folder = './';
    $filename = basename($path_parts['filename']);

    $filepath = $folder . $filename;
    $extension = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_EXTENSION);
    if($extension == "php"){
      header('Location: '.$filepath);
    }
    if (file_exists($filepath.'.php')) {
        //echo "File found: " . $filepath;
    } else {
        exit('File Not Found mah nigga!');
    }
    //echo $path_parts['filename'];
  ?>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?=$_ENV['PAGE_ICON']?>">
  <link rel="icon" type="image/png" href="<?=$_ENV['PAGE_ICON']?>">
  <title>
    <?=$_ENV['PAGE_HEADER']?>
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />



  