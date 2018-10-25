<?php 
//Use session object
session_start();
$id=$_GET["id"];
include("includes/openDbConn.php");
$sql="DELETE FROM billinginfo WHERE BillingID='".$id."'";

$result=mysqli_query($db,$sql);
include("includes/closeDbConn.php");
$_SESSION["errorMessage"]="The billing address has been successfully deleted.";
header("Location:billing.php");
?>
