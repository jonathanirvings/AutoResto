<html>
<head>
    <?php
    include "htmlHeader.php";
    ?>
</head>

<?php
    function showLoginForm()
    {
        ?>
        <form method="post" action="">
            IC Number
            <input type="text" id="ic_number" name="ic_number" size="10"/>
            Password
            <input type="password" id="password" name="password" size="10"/>
            <input type="submit" name="login" id="login" class="button" value="login"/>
        </form>
        <?php
    }

?>

<body class="homepage">
    <!-- Header -->
    <?php
        include "headerPage.php";
        ?>
        <script>$(".index").addClass("active");</script>
        <?php
    ?>
    <!-- Header -->

     <!-- Main -->

        <div id="page">
       <!-- Main -->
            <div class="container">
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
                                $userIsAdmin = $eventHandler->isAdmin($ic_number);
                                
                                
                            ?>
                            <div>
                                <form name="search"><ul class="style2"><li>
                                    <input name="search_string" id="search_string" type="text" value="<?php echo $search_string ?>"/>
                                    <input type="submit" name="search" id="search" class="button" value="Search"/>
                                </li></ul></form>
                                <?php
                                    if ($userIsAdmin)
                                    {
                                        echo "<a href=\"restaurant_edit.php?page_mode=add\">Add a new Restaurant</a>";
                                    }
                                ?>
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
                                                        $editLink = "<a href=\"restaurant_edit.php?contact_no=$restaurant&page_mode=edit\">Edit</a>";
                                                        if ($row["open"] && $userIsAdmin)
                                                        {
                                                            echo $bookLink." - ".$editLink;
                                                        } else if ($row["open"])
                                                        {
                                                            echo $bookLink;
                                                        } else if ($userIsAdmin)
                                                        {
                                                            echo $editLink;
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