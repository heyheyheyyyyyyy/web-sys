<?php include 'session.php'; ?>
<html lang="en">
    <head>
        <?php
        include "head.inc.php";
        ?>
        <link rel="stylesheet" href="css/main.css">
        <style>
            .elem-group {
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <?php
        include "nav.inc.php";
        ?>
        <main>
            <div class="container">
                <h1>Contact Us</h1>
                <img src="images/customer-service.jpg">
                <p>CUSTOMIZED SERVICES
                <div>
At Quench, we take pride in offering an extensive variety of water bottles at competitive prices, without compromising on quality. 
                </div>
                <div>
Our team is dedicated to providing specialized and superior service, with quick response times and fast delivery.
                </div>
                <div>
If you are interested in any of our products or would like to discuss a custom order, please feel free to contact us.
                </div>
                <div>
​​​​​​​●  We provide all kinds of bottles: Eco-friendly, Glass, Thermal, Steel and more.
                </div>
                <div>
​​​​​​​●  Price: Good price,quick delivery time, goods quality ,good service are always our goal.
</div>
                <div>
●  Application: All products are used in shops, restaurant,  school, GYM and shopping mall, etc.
                </div>
                <form action="contact.php" method="post">
                    <div class="elem-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="visitor_name" placeholder="John Doe" pattern="[A-Za-z\s]{3,20}" required>
                    </div>
                    <div class="elem-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="visitor_email" placeholder="john.doe@email.com" required>
                    </div>
                    <div class="elem-group">
                        <label for="department">Department:</label>
                        <select id="department" name="concerned_department" required>
                            <option value="">Select a Department</option>
                            <option value="billing">Billing</option>
                            <option value="marketing">Marketing</option>
                            <option value="technical-support">Technical Support</option>
                        </select>
                    </div>
                    <div class="elem-group">
                        <label for="short-problem">Short description on problem:</label>
                        <br>
                        <input type="text" id="short-problem" name="email_title" required placeholder="Unable to Reset my Password" pattern="[A-Za-z0-9\s]{8,60}">
                    </div>
                    <div class="elem-group">
                        <label for="long_problem">Describe the problem in detail:</label>
                        <br>
                        <textarea id="long_problem" name="visitor_message" required></textarea>
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