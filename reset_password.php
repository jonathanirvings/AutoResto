<html>
<head>
    <title>AutoResto - Reset Password</title>
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
        $ic_number = "";
        $email = "";
        $contact_no = "";
        
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
    
        function checkAttributes($input, $database) {         
            if(count($database)==0){
                ?><script>
                    alert("Wrong information entered");
                </script><?php
                return false;
            }
                
            global $customer_ic_no;
            global $customer_contact_no;
            global $customer_email;
            $valid = true;
            
            if ($input[$customer_ic_no] != $database[$customer_ic_no]) {
                $valid = false;
            }
            if ($input[$customer_contact_no] != $database[$customer_contact_no]) {
                $valid = false;
            }
            if ($input[$customer_email] != $database[$customer_email]) {
                $valid = false;
            }
            if($valid==false){
                ?><script>
                    alert("Wrong information entered");
                </script><?php
                return false;
            }
            return true;
        }
        
        function addUser() {
            global $eventHandler;
            global $customer_ic_no;
            global $customer_password;
            global $customer_contact_no;
            global $customer_email;
            
            $ic_number = $_POST["ic_number"];
            $email = $_POST["email"];
            $contact_no = $_POST["contact_no"];
            
            $customer_details = $eventHandler->getCustomerDetails($ic_number);
            
            $newArray = array();
            $newArray[$customer_ic_no] = $ic_number;
            $newArray[$customer_email] = $email;
            $newArray[$customer_contact_no] = $contact_no;
            
            if (!checkContactNo($contact_no)) {
                return false;
            }
            if (!checkAttributes($newArray,$customer_details)) {
                return false;
            }
            
            $new_password = "1234";
            $errorMessage = $eventHandler->changePasswordCustomer($ic_number,$new_password);
            ?><script>
            window.location.href = "login.php";
            alert("Your password has been successfully reset to <?php echo $new_password;?>! Please change your password!");
            </script><?php
            return true;
        }
    
        if (isset($_POST["hidden_add"])) {
            addUser();
        }
    ?>
    <!-- Header -->
    <div id="header">
           <div class="container">

               <!-- Logo -->
               <div id="logo">
                   <h1><a href="./">AutoResto</a></h1>
               </div>
           </div>
   </div>
    <nav id="nav">
                <ul>
                    <li class="signup"><a href="login.php">Log in</a></li>
                </ul>
            </nav>
    <!-- Header -->

     <!-- Main -->
        <div id="page">
            <div class="container">
                <div class="row">
                    <div class="15u">
                        <section>
                            <header>
                                <span class="byline">Reset Password</span>
                            </header>    
                            <div id="bookingoptions" class="container">
                                <form method="post" action="">
                                    <input type="hidden" name="hidden_add" value=true>
                                    <h3>IC Number</h3>
                                    <h3><input type="text" id="ic_number" name="ic_number" size="20" value="<?php echo $ic_number;?>"/></h3>
                                    <h3>Email</h3>
                                    <h3><input type="text" id="email" name="email" size="20" value="<?php echo $email;?>"/></h3>
                                    <h3>Contact Number</h3>
                                    <h3><input type="text" id="contact_no" name="contact_no" size="20" value="<?php echo $contact_no;?>"/></h3>
                                   <input type="submit" name="save" id="save" class="button" value="Reset"/>
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