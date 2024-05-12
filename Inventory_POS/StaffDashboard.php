<?php
session_start(); 

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];

include('logic/dbCon.php');

$sql_access = "SELECT * FROM user_access WHERE code = $user_id";
$result_access = mysqli_query($conn, $sql_access);

$is_admin = false;
while ($row_access = mysqli_fetch_assoc($result_access)) {
    if ($row_access['access'] === 'UsersAccess_Admin') {
        $is_admin = true;
        break;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        form {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        form label {
            display: block;
            margin-bottom: 5px;
        }
        form input[type="text"],
        form input[type="number"],
        form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        form input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="#">Inventory</a></li>
            <li><a href="#">Report</a></li>
            <li><a href="#">POS</a></li>
        </ul>
    </nav>
	<?php if($is_admin): ?>
		<div class="container">
			<h2>Add New Product</h2>
			<form action="add_product.php" method="post">
				<label for="category">Category:</label>
				<select name="category" id="category">
					<?php
					$sql_categories = "SELECT category FROM inventory";
					$result_categories = mysqli_query($conn, $sql_categories);
					if (mysqli_num_rows($result_categories) > 0) {
						while ($row = mysqli_fetch_assoc($result_categories)) {
							echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
						}
					}
					?>       
				</select>
				<label for="product_name">Product Name:</label>
				<input type="text" id="product_name" name="product_name" required>
				<label for="price">Price:</label>
				<input type="number" id="price" name="price" min="0" step="0.01" required>
				<label for="quantity">Quantity:</label>
				<input type="number" id="quantity" name="quantity" min="0" required>
				<input type="submit" value="Add Product">
			</form>
		</div>
	<?php endif; ?>

</body>
</html>
