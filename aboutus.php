<?php include 'session.php'; ?>
<html>
    <head>
        <?php
        include "head.inc.php";
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
            .location {
                display: inline-block;
                width: 30%;
                padding: 10px;
                box-sizing: border-box;
            }
            .location img {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                object-fit: cover;
                object-position: center;
            }
        </style>
    </head>
    <body>
        <?php
        include "nav.inc.php";
        ?>
        <main class="container">
            <div class="about-section">
                <h1>About Us</h1>
                <br>
                <section>
                    <h2>Our Mission</h2>
                    <p>At Quench, we believe in promoting a healthy and sustainable lifestyle. 
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
                <div>
                    <div class="team-member">
                        <a href="mailto:ChungShing@gmail.com">
                            <p>
                                <img src="images/profile.jpg" alt="Chung Shing"> 

                            <h3>Chung Shing</h3>
                           
                            </p>
                        </a>
                        <h4>Sales Executive</h4>
                    </div>
                    <div class="team-member">
                        <a href="mailto:XinEr@gmail.com">
                            <p>
                                <img src="images/profile.jpg" alt="Xin Er">
                            <h3>Xin Er</h3>
                            
                            </p>
                        </a>
                        <h4>Operations Manager</h4>
                    </div>
                    <div class="team-member">
                        <a href="mailto:Julene@gmail.com">
                            <p>
                                <img src="images/profile.jpg" alt="Julene">
                            <h3>Julene</h3>
                            </p>  
                        </a>
                        <h4>Marketing Coordinator</h4>
                    </div>
                    <div class="team-member">
                        <a href="mailto:Linus@gmail.com">
                            <p>
                                <img src="images/profile.jpg" alt="Linus">
                            <h3>Linus</h3>
                            </p>
                        </a>
                        <h4>Customer Service</h4>
                    </div>
                    <div class="team-member">
                        <a href="mailto:Pei Sheng@gmail.com">
                            <p>
                                <img src="images/profile.jpg" alt="Pei Sheng">
                            <h3>Pei Sheng</h3>
                            </p>
                        </a>
                        <h4>Product Designer</h4>
                    </div>
                </div>

            </section>
            <br>
            <div>
            <div class="location">
                <img src="images/location.png" alt="Office Location">
                <h3>Office Location</h3>
                <p> 5th Floor East Tower Singapore Institute of Technology (SIT@NYP)
                    172 Ang Mo Kio Ave 8, Singapore 567739
                </p>
            </div>
             <div class="location">
                <img src="images/location.png" alt="Factory Location">
                <h3>Factory Location</h3>
                <p> 50 Kallang Pudding Rd, #03-03 Golden Wheel Industrial Building, Singapore 349326
                </p>
            </div>
            </div>
            <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.6653940525916!2d103.84659831523616!3d1.3774387618686943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da16e96db0a1ab%3A0x3d0be54fbbd6e1cd!2sSingapore%20Institute%20of%20Technology%20(SIT%40NYP)!5e0!3m2!1sen!2ssg!4v1679979375992!5m2!1sen!2ssg" 
                        width="1200" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </main>
        <?php
        include "footer.inc.php";
        ?>
    </body> 
</html>