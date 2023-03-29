<?php

include 'session.php';
header("location: index.php");
?>
<?php

// If the request method is post, process the search query
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $error_msg = "";

    // Basic field checking
    if (empty($_POST["Product_name"])) {
        echo "<p>Please provide product name!</p>";
        exit;
    } else if (empty($_POST["Product_category"])) {
        echo "<p>Please provide product brand!</p>";
        exit;
    } else if (empty($_POST["Product_qty"])) {
        echo "<p>Please provide quantity!</p>";
        exit;
    } else if (empty($_POST["Product_price"])) {
        echo "<p>Please provide product price!</p>";
        exit;
    } else if (empty($_POST["Product_desc"])) {
        echo "<p>Please provide product description!</p>";
        exit;
    }

    // Connect to DB
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);
    echo "connected";

    // Check connection    
    if ($conn->connect_error) {
        $error_msg = "Connection failed: " . $conn->connect_error;
        echo "<h1>Oops!</h4>";
        echo "<h4>The following input errors were detected:</h4>";
        echo "<p> {$error_msg} </p>";
        echo "<a class='btn btn-warning' href='index.php'>Return to homepage</a>";
        exit;
    } else {

        $product_category = $_POST["Product_category"];

        $product_name = sanitize_input($_POST["Product_name"]);
        $product_desc = sanitize_input($_POST["Product_desc"]);

        // Cast form data to appropriate data type for DB operation
        $product_quantity = (int) $_POST["Product_qty"];
        $product_price = (float) $_POST["Product_price"];

        // Process create in DB
        $success = process_create($conn, $product_name, $product_desc, $product_category, $product_quantity, $product_price);

        // Basic checking
        if (!$success) {
            echo "<p> {$error_msg} </p>";
            exit;
        }

        // Else redirect to the home page
        else {
            header("index.php");
            exit;
        }
    }
}

// Else if user tries to GET this page or other forms of access
else {
    echo "<h4>Please submit your request using the admin form instead of other forms of access!</h4>";
    echo "<a class='btn btn-warning' href='index.php'>Return to Home page</a><btn>";
}

if ($success) {
    process_create();
    echo" <h2> You have added a product!</h2>";
    echo "<a href='admin_page.php' class='btn btn-danger'> Return to admin Page</a>";
} else {
    echo "<h2>Oops!</h2>";
    echo "<h4> The following errors were detected: </h4>";
    echo "<p>" . $errorMsg . "</p>";
    echo "<a href='admin_page.php' class='btn btn-danger'> Return to admin Page</a>";
}

/* This function creates a new entry in the product table
 *
 * Function takes in 7 arguments: 
 *      1. Database connection object
 *      2. Product name (string)
 *      3. Product description (string)
 *      4. Product category (string)
 *      5. Product quantity (int)
 *      6. Product price (float)
 * 
 */

function process_create($conn, $product_name, $product_desc, $product_category, $product_quantity, $product_price) {

    // Get the global error_msg variable
    global $error_msg;

    // get the latest increment
    $conn->query("ANALYZE TABLE Group2.Product");

    // Get the newest inventory ID.
    $stmt = $conn->prepare("SELECT AUTO_INCREMENT
                                                FROM information_schema.TABLES
                                                WHERE TABLE_SCHEMA = 'Group2'
                                                AND TABLE_NAME = 'Product'");

    $stmt->execute();

    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    $image_path = "images/product_imgs/{$rows[0]["AUTO_INCREMENT"]}.jpg";

    $stmt->close();

    // Prepare the insert statement
    $stmt = $conn->prepare("INSERT INTO Group2.Product(Product_name, Product_desc, Product_category, Product_qty, Product_price, Product_image) "
            . "VALUES (?, ?, ?, ?, ?, ?)");

    // Bind & execute the query statement:
    $stmt->bind_param("sssids", $product_name, $product_desc, $product_category, $product_quantity, $product_price, $image_path);

    if (!$stmt->execute()) {
        $error_msg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        $stmt->close();
        return false;
    }

    $stmt->close();

    // Get the image uploaded
    $image = $_FILES['Product_image'] ?? null;

    // If there is an image uploaded
    if ($image && $image["tmp_name"]) {

        // upload a new image in images/products/inventory_id.jpg as well
        move_uploaded_file($image["tmp_name"], $image_path);
        echo "File successfully uploaded";
    }

    // Close the DB connection
    $conn->close();

    return true;
}

// Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
