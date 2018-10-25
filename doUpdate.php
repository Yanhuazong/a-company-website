<?php 
//Use session object
session_start();

//$userID=$_POST["UserID"];
$passwd1=$_POST["Passwd"];
$passwd2=$_POST["PasswdConfirm"];
$passwdMatch=false;
$hashed_password = password_hash($passwd1, PASSWORD_DEFAULT);
//check if the form is filled
if(empty($_POST["Passwd"])||empty($_POST["PasswdConfirm"])||empty($_POST["firstName"])||empty($_POST["lastName"])||empty($_POST["email"]))
{
    $_SESSION["errorMessage"]="* Please complete all the form fields.";
    header("Location:myaccount.php");
    exit;
}
//connect to database
include("includes/openDbconn.php");
if($passwd1!=$passwd2)
{
    $_SESSION["errorMessage"]="* The two passwords you entered do not match.";
     header("Location:myaccount.php");
    exit;
}
else
{
    //let user know passwords do not match
     $_SESSION["errorMessage"]="Your account information has been successfully updated.";
}


include("includes/openDbConn.php");
$sql="UPDATE p1user SET FirstName='".$_POST["firstName"]."', LastName='".$_POST["lastName"]."', Passwd='".$hashed_password."', Email='".$_POST["email"]."', NewsLetter='".$_POST["option"]."' WHERE Login='".$_SESSION["login"]."'";
//echo $sql;
//exit;    
$result=mysqli_query($db,$sql);
include("includes/closeDbConn.php");

header("Location:index.php");
?>
