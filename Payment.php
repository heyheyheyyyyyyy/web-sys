<?php
include 'session.php';
if (!isset($_SESSION['User_id'])) {
    header("location: index.php");
}
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location: index.php");
}
?>
<html lang="en">
    <head>
        <?php
        include "head.inc.php";
        ?>
    </head>
    <body>
        <?php
        include "nav.inc.php";
        ?>
        <div id="main_container">
            <div id="left_page">
                <p>CHECKOUT</p>
                <p>SHIPPING ADDRESS</p>
                <hr />
                <form class="shipping_details">
                    <div id="left_part">
                        <label>First Name</label><br />
                        <input id=fname" type="text" /><br />
                        <label>Address</label><br />
                        <input type="text" /><br />
                        <label>Country/Region</label><br />
                        <select name="select" id="select">
                            <option value="Singapore">Singapore</option>
                        </select>
                    </div>
                    <div id="right_part">
                        <label>Last Name</label><br />
                        <input id=lname" type="text" /><br />
                        <label>Postal Code</label><br />
                        <input id="zip" type="number" maxlength="6" /><br />
                    </div>
                </form>
                <br><br>
                <br>
                <div class="payment_methods">
                    <p class="forallheading">PAYMENT METHOD</p>
                    <hr />
                    <input name="card" type="radio" checked/>
                    <label for="card">Pay with credit or debit card </label>
                    <span class="card_image">
                        <img src="https://res.cloudinary.com/ssenseweb/image/upload/v1535478719/web/checkout/visa_borderless_v2.svg" >
                    </span>
                    <span class="card_image">
                        <img src="https://res.cloudinary.com/ssenseweb/image/upload/v5478719/web/checkout/mastercard_borderless_v2.svg" >
                    </span>
                </div>

                <div id="card_details" class="forallheading">CARD DETAILS</div>
                <hr />
                <form id="card_data">
                    <div class="card_left">
                        <label class="special" class="card_all_label" for="card_no">
                            Card number
                        </label>
                        <br />
                        <input
                            class="special"
                            class="card_all_input"
                            type="text"
                            maxlength="16"
                            placeholder="1234 1234 1234 1234"
                            inputmode="numeric"
                            id="cardnumber"
                            /><br />
                        <label class="special" class="card_all_label" for="name"
                               >Cardholder's name</label
                        ><br />
                        <input class="special" class="card_all_input" type="text" /><br />
                    </div>
                    <div class="card_right">
                        <label class="card_all_label" for="exp_date">Expiration date</label
                        ><br />
                        <input
                            class="card_all_input"
                            type="text"
                            maxlength="4"
                            placeholder="MM / YY"
                            inputmode="numeric"

                            id="cardnumber"
                            /><br />
                        <label class="card_all_label" for="Security code"
                               >Security Code</label
                        ><br />
                        <input
                            inputmode="numeric"
                            class="card_all_input"
                            type="password"
                            placeholder="CVC"
                            maxlength="3"
                            id="cardnumber"</>
                    </div>
                </form>
            </div>


            <div id="right_page">
                <p  class="customization_for_right">ORDER SUMMARY</p>
                <hr />
                <div id="cart_product" class="container">
                    <div class="row">
                        <div class="col-sm">
                            <p><b>Product Name</b></p>
                        </div>
                        <div class="col-sm">
                            <p><b>Quantity</b></p>
                        </div>
                        <div class="col-sm">
                            <p><b>Price</b></p>
                        </div>
                    </div>
                    <!-- append cart here -->
                    <?php
                    show();
                    if ($result->num_rows > 0) :
                        foreach ($result as $cart) :
                            ?>
                            <div class="row">
                                <div class="col-sm">
                                    <p><?= $cart['Product_name'] ?></p>
                                </div>
                                <div class="col-sm">
                                    <p><?= $cart['Cart_Qty'] ?></p>
                                </div>
                                <div class="col-sm">
                                    <p>$ <?= $cart['Product_price'] * $cart['Cart_Qty'] ?></p>
                                </div>

                            </div>
                            <?php $total = $total + $cart['Product_price'] * $cart['Cart_Qty'] ?>
                        <?php endforeach; ?>
                        <?php
                    endif;
                    ?>

                </div>
                <div>
                    <p class="customization_for_right"id="country_region">COUNTRY/REGION: SINGAPORE / SGD</p>
                    <hr />
                    <div id="total">
                        <p  class="customization_for_right">Order total (SGD)</p>
                        <p  id="total_order" class="customization_for_right">$ <?= $total ?></p>
                    </div>
                    <br>
                    <hr />
                    <div id="notice">
                        <p class="customization_for_right">Important Notice</p>
                        <p class="customization_for_right">
                            Our Prices do not include Duty and VAT. Please consult your
                        <p class="customization_for_right"> country/region's customs legislation for more information about
                            potential additional charges.</p>
                        <br>
                        <form action ='process_purchase.php' method='POST'>
                            <button class="btn btn-success" type="submit" name="purchase">Purchase</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include "footer.inc.php";
        ?>

    </body>
</html>

<?php

function show() {
    global $errorMsg, $success, $result;
    $user_id = $_SESSION['User_id'];
// Create database connection.
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);
// Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
// Prepare the statement:
        $stmt = $conn->prepare("SELECT A.Product_id, A.Cart_id, A.Cart_Qty, B.Product_name, B.Product_price FROM Group2.Cart as A "
                . "inner join Group2.Product as B where A.Product_id = B.Product_id AND A.User_id = ?");
        $stmt->bind_param("i", $user_id);
// Execute the query statement:
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    }
    $conn->close();
}
