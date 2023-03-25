<!DOCTYPE html>
<?php include 'session.php';?>
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
            <label>Full Name</label><br />
            <input id=name" type="text" /><br />
            <label>Street Address</label><br />
            <input type="text" /><br />
            <label id="city">City</label><br />
            <input type="text" /><br />
            <label>Country/Region</label><br />
             <select name="select" id="select">
              <option value="Singapore">Singapore</option>
              <option value="America">America</option>
              <option value="Malaysia">Malaysia</option>
              <option value="China">China</option>
              <option value="Africa">Africa</option>
              <option value="Indonesia">Indonesia</option>
              <option value="UK>UK</option>
             </select><br>
            <label>Phone</label><br />
            <input id="number" type="text" maxlength="12" value="+91" /><br />
          </div>
          <div id="right_part">
            <label>Person name buying for (Optional)</label><br />
            <input id="personname" type="text" /><br />
            <label>Zip Or Postal Code</label><br />
            <input id="zip" type="number" maxlength="6" /><br />
            <label>State/Province</label><br />
            <select name="state" id="state">
              <option value="Select">Select</option>
              <option value="Sabah">Sabah</option>
              <option value="Sawarawak">Sarawak</option>
              <option value="Selangor">Selangor</option>
              <option value="Kelatan">Kelantan</option>
              <option value="Pahang">Pahang</option>
              <option value="Terenganu">Terenganu</option>
              <option value="Penang">Penang</option>
              <option value="Negeri">Negeri</option>
              <option value="Johor">Johor</option>
              <option value="Perak">Perak</option>
              <option value="Perlis">Perlis</option>
              <option value="Kedah">Kedah</option>
              <option value="Odisa">Odisa</option>
              <option value="Malacca">Malacca</option>
              <option value="1">1</option>
              <option value="2">2</option>
            </select>
        
          </div>
        </form>

        <div class="payment_methods">
          <p class="forallheading">PAYMENT METHOD</p>
          <hr />
          <input onclick="payment()" name="card" type="radio" value="C"/>

          <label for="card">Pay with credit or debit card </label><span class="card_image"><img src="https://res.cloudinary.com/ssenseweb/image/upload/v1535478719/web/checkout/visa_borderless_v2.svg" ></span><span class="card_image"><img src="	https://res.cloudinary.com/ssenseweb/image/upload/v5478719/web/checkout/mastercard_borderless_v2.svg" ></span><br />

          <input onclick="payment()" id="rd1" name="card" type="radio" value="B" />

          <label for="paypal">Pay with PayPal</label><span class="card_image"><img src="https://res.cloudinary.com/ssenseweb/image/upload/v1535478719/web/checkout/paypal_borderless_v2.svg" ></span><br />

          <input onclick="payment()" id="rd2" name="card" type="radio"  value="A"/>

          <label for="other">Pay with Alipay</label><span class="card_image"><img src="	https://res.cloudinary.com/ssenseweb/image/upload/v1535478719/web/checkout/alipay_borderless_v2.svg" ></span>
        </div>


        <div id="card_details" class="forallheading">CARD DETAILS</div>
        <hr />
        <form id="card_data">
          <div class="card_left">
            <label class="special" class="card_all_label" for="card_no"
              >Card number</label
            ><br />
            <input
              class="special"
              class="card_all_input"
              type="text"
              maxlength="16"
              placeholder="1234 1234 1234 1234"
              inputmode="numeric"
            /><br />
            <label class="special" class="card_all_label" for="name"
              >Cardholder's name</label
            ><br />
            <input class="special" class="card_all_input" type="text" /><br />
            <input id="save_card" type="checkbox" />
            <label for="checkbox"
              >Save your card details for future purchase</label
            >
          </div>
          <div class="card_right">
            <label class="card_all_label" for="exp_date">Expiration date</label
            ><br />
            <input
         
              id="expiry"
              class="card_all_input"
              type="text"
              maxlength="4"
              placeholder="MM / YY"
              inputmode="numeric"
            /><br />
            <label class="card_all_label" for="Security code"
              >Security Code</label
            ><br />
            <input
            inputmode="numeric"
              id="cvv"
              class="card_all_input"
              type="text"
              placeholder="CVC"
              maxlength="3"
            /><br />
          </div>
        </form>

        <div class="billing">
          <!-- billing address code start here -->

          <p class="forall#payment_heading ing">BILLING ADDRESS</p>
          <hr />    
          <input id="shippingbox" type="checkbox" />
          <label class="shipping_address" for="billing"
            >Same as shipping address</label
          >
          <p id="addresschanger" class="shipping_address">
            Please complete your shipping address
          </p>

          <div id="dynamic_form">
          </div>
        </div>
       
      </div>


      <div id="right_page">
        <p  class="customization_for_right">ORDER SUMMARY - <span id="order_summary">(0) ITEMS</span></p>
        <hr />
        <div id="cart_product">
          <!-- append cart here -->
       <?php
                            show();
                            if ($result->num_rows > 0) :
                                foreach ($result as $cart) :
                                    ?>
                                    <tr>
                                        <td><?= $cart['Product_name'] ?></td>
                                        <td>><?= $cart['Cart_Qty']?></td>>
                                        <td>$ <?= $cart['Product_price'] * $cart['Cart_Qty'] ?></td>
                                    </tr>
                                    
                                <?php $total = $total + $cart['Product_price'] * $cart['Cart_Qty'] ?>
                            <?php endforeach; ?>
                                 <?php
                        endif;
                        ?>
                
          
        </div>
        <div>
          <p class="customization_for_right"id="country_region">COUNTRY/REGION: SINGAPORE / SGD</p>
          <hr />
          <div id="subtotal">
            <div>
              <p class="customization_for_right">Shipping total</p>
            </div>
            <div>
              <p id="shipping_total" class="customization_for_right">$0</p>
            </div>
          </div>
          <hr />
          <div id="total">
            <p  class="customization_for_right">Order total (SGD)</p>
            <p  id="total_order" class="customization_for_right"><?= $total?></p>
          </div>
          <div id="notice">
            <p class="customization_for_right">Important Notice</p>
            <p class="customization_for_right">
              Our Prices do not include Duty and VAT. Please consult your
              <p class="customization_for_right"> country/region's customs legislation for more information about
              potential additional charges.</p>
            </p>
            <input id="order_place" type="text" value="PLACE ORDER" />
          </div>
        </div>
      </div>
    </div>

   
    <hr  id="hr_last"/>
    <div id="assistant" >
      <a  href="www.google.com"></a>Live Assistance
    </div>
    
    <?php
        include "footer.inc.php";
        ?>
    
  </body>
  <script src="js/Payment.js"></script>
</html>

<?php

function show() {
    global $errorMsg, $success, $result;
    $user_id = 2;
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