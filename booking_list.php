<html>
<head>
    <?php
    include "htmlHeader.php";
    ?>
</head>

<?php
?>

<body class="homepage">
    <!-- Header -->
    <?php
        include "headerPage.php";
        if ($isAdmin) {
            header('Location: booking_list_admin.php');
        }
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
                                
                                //get list of the user's bookings
                                $bookingRows = $eventHandler->getBookingsByIC($ic_number);
                                if(isset($_GET["order_by"])){
                                   $order_by = $_GET["order_by"];
                                   $bookingRows = $eventHandler->sortBookings($bookingRows,$order_by);
                                }
                            ?>
                            
                            <form name="table">
                                <table>
                                    <tr>
                                        <th> Restaurant Name </a></th>
                                        <th> Address </th>
                                        <th> Contact No. </th>
                                        <th> Cuisine </a></th>
                                        <th><a href="?order_by=date">Date </a></th>
                                        <th> Session </th>
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
                                                    <td> <?= $row['session'] ?> </td>
                                                    <td> <?= $row['booked1seaters'] + $row['booked2seaters'] + $row['booked4seaters'] ?> </td>
                                                    <td>
                                                    <?php
                                                        $contact_no = $restaurant['contact_no'];
                                                        $date = $row['date'];
                                                        $session = $row['session'];
                                                        echo "<a href=\"booking_new.php?contact_no=$contact_no&date=$date&session=$session&page_mode=edit\">Edit</a> - <a href=\"booking_delete.php?restaurant_contact_no=$contact_no&date=$date&session=$session\">Delete</a>";
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