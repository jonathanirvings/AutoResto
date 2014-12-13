<html>
<header>
	<?php include("htmlHeader.php"); ?>
</header>
<?php
function deleteCustomer($arrQuery){
	$eventHandler = new EventHandler();
	$eventHandler->deleteCustomer($arrQuery);
}
?>

<body>

<?php
	deleteCustomer($_GET);

	header('Location: customer_list_admin.php');
?>

</body>
</html>