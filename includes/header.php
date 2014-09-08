<!DOCTYPE html>
<html>
<head>
<title>Zip Cat</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
<h1 id="zipcat"><a href="." style="color:black;text-decoration:none;"><img id="cat" src="./Black-Cat-icon.png">ZipC.at</a></h1><a id="contact" href="./contact.php" target="_blank">Contact me!</a>
<div id="wrapper">
<?php
if(isset($_GET['invalid_url']))
	echo '<p class="caution">Invalid URL .</p>';
else if(isset($_GET['exists']))
	echo '<p class="caution">Customized code alredy exists.</p>';
else if(isset($_GET['negative']))
	echo '<p class="caution">Days can\'t be negative</p>';
else if(isset($_GET['invalid_code']))
	echo '<p class="caution">Customized code is invalid.</p>';
else if(isset($_GET['passwd']))
	echo '<p class="caution">Invalid password.</p>';
else if(isset($_GET['long_riddle']))
	echo '<p class="caution">Riddle too long.</p>';
else
	echo '<br>';
?>

