<?php
require_once 'dbcon.php';

// Get the selected category from the dropdown
$category = $_POST['category'];

// Get the current page number
$page = $_POST['page'];

// Set the number of products to display per page
$limit = 10;

// Calculate the offset for pagination
$offset = ($page - 1) * $limit;

// Query to get products from the selected category
$query = "SELECT * FROM products WHERE category = '$category' LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);

// Display products
while ($row = mysqli_fetch_assoc($result)) {
  echo "<div class='product'>";
  echo "<h2>" . $row['Product_Name'] . "</h2>";
  echo "<p>" . $row['Product_Specs'] . "</p>";
  echo "<img src='" . $row['Product_Picture'] . "' alt='" . $row['Product_Name'] . "'>";
  echo "<p>Price: $" . $row['Price'] . "</p>";
  echo "<button class='add-to-cart' data-product-id='" . $row['id'] . "'>Add to Cart</button>";
  echo "</div>";
}

// Get the total number of products in the category
$query = "SELECT COUNT(*) as total FROM products WHERE category = '$category'";
$result = mysqli_query($conn, $query);
$total = mysqli_fetch_assoc($result)['total'];

// Display pagination links
echo "<div class='pagination'>";
for ($i = 1; $i <= ceil($total / $limit); $i++) {
  echo "<a href='#' class='page-link' data-page='" . $i . "'>" . $i . "</a>";
}
echo "</div>";

mysqli_close($conn);
?>