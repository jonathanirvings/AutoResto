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
                                $page = 0;
                                if (isset($_GET["page"])) {
                                    $page = $_GET["page"] - 1;
                                }
                            
                                if(isset($_GET["order_by"])){
                                   $order_by = $_GET["order_by"];
                                }
                                else{
                                   $order_by = "";
                                }
                                
                                $rows = $eventHandler->getListOfRestaurants("","","",$order_by);
                                
                                if (isset($_POST["filter"])) {
                                    $keyword_name = $_POST["restaurant_name"];
                                    $keyword_address = $_POST["restaurant_address"];
                                    $keyword_cuisine = $_POST["restaurant_cuisine"];
                                    $rows = $eventHandler->getListOfRestaurants($keyword_name,$keyword_address,$keyword_cuisine,$order_by);
                                }
                            ?>
                            <div>
                                <form id="filtering" method="post">
                                    <input name="filter" type="hidden" value="true"/>
                                    Restaurant Name <input name="restaurant_name" id="restaurant_name" type="text" value=""/>
                                    Restaurant Address <input name="restaurant_address" id="restaurant_address" type="text" value=""/>
                                    Cuisine <input name="restaurant_cuisine" id="restaurant_cuisine" type="text" value=""/>
                                    <input type="submit" name="search" id="search" class="button" value="Search"/>
                                </form>
                                <!--
                                <form name="search"><ul class="style2"><li>
                                    <input name="search_string" id="search_string" type="text" value="<?php echo $search_string ?>"/>
                                    <input type="submit" name="search" id="search" class="button" value="Search"/>
                                </li></ul>
                                </form>-->
                                <?php
                                    if ($isAdmin)
                                    {
                                        echo "<a href=\"restaurant_edit.php?page_mode=add\">Add a new Restaurant</a>";
                                    }
                                ?>
                            </div>
                            <div class="page_button"></div>
                            <form name="table">
                                <table>
                                    <tr>
                                        <th><a href="?order_by=restaurant_name"> Name </a></th>
                                        <th> Address </th>
                                        <th> Contact No. </th>
                                        <th><a href="?order_by=cuisine"> Cuisine </a></th>
                                        <th> 1 Seater </th>
                                        <th> 2 Seater </th>
                                        <th> 4 Seater </th>
                                        <th><a href="?order_by=open"> Status </a></th>
                                        <th> Option </th>
                                    </tr>
                                    <?php
                                        global $rows_each_page;
                                        if (sizeof($rows) > 0){
                                            $firstRow = $page * $rows_each_page;
                                            $lastRow = min(($page+1) * $rows_each_page,sizeof($rows)) - 1;
                                            $numPages = ceil(sizeof($rows) / $rows_each_page);
                                            echo "Showing from ".($firstRow+1)." to ".($lastRow+1)." from ".sizeof($rows)." rows";
                                            for ($i = $firstRow; $i <= $lastRow; ++$i){
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
                                                        
                                                        $bookLink = "<a href=\"booking_new.php?contact_no=$restaurant&page_mode=add\">Book</a>";
                                                        $editLink = "<a href=\"restaurant_edit.php?contact_no=$restaurant&page_mode=edit\">Edit</a>";
                                                        $deleteLink = "<a href=\"restaurant_delete.php?contact_no=$restaurant\">Delete</a>";
                                                        $url = "";
                                                        if ($row["open"] && !$isAdmin)
                                                        {
                                                            $url .= $bookLink;
                                                        } else if ($isAdmin)
                                                        {
                                                            $url = $editLink." - ".$deleteLink;
                                                        }
                                                        echo $url;
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
                            <div class="page_button"></div>
                            <?php
                                $pageButton = "Jump to Page ";
                                for ($i = 1; $i <= $numPages; ++$i) {
                                                if ($order_by == "") {
                                                    $pageButton .= "<a href='?page=".$i."'>".$i."</a>  ";
                                                } else {
                                                    $pageButton .= "<a href='?order_by=".$order_by."&page=".$i."'>".$i."</a>  ";
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