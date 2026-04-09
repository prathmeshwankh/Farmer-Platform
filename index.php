<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>FarmConnect 🌾</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<!-- CSS -->
<link rel="stylesheet" href="style.css">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand text-white fw-bold" href="#">🌾 FarmConnect</a>

    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
  <span class="navbar-toggler-icon"></span>
</button>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link text-white" href="#home">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#about">About</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#marketplace">Marketplace</a></li>
        <!-- <li class="nav-item"><a class="nav-link" href="farmer_register.php">Join</a> -->
        <li class="nav-item"><a class="nav-link text-white" href="#contact">Contact</a></li>
       <li class="nav-item">
  <select id="lang" onchange="changeLang()" class="form-select">
    <option value="en">English</option>
    <option value="hi">Hindi</option>
    <option value="mr">Marathi</option>
  </select>
</li>
</select>
      </ul>
    </div>
  </div>
</nav>

<!-- HERO -->
<section id="home" class="hero d-flex align-items-center text-center text-white">
  <div class="container">
    <h1 class="display-4 fw-bold">FarmConnect 🌾</h1>
    <p class="lead">Direct Connection Between Farmers & Buyers</p>

    <a href="#marketplace" class="btn btn-light me-2">Explore</a>
    <a href="farmer_register.php" class="btn btn-outline-light">Join Now as a farmer</a>
  </div>
</section>

<!-- ABOUT -->
<section id="about" class="py-5 text-center">
  <div class="container">
    <h2>About Us</h2>
    <p class="text-muted">
FarmConnect is an innovative digital platform designed to bridge the gap between farmers and buyers by creating a direct and transparent marketplace. 
It eliminates the dependency on middlemen, ensuring that farmers receive fair prices for their produce while buyers get fresh and high-quality products at reasonable rates.

Our platform empowers farmers by giving them control over pricing, product listing, and customer interaction. 
By using modern technology, FarmConnect transforms traditional agricultural practices into a more efficient and profitable system.

Farmers can easily register on the platform, add their products, and reach a wide range of customers including individuals, retailers, hotels, and businesses. 
This increases their market reach and helps them grow economically.

For buyers, FarmConnect offers a simple and user-friendly interface where they can explore a variety of agricultural products, compare prices, and purchase directly from trusted farmers. 
This ensures transparency and builds trust between farmers and consumers.

One of the key features of FarmConnect is its smart agriculture support system. 
The platform includes AI-based suggestions for agricultural waste management, helping farmers utilize waste effectively for compost, biogas, and other eco-friendly purposes.

FarmConnect also supports digital payments through secure gateways such as UPI and other online methods, making transactions quick and reliable. 
Additionally, it provides order tracking and real-time updates to enhance user experience.
With FarmConnect, we are not just building a platform, but creating a strong ecosystem that supports farmers, benefits consumers, and contributes to the growth of the agricultural sector.
</p>
<section class="info-section">
  <div class="container">

    <div class="row g-4">

      <!-- FEATURES -->
      <div class="col-md-4">
        <div class="info-card">
          <h3>🌟 Features</h3>
          <ul>
            <li>Direct farmer-to-buyer marketplace</li>
            <li>Easy product listing</li>
            <li>Secure online payments</li>
            <li>AI waste suggestion system</li>
            <li>Search and filter products</li>
            <li>Cart and order management</li>
          </ul>
        </div>
      </div>

      <!-- WHY CHOOSE US -->
      <div class="col-md-4">
        <div class="info-card">
          <h3>💡 Why Choose Us</h3>
          <ul>
            <li>No middlemen involvement</li>
            <li>Fair pricing for farmers</li>
            <li>Fresh and organic products</li>
            <li>Transparent system</li>
            <li>Supports sustainable farming</li>
            <li>Easy and fast platform</li>
          </ul>
        </div>
      </div>

      <!-- FUTURE PLANS -->
      <div class="col-md-4">
        <div class="info-card">
          <h3>🚀 Future Plans</h3>
          <ul>
            <li>Mobile app development</li>
            <li>AI chatbot integration</li>
            <li>Weather alerts system</li>
            <li>Government scheme integration</li>
            <li>Farmer dashboard analytics</li>
            <li>Global market access</li>
          </ul>
        </div>
      </div>

    </div>

  </div>
</section>
  </div>
</section>
<div class="container mb-4">
  <input type="text" id="searchInput" class="form-control" placeholder="Search products...">
</div>
<!-- MARKETPLACE -->
<?php
include 'db.php';

$result = mysqli_query($conn, "SELECT * FROM products");

if(mysqli_num_rows($result) > 0){

  while($row = mysqli_fetch_assoc($result)){
?>

<div class="col-md-3">
  <div class="card p-4">

    <h5><?php echo $row['product_name']; ?></h5>

    <p class="text-muted"><?php echo $row['description']; ?></p>

    <h4 class="text-success">
      ₹<?php echo $row['price']; ?> / <?php echo $row['unit']; ?>
    </h4>

    <!-- BUY -->
    <form action="add_to_cart.php" method="POST">
      <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
      <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
      <button class="btn btn-success w-100 mb-2">Buy</button>
    </form>

    <!-- EDIT DELETE (ONLY IF LOGGED IN) -->
    <?php if(isset($_SESSION['phone'])){ ?>
      <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>

      <a href="delete_product.php?id=<?php echo $row['id']; ?>" 
         class="btn btn-danger btn-sm"
         onclick="return confirm('Are you sure?')">Delete</a>
    <?php } ?>

  </div>
</div>

<?php
  }

} else {
  echo "<p>No products available</p>";
}
?>

<!-- REGISTER -->
<!-- <section id="register" class="py-5">
  <div class="container">
    <h2 class="text-center mb-4">Join as Farmer</h2>

    <form action="register.php" method="POST" onsubmit="return validateForm()" class="mx-auto" style="max-width:500px;">
      <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>
      <input type="text" name="phone" class="form-control mb-3" placeholder="Phone" required>
      <input type="text" name="location" class="form-control mb-3" placeholder="Location" required>

      <select name="product" class="form-control mb-3">
        <option value="">Select Product</option>
        <option>Vegetables</option>
        <option>Fruits</option>
        <option>Grains</option>
        <option>Dairy</option>
      </select>

      <button class="btn btn-success w-100">Register</button>
    </form>
  </div>
</section> -->

<!-- CONTACT -->
<!-- <section id="contact" class="py-5 bg-dark text-white text-center">
  <div class="container">
    <h2>Contact</h2>
    <p>📍 Nagpur</p>
    <p>📞 +91 XXXXXXXX</p>
  </div>
</section> -->
<section class="py-5 bg-light">
  <div class="container text-center">
    <h2>Feedback</h2>

    <form action="feedback.php" method="POST" class="mx-auto" style="max-width:400px;">
      <input type="text" name="name" class="form-control mb-3" placeholder="Your Name" required>

      <textarea name="message" class="form-control mb-3" placeholder="Your Feedback" required></textarea>

      <button class="btn btn-success w-100">Submit Feedback</button>
    </form>
  </div>
</section>
<!-- FOOTER -->
<footer class="text-center bg-black text-white p-3">
  © 2026 FarmConnect 🌾
</footer>

<script src="script.js"></script>
<!-- Chat Button -->
<div id="chatBtn">💬</div>

<!-- Chat Box -->
<div id="chatBox">
  <div class="chat-header">AI Assistant 🤖</div>
  <div class="chat-body" id="chatBody"></div>

  <input type="text" id="userInput" placeholder="Ask about farming..." />
  <button onclick="sendMessage()">Send</button>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
