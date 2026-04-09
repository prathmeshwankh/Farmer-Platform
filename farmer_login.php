<!DOCTYPE html>
<html>
<head>
<title>Farmer Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-5">

<div class="container" style="max-width:400px;">
  <h3 class="text-center mb-4">Farmer Login</h3>

  <form action="farmer_login_process.php" method="POST">
    <input type="text" name="phone" class="form-control mb-3" placeholder="Enter Mobile Number" required>
    <button class="btn btn-success w-100">Login</button>
  </form>
</div>

</body>
</html>
