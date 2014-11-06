<html>
<head>
    <?php
        ini_set("memory_limit",-1);
        session_start();
        include "constant.php";
        include "dbhandler.php";
        include "dboperation.php";
        include "booking.php";
        include "restaurant.php";
        include "customer.php";
        include "eventhandler.php";
    ?>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700italic,400,300,700' rel='stylesheet' type='text/css'>
    <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-panels.min.js"></script>
    <script src="js/init.js"></script>
    <noscript>
        <link rel="stylesheet" href="css/skel-noscript.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-desktop.css" />
    </noscript>
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
    <!-- Header -->
    

     <!-- Main -->
        <div id="page">

       <!-- Main -->
            <div id="main" class="container">
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