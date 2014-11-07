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

        function editRestaurant($contact_no, $newArray){
            
            $eventHandler = new eventhandler();
            $newDetails = array();

            $newDetails['restaurant_name'] = $newArray['restaurant_name'];
            $newDetails['contact_no'] = $newArray['contact_no'];
            $newDetails['cuisine'] = $newArray['cuisine'];
            $newDetails['address'] = $newArray['address'];
            $newDetails['total1seaters'] = $newArray['total1seaters'];
            $newDetails['total2seaters'] = $newArray['total2seaters'];
            $newDetails['total4seaters'] = $newArray['total4seaters'];
            $newDetails['open'] = $newArray['open'];

            $eventHandler->editRestaurant($contact_no, $newDetails);
        }
        
        function addRestaurant($newArray) {
            $eventHandler = new eventhandler();
            $newDetails = array();

            $newDetails['restaurant_name'] = $newArray['restaurant_name'];
            $newDetails['contact_no'] = $newArray['contact_no'];
            $newDetails['cuisine'] = $newArray['cuisine'];
            $newDetails['address'] = $newArray['address'];
            $newDetails['total1seaters'] = $newArray['total1seaters'];
            $newDetails['total2seaters'] = $newArray['total2seaters'];
            $newDetails['total4seaters'] = $newArray['total4seaters'];
            $newDetails['open'] = $newArray['open'];

            $eventHandler->addRestaurant($newDetails);
        }
    ?>
    <!-- Header -->
    <?php
        include "headerPage.php";
    ?>
    <!-- Header -->

     <!-- Main -->
        <div id="page">
            <div class="container">
                <div class="row">
                    <div class="15u">
                        <section>
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
                                        editRestaurant($contact_no, $_POST);
                                    } else {
                                        addRestaurant($_POST);
                                    }
                                    $restaurant = $_POST;
                                    $contact_no = $restaurant['contact_no'];
                                    header("Location: restaurant_edit.php?contact_no=$contact_no&page_mode=edit");
                                }
                            ?>

                            <header>
                                <?php
                                    if ($page_mode != "edit"){
                                        echo "<h2>Add New Restaurant</h2>";
                                    } else {
                                        echo "<h2>Edit Restaurant</h2>";
                                    }
                                ?>
                            </header>

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
                                                                '1'=>"Open",
                                                                '0'=>"Closed"
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