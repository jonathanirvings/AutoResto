<div id="header">
        <div class="container">
                
            <!-- Logo -->
            <div id="logo">
                <h1><a href="./">AutoResto</a></h1>
            </div>
            
            <!-- Nav -->
            <nav id="nav">
                <ul>
                    <li class="name"><a>Welcome, 
                    <?php
                        $eventHandler = new EventHandler();
                        echo $eventHandler->getCustomerName($ic_number);
                    ?>
                        </a></li>
                    <li class="index"><a href="./">Restaurants</a></li>
                    <li class="booking_list"><a href="booking_list.php">My Bookings</a></li>
                    <li class="logout"><a href="login.php">Log Out</a></li>
                </ul>
            </nav>
        </div>
</div>

<!-- Banner
        <div id="banner">
            <div class="container">
            </div>
        </div>
<!-- /Banner -->