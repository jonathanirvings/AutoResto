<html>
<head>
    <?php
        ini_set("memory_limit",-1);
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
    <script>
        $(document).ready(function() {
        $("#datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
            });
        })
    </script>
</head>

<body class="homepage">
    <?php
        $restaurant = new Restaurant();
        $restaurantDetails = Restaurant::getRestaurantDetails($_GET['contact_no']);
        
        function bookTable($bookingDetails, $restaurant_contact_no) {
            $eventHandler = new EventHandler();
            
            $bookingDetails['restaurant_contact_no'] = $restaurant_contact_no;
            $bookingDetails['booker_ic_no'] = "G0325435L";
            
            $no_of_pax = $bookingDetails['pax'];
            unset($bookingDetails['pax']);
            unset($bookingDetails['book']);
            
            $eventHandler->book($bookingDetails, $no_of_pax);
            ?>
            <script>
                alert("Booking successful");
            </script>
            <?php
        }
    ?>
    <!-- Header -->
    <div id="header">
        <div class="container">
                
            <!-- Logo -->
            <div id="logo">
                <h1><a href="#">AutoResto</a></h1>
            </div>
            
            <!-- Nav -->
            <nav id="nav">
                <ul>
                   <li class="active"><a href="index.html">Homepage</a></li>
                    <li><a href="left-sidebar.html">Left Sidebar</a></li>
                    <li><a href="right-sidebar.html">Right Sidebar</a></li>
                    <li><a href="no-sidebar.html">No Sidebar</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- Header -->

    <!-- Banner -->
        <div id="banner">
            <div class="container">
            </div>
        </div>
    <!-- /Banner -->

     <!-- Main -->
        <div id="page">
            <div id="main" class="container">
                <div class="row">
                    <div class="15u">
                        <section>
                            <header>
                                <h2><?php echo $restaurantDetails['restaurant_name']?></h2>
                            </header>
                            <?php
                            
                            if (isset($_POST['date'])){
                                $date = $_POST['date'];
                            } else {
                                $date = date('Y-m-d', strtotime("today"));
                            }

                            if (isset($_POST['session'])){
                                $time = $_POST['session'];
                            } else {
                                $time = "lunch";
                            }

                            if (isset($_POST['pax'])){
                                $numberOfPax = $_POST['pax'];
                            } else {
                                $numberOfPax = 0;
                            }
                            
                            if (isset($_POST['date'])){
                                bookTable($_POST, $restaurantDetails['contact_no']);
                            }
                            ?>
                            <div id="bookingoptions" class="container">
                                <form method="post" action="">
                                    Date
                                    <?php
                                        echo "<input type=\"date\" id=\"datepicker\" name=\"date\" size=\"10\" value=\"$date\"/>";
                                    ?>

                                    Time <select name="session" id="session">
                                    <?php
                                        $states = array(
                                                    'lunch'=>"Lunch",
                                                    'dinner'=>"Dinner"
                                                    );
                                        foreach($states as $key=>$val) {
                                            echo ($key == $time)
                                                    ? "<option selected=\"selected\" value=\"$key\">$val</option>"
                                                    :"<option value=\"$key\">$val</option>";
                                        }
                                    ?>

                                    </select>
                                    No of pax. <input name="pax" id="pax" type="text" value="<?php echo $numberOfPax ?>"/>
                                    <input type="submit" name="book" id="book" class="button" value="Book"/>
                                </form>
                            </div>
                            <div id="restaurantdetails" class="container">
                                <div class="6u">
                                    <ul>
                                        <h3>Cuisine</h3>
                                        <p>
                                            <?php echo $restaurantDetails['cuisine']?>
                                        </p>

                                        <h3>Address</h3>
                                        <p class="subtitle">
                                            <?php echo $restaurantDetails['address']?>
                                        </p>

                                        <h3>Contact Number</h3>
                                        <p>
                                            <?php echo $restaurantDetails['contact_no']?>
                                        </p>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
    <!-- Main -->

    </div>
</body>
</html>