<html>
<head>
    <?php
    include "htmlHeaderLogin.php";
    ?>
</head>

<?php
    function showLoginForm()
    {
        ?>
        <form method="post" action="">
            IC Number
            <input type="text" id="ic_number" name="ic_number" size="10"/>
            Password
            <input type="password" id="password" name="password" size="10"/>
            <input type="submit" name="login" id="login" class="button" value="login"/>
            <p class="error_message" id="login_error"></p>
        </form>
        <?php
    }

?>

<body class="homepage">
    <!-- Header -->
    <div id="header">
           <div class="container">

               <!-- Logo -->
               <div id="logo">
                   <h1><a href="./">AutoResto</a></h1>
               </div>
           </div>
   </div>
    <nav id="nav">
                <ul>
                    <li class="signup"><a href="customer_new.php">Sign up</a></li>
                </ul>
            </nav>
    <!-- Header -->
    

     <!-- Main -->
        <div id="page">

       <!-- Main -->
            <div class="container">
                <div class="row">
                    <div class="15u">
                        <section>
                            Please login
                            <?php
                                $eventHandler = new EventHandler();
                                
                                if (isset($_POST["ic_number"]) && isset($_POST["password"]))
                                    {
                                        $ic_number = $_POST["ic_number"];
                                        $password = $_POST["password"];
                                        if ($eventHandler->login($ic_number,$password))
                                        {
                                            $_SESSION["ic_number"] = $ic_number;
                                            header('Location: index.php');
                                        } else
                                        {
                                            showLoginForm();
                                            ?>
                                            <script>
                                                $("#login_error").html("Invalid IC Number/Password");
                                                //alert("Invalid IC Number/Password");
                                            </script>
                                            <?php
                                        }
                                    } else
                                    {
                                        // remove all session variables
                                        session_unset(); 
                                        // destroy the session 
                                        session_destroy(); 
                                        showLoginForm();
                                    }
                            ?>
                        </section>
                    </div>
                </div>
            </div>
            <!-- Main -->
    </div>
</body>
</html>