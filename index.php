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
</head>

<body class="homepage">
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

       <!-- Main -->
            <div id="main" class="container">
                <div class="row">
                    <div class="15u">
                        <section>
                            <header>
                                <h2>List of Restaurants</h2>
                                <span class="byline">Below are the available restaurants that you can book.</span>
                            </header>
                            
                            <?php
                                $eventHandler = new EventHandler();

                                if(isset($_GET["order_by"])){
                                   $order_by = $_GET["order_by"];
                                }
                                else{
                                   $order_by = "";
                                }

                                if (isset($_GET['search_string'])){
                                    $search_string = $_GET['search_string'];
                                } else {
                                    $search_string = "";
                                }

                                $rows = $eventHandler->getListOfRestaurants($search_string, $order_by);

                                //Check whether the user is an admin or not
                                $userIsAdmin = $eventHandler->isAdmin("G0587235M");
                            ?>
                            <div>
                                <form name="search"><ul class="style2"><li>
                                    <input name="search_string" id="search_string" type="text" value="<?php echo $search_string ?>"/>
                                    <input type="submit" name="search" id="search" class="button" value="Search"/>
                                </li></ul></form>
                            </div>
                            <form name="table">
                                <table>
                                    <tr>
                                        <th><a href="?order_by=restaurant_name<?php
                                               if($search_string!=""){
                                                   echo "&search_string=".$search_string."&search=Search";
                                               }
                                               ?>"> Name </a></th>
                                        <th> Address </th>
                                        <th> Contact No. </th>
                                        <th><a href="?order_by=cuisine<?php
                                               if($search_string!=""){
                                                   echo "&search_string=".$search_string."&search=Search";
                                               }
                                               ?>"> Cuisine </a></th>
                                        <th> 1 Seater </th>
                                        <th> 2 Seater </th>
                                        <th> 4 Seater </th>
                                        <th><a href="?order_by=open<?php
                                               if($search_string!=""){
                                                   echo "&search_string=".$search_string."&search=Search";
                                               }
                                               ?>"> Status </a></th>
                                        <th> Option </th>
                                    </tr>
                                    <?php
                                        if (sizeof($rows) > 0){
                                            for ($i = 0; $i < sizeof($rows); ++$i){
                                                $row = $rows[$i];
                                            ?>
                                                <tr>
                                                    <td> <?= $row['restaurant_name'] ?> </td>
                                                    <td> <?= $row['address'] ?> </td>
                                                    <td> <?= $row['contact_no'] ?> </td>
                                                    <td> <?= $row['cuisine'] ?> </td>
                                                    <td> <?= $row['total1seaters'] ?> </td>
                                                    <td> <?= $row['total2seaters'] ?> </td>
                                                    <td> <?= $row['total4seaters'] ?> </td>
                                                    <td> <?= $row['open']?"Open":"Closed" ?> </td>
                                                    <td>
                                                    <?php
                                                        $restaurant = $row['contact_no'];
                                                        $bookLink = "<a href=\"booking_new.php?contact_no=$restaurant\">Book</a>";

                                                        if ($userIsAdmin){
                                                            echo $bookLink . " - <a href=\"restaurant_edit.php?contact_no=$restaurant&page_mode=edit\">Edit</a>";
                                                        } else {
                                                            echo $bookLink;
                                                        }
                                                    ?>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>There are no bookings to display.</td></tr>";
                                        }
                                    ?>
                                </table>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
            <!-- Main -->
    </div>
</body>
</html>