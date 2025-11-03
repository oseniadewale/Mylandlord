<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyLandlord</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="Myfonts/fontawesome-free-6.6.0-web/css/all.min.css">
  <style>
    :root {
      --main-green: #1c961c;
    }
    body { font-family: 'Segoe UI', Tahoma, sans-serif; }
    header { background: var(--main-green); }
    header a { color: white; margin: 0 10px; }
    .hero {
      background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.3)), url("images/house12.jpg") center/cover no-repeat;
      height: 70vh;
      display: flex; align-items: center; justify-content: center;
      color: white; text-align: center;
    }
    .hero h1 { font-size: 2.5rem; font-weight: bold; }
    .indexbtn { background: var(--main-green); color: white; }
    .indexbtn:hover { background: #157715; }
    footer { background: var(--main-green); color: white; padding: 30px 0; }
  </style>
</head>
<body>
  <!-- HEADER -->
  <header class="py-2 sticky-top shadow-sm">
    
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color:#1c961c;">
  <div class="container">
    <!-- Brand -->
    <a class="navbar-brand d-flex align-items-center" href="index5.php">
      <img src="images/houseimg.png" alt="logo" height="40" class="me-2">
      <span>MyLandlord</span>
    </a>

    <!-- Hamburger toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="index5.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="landlord_login.php">Landlord</a></li>
        <li class="nav-item"><a class="nav-link" href="tenant_login.php">Tenant</a></li>
        <li class="nav-item"><a class="nav-link" href="nysc_login.php">NYSC</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Complaint</a></li>
        <li class="nav-item"><a class="nav-link" href="admin_login.php">Admin</a></li>
      </ul>
    </div>
  </div>
</nav>
    </div>
  </header>

  <!-- HERO + SEARCH -->
  <section class="hero">
    <div class="container">
      <h1>Connecting Home Owners with Tenants</h1>
      <p class="mb-4">Search houses quickly and directly.</p>
      <form action="process/show_index_process.php" method="POST" class="row g-2 bg-white p-3 rounded shadow-sm">
        <div class="col-md-3">
          <select name="state" class="form-select" required>
            <option value="">Select State</option>
            <option value="Lagos">Lagos</option>
            <option value="Oyo">Oyo</option>
            <!-- etc -->
          </select>
        </div>
        <div class="col-md-3">
          <select name="lga" class="form-select" required>
            <option value="">Select LGA</option>
          </select>
        </div>
        <div class="col-md-3">
          <select name="price" class="form-select" required>
            <option value="1">₦0 - ₦50,000</option>
            <option value="2">₦50,000 - ₦100,000</option>
            <!-- etc -->
          </select>
        </div>
        <div class="col-md-3">
          <select name="house_type" class="form-select" required>
            <option value="duplex">Duplex</option>
            <option value="flat">Flat</option>
            <!-- etc -->
          </select>
        </div>
        <div class="col-12 text-center mt-3">
          <button type="submit" class="btn indexbtn px-4">Search</button>
        </div>
      </form>
    </div>
  </section>

  <!-- QUICK LINKS -->
  <section class="py-5 text-center">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-6">
          <a href="landlord_signup_form3.php" class="btn btn-success btn-lg w-100">Landlord Signup</a>
        </div>
        <div class="col-md-6">
          <a href="tenant_signup_form3.php" class="btn btn-success btn-lg w-100">Tenant Signup</a>
        </div>
      </div>
    </div>
  </section>

  <!-- FEATURED HOUSES -->
  <section class="container my-5">
    <h3 class="text-center mb-4">Featured Houses</h3>
    <div class="row g-3">
      <div class="col-md-3"><img src="images/house2.jpg" class="img-fluid rounded"></div>
      <div class="col-md-3"><img src="images/house3.jpg" class="img-fluid rounded"></div>
      <div class="col-md-3"><img src="images/house4.jpg" class="img-fluid rounded"></div>
      <div class="col-md-3"><img src="images/house10.jpg" class="img-fluid rounded"></div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer id="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-5"><p>We connect tenants and landlords directly.</p></div>
        <div class="col-md-4">
          <h5>Socials</h5>
          <p><i class="fab fa-facebook me-2"></i>Facebook</p>
          <p><i class="fab fa-x-twitter me-2"></i>X</p>
          <p><i class="fab fa-instagram me-2"></i>Instagram</p>
        </div>
        <div class="col-md-3">
          <h5>Contact</h5>
          <p>Email: oseni246femi@gmail.com</p>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>
