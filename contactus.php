<?php include 'session.php'; ?>
<html lang="en">
    <head>
        <?php
        include "head.inc.php";
        include "nav.inc.php";
        ?>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body id="contactus">
        <main>
            <div class="container">
                <h1>Contact Us</h1>
                <img src="images/customer-service.jpg" alt="" role="presentation">
                <p>CUSTOMIZED SERVICES <br> 
                <div><h2>
                        At Quench, <br><br>we take pride in offering an extensive variety of water bottles at competitive prices, without compromising on quality. </h2>
                </div>
                <div><h2>
                        Our team is dedicated to providing specialized and superior service, with quick response times and fast delivery.</h2>
                </div>
                <br>
                <div>
                    If you are interested in any of our products or would like to discuss a custom order, please feel free to contact us.
                </div>
                <div>
                    ​​​​​​​●  We provide all kinds of bottles: Eco-friendly, Glass, Thermal, Steel and more.
                </div>
                <div>
                    ​​​​​​​●  Friendly prices with quick delivery time. Best deal in town.
                </div>
                <div>
                    ●  All products are cruelty-free.
                </div>
                </p>
                <br>
                <form action="contact.php" method="post">
                    <div class="elem-group">
                        <label for="name">Name:</label> <br>
                        <input type="text" id="name" name="visitor_name" placeholder="John Doe" pattern="[A-Za-z\s]{3,20}" required><br>
                    </div>
                    <div class="elem-group">
                        <label for="email">E-mail:</label><br>
                        <input type="email" id="email" name="visitor_email" placeholder="john.doe@email.com" required><br>
                    </div>
                    <div class="elem-group">
                        <label for="department">Department:</label><br>
                        <select id="department" name="concerned_department" required>
                            <option value="">Select a Department</option>
                            <option value="product issue">Product Issue</option>
                            <option value="billing">Billing</option>
                            <option value="technical-support">Technical Support</option>
                        </select>
                    </div>
                    <div class="elem-group">
                        <label for="short-problem">Short description on problem:</label>
                        <br>
                        <input type="text" id="short-problem" name="email_title" required placeholder="Unable to Reset my Password" pattern=".{0,30}"><br>
                    </div>
                    <div class="elem-group">
                        <label for="long_problem">Describe the problem in detail:</label><br>
                        
                        <textarea id="long_problem" name="visitor_message" required pattern=".{0,100}"></textarea><br>
                    </div>
                    <button class='btn btn-primary' type="submit">Submit Form</button>
                </form>
            </div>
        </main>
        <?php
        include "footer.inc.php";
        ?>
    </body>
</html>