<html>
<head>
    <?php
    include "htmlHeaderLogin.php";
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
        
        if (isset($_GET['ic_no'])){
            $ic_number = $_GET["ic_no"];
        } else {
            $ic_number = $_SESSION["ic_number"];
        }
        $customer_details = $eventHandler->getCustomerDetails($ic_number);
        
        global $customer_name;
        global $customer_email;
        global $customer_ic_no;
        global $customer_contact_no;
        global $customer_password;
        
        $name = $customer_details[$customer_name];
        $email = $customer_details[$customer_email];
        $contact_no = $customer_details[$customer_contact_no];
        
        $password_old = "";
        $password_new = "";
        $password_confirm = "";
    
        function checkOldPassword($password_old, $password_old_database) {
            $password_old = md5($password_old);
            if ($password_old != $password_old_database) {
                ?><script>
                    alert("Old password does not match");
                </script><?php
                return false;
            }
            return true;
        }
        
        function checkPassword($password_new,$password_confirm) {
            if ($password_new != $password_confirm) {
                ?><script>
                    alert("New password does not match");
                </script><?php
                return false;
            }
            return true;
        }            
        
        function changeUserPassword() {
            global $eventHandler;
            global $customer_password;
            
            if (isset($_GET['ic_no'])){
                $ic_number = $_GET["ic_no"];
            } else {
                $ic_number = $_SESSION["ic_number"];
            }
            
            $customer_details = $eventHandler->getCustomerDetails($ic_number);
            $password_old_database = $customer_details[$customer_password];
            
            $password_old = $_POST["password_old"];
            $password_new = $_POST["password_new"];
            $password_confirm = $_POST["password_confirm"];
            if (!checkOldPassword($password_old,$password_old_database)) {
                return false;
            }
            if (!checkPassword($password_new,$password_confirm)) {
                return false;
            }           
            
            $error_message = $eventHandler->changePasswordCustomer($ic_number,$password_new);
            ?><script>
            alert("Password changed successfully!");
            window.location.href = "index.php";
            </script><?php
            return true;
        }
    
        if (isset($_POST["hidden_add"])) {
            changeUserPassword();
        }
    ?>

     <!-- Main -->
        <div id="page">
            <div class="container">
                <div class="row">
                    <div class="15u">
                        <section>
                            <header>
                                <span class="byline">Change Password</span>
                            </header>
                                
                            <div id="bookingoptions" class="container">
                                <form method="post" action="">
                                    <input type="hidden" name="hidden_add" value=true>
                                    
                                    <h3>IC Number</h3>
                                    <h3><?php echo $ic_number;?></h3>
                                    <h3>Old Password</h3>
                                    <h3><input type="password" id="password" name="password_old" size="20" value="<?php echo $password_old;?>"/></h3>
                                    <h3>Password</h3>
                                    <h3><input type="password" id="password" name="password_new" size="20" value="<?php echo $password_new;?>"/></h3>
                                    <h3>Confirm Password</h3>
                                    <h3><input type="password" id="password_confirm" name="password_confirm" size="20" value="<?php echo $password_confirm;?>"/></h3>
                                    <input type="submit" name="save" id="save" class="button" value="Change"/>
                                </form>
                            </div>
                            <br>
                            <a href="manage_account.php">< Back to Update Particular</a>
                        </section>
                    </div>
                </div>
            </div>
    <!-- Main -->

    </div>
</body>
</html>