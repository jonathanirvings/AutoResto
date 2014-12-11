<html>
<head>
    <title>AutoResto - Bookings</title>
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

        $eventHandler = new EventHandler();
        if (isset($_GET['contact_no'])){
            $contact_no = $_GET['contact_no'];
        } else {
            $contact_no = "";
        }
        $restaurantDetails = $eventHandler->getRestaurantDetails($contact_no);

        function addBooking($bookingPost, $restaurant_contact_no) {
            global $ic_number;
            $eventHandler = new EventHandler();
            
            $bookingDetails = array(
                'restaurant_contact_no' => $restaurant_contact_no,
                'booker_ic_no' => $bookingPost['booker_ic_no'],
                'date' => $bookingPost['date'],
                'session' => $bookingPost['session']
                );
            $no_of_pax = $bookingPost['pax'];
            
            $feedback = $eventHandler->book($bookingDetails, $no_of_pax);
            if ($feedback == "Booking successful!") {
            ?>
                <script>
                    window.location.href = "booking_list.php";
                    alert("<?php echo $feedback?>");
                </script>
            <?php
            }
            return ($feedback == "Booking successful!");
        }

        function editBooking($old, $new, $restaurant_contact_no){
            global $ic_number;
            $eventHandler = new EventHandler();

            $oldBookingDetails = array(
                'restaurant_contact_no' => $restaurant_contact_no,
                'booker_ic_no' => $old['booker_ic_no'],
                'date' => $old['date'],
                'session' => $old['session']
                );
            $newBookingDetails = array(
                'restaurant_contact_no' => $restaurant_contact_no,
                'booker_ic_no' => $new['booker_ic_no'],
                'date' => $new['date'],
                'session' => $new['session']
                );
            $feedback = $eventHandler->editBookings($oldBookingDetails, $newBookingDetails, $new['pax']);
            if ($feedback == "Edit booking successful!"){
            ?>
                <script>
                    window.location.href = "booking_list.php";
                    alert("<?php echo $feedback?>");
                </script>
            <?php
            } 
            return ($feedback == "Edit booking successful!");
        }

        function isValidBooking($bookingPost){
            $msg = "";
            if (!isset($_POST['date']) || empty($_POST['date'])){
                $msg = "Date should not be empty.";
            } else if (strtotime($_POST['date']) < strtotime("today")){
                $msg = "Date should not be earlier than today.";
            }
            if (!isset($_POST['pax']) || $_POST['pax'] <= 0){
                $msg .= ($msg != "" ? " " : "")."No of pax booked should be more than 0.";
            }
            return $msg;
        }

        if (isset($_POST['save'])){
            $msg = isValidBooking($_POST);
            if ($msg == ""){
                if ($_POST['save'] == "Book"){
                    $success = addBooking($_POST, $restaurantDetails['contact_no']);
                } else if ($_POST['save'] == "Edit Booking"){
                    $arrQuery = array();
                    $arrQuery['booker_ic_no'] = $_GET['booker_ic_no'];
                    $arrQuery['restaurant_contact_no'] = $_GET['contact_no'];
                    $arrQuery['date'] = $_GET['date'];
                    $arrQuery['session'] = $_GET['session'];
                    
                    $oldBookingDetails = $eventHandler->getBookings($arrQuery);
                    $oldBookingDetails = $oldBookingDetails[0];

                    $success = editBooking($oldBookingDetails, $_POST, $restaurantDetails['contact_no']);
                }
                if ($success){
                    //redirect to index.php page
                    // header("Location: index.php");
                }
            } else {
                unset($_POST['save']);
                ?>
                <script>  
                    alert("<?php echo $msg?>");
                </script>
                <?php
            }
        }
        
        if ($page_mode == "edit"){
            $arrQuery = array();
            $arrQuery['booker_ic_no'] = $_GET['booker_ic_no'];
            $arrQuery['restaurant_contact_no'] = $_GET['contact_no'];
            $arrQuery['date'] = $_GET['date'];
            $arrQuery['session'] = $_GET['session'];
            
            if (!$isAdmin && strtoupper($_GET["booker_ic_no"]) != strtoupper($ic_number)) {
                header("Location: no_permission.php");
            }
            
            $bookingDetails = $eventHandler->getBookings($arrQuery);
            $bookingDetails = $bookingDetails[0];

            $date = $bookingDetails['date'];
            $session = $bookingDetails['session'];
            $numberOfPax = $bookingDetails[$booking_booked1seaters] +(2*$bookingDetails[$booking_booked2seaters]) + (4*$bookingDetails[$booking_booked4seaters]);
        } else {
            if (!isset($_POST['hidden_save'])){
                $date = date('Y-m-d', strtotime("today"));
                $session = 'lunch';
                $numberOfPax = 0;
            } else {
                $date = $_POST['date'];
                $session = $_POST['session'];
                $numberOfPax = $_POST['pax'];
            }
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
                                    <input type="hidden" name="hidden_save" value=true>
                                    <input type="hidden" name="booker_ic_no" value=<?php echo ($page_mode != "edit") ? $ic_number : $_GET["booker_ic_no"]?> >
                                    
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
                                    <input type="submit" name="save" id="save" class="button" value="<?php echo ($page_mode != "edit") ? "Book" : "Edit Booking"?>"/>
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