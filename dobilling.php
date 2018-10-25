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
    header("Location:billing.php");
    exit;
}
if(!is_numeric($bzip)||!is_numeric($bnumber)||!is_numeric($bexp))
{
    $_SESSION["errorMessage"]="You must enter numbers for zip code or card number or Exp. date!";
    header("Location:billing.php");
    exit;
}
else{
    $_SESSION["errorMessage"]="";
}

include("includes/openDbConn.php");
include("includes/encryption.php");

$bnumber_encrypted = my_encrypt($bnumber, $key);

$sql="SELECT BillingID, Login, BillName,BillAddress1,BillAddress2,BillCity,BillState,BillZip,CardType,CardNumber,ExpDate FROM billinginfo WHERE BillingID='".$bID."' AND Login='".$_SESSION["login"]."' AND BillName='".$bname."' AND BillAddress1='".$baddress1."' AND BillAddress2='".$baddress2."'AND BillCity='".$bcity."' AND BillState='".$bstate."'AND BillZip='".$bzip."' AND CardType='".$btype."' AND CardNumber='".$bnumber_encrypted."' AND ExpDate='".$bexp."'";
$result=mysqli_query($db,$sql);
if(empty($result)){
    $num_result=0;
}else{
    $num_result=mysqli_num_rows($result);
}
if($num_result!=0){
    $_SESSION["errorMessage"]="The billing address you entered already exists!";
    header("Location:billing.php");
    exit;
}else{
    $_SESSION["errorMessage"]="The billing address has been successfully added!";
}

//Prepare SQL statement
$sql="INSERT INTO billinginfo (BillingID, Login, BillName,BillAddress1,BillAddress2,BillCity,BillState,BillZip,CardType,CardNumber,ExpDate) VALUES ('".$bID."', '".$_SESSION["login"]."', '".$bname."', '".$baddress1."', '".$baddress2."', '".$bcity."', '".$bstate."', '".$bzip."', '".$btype."', '".$bnumber_encrypted."', '".$bexp."')";
//echo $sql;
$result=mysqli_query($db,$sql);
include("includes/closeDbConn.php");
header("Location:billing.php");
exit;
?>
