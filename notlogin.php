<?php
	echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
session_start();
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; UTF-8" />
    <title>Initial page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  
</head>
    
<body>
<div class="header">
    <div class="navbar" id="navbar">
    <a href="index.php"><img src="logo.png" width="200" height="150" align="left" alt="logo" /></a>
    <ul class="nav">
        <li><a href="index.php">HOME</a></li>
        <li><a href="notlogin.php">SHIPPING</a></li>
        <li><a href="notlogin.php">BILLING</a></li>
        <li><a href="notlogin.php">MY ACCOUNT</a></li>
        <li><a href="readme.php">READ ME</a></li>
    </ul>
    </div>
</div>
<div class="body">
   <p id="notlogin">You must <a href="login.php">login</a> to view this page.</p>
    <div class="message">New user: please <a href="register.php">register</a>. </div>
</div>
       
    
</body>
</html>