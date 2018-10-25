<?php 
//Use session object
session_start();

$addressID = $_POST["SAddressID"];
$name=$_POST["Sname"];
$address1=$_POST["Saddress1"];
$address2=$_POST["Saddress2"];
$city=$_POST["Scity"];
$state=$_POST["Sstate"];
$zip=$_POST["Szip"];
if($addressID==""||$name==""||$address1==""||$address2==""||$city==""||$state==""||$zip=="")
{
    $_SESSION["errorMessage"]="You must enter a value for all boxes!";
    header("Location:updateshipping.php?id=$addressID");
    exit;
}
if(!is_numeric($zip))
{
    $_SESSION["errorMessage"]="You must enter numbers for zip code!";
    header("Location:updateshipping.php?id=$addressID");
    exit;
}
else
{
   $_SESSION["errorMessage"]="You have successfully updated the address!";  
}

include("includes/openDbConn.php");
$sql="UPDATE shippingaddress SET Name='".$name."', Address1='".$address1."', Address2='".$address2."', City='".$city."', State='".$state."', Zip='".$zip."' WHERE AddressID='".$addressID."'";
//echo $sql;
    
$result=mysqli_query($db,$sql);
include("includes/closeDbConn.php");

header("Location:shipping.php");
?>
