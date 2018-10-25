<?php
	echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
session_start();
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; UTF-8" />
    <title>Readme page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    
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
        <li><a class="active" href="readme.php">READ ME</a></li>
 
    </ul>
    </div>
</div>
    

<div class="body">
   <?php
    if(empty($_SESSION["login"]))
    {
    echo '<div class="message" style="font-size:30px; color:red; padding:50px;margin-top:100px;">* You can only view this page after <a style="color:red;" href="login.php">login</a>. </div>';
    echo '<div class="message" style="font-size:30px; color:white; padding:50px;">New user? please <a href="register.php">register</a>. </div>';
    
    }else{
        echo '<h2>CGT356 Project 1</h2><br><h3>Yanhua Zong</h3>';
echo '<div class="display">Welcome <a class="link" href="myaccount.php">'.$_SESSION["login"].'</a>&nbsp;&nbsp;<a id="link" href="logout.php">Logout</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>';
      }  ?>
</div>
 
    
</body>
</html>