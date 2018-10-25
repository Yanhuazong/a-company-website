<?php
    echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
    session_start();
    $id=$_GET["id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; UTF-8" />
    <title>Update shipping page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
    
<body>
<div class="header">
    <div class="navbar" id="navbar">
    <a href="index.php"><img src="logo.png" width="200" height="150" align="left" alt="logo" /></a>
    <ul class="nav">
        <li><a href="index.php">HOME</a></li>
        <li><a class="active" href="shipping.php">SHIPPING</a></li>
        <li><a href="billing.php">BILLING</a></li>
        <li><a href="myaccount.php">MY ACCOUNT</a></li>
        <li><a href="readme.php">READ ME</a></li>
    </ul>
    </div>
</div>
<div class="body">
<?php
    include("includes/openDbConn.php");
    if(empty($_SESSION["login"]))
    {
        echo '<div class="message" style="font-size:30px; color:red; padding:50px;margin-top:100px;">* You can only view this page after <a style="color:red;" href="login.php">login</a>. </div>';
        
    }
    else
    {
        echo '<div class="display">Welcome <a class="link" href="myaccount.php">'.$_SESSION["login"].'</a>&nbsp;&nbsp;<a id="link" href="logout.php">Logout</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>';
    //update address
        
        //Creat a SQL query
        $sql="SELECT AddressID, Name, Address1, Address2, City, State, Zip FROM shippingaddress WHERE AddressID='".$id."'";
        $results=mysqli_query($db,$sql);
    //Check to see if there are records about shipperID 2
        if(empty($results)){
        $num_results=0;
        }
        else{
        $num_results=mysqli_num_rows($results);
        $row=mysqli_fetch_array($results);
        }
 ?>
  <div class="screenright">
    <form id="form2" method="post" action="doupdateshipping.php"> 
        <fieldset id="shipping">
        <legend>Update shipping address</legend>

        <ul id="shippingul">
            <li> <label title="SAddressID" for="SAddressID">Address ID </label> <input type="text" name="SAddressID" id="SAddressID" size="30" maxlength="30" disabled="disabled" value="<?php if($num_results!=0) echo(trim($row["AddressID"]));?>"/><input type="hidden" name="SAddressID" id="SAddressID" size="30" maxlength="30" value="<?php if($num_results!=0) echo(trim($row["AddressID"]));?>"/></li>
            <li> <label title="SAddressID" for="SAddressID">Address ID </label> <input type="text" name="SAddressID" id="SAddressID" size="30" maxlength="30" value="<?php if($num_results!=0) echo(trim($row["AddressID"]));?>"/></li>
            <li> <label title="SName" for="Sname">Name </label> <input type="text" name="Sname" id="Sname" size="30" maxlength="30" value="<?php if($num_results!=0) echo(trim($row["Name"]));?>"/></li>
            <li> <label title="SAddress1" for="Saddress1">Address 1 </label> <input type="text" name="Saddress1" id="Saddress1" size="30" maxlength="30" value="<?php if($num_results!=0) echo(trim($row["Address1"]));?>"/></li>
            <li> <label title="SAddress2" for="Saddress2">Address 2 </label> <input type="text" name="Saddress2" id="Saddress2" size="30" maxlength="30" value="<?php if($num_results!=0) echo(trim($row["Address2"]));?>"/></li>
            <li> <label title="SCity" for="Scity">City </label> <input type="text" name="Scity" id="Scity" size="30" maxlength="30" value="<?php if($num_results!=0) echo(trim($row["City"]));?>"/></li>
            <li> <label title="SState" for="Sstate">State </label> <input type="text" name="Sstate" id="Sstate" size="30" maxlength="30" value="<?php if($num_results!=0) echo(trim($row["State"]));?>"/></li>
            <li> <label title="SZip" for="Szip">Zip Code </label> <input type="text" name="Szip" id="Szip" size="30" maxlength="5" value="<?php if($num_results!=0) echo(trim($row["Zip"]));?>"/></li>

        </ul>
        <div id="errorMsg"><?php if(isset($_SESSION["errorMessage"])){echo($_SESSION["errorMessage"]); unset($_SESSION["errorMessage"]);} ?>

    </div>
            <input id="SubmitBtn" name="SubmitBtn" type="submit" value="Update" />   
    </fieldset>
</form>
 </div> 

 <?php 
    //Get shipping addresses from database
    $sql = "SELECT AddressID, Login, Name, Address1, Address2, City, State, Zip FROM shippingaddress WHERE Login='".$_SESSION["login"]."'";
    $result = mysqli_query($db,$sql);
    if(empty($result))
	$num_results = 0;
   else
	$num_results = mysqli_num_rows($result);
    //Loop through the results
    for( $i=1; $i < $num_results+1; $i++)
    {
        //store a single record into $row 
        $row = mysqli_fetch_array($result);
?>
    <table class="oldshipping">
    <tr>
       <td><?php echo 'Shipping address'.$i;?></td>
    </tr>
    <tr>
       <td><?php echo(trim($row["AddressID"]));?></td>
    </tr>
    <tr>
       <td><?php echo(trim($row["Name"]));?></td>
    </tr>
    <tr>
       <td ><?php echo(trim($row["Address1"]));?></td>
    </tr>
    <tr>
       <td ><?php echo(trim($row["Address2"]));?></td>
    </tr>
    <tr>
       <td><?php echo(trim($row["City"]));?></td>
       <td><?php echo(trim($row["State"]));?></td>
       <td><?php echo(trim($row["Zip"]));?></td>
    </tr>
    <tr>
        <td><a class="shippingbutton" href="updateshipping.php?id=<?php echo(trim($row["AddressID"]));?>">edit</a>|<a class="shippingbutton" href="deleteshipping.php?id=<?php echo(trim($row["AddressID"]));?>">delete</a></td>
    </tr>
    </table>
    <?php
    }
 }
?>
 <?php
//clean u
	include("includes/closeDbConn.php");
?>
</div>
 <script type="text/javascript">
	document.getElementById("SAddressID").focus();
</script>   
</body>
</html>