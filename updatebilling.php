<?php
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
session_start();
$id=$_GET["id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; UTF-8" />
    <title>Update billing page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
    
<body>
<div class="header">
    <div class="navbar" id="navbar">
    <a href="index.php"><img src="logo.png" width="200" height="150" align="left" alt="logo" /></a>
    <ul class="nav">
        <li><a href="index.php">HOME</a></li>
        <li><a href="shipping.php">SHIPPING</a></li>
        <li><a class="active" href="billing.php">BILLING</a></li>
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
    echo '<div class="message" style="font-size:30px; color:white; padding:50px;">New user? please <a href="register.php">register</a>. </div>';
    
}
else
{
   echo '<div class="display">Welcome <a class="link" href="myaccount.php">'.$_SESSION["login"].'</a>&nbsp;&nbsp;<a id="link" href="logout.php">Logout</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>';
    include("includes/encryption.php");
	//update address
     
    //Creat a SQL query
    $sql="SELECT BillingID, Login, BillName,BillAddress1,BillAddress2,BillCity,BillState,BillZip,CardType,CardNumber,ExpDate FROM billinginfo WHERE BillingID='".$id."'";
    $results=mysqli_query($db,$sql);
   //Check to see if there are records about shipperID 2
    if(empty($results)){
    $num_results=0;
    }
    else{
    $num_results=mysqli_num_rows($results);
    $row=mysqli_fetch_array($results);
    $bnumber_decrypted = my_decrypt($row["CardNumber"], $key);
    }
 ?>
  <div class="screenright">
 	<form id="form2" method="post" action="doupdatebilling.php"> 
        <fieldset id="billing">
        <legend>Update billing address</legend>

        <ul id="billingul">
            <li> <label title="BAddressID" for="BAddressID">Billing Address ID </label> <input type="text" name="BAddressID" id="BAddressID" size="30" maxlength="30" disabled="disabled" value="<?php if($num_results!=0) echo(trim($row["BillingID"]));?>"/><input type="hidden" name="BAddressID" id="BAddressID" size="30" maxlength="30" value="<?php if($num_results!=0) echo(trim($row["BillingID"]));?>"/></li>
            <li> <label title="BName" for="Bname">Name </label> <input type="text" name="Bname" id="Bname" size="30" maxlength="30" value="<?php if($num_results!=0) echo(trim($row["BillName"]));?>"/></li>
            <li> <label title="BAddress1" for="Baddress1">Address 1 </label> <input type="text" name="Baddress1" id="Baddress1" size="30" maxlength="30" value="<?php if($num_results!=0) echo(trim($row["BillAddress1"]));?>"/></li>
            <li> <label title="BAddress2" for="Baddress2">Address 2 </label> <input type="text" name="Baddress2" id="Baddress2" size="30" maxlength="30" value="<?php if($num_results!=0) echo(trim($row["BillAddress2"]));?>"/></li>
            <li> <label title="BCity" for="Bcity">City </label> <input type="text" name="Bcity" id="Bcity" size="30" maxlength="30" value="<?php if($num_results!=0) echo(trim($row["BillCity"]));?>"/></li>
            <li> <label title="BState" for="Bstate">State </label> <input type="text" name="Bstate" id="Bstate" size="30" maxlength="30" value="<?php if($num_results!=0) echo(trim($row["BillState"]));?>"/></li>
            <li > <label title="BZip" for="Bzip">Zip Code </label> <input type="text" name="Bzip" id="Bzip" size="30" maxlength="5" value="<?php if($num_results!=0) echo(trim($row["BillZip"]));?>"/></li>
            <li> <label title="BCardType" for="BCardType">Card type </label> <select name="Boption" id="Boption" >
                <option value="VISA" <?php if($num_results!=0&&$row["CardType"]=="VISA") echo ' selected="selected"';?>>VISA</option>
                <option value="American Express" <?php if($num_results!=0&&$row["CardType"]=="American Express") echo ' selected="selected"';?>>American Express</option>
                <option value="MasterCard" <?php if($num_results!=0&&$row["CardType"]=="Master") echo ' selected="selected"';?>>MasterCard</option>
                <option value="Discover" <?php if($num_results!=0&&$row["CardType"]=="Discover") echo ' selected="selected"';?>>Discover</option>
              </select></li>
              <li> <label title="BNumber" for="BNumber">Card number </label> <input type="text" name="Bnumber" id="Bnumber" size="30" maxlength="30" value="<?php if($num_results!=0) echo $bnumber_decrypted; ?>"/></li>
              <li> <label title="BExp" for="BExp">Exp. Date </label><input type="text" name="BExp" id="BExp" size="30" maxlength="4" value="<?php if($num_results!=0) echo(trim($row["ExpDate"]));?>"/> </li>

        </ul>
        <div id="errorMsg"><?php if(isset($_SESSION["errorMessage"])){echo($_SESSION["errorMessage"]); unset($_SESSION["errorMessage"]);} ?>

    </div>
            <input id="SubmitBtn" name="SubmitBtn" type="submit" value="Update" />   
    </fieldset>
</form>
</div>
   
<?php
    //Get shipping addresses from database
    $sql = "SELECT BillingID, Login, BillName,BillAddress1,BillAddress2,BillCity,BillState,BillZip,CardType,CardNumber,ExpDate FROM billinginfo WHERE Login='".$_SESSION["login"]."'";
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
        $bnumber_decrypted = my_decrypt($row["CardNumber"], $key);
?>
   
    <table class="oldbilling">
    <tr >
       <td><?php echo 'Billing address '.$i;?></td>
    </tr>
    <tr>
       <td><?php echo(trim($row["BillingID"]));?></td>
    </tr>
    <tr>
       <td><?php echo(trim($row["BillName"]));?></td>
    </tr>
    <tr>
       <td ><?php echo(trim($row["BillAddress1"]));?></td>
    </tr>
    <tr>
       <td ><?php echo(trim($row["BillAddress2"]));?></td>
    </tr>
    <tr>
       <td><?php echo(trim($row["BillCity"]));?></td>
       <td><?php echo(trim($row["BillState"]));?></td>
       <td><?php echo(trim($row["BillZip"]));?></td>
    </tr>
    <tr style="height:30px;">
       <td><?php echo(trim($row["CardType"]));?></td>
    </tr>
    <tr>
       <td><?php echo str_repeat("x", (strlen($bnumber_decrypted) - 4)).substr($bnumber_decrypted,-4,4);?></td>
    </tr>
    <tr>
       <td><?php echo(trim($row["ExpDate"]));?></td>
    </tr>
    <tr style="height:30px;">
        <td><a class="shippingbutton" href="updatebilling.php?id=<?php echo(trim($row["BillingID"]));?>">edit</a>|<a class="shippingbutton" href="deletebilling.php?id=<?php echo(trim($row["BillingID"]));?>">delete</a></td>
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
	document.getElementById("BAddressID").focus();
</script>   
</body>
</html>