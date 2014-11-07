<html>
<header>
	<?php include("htmlHeader.php"); ?>
</header>
<?php
function deleteBooking($arrQuery){
	$eventHandler = new EventHandler();
	$eventHandler->deleteBookings($arrQuery);
}
?>

<body>

<?php
	deleteBooking($_GET);

	header('Location: booking_list.php');
?>

</body>
</html>