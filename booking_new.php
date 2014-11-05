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
        $eventHandler = new eventhandler();
        if (isset($_GET['contact_no'])){
            $contact_no = $_GET['contact_no'];
        } else {
            $contact_no = "";
        }
        $restaurantDetails = $eventHandler->getRestaurantDetails($contact_no);

        function addBooking($bookingPost, $restaurant_contact_no) {
            $eventHandler = new EventHandler();
            
            $bookingDetails = [];
            $bookingDetails['restaurant_contact_no'] = $restaurant_contact_no;
            $bookingDetails['booker_ic_no'] = "G0587235M";
            $bookingDetails['date'] = $bookingPost['date'];
            $bookingDetails['session'] = $bookingPost['session'];
            $no_of_pax = $bookingPost['pax'];
            
            $eventHandler->book($bookingDetails, $no_of_pax);
            
            ?>
            <script>
                alert("Booking successful");
            </script>
            <?php
        }
        
        $arrQuery = array();
        if (isset($_GET['contact_no']) && isset($_GET['date']) && isset($_GET['session'])){
            $arrQuery['booker_ic_no'] = "G0587235M";
            $arrQuery['restaurant_contact_no'] = $_GET['contact_no'];
            $arrQuery['date'] = $_GET['date'];
            $arrQuery['session'] = $_GET['session'];
        }
        
        $bookingDetails = $eventHandler->getBookings($arrQuery);

        if (isset($_POST['save'])){
            if ($_POST['save'] == "Edit"){
                editBooking($bookingDetails, $_POST);
            } else {
                addBooking($_POST, $restaurantDetails['contact_no']);
            }
        } 

        if (isset($_POST['date'])){
            $date = $_POST['date'];
        } else {
            $date = date('Y-m-d', strtotime("today"));
        }

        if (isset($_POST['session'])){
            $session = $_POST['session'];
        } else {
            $session = "lunch";
        }

        if (isset($_POST['pax'])){
            $numberOfPax = $_POST['pax'];
        } else {
            $numberOfPax = 0;
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
                    <li class="active"><a href="index.php">Restaurants</a></li>
                    <li><a href="booking_list.php">My Bookings</a></li>
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
                                
                            <div id="bookingoptions" class="container">
                                <form method="post" action="">
                                    <input type="hidden" name="save" value="Add">
                                    
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
                                            echo ($key == $session)
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