<?php
$mode=$_GET["mode"];

if($mode=="ask")
{
    $un=$_GET["username"];
    //connect to the database
    include("includes/openDbconn.php");
    //make sure login doesn't exist
    $sql="SELECT Login FROM p1user WHERE Login='".$un."'";
    //call query
    $result=mysqli_query($db, $sql);
    //check to make sure there is a result
    if(empty($result))
        $num_records=0;
    else
        $num_records=mysqli_num_rows($result);
    //close connect to the database
    include("includes/closeDbConn.php");
    if($num_records==0)
        echo("available");
    else
        echo("not available");
}
?>