<?php
	echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
    session_start();	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; UTF-8" />
    <title>My account page</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
    
<body>
<div class="header">
    <div class="navbar" id="navbar">
    <a href="index.php"><img src="logo.png" width="200" height="150" align="left" alt="logo" /></a>
    <ul class="nav">
        <li><a href="index.php">HOME</a></li>
        <li><a href="shipping.php">SHIPPING</a></li>
        <li><a href="billing.php">BILLING</a></li>
        <li><a class="active" href="myaccount.php">MY ACCOUNT</a></li>
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
        $sql="SELECT Login, FirstName, LastName, Passwd, Email, NewsLetter FROM p1user WHERE Login='".$_SESSION["login"]."'";
        $result=mysqli_query($db, $sql);
        if(empty($result))
        {
            $num_records=0;
        }
        else
        {
            $num_records=mysqli_num_rows($result);
                $row=mysqli_fetch_array($result);
        }
?>
        
    
<form id="form0" method="post" action="doUpdate.php"> 
    <fieldset id="register">
        <legend>Update My Account</legend>
        <ul id="registerul">
            <li> <label title="UserID" for="UserID">Username <span>*</span></label> <input type="text" name="UserID" id="UserID" size="30" maxlength="30" disabled="disabled" value="<?php if($num_records!=0) echo(trim($row["Login"]));?>"/></li>
         
            <li> <label title="FirstName" for="FirstName">First name <span>*</span></label> <input type="text" name="firstName" id="firstName" size="30" maxlength="30" value="<?php if($num_records!=0) echo(trim($row["FirstName"]));?>"/></li>
            <li> <label title="LastName" for="LastName">Last name <span>*</span></label> <input type="text" name="lastName" id="lastName" size="30" maxlength="30" value="<?php if($num_records!=0) echo(trim($row["LastName"]));?>"/></li>
            <li> <label title="Passwd" for="Passwd">Password <span>*</span></label> <input type="text" name="Passwd" id="Passwd" size="30" maxlength="30" placeholder="Please enter your new password"/></li>
            <li> <label title="PasswdConfirm" for="PasswdConfirm">Confirm Password <span>*</span></label> <input type="text" name="PasswdConfirm" id="PasswdConfirm" size="30" maxlength="30" placeholder="Please confirm your new password"/></li>
            <li> <label title="Email" for="email">Email <span>*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></label> <input type="text" name="email" id="email" size="30" maxlength="30" value="<?php if($num_records!=0) echo(trim($row["Email"]));?>" placeholder="aaa@aaa.aaa"/></li>
            <li> <label title="Newsletter" for="Newsletter">Newsletter <span>*</span></label><select name="option" id="option">
                <option value="Yes" <?php if($num_records!=0&&$row["NewsLetter"]=="Yes") echo ' selected="selected"';?>>Yes</option>
                <option value="No" <?php if($num_records!=0&&$row["NewsLetter"]=="No") echo ' selected="selected"';?>>No</option>

              </select></li>
        </ul>
    <div id="errorMsgregister"><?php if(!empty($_SESSION["errorMessage"])){echo($_SESSION["errorMessage"]);unset($_SESSION["errorMessage"]);} ?></div>
        <input id="SubmitBtnregister" name="SubmitBtn" type="submit" value="Update account" />
    </fieldset>
</form>
 <?php
   echo '<div class="display">Welcome <a class="link" href="myaccount.php">'.$_SESSION["login"].'</a>&nbsp;&nbsp;<a id="link" href="logout.php">Logout</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>';
    }
?>
<?php
	include("includes/closeDbConn.php");
?>
<script type="text/javascript">
	document.getElementById("firstName").focus();
</script>
</div>
</body>
</html>