<html>
<head>
    <?php
        session_start();
        if (!isset($_SESSION["ic_number"]))
        {
            header('Location: login.php');
        } else 
        {
            $ic_number = $_SESSION["ic_number"];
        }
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
    <?php
        include "headerPage.php";
        ?>
        <script>$(".booking_list").addClass("active");</script>
        <?php
    ?>
    <!-- Header -->

     <!-- Main -->
        <div id="page">

       <!-- Main -->
            <div id="main" class="container">
                <div class="row">
                    <div class="15u">
                        <section>
                            <header>
                                <h2>Booking List</h2>
                                <span class="byline">Below are the bookings that you have made</span>
                            </header>
                            
                            <?php
                                $eventHandler = new eventhandler();
                                
                                //get list of the user's bookings
                                $bookingRows = $eventHandler->getBookingsByIC($ic_number);
                            ?>
                            <form name="table">
                                <table>
                                    <tr>
                                        <th> Name </a></th>
                                        <th> Address </th>
                                        <th> Contact No. </th>
                                        <th> Cuisine </a></th>
                                        <th> Date </th>
                                        <th> No. of Tables </th>
                                        <th> Options </th>
                                    </tr>
                                    <?php
                                        if (sizeof($bookingRows) > 0){
                                            for ($i = 0; $i < sizeof($bookingRows); ++$i){
                                                $row = $bookingRows[$i];
                                                $restaurant = $eventHandler->getRestaurantDetails($row['restaurant_contact_no']);
                                            ?>
                                                <tr>
                                                    <td> <?= $restaurant['restaurant_name'] ?> </td>
                                                    <td> <?= $restaurant['address'] ?> </td>
                                                    <td> <?= $restaurant['contact_no'] ?> </td>
                                                    <td> <?= $restaurant['cuisine'] ?> </td>
                                                    <td> <?= date('d M Y', strtotime($row['date'])) ?> </td>
                                                    <td> <?= $row['booked1seaters'] + $row['booked2seaters'] + $row['booked4seaters'] ?> </td>
                                                    <td>
                                                    <?php
                                                        $contact_no = $restaurant['contact_no'];
                                                        $date = $row['date'];
                                                        $session = $row['session'];
                                                        echo "<a href=\"booking_new.php?contact_no=$contact_no&date=$date&session=$session&page_mode=edit\">Edit</a> - <a href=\"#\">Delete</a>";
                                                    ?>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='7'>There are no bookings to display.</td></tr>";
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