<?php include 'session.php';?>
<html>
    <head>
        <?php
        include "head.inc.php";
        include "nav.inc.php";
        ?>
        <link rel="stylesheet" href="css/main.css">
        <style>
            .team-member {
                display: inline-block;
                text-align: center;
                margin: 20px;
            }

            .team-member img {
                width: 200px;
                height: 200px;
                border-radius: 50%;
                object-fit: cover;
                object-position: center;
            }

            .team-member h3 {
                margin-top: 10px;
                font-size: 20px;
            }

            .team-member p {
                margin-top: 5px;
                font-style: italic;
            }
        </style>
    </head>
    <body>
        <main class="container">
            <div class="about-section">
                <br>
                <h1>About Us</h1>
                <br>
                <section>
                    <h2>Our Mission</h2>
                    <p>At AquaBottle, we believe in promoting a healthy and sustainable lifestyle. 
                        Our mission is to provide high-quality and eco-friendly water bottles that 
                        encourage people to stay hydrated and reduce their carbon footprint.</p>
                </section>
            </div>
            <br>
            <section>
                <h2>Our Products</h2>
                <p>We offer a wide range of water bottles in different sizes, colors, and materials 
                    to suit everyone's needs. Our bottles are made of BPA-free and food-grade stainless 
                    steel, glass, and silicone, ensuring that your water stays fresh and clean without 
                    any harmful chemicals. Our bottles are also leak-proof and durable, making them perfect for 
                    outdoor activities, sports, and travel.</p>
            </section>
            <br>
            <section>
                <h2>Our Team</h2>
                <div class="team-member">
                    <img src="images/glass1.jpg" alt="John Doe">
                    <h3>John Doe</h3>
                    <p>CEO</p>
                </div>
                <div class="team-member">
                    <img src="images/glass1.jpg" alt="Jane Smith">
                    <h3>Jane Smith</h3>
                    <p>COO</p>
                </div>
                <div class="team-member">
                    <img src="images/glass1.jpg" alt="Bob Johnson">
                    <h3>Bob Johnson</h3>
                    <p>CTO</p>
                </div>
            </section>
            <br>
            <h2>Office Location</h2>
            <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3034.5205451688286!2d-73.98568158458197!3d40.74844007932989!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2595a5b7d5f5b%3A0x5b5c5d748a9f5d2c!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1622539867158!5m2!1sen!2sus" width="1200" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </main>
        <?php
        include "footer.inc.php";
        ?>
    </body> 
</html>