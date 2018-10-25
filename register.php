<?php
	echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
session_start();
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; UTF-8" />
    <title>Register page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="includes/checkUserID.js"></script>
    <script type="text/javascript">
        window.onload=function(){
        document.getElementById("UserID").onchange=checkUsernameAvailability;
        };
    </script>
</head>
    
<body>
<div class="header">
    <div class="navbar" id="navbar">
    <a href="index.php"><img src="logo.png" width="200" height="150" align="left" alt="logo" /></a>
    <ul class="nav">
        <li><a href="index.php">HOME</a></li>
        <li><a href="shipping.php">SHIPPING</a></li>
        <li><a href="billing.php">BILLING</a></li>
        <li><a href="myaccount.php">MY ACCOUNT</a></li>
        <li><a href="readme.php">READ ME</a></li>
    </ul>
    </div>
</div>
<div class="body">
<form id="form0" method="post" action="doRegister.php"> 
    <fieldset id="register">
        <legend>Create New Account</legend>
        <ul id="registerul">
            <li> <label title="UserID" for="UserID">Username <span>*</span></label> <input type="text" name="UserID" id="UserID" size="30" maxlength="30" /></li>
            <li ><span id="usernameAvailability" class="checkID"> </span></li>
            <li> <label title="FirstName" for="FirstName">First name <span>*</span></label> <input type="text" name="firstName" id="firstName" size="30" maxlength="30" /></li>
            <li> <label title="LastName" for="LastName">Last name <span>*</span></label> <input type="text" name="lastName" id="lastName" size="30" maxlength="30" /></li>
            <li> <label title="Passwd" for="Passwd">Password <span>*</span></label> <input type="text" name="Passwd" id="Passwd" size="30" maxlength="30" /></li>
            <li> <label title="PasswdConfirm" for="PasswdConfirm">Confirm Password <span>*</span></label> <input type="text" name="PasswdConfirm" id="PasswdConfirm" size="30" maxlength="30" /></li>
            <li> <label title="Email" for="email">Email <span>*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></label> <input type="email" name="email" id="email" size="30" maxlength="30" placeholder="aaa@aaa.aaa"/></li>
            <li> <label title="Newsletter" for="Newsletter">Newsletter <span>*</span></label><select name="option" id="option">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select></li>
        </ul>
    <div id="errorMsgregister"><?php if(!empty($_SESSION["errorMessage"])){echo($_SESSION["errorMessage"]);unset($_SESSION["errorMessage"]);} ?></div>
        <input id="SubmitBtnregister" name="SubmitBtn" type="submit" value="Create New Account" />
    </fieldset>
</form>


<div class="message">Returning user: please <a href="login.php">login</a>. </div>
</div>
<script type="text/javascript">
	document.getElementById("UserID").focus();
</script>

</body>
</html>
