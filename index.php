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
                                $rows = $eventHandler->getListOfRestaurants();
                            ?>
                            <form name="table">
                                <table>
                                    <tr>
                                        <th><a href="?order_by=name"> Name </a></th>
                                        <th> Address </th>
                                        <th> Contact No. </th>
                                        <th><a href="?order_by=cuisine"> Cuisine </a></th>
                                        <th> 1 Seater </th>
                                        <th> 2 Seater </th>
                                        <th> 4 Seater </th>
                                        <th><a href="?order_by=status"> Status </a></th>
                                        <th> Option </th>
                                    </tr>
                                    <?php
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
                                            <td> <a href="booking_new.php?contact_no=<?php echo $row['contact_no']?>">Book</a></td>
                                        </tr>
                                    <?php
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