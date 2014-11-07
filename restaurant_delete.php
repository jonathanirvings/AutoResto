<html>
<header>
	<?php include("htmlHeader.php"); ?>
</header>
<?php
function deleteRestaurant($arrQuery){
	$eventHandler = new EventHandler();
	$eventHandler->deleteRestaurant($arrQuery);
}
?>

<body>

<?php
	deleteRestaurant($_GET);

	header('Location: index.php');
?>

</body>
</html>