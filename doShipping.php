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
    header("Location:shipping.php");
    exit;
}
if(!is_numeric($zip))
{
    $_SESSION["errorMessage"]="You must enter numbers for zip code!";
    header("Location:shipping.php");
    exit;
}
else{
    $_SESSION["errorMessage"]="";
}

include("includes/openDbConn.php");
$sql="SELECT AddressID, Login, Name, Address1, Address2, City, State, Zip FROM shippingaddress WHERE AddressID='".$addressID."' AND Login='".$_SESSION["login"]."' AND Name='".$name."' AND Address1='".$address1."' AND Address2='".$address2."'AND City='".$city."' AND State='".$state."'AND Zip='".$zip."'";
$result=mysqli_query($db,$sql);
if(empty($result)){
    $num_result=0;
}else{
    $num_result=mysqli_num_rows($result);
}
if($num_result!=0){
    $_SESSION["errorMessage"]="The address you entered already exists!";
    header("Location:shipping.php");
    exit;
}else{
    $_SESSION["errorMessage"]="The address has been successfully added!";
}

//Prepare SQL statement
$sql="INSERT INTO shippingaddress (AddressID, Login, Name, Address1, Address2, City, State, Zip) VALUES ('".$addressID."', '".$_SESSION["login"]."', '".$name."', '".$address1."', '".$address2."', '".$city."', '".$state."', '".$zip."')";
//echo $sql;
$result=mysqli_query($db,$sql);
include("includes/closeDbConn.php");
header("Location:shipping.php");
exit;
?>
