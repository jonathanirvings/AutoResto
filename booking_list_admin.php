<html>
<head>
    <?php
    include "htmlHeader.php";
    ?>
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
                                <span class="byline">Below are the bookings that users made</span>
                            </header>
                            
                            <?php
                            
                                if (!$isAdmin) {
                                    header("Location: no_permission.php");
                                } 
                            
                                $page = 0;
                                if (isset($_GET["page"])) {
                                    $page = $_GET["page"] - 1;
                                }
                                
                                $bookingRows = $eventHandler->getAllBookings();
                                
                                if (isset($_POST["filter"])) {
                                    $keyword_booker_ic = $_POST["booker_ic"];
                                    $bookingRows = $eventHandler->getBookingsSearch($keyword_booker_ic);
                                }
                                
                                $order_by = "";
                                if(isset($_GET["order_by"])){
                                   $order_by = $_GET["order_by"];
                                   $bookingRows = $eventHandler->sortBookings($bookingRows,$order_by);
                                }
                            ?>
                            <form id="filtering" method="post">
                                    <input name="filter" type="hidden" value="true"/>
                                    Booker IC <input name="booker_ic" id="booker_ic" type="text" value=""/>
                                    <input type="submit" name="search" id="search" class="button" value="Search"/>
                                </form>
                            <div class="page_button"></div>
                            <form name="table">
                                <table>
                                    <tr>
                                        <th><a href="?order_by=booker_ic_no">Booker </a></th>
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
                                        global $rows_each_page;
                                        if (sizeof($bookingRows) > 0){
                                            $firstRow = $page * $rows_each_page;
                                            $lastRow = min(($page+1) * $rows_each_page,sizeof($bookingRows)) - 1;
                                            $numPages = ceil(sizeof($bookingRows) / $rows_each_page);
                                            echo "Showing from ".($firstRow+1)." to ".($lastRow+1)." from ".sizeof($bookingRows)." rows";
                                            
                                            for ($i = $firstRow; $i <= $lastRow; ++$i){
                                                $row = $bookingRows[$i];
                                                $restaurant = $eventHandler->getRestaurantDetails($row['restaurant_contact_no']);
                                            ?>
                                                <tr>
                                                    <td> <?= $row['booker_ic_no'] ?> </td>
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
                                            echo "<tr><td colspan='9'>There are no bookings to display.</td></tr>";
                                        }
                                    ?>
                                </table>
                            </form>
                            <div class="page_button"></div>
                            <?php
                                if (sizeof($bookingRows) > 0)
                                {
                                    $pageButton = "Jump to Page ";
                                    for ($i = 1; $i <= $numPages; ++$i) {
                                                if ($order_by == "") {
                                                    $pageButton .= "<a href='?page=".$i."'>".$i."</a>  ";
                                                } else {
                                                    $pageButton .= "<a href='?order_by=".$order_by."&page=".$i."'>".$i."</a>  ";
                                                }
                                            }
                                }
                            ?>
                            <script>
                                $(".page_button").html("<?php echo $pageButton;?>");
                            </script>
                        </section>
                    </div>
                </div>
            </div>
            <!-- Main -->
    </div>
</body>
</html>