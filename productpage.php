<?php include 'session.php';?>
<html>
    <head>
        <?php
        include "head.inc.php";
        ?>
    </head>
    <body>
        <?php
        include "nav.inc.php";
        ?>
    </body>
</html>
<?php
// Get the product ID from the query parameter
$product_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($product_id <= 0) {
    // Invalid product ID
    die("Invalid product ID");
}

// Fetch the product from the database
$config = parse_ini_file('../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM Group2.Product WHERE Product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // Product not found
    die("Product not found");
}

$products = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!-- Display the product information -->
<h1><?= $products['Product_name'] ?></h1>
<img src="<?= $products['Product_image'] ?>">
<p><?= $products['Product_desc'] ?></p>
<p>Price: $<?= $products['Product_price'] ?></p>

<!-- Add to cart form -->
<form action="addtocart.php" method="post">
    <input type="hidden" name="product_id" value="<?= $product_id ?>">
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" value="1" min="1" max="10">
    <input type="submit" value="Add to cart">
</form>

<!-- View Cart button -->
<a href="shoppingcart.php"><button>View Cart</button></a>

<?php
        include "footer.inc.php";
        ?>
<?php
// Add product to cart
$_SESSION['cart'][] = array(
    'product_id' => $product_id,
    'product_name' => $product_name,
    'product_price' => $product_price
);
?>