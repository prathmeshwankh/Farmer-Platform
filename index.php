<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>FarmConnect 🌾</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link rel="stylesheet" href="style.css">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">🌾 FarmConnect</a>

    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#marketplace">Marketplace</a></li>
        <li class="nav-item"><a class="nav-link" href="#register">Join Farmer</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>

      </ul>
    </div>
  </div>
</nav>

<!-- HERO -->
<section id="home" class="bg-success text-white text-center p-5">
  <div class="container">
    <h1>FarmConnect 🌾</h1>
    <p>Direct Connection Between Farmers & Buyers</p>

    <a href="#marketplace" class="btn btn-light">Buy Products</a>
    <a href="#register" class="btn btn-outline-light">Join as Farmer</a>
  </div>
</section>

<!-- ABOUT -->
<section id="about" class="p-5">
  <div class="container text-center">
    <h2>About FarmConnect</h2>
    <p>
      FarmConnect is a platform that connects farmers directly with buyers. 
      It helps farmers sell their products at better prices and ensures 
      customers receive fresh and organic products.
    </p>
  </div>
</section>

<!-- MARKETPLACE -->
<section id="marketplace" class="p-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-4">Marketplace</h2>

    <div class="row g-4 text-center">

      <div class="col-md-3">
        <div class="card p-3">
          <h5>Tomatoes</h5>
          <p>Fresh & Organic</p>
          <h4>₹30/kg</h4>
          <button class="btn btn-success">Buy</button>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card p-3">
          <h5>Wheat</h5>
          <p>Premium Quality</p>
          <h4>₹25/kg</h4>
          <button class="btn btn-success">Buy</button>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card p-3">
          <h5>Milk</h5>
          <p>Direct from farm</p>
          <h4>₹60/L</h4>
          <button class="btn btn-success">Buy</button>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card p-3">
          <h5>Onions</h5>
          <p>Fresh harvest</p>
          <h4>₹20/kg</h4>
          <button class="btn btn-success">Buy</button>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- REGISTER -->
<section id="register" class="p-5">
  <div class="container">
    <h2 class="text-center mb-4">Join as Farmer</h2>

    <form action="register.php" method="POST" class="mx-auto" style="max-width:500px;">

      <input type="text" name="name" class="form-control mb-3" placeholder="Farmer Name" required>

      <input type="tel" name="phone" class="form-control mb-3" placeholder="Phone Number" required>

      <input type="text" name="location" class="form-control mb-3" placeholder="Farm Location" required>

      <select name="product" class="form-control mb-3" required>
        <option value="">Select Product</option>
        <option>Vegetables</option>
        <option>Fruits</option>
        <option>Grains</option>
        <option>Dairy</option>
      </select>

      <button class="btn btn-success w-100">Register</button>

    </form>
  </div>
</section>

<!-- FARMER COUNT -->
<section class="p-5 bg-light text-center">
  <div class="container">

    <h2>Platform Stats</h2>

    <?php
    include 'db.php';
    $count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM farmers"))['total'];
    ?>

    <h4 class="mt-3">🌾 Registered Farmers: <?php echo $count; ?></h4>

  </div>
</section>

<!-- GALLERY -->
<section class="p-5">
  <div class="container text-center">
    <h2>Gallery</h2>

    <div class="row g-4 mt-3">
      <div class="col-md-4">
        <img src="farm1.jpg" class="img-fluid">
      </div>
      <div class="col-md-4">
        <img src="farm2.jpg" class="img-fluid">
      </div>
      <div class="col-md-4">
        <img src="farm3.jpg" class="img-fluid">
      </div>
    </div>

  </div>
</section>

<!-- CONTACT -->
<section id="contact" class="p-5 bg-dark text-white">
  <div class="container text-center">

    <h2>Contact Us</h2>

    <p>📍 Nagpur, Maharashtra</p>
    <p>📞 +91 8805103954</p>
    <p>✉️ support@farmconnect.com</p>

  </div>
</section>

<!-- FOOTER -->
<footer class="text-center p-3 bg-black text-white">
  © 2026 FarmConnect 🌾 | All Rights Reserved
</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>