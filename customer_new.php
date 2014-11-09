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
        $ic_number = "";
        $name = "";
        $email = "";
        $contact_no = "";
        $password = "";
        $password_confirm = "";
        
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
    
        function checkPassword($password,$password_confirm) {
            if ($password != $password_confirm) {
                ?><script>
                    alert("Password does not match");
                </script><?php
                return false;
            }
            return true;
        }
        
        function addUser() {
            global $eventHandler;
            
            $ic_number = $_POST["ic_number"];
            $name = $_POST["name"];
            $email = $_POST["email"];
            $contact_no = $_POST["contact_no"];
            $password = $_POST["password"];
            $password_confirm = $_POST["password_confirm"];
            if (!checkPassword($password,$password_confirm)) {
                return false;
            }
            if (!checkContactNo($contact_no)) {
                return false;
            }
            $newArray = array();
            $newArray["ic_no"] = $ic_number;
            $newArray["name"] = $name;
            $newArray["email"] = $email;
            $newArray["contact_no"] = $contact_no;
            $newArray["password"] = $password;
            $newArray["active"] = 1;
            $newArray["isAdmin"] = 0;
            $error_message = $eventHandler->addCustomer($newArray);
            ?><script>
            alert("<?php echo $error_message; ?>");
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
                                <span class="byline">Sign Up</span>
                            </header>
                                
                            <div id="bookingoptions" class="container">
                                <form method="post" action="">
                                    <input type="hidden" name="hidden_add" value=true>
                                    
                                    <h3>IC Number</h3>
                                    <h3><input type="text" id="ic_number" name="ic_number" size="20" value="<?php echo $ic_number;?>"/></h3>
                                    <h3>Name</h3>
                                    <h3><input type="text" id="name" name="name" size="20" value="<?php echo $name;?>"/></h3>
                                    <h3>Email</h3>
                                    <h3><input type="text" id="email" name="email" size="20" value="<?php echo $email;?>"/></h3>
                                    <h3>Contact Number</h3>
                                    <h3><input type="text" id="contact_no" name="contact_no" size="20" value="<?php echo $contact_no;?>"/></h3>
                                    <h3>Password</h3>
                                    <h3><input type="password" id="password" name="password" size="20" value="<?php echo $password;?>"/></h3>
                                    <h3>Confirm Password</h3>
                                    <h3><input type="password" id="password_confirm" name="password_confirm" size="20" value="<?php echo $password_confirm;?>"/></h3>
                                    <input type="submit" name="save" id="save" class="button" value="Sign Up"/>
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