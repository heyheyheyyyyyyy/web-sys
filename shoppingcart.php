<?php
include 'session.php';
?>

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
        
        <h1>Shopping Cart</h1>
        <?php if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) { ?>
            <p>Your cart is currently empty.</p>
        <?php } else { ?>
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
                <?php
                    if (empty($_SESSION['cart'])) {
                        echo '<p>Your shopping cart is empty.</p>';
                    } else {
                        $total_cost = 0;
                        foreach ($_SESSION['cart'] as $item) {
                            $product_id = $item['product_id'];
                            $product_name = $item['product_name'];
                            $product_price = $item['product_price'];
                            $quantity = $item['quantity'];
                            $total_price = $product_price * $quantity;
                            $total_cost += $total_price;
                    ?>
                            <tr>
                                <td><?= $product_name ?></td>
                                <td>$<?= number_format($product_price, 2) ?></td>
                                <td><?= $quantity ?></td>
                                <td>$<?= number_format($total_price, 2) ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                <tr>
                    <td colspan="3" align="right">Total:</td>
                    <td>$<?= number_format($total_cost, 2) ?></td>
                </tr>
            </table>
        <?php } ?>
        
        <a href="shoppage.php"><button>Continue Shopping</button></a>
        <a href="payment.php"><button>Checkout</button></a>

        <?php
        include "footer.inc.php";
        ?>
    </body>
</html>
