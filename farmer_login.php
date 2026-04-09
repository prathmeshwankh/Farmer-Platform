<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Farmer Login 🌾</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<style>
body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(rgba(0, 80, 0, 0.7), rgba(0, 80, 0, 0.7)),
              url('https://images.unsplash.com/photo-1500382017468-9049fed747ef');
  background-size: cover;
}

.login-box {
  background: white;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0 5px 25px rgba(0,0,0,0.3);
}
</style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">

  <div class="login-box col-md-5">

    <h3 class="text-center mb-4">🌾 Farmer Login</h3>

    <form action="farmer_login_process.php" method="POST" onsubmit="return validateLogin()">

      <input type="tel" name="phone" class="form-control mb-3" placeholder="Enter Mobile Number" required>

      <button class="btn btn-success w-100">Login</button>

    </form>

    <!-- Register link -->
    <p class="text-center mt-3">
      New farmer? <a href="farmer_register.php">Register here</a>
    </p>

    <a href="index.php" class="btn btn-outline-secondary w-100 mt-2">← Back to Home</a>

  </div>

</div>

<!-- JS -->
<script>
function validateLogin(){
  let phone = document.querySelector("input[name='phone']").value;

  if(phone.length !== 10 || isNaN(phone)){
    alert("Enter valid 10-digit mobile number");
    return false;
  }
  return true;
}
</script>

</body>
</html>
