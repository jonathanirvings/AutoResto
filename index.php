<html>
<head>
	<title>AutoResto</title>
        <?php
            ini_set("memory_limit",-1);
            include "constant.php";
            include "dbhandler.php";
            include "dboperation.php";
            include "booking.php";
            include "restaurant.php";
            include "customer.php";
            include "eventhandler.php";
        ?>
</head>
<body>
	<marquee behavior="scroll" direction="left" scrollamount="5" style="font-size:100">AutoResto</marquee>
	<?php
            $eventhandler = new EventHandler();
            $resto = $eventhandler->getListOfRestaurants();
        ?>
</body>
</html>