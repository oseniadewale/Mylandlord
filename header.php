<?php $base_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo isset($page_title) ? $page_title : 'Index Page'; ?></title>

  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="Myfonts/fontawesome-free-6.6.0-web/css/all.css">
  <link rel="stylesheet" href="Myfonts/fontawesome-free-6.6.0-web/css/fontawesome.css">

  <?php if (isset($page_styles)) echo $page_styles; ?>

  <style>
    body {
      margin: 0;
      padding: 0;
    }

    header {
      background-color: green;
      padding: 10px 30px;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
    }

    .myheader {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .brand {
      display: flex;
      align-items: center;
    }

    .brand img {
      height: 40px;
      margin-right: 10px;
    }

    .brand h1 {
      color: white;
      font-size: 24px;
      margin: 0;
    }

    nav a {
      color: white;
      margin:  15px;
      text-decoration: none;
      font-weight: 500;
    }

    nav a:hover {
      color: #ccc;
    }
  </style>
</head>

<body>
  <header>
    <div class="container-fluid myheader">
      <div class="brand">
        <img src="<?php echo $base_url; ?>/images/houseimg.png" alt="Logo" />
        <h1>MyLandlord</h1>
      </div>

      <nav>
       
        <a href="<?php echo $base_url; ?>/index.php">Home Page</a>
        <a href="<?php echo $base_url; ?>/landlord_login.php">Landlord</a>
        <a href="<?php echo $base_url; ?>/tenant_login.php">Tenant</a>
        <a style=' flex-wrap: wrap;' href="<?php echo $base_url; ?>/nysc_login.php">NYSC</a>

        <a style=' flex-wrap: wrap;' href="#mycontact">Complaint</a>
                <a style=' flex-wrap: wrap;' href="<?php echo $base_url; ?>/about.php"> About</a>
        <a style=' flex-wrap: wrap;' href="<?php echo $base_url; ?>/admin_login.php"> Admin</a>
      </nav>
    </div>
  </header>

  <div style="margin-top: 60px;"></div> <!-- push body content below fixed header -->
