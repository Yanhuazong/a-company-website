<?php 
//Use session object
session_start();
$id=$_GET["id"];
include("includes/openDbConn.php");
$sql="DELETE FROM shippingaddress WHERE AddressID='".$id."'";

$result=mysqli_query($db,$sql);
include("includes/closeDbConn.php");
$_SESSION["errorMessage"]="The shipping address has been successfully deleted.";
header("Location:shipping.php");
?>
