<?php
session_start();

// ✅ Secure login check
if(!isset($_SESSION['phone'])){
    header("Location: farmer_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

<div class="container">
<h2 class="text-center">Add Product 🌾</h2>

<form action="add_product_process.php" method="POST">

<!-- ✅ Hidden Farmer Data -->
<input type="hidden" name="farmer_name" value="<?php echo $_SESSION['farmer_name']; ?>">
<input type="hidden" name="farmer_phone" value="<?php echo $_SESSION['phone']; ?>">

<!-- Show farmer info (readonly) -->
<input type="text" class="form-control mb-3"
       value="<?php echo $_SESSION['farmer_name']; ?>" readonly>

<input type="text" class="form-control mb-3"
       value="<?php echo $_SESSION['phone']; ?>" readonly>

<!-- Product Name -->
<input type="text" name="product_name" class="form-control mb-3" placeholder="Product Name" required>

<!-- Price -->
<input type="number" name="price" class="form-control mb-3" placeholder="Price (₹ per unit)" required>

<!-- Unit -->
<input type="text" name="unit" class="form-control mb-3" placeholder="Quantity (e.g. 1kg, 10kg, 1L)" required>

<!-- Type -->
<select name="type" id="type" class="form-control mb-3" required onchange="showAI()">
  <option value="">Select Type</option>
  <option value="crop">Crop</option>
  <option value="waste">Agriculture Waste</option>
</select>

<!-- Description -->
<textarea name="description" class="form-control mb-3" placeholder="Description"></textarea>

<!-- AI Suggestion -->
<div id="aiBox" class="alert alert-success d-none"></div>

<button class="btn btn-success w-100">Submit Product</button>

</form>
</div>

<script>
function showAI(){
    let type = document.getElementById("type").value;
    let aiBox = document.getElementById("aiBox");

    if(type === "waste"){
        aiBox.classList.remove("d-none");
        aiBox.innerHTML = "🤖 AI Suggestion: This waste can be used for compost, biogas, organic fertilizer, or animal feed.";
    } else {
        aiBox.classList.add("d-none");
    }
}
</script>

</body>
</html>