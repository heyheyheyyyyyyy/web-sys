<?php include 'session.php';?>
<?php
//session_start();

// Check if the product ID and quantity are set
if (!isset($_POST['product_id'], $_POST['quantity'])) {
    // Redirect the user back to the product page
    header('Location: product.php?id=' . $_POST['product_id']);
    exit;
}

// Sanitize and validate the product ID and quantity
$product_id = (int) $_POST['product_id'];
$quantity = (int) $_POST['quantity'];

if ($product_id <= 0 || $quantity <= 0 || $quantity > 10) {
    // Invalid product ID or quantity
    // Redirect the user back to the product page
    header('Location: product.php?id=' . $_POST['product_id']);
    exit;
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
    // Redirect the user back to the product page
    header('Location: product.php?id=' . $_POST['product_id']);
    exit;
}

$product = $result->fetch_assoc();

$stmt->close();
$conn->close();

// Add the product to the cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$cart_item = array(
    'product_id' => $product_id,
    'product_name' => $product['Product_name'],
    'product_price' => $product['Product_price'],
    'quantity' => $quantity
);

$_SESSION['cart'][] = $cart_item;

// Redirect the user to the shopping cart page
header('Location: productpage.php?id=' . $_POST['product_id']);
exit;
?>
