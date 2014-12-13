<html>
<head>
    <title>AutoResto - Customers</title>
    <?php
    include "htmlHeader.php";
    ?>
</head>

<body class="homepage">
    <!-- Header -->
    <?php
        include "headerPage.php";
        ?>
        <script>$(".all_customers").addClass("active");</script>
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
                                <h2>Customer List</h2>
                                <span class="byline">Below are the details of the customers</span>
                            </header>
                            
                            <?php
                            
                                if (!$isAdmin) {
                                    header("Location: no_permission.php");
                                } 
                            
                                $page = 0;
                                if (isset($_GET["page"])) {
                                    $page = $_GET["page"] - 1;
                                    if (!isset($_POST["filter"]) && isset($_SESSION["post_data"])) {
                                        $_POST = $_SESSION["post_data"];
                                    }
                                }
                                
                                $customerRows = $eventHandler->getAllCustomers();
                                
                                $order_by = "";
                                if(isset($_GET["order_by"])){
                                   $order_by = $_GET["order_by"];
                                   $customerRows = $eventHandler->sortCustomers($customerRows,$order_by);
                                   if (!isset($_POST["filter"]) && isset($_SESSION["post_data"])) {
                                        $_POST = $_SESSION["post_data"];
                                    }
                                }
                                global $customer_ic_no;
                                if (isset($_POST["filter"])) {
                                    $keyword_customer_ic_no = $_POST["ic_no"];
                                    $customerRows = $eventHandler->getCustomersSearch($keyword_customer_ic_no);
                                }
                                
                                $_SESSION['post_data'] = $_POST;
                            ?>
                            <form id="filtering" method="post">
                                    <input name="filter" type="hidden" value="true"/>
                                    Search IC <input name="ic_no" id="customer_ic_no" type="text" value=""/>
                                    <input type="submit" name="search" id="search" class="button" value="Search"/>
                                </form>
                            <div class="page_button"></div>
                            <form name="table">
                                <table>
                                    <tr>
                                        <th><a href="?order_by=ic_no">IC number </a></th>
                                        <th><a href="?order_by=name"> Name </a></th>
                                        <th><a href="?order_by=email"> Email </a></th>
                                        <th><a href="?order_by=contact_no"> Contact No. </a></th>
                                        <th> Options </th>
                                    </tr>
                                    <?php
                                        global $rows_each_page;
                                        global $customer_name;
                                        global $customer_email;
                                        global $customer_ic_no;
                                        global $customer_contact_no;
                                        
                                        if (sizeof($customerRows) > 0){
                                            $numPages = ceil(sizeof($customerRows) / $rows_each_page);
                                            $page = min($page,$numPages - 1);
                                            $firstRow = $page * $rows_each_page;
                                            $lastRow = min(($page+1) * $rows_each_page,sizeof($customerRows)) - 1;
                                            echo "Showing from ".($firstRow+1)." to ".($lastRow+1)." from ".sizeof($customerRows)." rows";
                                            
                                            for ($i = $firstRow; $i <= $lastRow; ++$i){
                                                $row = $customerRows[$i];
                                            ?>
                                                <tr>
                                                    <td> <?= $row[$customer_ic_no] ?> </td>
                                                    <td> <?= $row[$customer_name] ?> </td>
                                                    <td> <?= $row[$customer_email] ?> </td>
                                                    <td> <?= $row[$customer_contact_no] ?> </td>
                                                    <td>
                                                    <?php
                                                        $customer_ic = $row[$customer_ic_no];
                                                        echo "<a href=\"manage_account.php?ic_no=$customer_ic\">Edit</a> - <a href=\"customer_delete.php?ic_no=$customer_ic\">Delete</a>";
                                                    ?>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='9'>There are no users to display.</td></tr>";
                                        }
                                    ?>
                                </table>
                            </form>
                            <div class="page_button"></div>
                            <?php
                                if (sizeof($customerRows) > 0)
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
                        <a> *Please note that if a user is deleted, related bookings will also be deleted. </a>
                    </div>
                </div>
            </div>
            <!-- Main -->
    </div>
</body>
</html>