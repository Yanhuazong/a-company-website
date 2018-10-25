<?php 
//Use session object
session_start();

$bID = $_POST["BAddressID"];
$bname=$_POST["Bname"];
$baddress1=$_POST["Baddress1"];
$baddress2=$_POST["Baddress2"];
$bcity=$_POST["Bcity"];
$bstate=$_POST["Bstate"];
$bzip=$_POST["Bzip"];
$btype=$_POST["Boption"];
$bnumber=$_POST["Bnumber"];
$bexp=$_POST["BExp"];

if($bID==""||$bname==""||$baddress1==""||$baddress2==""||$bcity==""||$bstate==""||$bzip==""||$btype=="selected"||$bnumber==""||$bexp=="")
{
    $_SESSION["errorMessage"]="You must enter a value for all boxes!";
    header("Location:updatebilling.php?id=$bID");
    exit;
}
if(!is_numeric($bzip)||!is_numeric($bnumber)||!is_numeric($bexp))
{
    $_SESSION["errorMessage"]="You must enter numbers for zip code or card number or Exp. date!";
    header("Location:updatebilling.php?id=$bID");
    exit;
}
else
{
   $_SESSION["errorMessage"]="You have successfully updated the address!";  
}

include("includes/openDbConn.php");
include("includes/encryption.php");

$bnumber_encrypted = my_encrypt($bnumber, $key);
$sql="UPDATE billinginfo SET BillName ='".$bname."',BillAddress1='".$baddress1."',BillAddress2='".$baddress2."',BillCity='".$bcity."',BillState='".$bstate."',BillZip='".$bzip."',CardType='".$btype."',CardNumber='".$bnumber_encrypted."',ExpDate='".$bexp."' WHERE BillingID='".$bID."'";

//echo $sql;
    
$result=mysqli_query($db,$sql);
include("includes/closeDbConn.php");

header("Location:billing.php");
?>
