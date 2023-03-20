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
            <span>CREATE AN ACCOUNT</span>
            <form>
                <label>Email address</label>
                <input type="email" id="email" placeholder="Enter Your Email Here">
                <label>Password</label>
                <input type="password" id="password" placeholder="Enter Your Password">
                <span>Signup for update and promotions</span>
                
                <label id="radio">
                    <input type="radio" id="N"  name="editList" value="yes"/>
                    <label>Yes</label>
                    <input type="radio" id="NT" name="editList" value="no thanks"/>
                    <label>No thanks</label>
                </label>


                <button id="button">CREATE AN ACCOUNT</button>

                <button id="button">BACK</button>
                <a href="Login.php">Sign In</a>

                <span>When you create an account, we collect your email and other personal data to enhance your shopping experience.
                </span>
                <span>To find out more, please visit our About us.</span>
            </form>

        </div>  
        <?php
        include "footer.inc.php";
        ?>
    </body>
      <script src="js/Signup.js"></script>

</html>





