<?php
	echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
session_start();
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; UTF-8" />
    <title>Login page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
    
<body>
<div class="header">
    <div class="navbar" id="navbar">
    <a href="index.php"><img src="logo.png" width="200" height="200" align="left" alt="logo" /></a>
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
<form id="form0" method="post" action="doLogin.php"> 
    <fieldset id="info">
        <legend>Login</legend>

            <ul id="login">
                <li><label title="Username" for="username">Username</label><input type="text" name="username" id="username" size="30" maxlength="15" value="" /></li>
                <li><label title="Password" for="password">Password</label><input type="password" name="password" id="password" size="30" maxlength="60" value="" /></li>
            </ul>
            <div id="errorMsg"><?php if(isset($_SESSION["errorMessage"])){echo($_SESSION["errorMessage"]); unset($_SESSION["errorMessage"]);} ?></div>
            <input id="SubmitBtn" name="SubmitBtn" type="submit" value="Login" />   
    </fieldset>
</form>

<div class="message">New user: please <a href="register.php">register</a>. </div>
</div>    
 <script type="text/javascript">
	document.getElementById("username").focus();
</script>   
</body>
</html>