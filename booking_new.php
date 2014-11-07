<html>
<head>
    <?php
    include "htmlHeader.php";
    ?>
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

        $eventHandler = new eventhandler();
        if (isset($_GET['contact_no'])){
            $contact_no = $_GET['contact_no'];
        } else {
            $contact_no = "";
        }
        $restaurantDetails = $eventHandler->getRestaurantDetails($contact_no);

        function addBooking($bookingPost, $restaurant_contact_no) {
            global $ic_number;
            $eventHandler = new EventHandler();
            
            $bookingDetails = [];
            $bookingDetails['restaurant_contact_no'] = $restaurant_contact_no;
            $bookingDetails['booker_ic_no'] = $ic_number;
            $bookingDetails['date'] = $bookingPost['date'];
            $bookingDetails['session'] = $bookingPost['session'];
            $no_of_pax = $bookingPost['pax'];
            
            $feedback = $eventHandler->book($bookingDetails, $no_of_pax);
            
            ?>
            <script>
                alert("<?php echo $feedback?>");
            </script>
            <?php
        }
        
        $arrQuery = array();
        if (isset($_GET['contact_no']) && isset($_GET['date']) && isset($_GET['session'])){
            $arrQuery['booker_ic_no'] = $ic_number;
            $arrQuery['restaurant_contact_no'] = $_GET['contact_no'];
            $arrQuery['date'] = $_GET['date'];
            $arrQuery['session'] = $_GET['session'];

            $bookingDetails = $eventHandler->getBookings($arrQuery);
            $bookingDetails = $bookingDetails[0];
            $date = $bookingDetails['date'];
            $session = $bookingDetails['session'];
            //how to manage this?
            $numberOfPax = 0;
        }

        if (isset($_POST['save'])){
            if (isset($_POST['save'])){
                if ($_POST['save'] == "Edit"){
                    editBooking($bookingDetails, $_POST);
                } else {
                    addBooking($_POST, $restaurantDetails['contact_no']);
                }
                $bookingDetails = $_POST;
            }
            $date = $bookingDetails['date'];
            $session = $bookingDetails['session'];
            $contact_no = $restaurantDetails['contact_no'];
            header("Location: booking_new.php?contact_no=$contact_no&date=$date&session=$session&page_mode=edit");
            //how to manage this?
            $numberOfPax = 0;
        } else if (!isset($_GET['page_mode']) || $page_mode == "add") {
            $date = date('Y-m-d', strtotime("today"));
            $session = 'lunch';
            $numberOfPax = 0;
        }
    ?>
    <!-- Header -->
    <?php
        include "headerPage.php";
    ?>
    <!-- Header -->

     <!-- Main -->
        <div id="page">
            <div id="main" class="container">
                <div class="row">
                    <div class="15u">
                        <section>
                            <header>
                                <h2><?php echo $restaurantDetails['restaurant_name']?></h2>
                                <?php
                                if ($page_mode != 'edit'){
                                    echo "<span class=\"byline\">New Booking</span>";
                                } else {
                                    echo "<span class=\"byline\">Edit Booking</span>";
                                }
                                ?>
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
                                    <?php echo $page_mode!="edit" ? "No of Pax." : "Seats Allocated"?> <input name="pax" id="pax" type="text" value="<?php echo $numberOfPax ?>"/>
                                    <input type="submit" name="book" id="book" class="button" value="<?php echo ($page_mode != "edit") ? "Book" : "Edit Booking"?>"/>
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