<?php 
include 'db.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Farmers List</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
  background: #f5f7fa;
  font-family: 'Poppins', sans-serif;
}

.table {
  background: white;
  border-radius: 10px;
  overflow: hidden;
}

h2 {
  font-weight: 600;
  color: #2e7d32;
}

.btn-back {
  margin-bottom: 15px;
}
</style>

</head>

<body class="p-4">

<div class="container">

  <!-- Back Button -->
  <a href="index.php" class="btn btn-success btn-back">⬅ Back to Home</a>

  <h2 class="text-center mb-4">🌾 Farmers Registered</h2>
<input type="text" id="search" class="form-control mb-3" placeholder="Search farmer...">
  <div class="table-responsive">
    <table class="table table-bordered table-hover text-center">
      <thead class="table-success">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Location</th>
          <th>Product</th>
        </tr>
      </thead>

      <tbody>

<?php
$result = mysqli_query($conn, "SELECT * FROM farmers");

if(mysqli_num_rows($result) > 0){

  while ($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['phone']; ?></td>
      <td><?php echo $row['location']; ?></td>
      <td><?php echo $row['product']; ?></td>
    </tr>
<?php
  }

} else {
  echo "<tr><td colspan='5'>No farmers registered</td></tr>";
}
?>

      </tbody>
    </table>
  </div>

</div>
<script>
document.getElementById("search").addEventListener("keyup", function(){
  let val = this.value.toLowerCase();
  document.querySelectorAll("tbody tr").forEach(row=>{
    row.style.display = row.innerText.toLowerCase().includes(val) ? "" : "none";
  });
});
</script>
</body>
</html>

</table>

</body>
</html>
