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
        $page_mode = $_GET['page_mode'];

        function editRestaurant($oldArray, $newArray){
            $eventHandler = new eventhandler();
            $oldDetails = array();
            $newDetails = array();

            $oldDetails['restaurant_name'] = $oldArray['restaurant_name'];
            $oldDetails['contact_no'] = $oldArray['contact_no'];
            $oldDetails['cuisine'] = $oldArray['cuisine'];
            $oldDetails['address'] = $oldArray['address'];
            $oldDetails['total1seaters'] = $oldArray['total1seaters'];
            $oldDetails['total2seaters'] = $oldArray['total2seaters'];
            $oldDetails['total4seaters'] = $oldArray['total4seaters'];
            $oldDetails['open'] = $oldArray['open'];

            $newDetails['restaurant_name'] = $newArray['restaurant_name'];
            $newDetails['contact_no'] = $newArray['contact_no'];
            $newDetails['cuisine'] = $newArray['cuisine'];
            $newDetails['address'] = $newArray['address'];
            $newDetails['total1seaters'] = $newArray['total1seaters'];
            $newDetails['total2seaters'] = $newArray['total2seaters'];
            $newDetails['total4seaters'] = $newArray['total4seaters'];
            $newDetails['open'] = $newArray['open'];

            $eventHandler->editRestaurant($oldDetails, $newDetails);
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
                                <?php
                                    if ($page_mode != "edit"){
                                        echo "<h2>Add New Restaurant</h2>";
                                    } else {
                                        echo "<h2>Edit Restaurant</h2>";
                                    }
                                ?>
                            </header>
                            
                            <?php
                                $eventHandler = new eventhandler();
                                if (isset($_GET['contact_no'])){
                                    $contact_no = $_GET['contact_no'];
                                } else {
                                    $contact_no = "";
                                }
                                $restaurant = $eventHandler->getRestaurantDetails($contact_no);

                                if (isset($_POST['save'])) {
                                    if ($_POST['save'] == "Edit"){
                                        editRestaurant($restaurant, $_POST);
                                    } else {
                                        // addRestaurant($_POST);
                                    }
                                    $restaurant = $_POST;  
                                }
                            ?>

                            <div id="restaurantdetails" class="container">
                                <form method="post" action="">
                                    <div class="6u">
                                        <ul>
                                            <h3><b>Basic Information</b><h3>
                                            <h3>Restaurant Name</h3>
                                            <input name="restaurant_name" id="restaurant_name" type="text" size="50" value="<?php echo $restaurant['restaurant_name'] ?>"/>
                                            <h3>Cuisine</h3>
                                            <input name="cuisine" id="cuisine" type="text" size="50" value="<?php echo $restaurant['cuisine'] ?>"/>
                                            <h3>Address</h3>
                                            <input name="address" id="address" type="text" size="50" value="<?php echo $restaurant['address'] ?>"/>
                                            <h3>Contact Number</h3>
                                            <input name="contact_no" id="contact_no" type="text" size="50" value="<?php echo $restaurant['contact_no'] ?>"/>
                                            <h3>Status</h3>
                                            <select name="open" id="open">
                                                <?php
                                                    $states = array(
                                                                '0'=>"Open",
                                                                '1'=>"Closed"
                                                                );
                                                    foreach($states as $key=>$val) {
                                                        echo ($key == $restaurant['open'])
                                                                ? "<option selected=\"selected\" value=\"$key\">$val</option>"
                                                                :"<option value=\"$key\">$val</option>";
                                                    }
                                                ?>
                                            </select>
                                            <br><br>
                                            <h3><b>Seat Details</b><h3>
                                            <h3>Total 1 Seaters</h3>
                                            <input name="total1seaters" id="total1seaters" type="text" size="25"  value="<?php echo $restaurant['total1seaters'] ?>"/>
                                            <h3>Total 2 Seaters</h3>
                                            <input name="total2seaters" id="total2seaters" type="text" size="25" value="<?php echo $restaurant['total2seaters'] ?>"/>
                                            <h3>Total 1 Seaters</h3>
                                            <input name="total4seaters" id="total2seaters" type="text" size="25" value="<?php echo $restaurant['total4seaters'] ?>"/>
                                            <br><br>
                                            <input type="submit" name="save" id="save" class="button" size="50" value="<?php echo ($page_mode != "edit") ? "Add" : "Edit"?>"/>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
    <!-- Main -->

    </div>
</body>
</html>