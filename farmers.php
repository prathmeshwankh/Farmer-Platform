<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Farmers List</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h2 class="text-center">Farmers Registered</h2>

<table class="table table-bordered text-center mt-4">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Location</th>
    <th>Product</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM farmers");

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['phone']}</td>
        <td>{$row['location']}</td>
        <td>{$row['product']}</td>
    </tr>";
}
?>

</table>

</body>
</html>
