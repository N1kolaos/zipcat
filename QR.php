<?php
require './config/init.php';
require './config/connect.php';
require './includes/phpqrcode.php';

if(isset($_GET['code'])){
	$code=$_GET['code'];
	if(valid_code($code) && mysql_num_rows(mysql_query("SELECT url FROM urls WHERE code='$code' AND(expiration IS NULL OR expiration >=CURRENT_DATE)"))===1){
			header('content-type: image/png');
			$QR=QRcode::png("http://zipc.at/$code");
	}else{
		header('Location: ../?invalid_code');exit;}
}else{
	header('Location: ../.');exit;}
?>
