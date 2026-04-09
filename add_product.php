<?php
session_start();

if(!isset($_SESSION['farmer_name'])){
    header("Location: farmer_login.php");
    exit();
}
?>
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

<input type="text" name="farmer_name" class="form-control mb-3" placeholder="Farmer Name" required>

<input type="text" name="product_name" class="form-control mb-3" placeholder="Product Name" required>
<input type="text" name="unit" class="form-control mb-3" placeholder="Quantity (e.g. 1kg, 10kg, 1L)" required>
<select name="type" id="type" class="form-control mb-3" required onchange="showAI()">
  <option value="">Select Type</option>
  <option value="crop">Crop</option>
  <option value="waste">Agriculture Waste</option>
</select>

<input type="text" name="farmer_name" 
       value="<?php echo $_SESSION['farmer_name']; ?>" 
       readonly 
       class="form-control mb-3">

<textarea name="description" class="form-control mb-3" placeholder="Description"></textarea>

<!-- AI Suggestion Box -->
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
        aiBox.innerHTML = "🤖 AI Suggestion: This waste can be used for compost, biogas production, organic fertilizer, or animal feed.";
    } else {
        aiBox.classList.add("d-none");
    }
}
</script>

</body>
</html>
