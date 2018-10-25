<?php
//start session
session_start();
$_SESSION["errorMessage"]="";
include("includes/openDbConn.php");
//get data from the form
$userID=$_POST["username"];
$passwd=$_POST["password"];

$sql="SELECT * FROM p1user WHERE Login='".$userID."'";
$result=mysqli_query($db,$sql);
//check to make sure there is a result
if(empty($result))
{
    $num_result=0;
}else
{
    $num_result=mysqli_num_rows($result);
}
//echo $num_result;

if($num_result==0){
    Cleanup();
   $_SESSION["errorMessage"]="This user doesn't exist!";
    header("Location:login.php");
    exit;
}else
{   for($i=0; $i < $num_result; $i++)
    {
    $row = mysqli_fetch_array($result);
    }
    if(password_verify($passwd,$row["Passwd"]))
    {
    Cleanup();
    $_SESSION["errorMessage"] = "You have successfully logged in.";
    $_SESSION["login"]=$userID;
    header("Location:index.php");
    exit;
    }else{
   Cleanup();
    $_SESSION["errorMessage"]="The password is not correct. Please try again!";
     header("Location:login.php");
    exit;
    }
}
include("includes/closeDbConn.php");



//Cleanup() function
function Cleanup()
{
    $userID="";
    $passwd="";
    $sql="";
    $result="";
    $num_records="";
}

?>