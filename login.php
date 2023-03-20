<html>
    <head>
        <?php
        include "head.inc.php";
        ?>
                    <link rel="stylesheet" href="css/Signup.css">

    </head>
    <body>
        <?php
        include "nav.inc.php";
        ?>
         <div id="form">
        <form>
            <span>WELCOME BACK!</span>
            <label>Email address</label>
            <input type="email" id="email" placeholder="Enter Your Email Here">
            <label>Password</label>
            <input type="password" id="password" placeholder="Password">
            <button id="button">CONTINUE</button>
            <a href="">Forgot your password?</a>
            <a href="Signup.php">New Here?</a>
        </form>
    </div>
        </main>
        <?php
        include "footer.inc.php";
        ?>
    </body>
</html>