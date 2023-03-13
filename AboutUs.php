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
        <main class="container">
            <div class="about-section">
                <h1 style="text-align:center">About Us Page</h1>
                <p style="text-align:center">Some text about who we are and what we do.</p>
                <p style="text-align:center">Resize the browser window to see that this page is responsive by the way.</p>
            </div>

            <h2 style="text-align:center">Our Team</h2>
            <div class="row">
                <div class="column">
                    <div class="card">
                        <img src="images/smiley-face.png" alt="Jane" style="width:100%">
                        <div class="container">
                            <h2>Jane Doe</h2>
                            <p class="title">CEO & Founder</p>
                            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                            <p>jane@example.com</p>
                            <p><button class="button"><a href="contactus.php">Contact</a></button></p>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="card">
                        <img src="images/depress.png" alt="John" style="width:100%">
                        <div class="container">
                            <h2>Mike Ross</h2>
                            <p class="title">Art Director</p>
                            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                            <p>mike@example.com</p>
                            <p><button class="button"><a href="contactus.php">Contact</a></button></p>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="card">
                        <img src="images/depress.png" alt="John" style="width:100%">
                        <div class="container">
                            <h2>John Doe</h2>
                            <p class="title">Designer</p>
                            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                            <p>john@example.com</p>
                            <p><button class="button"><a href="contactus.php">Contact</a></button></p>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <img src="images/crying.png" alt="Bob" style="width:100%">
                        <div class="container">
                            <h2>Bob Smith</h2>
                            <p class="title">Sale Manager</p>
                            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                            <p>Bob@example.com</p>
                            <p><button class="button"><a href="contactus.php">Contact</a></button></p>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-bottom: 50px;"></div> <!empty space!>
            <h2  style="text-align:center">Our Location</h2>

           <div class="embed-responsive embed-responsive-1by1 p-4">
                                <iframe title="Location" class="responsive-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.665252371279!2d103.84664861589684!3d1.377523398995323!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da16e96db0a1ab%3A0x3d0be54fbbd6e1cd!2sSingapore%20Institute%20of%20Technology%20(SIT%40NYP)!5e0!3m2!1sen!2ssg!4v1606633072921!5m2!1sen!2ssg" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                </div>
        </main>
        <?php
        include "footer.inc.php";
        ?>
    </body> 
</html>