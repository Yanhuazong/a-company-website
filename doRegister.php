<?php
session_start();
//get the data from the form
$userID=$_POST["UserID"];
$passwd1=$_POST["Passwd"];
$passwd2=$_POST["PasswdConfirm"];
$passwdMatch=false;
$hashed_password = password_hash($passwd1, PASSWORD_DEFAULT);

//check if the form is filled
if(empty($_POST["UserID"])||empty($_POST["Passwd"])||empty($_POST["PasswdConfirm"])||empty($_POST["firstName"])||empty($_POST["lastName"])||empty($_POST["email"]))
{
    $_SESSION["errorMessage"]="* Please complete all the form fields.";
    header("Location:register.php");
    exit;
}
//connect to database
include("includes/openDbconn.php");
if($passwd1==$passwd2)
{
    //check if user is already exists
    $sql="SELECT Login FROM p1user WHERE Login='".$userID."'";
    $result=mysqli_query($db, $sql);
    if(empty($result))
    {
        $num_records=0;
    }
    else
    {
        $num_records=mysqli_num_rows($result);
    }
    if($num_records==0)
    {
        //insert into database
        $sql="INSERT INTO p1user(Login, FirstName, LastName, Passwd, Email, NewsLetter)";        $sql.="VALUES('".$userID."','".$_POST["firstName"]."','".$_POST["lastName"]."','".$hashed_password."','";        $sql.=$_POST["email"]."','".$_POST["option"]."')";

        $result=mysqli_query($db, $sql);
        //message to user
        $_SESSION["errorMessage"]="*User added successfully.";
        $_SESSION["login"]=$userID;
        //set password match to true
        $passwdMatch=true;
    }
    else
    {
        //messgae to user
        $_SESSION["errorMessage"]="* User already exists in the database.";
        $passwdMatch=false;
    }
}
else
{
    //let user know passwords do not match
    $_SESSION["errorMessage"]="The two passwords you entered do not match.";
    $passwdMatch=false;
}

//close connect to the database
include("includes/closeDbConn.php");

if($passwdMatch)
{
    CleanUp();
    //redirect to success
    header("Location:index.php");
    exit;
}
else
{
    CleanUp();
    //redirect back to new account
    header("Location:register.php");
    exit;
}

//clear variables
function CleanUp()
{
    $userID="";
    $passwd1="";
    $passwd2="";
    $passwdMatch="";
    $sql="";
    $result="";
}
?>