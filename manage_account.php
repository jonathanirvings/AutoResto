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
        include "headerPage.php";
    ?>
    <script>$(".manage_account").addClass("active")</script>
    <?php
    
        global $eventHandler;
        
        $ic_number = $_SESSION["ic_number"];
        $customer_details = $eventHandler->getCustomerDetails($ic_number);
        
        global $customer_name;
        global $customer_email;
        global $customer_ic_no;
        global $customer_contact_no;
        
        $name = $customer_details[$customer_name];
        $email = $customer_details[$customer_email];
        $contact_no = $customer_details[$customer_contact_no];
        
        function checkContactNo($contact_no) {
            for ($i = 0; $i < strlen($contact_no); ++$i) {
                if ($contact_no[$i] < '0' || $contact_no[$i] > '9') {
                    ?><script>
                    alert("Contact Number must only consist of numbers");
                    </script><?php
                    return false;
                }
            }
            return true;
        }
    
        
        function editUser() {
            global $eventHandler;
            
            $ic_number = $_SESSION["ic_number"];
            $name = $_POST["name"];
            $email = $_POST["email"];
            $contact_no = $_POST["contact_no"];
            
            $newArray = array();
            $newArray["name"] = $name;
            $newArray["email"] = $email;
            $newArray["contact_no"] = $contact_no;
            $error_message = $eventHandler->editCustomer($ic_number,$newArray);
            ?><script>
            alert("<?php echo $error_message; ?>");
            window.location.href = "index.php";
            </script><?php
            return true;
        }
    
        if (isset($_POST["hidden_add"])) {
            editUser();
        }
    ?>
    

     <!-- Main -->
        <div id="page">
            <div class="container">
                <div class="row">
                    <div class="15u">
                        <section>
                            <header>
                                <span class="byline">Manage Account</span>
                            </header>
                                
                            <div id="bookingoptions" class="container">
                                <form method="post" action="">
                                    <input type="hidden" name="hidden_add" value=true>
                                    
                                    <h3>IC Number</h3>
                                    <h3><?php echo $ic_number;?></h3>
                                    <h3>Name</h3>
                                    <h3><input type="text" id="name" name="name" size="20" value="<?php echo $name;?>"/></h3>
                                    <h3>Email</h3>
                                    <h3><input type="text" id="email" name="email" size="20" value="<?php echo $email;?>"/></h3>
                                    <h3>Contact Number</h3>
                                    <h3><input type="text" id="contact_no" name="contact_no" size="20" value="<?php echo $contact_no;?>"/></h3>
                                    <input type="submit" name="save" id="save" class="button" value="Update"/>
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